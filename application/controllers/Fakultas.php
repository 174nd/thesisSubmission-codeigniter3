<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fakultas extends CI_Controller
{
  protected $sidebar;
  public function __construct()
  {
    parent::__construct();
    $this->sidebar = set_sidebar('admin');
    $this->load->model('Fakultas_model', 'fakultas');
    kicked('admin');
  }

  public function index()
  {
    $this->form_validation->set_rules('nm_fakultas', 'Nama Fakultas', 'required|trim');
    $this->form_validation->set_rules('form_fakultas', 'Form', 'required|trim');
    if ($this->form_validation->run() == FALSE) {

      $this->load->view('templates/dashboard-admin', [
        'content'    => $this->load->view('fakultas/main', ['fakultas' => null], true),
        'add_css'    => $this->load->view('fakultas/add_css', null, true),
        'add_script' => $this->load->view('fakultas/add_script', null, true),
        'own_script' => $this->load->view('fakultas/main_script', null, true),
        'set'        => [
          'title'          => 'Fakultas',
          'content'        => 'Fakultas',
          'sidebar'        => $this->sidebar,
          'active-sidebar' => ['Dashboard', 'bg-dark', 'Fakultas'],
          'breadcrumb'     => [
            'Dashboard' => base_url('admin'),
            'Fakultas'     => 'active',
          ],
        ],
      ]);
    } else {
      $this->fakultas->insertFakultas();
    }
  }


  public function update()
  {
    $id_fakultas = $this->uri->segment(3);
    if ($id_fakultas != '') {
      $this->form_validation->set_rules('nm_fakultas', 'Nama Fakultas', 'required|trim');
      $this->form_validation->set_rules('form_fakultas', 'Form', 'required|trim');
      if ($this->form_validation->run() == FALSE) {
        $fakultas = $this->db->get_where('fakultas', ['id_fakultas' => $id_fakultas])->row_array();

        $this->load->view('templates/dashboard-admin', [
          'content'    => $this->load->view('fakultas/main', ['fakultas' => $fakultas], true),
          'add_css'    => $this->load->view('fakultas/add_css', null, true),
          'add_script' => $this->load->view('fakultas/add_script', null, true),
          'own_script' => $this->load->view('fakultas/main_script', null, true),
          'set'        => [
            'title'          => 'Update Fakultas',
            'content'        => 'Update Fakultas',
            'sidebar'        => $this->sidebar,
            'active-sidebar' => ['Dashboard', 'bg-dark', 'Fakultas'],
            'breadcrumb'     => [
              'Dashboard' => base_url('admin'),
              'Fakultas'  => base_url('fakultas'),
              'Update'    => 'active',
            ],
          ],
        ]);
      } else {
        $this->fakultas->updateFakultas($id_fakultas, 'fakultas', 'fakultas/update/' . $id_fakultas);
      }
    } else {
      redirect('fakultas');
    }
  }


  public function delete()
  {
    if ($this->input->post('delete-fakultas')) {
      $this->fakultas->deleteFakultas($this->input->post('id_fakultas'), 'fakultas');
    } else {
      $this->session->set_flashdata('alert', ['danger', 'icon fas fa-exclamation-triangle', 'Data Gagal di Eksekusi!', 'Ada kesalahan pada query, Silahkan cek lagi!!']);
      redirect('fakultas');
    }
  }


  public function get_data()
  {
    $this->fakultas->getData();
  }
}
