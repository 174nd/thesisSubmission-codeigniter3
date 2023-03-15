<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Adm_dosen_model extends CI_Model
{
  public function insertDosen($get_return = null, $get_redirect = null)
  {
    $return = $get_return == null ? uri_string() : $get_return;
    $redirect = $get_redirect == null ? uri_string() : $get_redirect;

    $data = [
      'nidn_dosen'      => $this->input->post('nidn_dosen'),
      'nm_dosen'        => $this->input->post('nm_dosen'),
      'id_fakultas'     => $this->input->post('id_fakultas'),
      'no_telp'         => $this->input->post('no_telp'),
    ];

    if ($this->db->insert('dosen', $data)) {
      $this->session->set_flashdata('alert', ['success', 'icon fas fa-check', 'Data Berhasil di Simpan!', 'Data berhasil Disimpan dari Database!']);
      redirect($return);
    } else {
      $this->session->set_flashdata('alert', ['danger', 'icon fas fa-exclamation-triangle', 'Data Gagal di Eksekusi!', 'Ada kesalahan pada query, Silahkan cek lagi!!']);
      redirect($redirect);
    }
  }

  public function updateDosen($id_dosen, $get_return = null, $get_redirect = null)
  {
    $return = $get_return == null ? uri_string() : $get_return;
    $redirect = $get_redirect == null ? uri_string() : $get_redirect;

    $data = [
      'nidn_dosen'      => $this->input->post('nidn_dosen'),
      'nm_dosen'        => $this->input->post('nm_dosen'),
      'id_fakultas'     => $this->input->post('id_fakultas'),
      'no_telp'         => $this->input->post('no_telp'),
    ];

    if ($this->db->update('dosen', $data, ['id_dosen' => $id_dosen])) {
      $this->session->set_flashdata('alert', ['success', 'icon fas fa-check', 'Data Berhasil di Ubah!', 'Data berhasil Diubah dari Database!']);
      redirect($return);
    } else {
      $this->session->set_flashdata('alert', ['danger', 'icon fas fa-exclamation-triangle', 'Data Gagal di Eksekusi!', 'Ada kesalahan pada query, Silahkan cek lagi!!']);
      redirect($redirect);
    }
  }

  public function deleteDosen($id_dosen, $get_return = null)
  {
    $return = $get_return == null ? uri_string() : $get_return;

    $guest = $this->db->get_where('dosen', ['id_dosen' => $id_dosen]);
    if ($guest->num_rows() > 0) {
      if ($this->db->delete('dosen', ['id_dosen' => $id_dosen])) {
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
    if ($this->input->post('set') == 'get_dosen') {
      $id_dosen = $this->input->post('id_dosen');
      $this->db->join('fakultas', 'id_fakultas');
      $sql = $this->db->get_where("dosen", ['id_dosen' => $id_dosen]);
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
