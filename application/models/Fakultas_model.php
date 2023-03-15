<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fakultas_model extends CI_Model
{
  public function insertFakultas($get_return = null, $get_redirect = null)
  {
    $return = $get_return == null ? uri_string() : $get_return;
    $redirect = $get_redirect == null ? uri_string() : $get_redirect;

    $data = [
      'nm_fakultas'   => $this->input->post('nm_fakultas'),
      'form_fakultas' => $this->input->post('form_fakultas'),
    ];

    if ($this->db->insert('fakultas', $data)) {
      $this->session->set_flashdata('alert', ['success', 'icon fas fa-check', 'Data Berhasil di Simpan!', 'Data berhasil Disimpan dari Database!']);
      redirect($return);
    } else {
      $this->session->set_flashdata('alert', ['danger', 'icon fas fa-exclamation-triangle', 'Data Gagal di Eksekusi!', 'Ada kesalahan pada query, Silahkan cek lagi!!']);
      redirect($redirect);
    }
  }

  public function updateFakultas($id_fakultas, $get_return = null, $get_redirect = null)
  {
    $return = $get_return == null ? uri_string() : $get_return;
    $redirect = $get_redirect == null ? uri_string() : $get_redirect;

    $data = [
      'nm_fakultas'   => $this->input->post('nm_fakultas'),
      'form_fakultas' => $this->input->post('form_fakultas'),
    ];

    if ($this->db->update('fakultas', $data, ['id_fakultas' => $id_fakultas])) {
      $this->session->set_flashdata('alert', ['success', 'icon fas fa-check', 'Data Berhasil di Ubah!', 'Data berhasil Diubah dari Database!']);
      redirect($return);
    } else {
      $this->session->set_flashdata('alert', ['danger', 'icon fas fa-exclamation-triangle', 'Data Gagal di Eksekusi!', 'Ada kesalahan pada query, Silahkan cek lagi!!']);
      redirect($redirect);
    }
  }

  public function deleteFakultas($id_fakultas, $get_return = null)
  {
    $return = $get_return == null ? uri_string() : $get_return;

    $guest = $this->db->get_where('fakultas', ['id_fakultas' => $id_fakultas]);
    if ($guest->num_rows() > 0) {
      if ($this->db->delete('fakultas', ['id_fakultas' => $id_fakultas])) {
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
    if ($this->input->post('set') == 'get_fakultas') {
      $id_fakultas = $this->input->post('id_fakultas');
      $sql = $this->db->get_where("fakultas", ['id_fakultas' => $id_fakultas]);
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
