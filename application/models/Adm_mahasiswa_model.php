<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Adm_mahasiswa_model extends CI_Model
{
  public function insertMahasiswa($get_return = null, $get_redirect = null)
  {
    $return   = $get_return == null ? uri_string() : $get_return;
    $redirect = $get_redirect == null ? uri_string() : $get_redirect;

    $data = [
      'nim_mahasiswa'   => $this->input->post('nim_mahasiswa'),
      'nm_mahasiswa'    => $this->input->post('nm_mahasiswa'),
      'email_mahasiswa' => $this->input->post('email_mahasiswa'),
      'id_prodi'        => $this->input->post('id_prodi'),
      'no_telp'         => $this->input->post('no_telp'),
    ];

    if ($this->db->insert('mahasiswa', $data)) {
      $this->session->set_flashdata('alert', ['success', 'icon fas fa-check', 'Data Berhasil di Simpan!', 'Data berhasil Disimpan dari Database!']);
      redirect($return);
    } else {
      $this->session->set_flashdata('alert', ['danger', 'icon fas fa-exclamation-triangle', 'Data Gagal di Eksekusi!', 'Ada kesalahan pada query, Silahkan cek lagi!!']);
      redirect($redirect);
    }
  }

  public function updateMahasiswa($id_mahasiswa, $get_return = null, $get_redirect = null)
  {
    $return   = $get_return == null ? uri_string() : $get_return;
    $redirect = $get_redirect == null ? uri_string() : $get_redirect;

    $data = [
      'nim_mahasiswa'   => $this->input->post('nim_mahasiswa'),
      'nm_mahasiswa'    => $this->input->post('nm_mahasiswa'),
      'email_mahasiswa' => $this->input->post('email_mahasiswa'),
      'id_prodi'        => $this->input->post('id_prodi'),
      'no_telp'         => $this->input->post('no_telp'),
    ];

    if ($this->db->update('mahasiswa', $data, ['id_mahasiswa' => $id_mahasiswa])) {
      $this->session->set_flashdata('alert', ['success', 'icon fas fa-check', 'Data Berhasil di Ubah!', 'Data berhasil Diubah dari Database!']);
      redirect($return);
    } else {
      $this->session->set_flashdata('alert', ['danger', 'icon fas fa-exclamation-triangle', 'Data Gagal di Eksekusi!', 'Ada kesalahan pada query, Silahkan cek lagi!!']);
      redirect($redirect);
    }
  }

  public function deleteMahasiswa($id_mahasiswa, $get_return = null)
  {
    $return = $get_return == null ? uri_string() : $get_return;

    $guest = $this->db->get_where('mahasiswa', ['id_mahasiswa' => $id_mahasiswa]);
    if ($guest->num_rows() > 0) {
      if ($this->db->delete('mahasiswa', ['id_mahasiswa' => $id_mahasiswa])) {
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
    if ($this->input->post('set') == 'get_mahasiswa') {
      $id_mahasiswa = $this->input->post('id_mahasiswa');
      $this->db->join('prodi', 'id_prodi');
      $sql = $this->db->get_where("mahasiswa", ['id_mahasiswa' => $id_mahasiswa]);
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
