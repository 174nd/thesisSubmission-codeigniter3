<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konsentrasi extends CI_Controller
{
  protected $sidebar;
  public function __construct()
  {
    parent::__construct();
    $this->sidebar = set_sidebar('admin');
    $this->load->model('Konsentrasi_model', 'konsentrasi');
    kicked('admin');
  }

  public function index()
  {
    $this->form_validation->set_rules('nm_konsentrasi', 'Konsentrasi', "required|trim|is_unique[konsentrasi.nm_konsentrasi=]");
    $this->form_validation->set_rules('id_prodi', 'Program Studi', 'required|trim');
    if ($this->form_validation->run() == FALSE) {
      $this->db->order_by('nm_prodi', 'asc');
      $prodi = $this->db->get_where('prodi')->result_array();


      $this->load->view('templates/dashboard-admin', [
        'content'    => $this->load->view('konsentrasi/main', ['konsentrasi' => null, 'prodi' => $prodi], true),
        'add_css'    => $this->load->view('konsentrasi/add_css', null, true),
        'add_script' => $this->load->view('konsentrasi/add_script', null, true),
        'own_script' => $this->load->view('konsentrasi/main_script', null, true),
        'set'        => [
          'title'          => 'Konsentrasi',
          'content'        => 'Konsentrasi',
          'sidebar'        => $this->sidebar,
          'active-sidebar' => ['Dashboard', 'bg-dark', 'Konsentrasi'],
          'breadcrumb'     => [
            'Dashboard' => base_url('admin'),
            'Konsentrasi'     => 'active',
          ],
        ],
      ]);
    } else {
      $this->konsentrasi->insertKonsentrasi();
    }
  }


  public function update()
  {
    $id_konsentrasi = $this->uri->segment(3);
    if ($id_konsentrasi != '') {
      $this->form_validation->set_rules('nm_konsentrasi', 'Konsentrasi', "required|trim|is_unique[konsentrasi.id_konsentrasi!='$id_konsentrasi' AND nm_konsentrasi=]");
      $this->form_validation->set_rules('id_prodi', 'Program Studi', 'required|trim');
      if ($this->form_validation->run() == FALSE) {
        $konsentrasi = $this->db->get_where('konsentrasi', ['id_konsentrasi' => $id_konsentrasi])->row_array();

        $this->db->order_by('nm_prodi', 'asc');
        $prodi = $this->db->get_where('prodi')->result_array();


        $this->load->view('templates/dashboard-admin', [
          'content'    => $this->load->view('konsentrasi/main', ['konsentrasi' => $konsentrasi, 'prodi' => $prodi], true),
          'add_css'    => $this->load->view('konsentrasi/add_css', null, true),
          'add_script' => $this->load->view('konsentrasi/add_script', null, true),
          'own_script' => $this->load->view('konsentrasi/main_script', null, true),
          'set'        => [
            'title'          => 'Update Konsentrasi',
            'content'        => 'Update Konsentrasi',
            'sidebar'        => $this->sidebar,
            'active-sidebar' => ['Dashboard', 'bg-dark', 'Konsentrasi'],
            'breadcrumb'     => [
              'Dashboard' => base_url('admin'),
              'Konsentrasi'     => base_url('konsentrasi'),
              'Update'    => 'active',
            ],
          ],
        ]);
      } else {
        $this->konsentrasi->updateKonsentrasi($id_konsentrasi, 'konsentrasi', 'konsentrasi/update/' . $id_konsentrasi);
      }
    } else {
      redirect('konsentrasi');
    }
  }


  public function delete()
  {
    if ($this->input->post('delete-konsentrasi')) {
      $this->konsentrasi->deleteKonsentrasi($this->input->post('id_konsentrasi'), 'konsentrasi');
    } else {
      $this->session->set_flashdata('alert', ['danger', 'icon fas fa-exclamation-triangle', 'Data Gagal di Eksekusi!', 'Ada kesalahan pada query, Silahkan cek lagi!!']);
      redirect('konsentrasi');
    }
  }


  public function get_data()
  {
    $this->konsentrasi->getData();
  }
}
