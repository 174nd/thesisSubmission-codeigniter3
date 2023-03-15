<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Export extends CI_Controller
{
  protected $sidebar;
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    show_404();
  }

  public function cetak_sk()
  {
    $id_user = $this->session->userdata('id_user');


    $this->db->join('mahasiswa', 'id_mahasiswa');
    $this->db->join('prodi', 'id_prodi');
    $this->db->join('judul', 'id_judul');
    $this->db->join('pimpinan', 'id_pimpinan');
    $pengajuan = $this->db->get_where('pengajuan', ['id_user' => $id_user, 'stt_pengajuan' => 'terima']);
    if ($pengajuan->num_rows() > 0) {
      $pengajuan = $pengajuan->row_array();
      $this->load->library('pdf');
      $this->pdf->setPaper('A4', 'potrait');

      $this->pdf->filename = "SK - $pengajuan[nm_judul].pdf";
      $this->pdf->load_view('export/sk', [
        'data' => $pengajuan
      ]);
    } else {
      show_404();
    }
  }

  public function panduan_mahasiswa()
  {
    $panduan = $this->db->get_where("panduan", ['id_panduan' => 1])->row_array();
    redirect('uploads/panduan/' . $panduan['file_panduan']);
  }

  public function panduan_dosen()
  {
    $panduan = $this->db->get_where("panduan", ['id_panduan' => 2])->row_array();
    redirect('uploads/panduan/' . $panduan['file_panduan']);
  }
}
