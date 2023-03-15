<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pimpinan extends CI_Controller
{
  protected $sidebar;
  public function __construct()
  {
    parent::__construct();
    $this->sidebar = set_sidebar('admin');
    $this->load->model('Pimpinan_model', 'pimpinan');
    kicked('admin');
  }

  public function index()
  {
    $this->form_validation->set_rules('unsur_pimpinan', 'Unsur Pimpinan', 'required|trim');
    if ($this->form_validation->run() == FALSE) {

      $this->load->view('templates/dashboard-admin', [
        'content'    => $this->load->view('pimpinan/main', ['pimpinan' => null], true),
        'add_css'    => $this->load->view('pimpinan/add_css', null, true),
        'add_script' => $this->load->view('pimpinan/add_script', null, true),
        'own_script' => $this->load->view('pimpinan/main_script', null, true),
        'set'        => [
          'title'          => 'Pimpinan',
          'content'        => 'Pimpinan',
          'sidebar'        => $this->sidebar,
          'active-sidebar' => ['Dashboard', 'bg-dark', 'Pimpinan'],
          'breadcrumb'     => [
            'Dashboard' => base_url('admin'),
            'Pimpinan'     => 'active',
          ],
        ],
      ]);
    } else {
      $this->pimpinan->insertPimpinan();
    }
  }


  public function update()
  {
    $id_pimpinan = $this->uri->segment(3);
    if ($id_pimpinan != '') {
      $this->form_validation->set_rules('unsur_pimpinan', 'Unsur Pimpinan', 'required|trim');
      if ($this->form_validation->run() == FALSE) {
        $pimpinan = $this->db->get_where('pimpinan', ['id_pimpinan' => $id_pimpinan])->row_array();

        $this->load->view('templates/dashboard-admin', [
          'content'    => $this->load->view('pimpinan/main', ['pimpinan' => $pimpinan], true),
          'add_css'    => $this->load->view('pimpinan/add_css', null, true),
          'add_script' => $this->load->view('pimpinan/add_script', null, true),
          'own_script' => $this->load->view('pimpinan/main_script', null, true),
          'set'        => [
            'title'          => 'Update Pimpinan',
            'content'        => 'Update Pimpinan',
            'sidebar'        => $this->sidebar,
            'active-sidebar' => ['Dashboard', 'bg-dark', 'Pimpinan'],
            'breadcrumb'     => [
              'Dashboard' => base_url('admin'),
              'Pimpinan'  => base_url('pimpinan'),
              'Update'    => 'active',
            ],
          ],
        ]);
      } else {
        $this->pimpinan->updatePimpinan($id_pimpinan, 'pimpinan', 'pimpinan/update/' . $id_pimpinan);
      }
    } else {
      redirect('pimpinan');
    }
  }


  public function delete()
  {
    if ($this->input->post('delete-pimpinan')) {
      $this->pimpinan->deletePimpinan($this->input->post('id_pimpinan'), 'pimpinan');
    } else {
      $this->session->set_flashdata('alert', ['danger', 'icon fas fa-exclamation-triangle', 'Data Gagal di Eksekusi!', 'Ada kesalahan pada query, Silahkan cek lagi!!']);
      redirect('pimpinan');
    }
  }


  public function get_data()
  {
    $this->pimpinan->getData();
  }
}
