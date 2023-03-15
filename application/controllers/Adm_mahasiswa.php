<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Adm_mahasiswa extends CI_Controller
{
  protected $sidebar;
  public function __construct()
  {
    parent::__construct();
    $this->sidebar = set_sidebar('admin');
    $this->load->model('Adm_mahasiswa_model', 'mahasiswa');
    kicked('admin');
  }

  public function index()
  {
    $this->form_validation->set_rules('nim_mahasiswa', 'No. Induk', "required|trim|is_unique[mahasiswa.nim_mahasiswa=]");
    $this->form_validation->set_rules('nm_mahasiswa', 'Nama Mahasiswa', 'required|trim');
    $this->form_validation->set_rules('email_mahasiswa', 'Email', 'required|valid_email|trim');
    $this->form_validation->set_rules('id_prodi', 'Program Studi', 'required|trim');
    $this->form_validation->set_rules('no_telp', 'No. Telepon', 'required|trim');
    if ($this->form_validation->run() == FALSE) {
      $this->db->order_by('nm_prodi', 'asc');
      $prodi = $this->db->get_where('prodi')->result_array();


      $this->load->view('templates/dashboard-admin', [
        'content'    => $this->load->view('adm_mahasiswa/main', ['mahasiswa' => null, 'prodi' => $prodi], true),
        'add_css'    => $this->load->view('adm_mahasiswa/add_css', null, true),
        'add_script' => $this->load->view('adm_mahasiswa/add_script', null, true),
        'own_script' => $this->load->view('adm_mahasiswa/main_script', null, true),
        'set'        => [
          'title'          => 'Mahasiswa',
          'content'        => 'Mahasiswa',
          'sidebar'        => $this->sidebar,
          'active-sidebar' => ['Dashboard', 'bg-dark', 'Mahasiswa'],
          'breadcrumb'     => [
            'Dashboard' => base_url('admin'),
            'Mahasiswa'     => 'active',
          ],
        ],
      ]);
    } else {
      $this->mahasiswa->insertMahasiswa();
    }
  }


  public function update()
  {
    $id_mahasiswa = $this->uri->segment(3);
    if ($id_mahasiswa != '') {
      $this->form_validation->set_rules('nim_mahasiswa', 'No. Induk', "required|trim|is_unique[mahasiswa.id_mahasiswa!='$id_mahasiswa' AND nim_mahasiswa=]");
      $this->form_validation->set_rules('nm_mahasiswa', 'Nama Mahasiswa', 'required|trim');
      $this->form_validation->set_rules('email_mahasiswa', 'Email', 'required|valid_email|trim');
      $this->form_validation->set_rules('id_prodi', 'Program Studi', 'required|trim');
      $this->form_validation->set_rules('no_telp', 'No. Telepon', 'required|trim');
      if ($this->form_validation->run() == FALSE) {
        $mahasiswa = $this->db->get_where('mahasiswa', ['id_mahasiswa' => $id_mahasiswa])->row_array();

        $this->db->order_by('nm_prodi', 'asc');
        $prodi = $this->db->get_where('prodi')->result_array();


        $this->load->view('templates/dashboard-admin', [
          'content'    => $this->load->view('adm_mahasiswa/main', ['mahasiswa' => $mahasiswa, 'prodi' => $prodi], true),
          'add_css'    => $this->load->view('adm_mahasiswa/add_css', null, true),
          'add_script' => $this->load->view('adm_mahasiswa/add_script', null, true),
          'own_script' => $this->load->view('adm_mahasiswa/main_script', null, true),
          'set'        => [
            'title'          => 'Update Mahasiswa',
            'content'        => 'Update Mahasiswa',
            'sidebar'        => $this->sidebar,
            'active-sidebar' => ['Dashboard', 'bg-dark', 'Mahasiswa'],
            'breadcrumb'     => [
              'Dashboard' => base_url('admin'),
              'Mahasiswa'     => base_url('mahasiswa'),
              'Update'    => 'active',
            ],
          ],
        ]);
      } else {
        $this->mahasiswa->updateMahasiswa($id_mahasiswa, 'adm_mahasiswa', 'adm_mahasiswa/update/' . $id_mahasiswa);
      }
    } else {
      redirect('mahasiswa');
    }
  }


  public function delete()
  {
    if ($this->input->post('delete-mahasiswa')) {
      $this->mahasiswa->deleteMahasiswa($this->input->post('id_mahasiswa'), 'adm_mahasiswa');
    } else {
      $this->session->set_flashdata('alert', ['danger', 'icon fas fa-exclamation-triangle', 'Data Gagal di Eksekusi!', 'Ada kesalahan pada query, Silahkan cek lagi!!']);
      redirect('mahasiswa');
    }
  }


  public function get_data()
  {
    $this->mahasiswa->getData();
  }
}
