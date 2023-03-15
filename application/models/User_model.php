<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
  public function insertUser($get_return = null, $get_redirect = null)
  {
    $return = $get_return == null ? uri_string() : $get_return;
    $redirect = $get_redirect == null ? uri_string() : $get_redirect;

    $id_user = getAutoIncrement('user');

    $data = [
      'username' => $this->input->post('username'),
      'password' => $this->input->post('password'),
      'akses'    => $this->input->post('akses'),
    ];

    if ($_FILES['foto_user']['name']) {
      $config['allowed_types'] = 'gif|jpg|png';
      $config['upload_path'] = './uploads/users/';
      $config['max_size']     = '2048';
      $this->load->library('upload', $config);
      if ($this->upload->do_upload('foto_user')) {
        $data['foto_user'] = $this->upload->data('file_name');
      } else {
        $this->session->set_flashdata('alert', ['danger', 'icon fas fa-exclamation-triangle', 'Error!', $this->upload->display_errors()]);
        redirect($redirect);
      }
    }
    if ($data['akses'] == 'admin') {
      $data['nm_user'] = $this->input->post('nm_user');
      $query = $this->db->insert('user', $data);
    } else if ($data['akses'] == 'dosen') {
      $query = $this->db->insert('user', $data) && $this->db->update('dosen', ['id_user' => $id_user], ['id_dosen' => $this->input->post('id_dosen')]);
    } else {
      $query = $this->db->insert('user', $data) && $this->db->update('mahasiswa', ['id_user' => $id_user], ['id_mahasiswa' => $this->input->post('id_mahasiswa')]);
    }



    if ($query) {
      $this->session->set_flashdata('alert', ['success', 'icon fas fa-check', 'Data Berhasil di Simpan!', 'Data berhasil Disimpan dari Database!']);
      redirect($return);
    } else {
      $this->session->set_flashdata('alert', ['danger', 'icon fas fa-exclamation-triangle', 'Data Gagal di Eksekusi!', 'Ada kesalahan pada query, Silahkan cek lagi!!']);
      redirect($redirect);
    }
  }

  public function updateUser($id_user, $get_return = null, $get_redirect = null)
  {
    $return = $get_return == null ? uri_string() : $get_return;
    $redirect = $get_redirect == null ? uri_string() : $get_redirect;
    $user = $this->db->get_where('user', ['id_user' => $id_user])->row_array();

    $data = [
      'username' => $this->input->post('username'),
      'password' => $this->input->post('password'),
      'akses'    => $this->input->post('akses'),
    ];

    if ($_FILES['foto_user']['name']) {
      $config['allowed_types'] = 'gif|jpg|png';
      $config['upload_path'] = './uploads/users/';
      $config['max_size']     = '2048';
      $this->load->library('upload', $config);
      if ($this->upload->do_upload('foto_user')) {
        $data['foto_user'] = $this->upload->data('file_name');
      } else {
        $this->session->set_flashdata('alert', ['danger', 'icon fas fa-exclamation-triangle', 'Error!', $this->upload->display_errors()]);
        redirect($redirect);
      }
    }


    $query = $user['akses'] == 'dosen' ? $this->db->update('dosen', ['id_user' => null], ['id_user' => $id_user]) : ($user['akses'] == 'mahasiswa' ? $this->db->update('mahasiswa', ['id_user' => null], ['id_user' => $id_user]) : null);

    if ($data['akses'] == 'admin') {
      $data['nm_user'] = $this->input->post('nm_user');
      $query .= $this->db->update('user', $data, ['id_user' => $id_user]);
    } else if ($data['akses'] == 'dosen') {
      $query .= $this->db->update('user', $data, ['id_user' => $id_user]) && $this->db->update('dosen', ['id_user' => $id_user], ['id_dosen' => $this->input->post('id_dosen')]);
    } else {
      $query .= $this->db->update('user', $data, ['id_user' => $id_user]) && $this->db->update('mahasiswa', ['id_user' => $id_user], ['id_mahasiswa' => $this->input->post('id_mahasiswa')]);
    }


    if ($query) {
      if ($user['foto_user'] != '') unlink(FCPATH . 'uploads/users/' . $user['foto_user']);
      $this->session->set_flashdata('alert', ['success', 'icon fas fa-check', 'Data Berhasil di Ubah!', 'Data berhasil Diubah dari Database!']);
      redirect($return);
    } else {
      if ($data['foto_user'] != '') unlink(FCPATH . 'uploads/users/' . $data['foto_user']);
      $this->session->set_flashdata('alert', ['danger', 'icon fas fa-exclamation-triangle', 'Data Gagal di Eksekusi!', 'Ada kesalahan pada query, Silahkan cek lagi!!']);
      redirect($redirect);
    }
  }

  public function deleteUser($id_user, $get_return = null)
  {
    $return = $get_return == null ? uri_string() : $get_return;

    $user = $this->db->get_where('user', ['id_user' => $id_user]);
    if ($user->num_rows() > 0) {
      $data = $user->row_array();

      if ($data['akses'] == 'admin') {
        $query = $this->db->delete('user', ['id_user' => $id_user]);
      } else if ($data['akses'] == 'dosen') {
        $query = $this->db->delete('user', ['id_user' => $id_user]) && $this->db->update('dosen', ['id_user' => null], ['id_user' => $id_user]);
      } else {
        $query = $this->db->delete('user', ['id_user' => $id_user]) && $this->db->update('mahasiswa', ['id_user' => null], ['id_user' => $id_user]);
      }

      if ($query) {
        if ($data['foto_user'] != '') unlink(FCPATH . 'uploads/users/' . $data['foto_user']);
        $this->session->set_flashdata('alert', ['warning', 'icon fas fa-exclamation-triangle', 'Data Berhasil di Hapus!', 'Data berhasil Dihapus dari Database!']);
        redirect($return);
      } else {
        $this->session->set_flashdata('alert', ['danger', 'icon fas fa-exclamation-triangle', 'Data Gagal di Eksekusi!', 'Ada kesalahan pada query, Silahkan cek lagi!!']);
        redirect($return);
      }
    } else {
      $this->session->set_flashdata('alert', ['danger', 'icon fas fa-exclamation-triangle', 'Data Gagal di Eksekusi!', 'Ada kesalahan pada query, Silahkan cek lagi!!']);
      redirect($return);
    }
  }

  public function getData()
  {
    if ($this->input->post('set') == 'get_user') {
      $id_user = $this->input->post('id_user');
      $this->db->select("*, IF(akses='mahasiswa', (SELECT nm_mahasiswa FROM mahasiswa WHERE mahasiswa.id_user=user.id_user LIMIT 1), IF(akses='dosen', (SELECT nm_dosen FROM dosen WHERE dosen.id_user=user.id_user LIMIT 1), user.nm_user)) nama_user");
      $sql = $this->db->get_where("user", ['id_user' => $id_user]);
      if ($sql->num_rows() > 0) {
        $hasil = $sql->row_array();
        $hasil['status'] = 'done';
      } else {
        $hasil['status'] = 'none';
      }
    } else {
      $hasil['status'] = 'none';
    }
    echo json_encode($hasil);
  }
}
