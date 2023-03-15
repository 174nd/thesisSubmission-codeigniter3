<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prodi_model extends CI_Model
{
  public function insertProdi($get_return = null, $get_redirect = null)
  {
    $return = $get_return == null ? uri_string() : $get_return;
    $redirect = $get_redirect == null ? uri_string() : $get_redirect;

    $data = [
      'nm_prodi'    => $this->input->post('nm_prodi'),
      'id_fakultas' => $this->input->post('id_fakultas'),
    ];

    if ($this->db->insert('prodi', $data)) {
      $this->session->set_flashdata('alert', ['success', 'icon fas fa-check', 'Data Berhasil di Simpan!', 'Data berhasil Disimpan dari Database!']);
      redirect($return);
    } else {
      $this->session->set_flashdata('alert', ['danger', 'icon fas fa-exclamation-triangle', 'Data Gagal di Eksekusi!', 'Ada kesalahan pada query, Silahkan cek lagi!!']);
      redirect($redirect);
    }
  }

  public function updateProdi($id_prodi, $get_return = null, $get_redirect = null)
  {
    $return = $get_return == null ? uri_string() : $get_return;
    $redirect = $get_redirect == null ? uri_string() : $get_redirect;

    $data = [
      'nm_prodi'    => $this->input->post('nm_prodi'),
      'id_fakultas' => $this->input->post('id_fakultas'),
    ];

    if ($this->db->update('prodi', $data, ['id_prodi' => $id_prodi])) {
      $this->session->set_flashdata('alert', ['success', 'icon fas fa-check', 'Data Berhasil di Ubah!', 'Data berhasil Diubah dari Database!']);
      redirect($return);
    } else {
      $this->session->set_flashdata('alert', ['danger', 'icon fas fa-exclamation-triangle', 'Data Gagal di Eksekusi!', 'Ada kesalahan pada query, Silahkan cek lagi!!']);
      redirect($redirect);
    }
  }

  public function deleteProdi($id_prodi, $get_return = null)
  {
    $return = $get_return == null ? uri_string() : $get_return;

    $guest = $this->db->get_where('prodi', ['id_prodi' => $id_prodi]);
    if ($guest->num_rows() > 0) {
      if ($this->db->delete('prodi', ['id_prodi' => $id_prodi])) {
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
    if ($this->input->post('set') == 'get_prodi') {
      $id_prodi = $this->input->post('id_prodi');
      $this->db->join('fakultas', 'id_fakultas');
      $sql = $this->db->get_where("prodi", ['id_prodi' => $id_prodi]);
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
