<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pimpinan_model extends CI_Model
{
  public function insertPimpinan($get_return = null, $get_redirect = null)
  {
    $return = $get_return == null ? uri_string() : $get_return;
    $redirect = $get_redirect == null ? uri_string() : $get_redirect;

    $data = [
      'unsur_pimpinan' => $this->input->post('unsur_pimpinan'),
    ];

    if ($this->db->insert('pimpinan', $data)) {
      $this->session->set_flashdata('alert', ['success', 'icon fas fa-check', 'Data Berhasil di Simpan!', 'Data berhasil Disimpan dari Database!']);
      redirect($return);
    } else {
      $this->session->set_flashdata('alert', ['danger', 'icon fas fa-exclamation-triangle', 'Data Gagal di Eksekusi!', 'Ada kesalahan pada query, Silahkan cek lagi!!']);
      redirect($redirect);
    }
  }

  public function updatePimpinan($id_pimpinan, $get_return = null, $get_redirect = null)
  {
    $return = $get_return == null ? uri_string() : $get_return;
    $redirect = $get_redirect == null ? uri_string() : $get_redirect;

    $data = [
      'unsur_pimpinan' => $this->input->post('unsur_pimpinan'),
    ];

    if ($this->db->update('pimpinan', $data, ['id_pimpinan' => $id_pimpinan])) {
      $this->session->set_flashdata('alert', ['success', 'icon fas fa-check', 'Data Berhasil di Ubah!', 'Data berhasil Diubah dari Database!']);
      redirect($return);
    } else {
      $this->session->set_flashdata('alert', ['danger', 'icon fas fa-exclamation-triangle', 'Data Gagal di Eksekusi!', 'Ada kesalahan pada query, Silahkan cek lagi!!']);
      redirect($redirect);
    }
  }

  public function deletePimpinan($id_pimpinan, $get_return = null)
  {
    $return = $get_return == null ? uri_string() : $get_return;

    $guest = $this->db->get_where('pimpinan', ['id_pimpinan' => $id_pimpinan]);
    if ($guest->num_rows() > 0) {
      if ($this->db->delete('pimpinan', ['id_pimpinan' => $id_pimpinan])) {
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
    if ($this->input->post('set') == 'get_pimpinan') {
      $id_pimpinan = $this->input->post('id_pimpinan');
      $sql = $this->db->get_where("pimpinan", ['id_pimpinan' => $id_pimpinan]);
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
