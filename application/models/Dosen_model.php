<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dosen_model extends CI_Model
{
  public function getData()
  {
    if ($this->input->post('set') == 'start-dashboard_dosen') {
      $id_user = $this->session->userdata('id_user');

      $dosen = $this->db->get_where("dosen", ['id_user' => $id_user])->row_array();
      $id_dosen = $dosen['id_dosen'];

      $hasil = $this->db->query("SELECT 
      COUNT(CASE WHEN pemb_1='$id_dosen' THEN 1 ELSE null END) AS total_1,
      COUNT(CASE WHEN pemb_2='$id_dosen' THEN 1 ELSE null END) AS total_2
      FROM pengajuan WHERE stt_pengajuan='terima' AND (pemb_1='$id_dosen' OR pemb_2='$id_dosen')")->row_array();

      $this->db->select("*, IF(pemb_1='$id_dosen', 'Satu', 'Dua') AS pembimbing");
      $hasil['pengajuan'] = $this->db->get_where("pengajuan", "stt_pengajuan='terima' AND (pemb_1='$id_dosen' OR pemb_2='$id_dosen')")->result_array();
    } else if ($this->input->post('set') == 'start-data_pengajuan') {
      $id_pengajuan = $this->input->post('id_pengajuan');
      $id_user = $this->session->userdata('id_user');

      $set = isset($id_pengajuan) ? ['id_pengajuan' => $id_pengajuan] : ['stt_pengajuan' => 'proses', 'id_user' => $id_user];

      $this->db->join('mahasiswa', 'id_mahasiswa');
      $this->db->join('prodi', 'id_prodi');
      $this->db->join('fakultas', 'id_fakultas');
      $this->db->join('konsentrasi', 'id_konsentrasi');
      $this->db->order_by('nm_mahasiswa', 'asc');
      $this->db->select('*, COALESCE((SELECT nm_dosen FROM dosen WHERE dosen.id_dosen=pengajuan.pemb_1),"-") AS nm_pemb1, COALESCE((SELECT nm_dosen FROM dosen WHERE dosen.id_dosen=pengajuan.pemb_2),"-") AS nm_pemb2');
      $mahasiswa = $this->db->get_where('pengajuan', $set)->row_array();
      $hasil = [
        'mahasiswa' => $mahasiswa,
        'judul'     => $this->getJudul($mahasiswa['id_pengajuan']),
        'status'    => 'done',
      ];
    } else if ($this->input->post('set') == 'start-detail_judul') {
      $id_judul = $this->input->post('id_judul');

      $this->db->join('pimpinan', 'id_pimpinan');
      $judul = $this->db->get_where('judul', ['id_judul' => $id_judul])->row_array();



      $jurnal = $this->db->get_where('jurnal', ['id_judul' => $id_judul])->result_array();
      $hasil = [
        'judul'  => $judul,
        'jurnal' => $jurnal,
        'status' => 'done',
      ];
    } else {
      $hasil['status'] = 'none';
    }


    echo json_encode($hasil);
  }


  private function getJudul($id_pengajuan)
  {
    $this->db->select('*, IF(COALESCE((SELECT COUNT(id_judul) FROM jurnal WHERE jurnal.id_judul=judul.id_judul))>= 3,1,0) AS stt_judul');
    $judul = $this->db->get_where("judul", ['id_pengajuan' => $id_pengajuan])->result_array();
    foreach ($judul as $key => $value) $judul[$key]['stt_judul'] = $value['stt_judul'] == 1 ? true : false;
    return $judul;
  }
}
