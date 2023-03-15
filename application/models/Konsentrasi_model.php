<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konsentrasi_model extends CI_Model
{
  public function insertKonsentrasi($get_return = null, $get_redirect = null)
  {
    $return   = $get_return == null ? uri_string() : $get_return;
    $redirect = $get_redirect == null ? uri_string() : $get_redirect;

    $data = [
      'nm_konsentrasi' => $this->input->post('nm_konsentrasi'),
      'id_prodi'       => $this->input->post('id_prodi'),
    ];

    if ($this->db->insert('konsentrasi', $data)) {
      $this->session->set_flashdata('alert', ['success', 'icon fas fa-check', 'Data Berhasil di Simpan!', 'Data berhasil Disimpan dari Database!']);
      redirect($return);
    } else {
      $this->session->set_flashdata('alert', ['danger', 'icon fas fa-exclamation-triangle', 'Data Gagal di Eksekusi!', 'Ada kesalahan pada query, Silahkan cek lagi!!']);
      redirect($redirect);
    }
  }

  public function updateKonsentrasi($id_konsentrasi, $get_return = null, $get_redirect = null)
  {
    $return   = $get_return == null ? uri_string() : $get_return;
    $redirect = $get_redirect == null ? uri_string() : $get_redirect;

    $data = [
      'nm_konsentrasi' => $this->input->post('nm_konsentrasi'),
      'id_prodi'       => $this->input->post('id_prodi'),
    ];

    if ($this->db->update('konsentrasi', $data, ['id_konsentrasi' => $id_konsentrasi])) {
      $this->session->set_flashdata('alert', ['success', 'icon fas fa-check', 'Data Berhasil di Ubah!', 'Data berhasil Diubah dari Database!']);
      redirect($return);
    } else {
      $this->session->set_flashdata('alert', ['danger', 'icon fas fa-exclamation-triangle', 'Data Gagal di Eksekusi!', 'Ada kesalahan pada query, Silahkan cek lagi!!']);
      redirect($redirect);
    }
  }

  public function deleteKonsentrasi($id_konsentrasi, $get_return = null)
  {
    $return = $get_return == null ? uri_string() : $get_return;

    $guest = $this->db->get_where('konsentrasi', ['id_konsentrasi' => $id_konsentrasi]);
    if ($guest->num_rows() > 0) {
      if ($this->db->delete('konsentrasi', ['id_konsentrasi' => $id_konsentrasi])) {
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
    if ($this->input->post('set') == 'get_konsentrasi') {
      $id_konsentrasi = $this->input->post('id_konsentrasi');
      $this->db->join('prodi', 'id_prodi');
      $sql = $this->db->get_where("konsentrasi", ['id_konsentrasi' => $id_konsentrasi]);
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
