<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prodi extends CI_Controller
{
  protected $sidebar;
  public function __construct()
  {
    parent::__construct();
    $this->sidebar = set_sidebar('admin');
    $this->load->model('Prodi_model', 'prodi');
    kicked('admin');
  }

  public function index()
  {
    $this->form_validation->set_rules('nm_prodi', 'Nama Program Studi', 'required|trim');
    $this->form_validation->set_rules('id_fakultas', 'Fakultas', 'required|trim');
    if ($this->form_validation->run() == FALSE) {
      $this->db->order_by('nm_fakultas', 'asc');
      $fakultas = $this->db->get_where('fakultas')->result_array();


      $this->load->view('templates/dashboard-admin', [
        'content'    => $this->load->view('prodi/main', ['prodi' => null, 'fakultas' => $fakultas], true),
        'add_css'    => $this->load->view('prodi/add_css', null, true),
        'add_script' => $this->load->view('prodi/add_script', null, true),
        'own_script' => $this->load->view('prodi/main_script', null, true),
        'set'        => [
          'title'          => 'Program Studi',
          'content'        => 'Program Studi',
          'sidebar'        => $this->sidebar,
          'active-sidebar' => ['Dashboard', 'bg-dark', 'Program Studi'],
          'breadcrumb'     => [
            'Dashboard' => base_url('admin'),
            'Program Studi'     => 'active',
          ],
        ],
      ]);
    } else {
      $this->prodi->insertProdi();
    }
  }


  public function update()
  {
    $id_prodi = $this->uri->segment(3);
    if ($id_prodi != '') {
      $this->form_validation->set_rules('nm_prodi', 'Nama Program Studi', 'required|trim');
      $this->form_validation->set_rules('id_fakultas', 'Fakultas', 'required|trim');
      if ($this->form_validation->run() == FALSE) {
        $prodi = $this->db->get_where('prodi', ['id_prodi' => $id_prodi])->row_array();

        $this->db->order_by('nm_fakultas', 'asc');
        $fakultas = $this->db->get_where('fakultas')->result_array();


        $this->load->view('templates/dashboard-admin', [
          'content'    => $this->load->view('prodi/main', ['prodi' => $prodi, 'fakultas' => $fakultas], true),
          'add_css'    => $this->load->view('prodi/add_css', null, true),
          'add_script' => $this->load->view('prodi/add_script', null, true),
          'own_script' => $this->load->view('prodi/main_script', null, true),
          'set'        => [
            'title'          => 'Update Program Studi',
            'content'        => 'Update Program Studi',
            'sidebar'        => $this->sidebar,
            'active-sidebar' => ['Dashboard', 'bg-dark', 'Prodi'],
            'breadcrumb'     => [
              'Dashboard' => base_url('admin'),
              'Program Studi'     => base_url('prodi'),
              'Update'    => 'active',
            ],
          ],
        ]);
      } else {
        $this->prodi->updateProdi($id_prodi, 'prodi', 'prodi/update/' . $id_prodi);
      }
    } else {
      redirect('prodi');
    }
  }


  public function delete()
  {
    if ($this->input->post('delete-prodi')) {
      $this->prodi->deleteProdi($this->input->post('id_prodi'), 'prodi');
    } else {
      $this->session->set_flashdata('alert', ['danger', 'icon fas fa-exclamation-triangle', 'Data Gagal di Eksekusi!', 'Ada kesalahan pada query, Silahkan cek lagi!!']);
      redirect('prodi');
    }
  }


  public function get_data()
  {
    $this->prodi->getData();
  }
}
