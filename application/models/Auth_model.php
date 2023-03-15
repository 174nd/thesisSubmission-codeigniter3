<?php
defined('BASEPATH') or exit('No direct script access allowed');
// date_default_timezone_set("Asia/Jakarta");

class Auth_model extends CI_Model
{
  public function logMeIn()
  {
    $this->db->select('*, IF(user.akses="mahasiswa",(SELECT nm_mahasiswa FROM mahasiswa WHERE mahasiswa.id_user=user.id_user), IF(user.akses="dosen",(SELECT nm_dosen FROM dosen WHERE dosen.id_user=user.id_user),user.nm_user)) AS nama_user');
    $user = $this->db->get_where('user', [
      'username' => $this->input->post('username'),
      'password' => $this->input->post('password'),
    ]);
    if ($user->num_rows() > 0) {
      $user = $user->row_array();
      $data = [
        'id_user'   => $user['id_user'],
        'username'  => $user['username'],
        'password'  => $user['password'],
        'nm_user'   => $user['nama_user'],
        'foto_user' => $user['foto_user'],
        'akses'     => $user['akses'],
      ];
      $this->session->set_userdata($data);
      if ($data['akses'] == 'admin') {
        redirect('admin');
      } else if ($data['akses'] == 'dosen') {
        redirect('dosen');
      } else if ($data['akses'] == 'mahasiswa') {
        redirect('mahasiswa');
      } else {
        redirect('auth/error');
      }
    } else {
      $this->session->set_flashdata('alert', ['danger', 'icon fas fa-exclamation-triangle', 'Log-In Gagal!', 'Username / Password Salah!']);
      redirect();
    }
  }

  public function logMeOut()
  {
    $this->session->unset_userdata('id_user');
    $this->session->unset_userdata('username');
    $this->session->unset_userdata('password');
    $this->session->unset_userdata('nm_user');
    $this->session->unset_userdata('foto_user');
    $this->session->unset_userdata('akses');
    redirect();
  }

  public function uploadPhotoUser()
  {
    $upload_image = $_FILES['foto_user']['name'];
    if ($upload_image) {
      $config['allowed_types'] = 'gif|jpg|png';
      $config['upload_path'] = './uploads/users/';
      $config['max_size']     = '2048';
      $this->load->library('upload', $config);
      if ($this->upload->do_upload('foto_user')) {
        $hasil_foto = $this->upload->data('file_name');
        if ($this->db->update('user', ['foto_user' => $hasil_foto], ['id_user' => $this->session->userdata('id_user')])) {
          if ($this->session->userdata('foto_user') != '') unlink(FCPATH . 'uploads/users/' . $this->session->userdata('foto_user'));
          $this->session->set_userdata(['foto_user'  => $hasil_foto]);
          $this->session->set_flashdata('alert', ['success', 'icon fas fa-check', 'Data Berhasil di Ubah!', 'Data berhasil Diubah dari Database!']);
          // redirect();
          redirect($this->uri->uri_string());
        } else {
          $this->session->set_flashdata('alert', ['danger', 'icon fas fa-exclamation-triangle', 'Data Gagal di Eksekusi!', 'Ada kesalahan pada query, Silahkan cek lagi!!']);
          // redirect();
          redirect($this->uri->uri_string());
        }
      } else {
        $this->session->set_flashdata('alert', ['danger', 'icon fas fa-exclamation-triangle', 'Error!', $this->upload->display_errors()]);
        // redirect();
        redirect($this->uri->uri_string());
      }
    }
  }

  public function changePasswordUser()
  {
    if ($this->db->get_where('user', [
      'id_user'  => $this->session->userdata('id_user'),
      'username' => $this->session->userdata('username'),
      'password' => $this->input->post('old_pass'),
    ])->num_rows() > 0) {
      if ($this->input->post('new_pass1') == $this->input->post('new_pass2')) {
        if ($this->db->update('user', ['password' => $this->input->post('new_pass1')], ['id_user' => $this->session->userdata('id_user')])) {
          $this->session->set_userdata(['password'  => $this->input->post('new_pass1')]);
          $this->session->set_flashdata('alert', ['success', 'icon fas fa-check', 'Data Berhasil di Ubah!', 'Data berhasil Diubah dari Database!']);
          // redirect();
          redirect($this->uri->uri_string());
        } else {
          $this->session->set_flashdata('alert', ['danger', 'icon fas fa-exclamation-triangle', 'Data Gagal di Simpan!', 'Ada kesalahan pada query, Silahkan cek lagi!!']);
          // redirect();
          redirect($this->uri->uri_string());
        }
      } else {
        $this->session->set_flashdata('alert', ['danger', 'icon fas fa-exclamation-triangle', 'Kesalahan!', 'Password Baru Berbeda / Tidak Sama!']);
        // redirect();
        redirect($this->uri->uri_string());
      }
    } else {
      $this->session->set_flashdata('alert', ['danger', 'icon fas fa-exclamation-triangle', 'Kesalahan!', 'Password yang Anda Masukan Salah!']);
      // redirect();
      redirect($this->uri->uri_string());
    }
  }
}
