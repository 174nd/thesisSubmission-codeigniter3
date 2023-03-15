<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Adm_dosen extends CI_Controller
{
  protected $sidebar;
  public function __construct()
  {
    parent::__construct();
    $this->sidebar = set_sidebar('admin');
    $this->load->model('Adm_dosen_model', 'dosen');
    kicked('admin');
  }

  public function index()
  {
    $this->form_validation->set_rules('nidn_dosen', 'NIDN Dosen', "required|trim|is_unique[dosen.nidn_dosen=]");
    $this->form_validation->set_rules('nm_dosen', 'Nama Dosen', 'required|trim');
    $this->form_validation->set_rules('id_fakultas', 'Fakultas', 'required|trim');
    $this->form_validation->set_rules('no_telp', 'No. Telepon', 'required|trim');
    if ($this->form_validation->run() == FALSE) {
      $this->db->order_by('nm_fakultas', 'asc');
      $fakultas = $this->db->get_where('fakultas')->result_array();


      $this->load->view('templates/dashboard-admin', [
        'content'    => $this->load->view('adm_dosen/main', ['dosen' => null, 'fakultas' => $fakultas], true),
        'add_css'    => $this->load->view('adm_dosen/add_css', null, true),
        'add_script' => $this->load->view('adm_dosen/add_script', null, true),
        'own_script' => $this->load->view('adm_dosen/main_script', null, true),
        'set'        => [
          'title'          => 'Dosen',
          'content'        => 'Dosen',
          'sidebar'        => $this->sidebar,
          'active-sidebar' => ['Dashboard', 'bg-dark', 'Dosen'],
          'breadcrumb'     => [
            'Dashboard' => base_url('admin'),
            'Dosen'     => 'active',
          ],
        ],
      ]);
    } else {
      $this->dosen->insertDosen();
    }
  }


  public function update()
  {
    $id_dosen = $this->uri->segment(3);
    if ($id_dosen != '') {
      $this->form_validation->set_rules('nidn_dosen', 'NIDN Dosen', "required|trim|is_unique[dosen.id_dosen!='$id_dosen' AND nidn_dosen=]");
      $this->form_validation->set_rules('nm_dosen', 'Nama Dosen', 'required|trim');
      $this->form_validation->set_rules('id_fakultas', 'Fakultas', 'required|trim');
      $this->form_validation->set_rules('no_telp', 'No. Telepon', 'required|trim');
      if ($this->form_validation->run() == FALSE) {
        $dosen = $this->db->get_where('dosen', ['id_dosen' => $id_dosen])->row_array();

        $this->db->order_by('nm_fakultas', 'asc');
        $fakultas = $this->db->get_where('fakultas')->result_array();


        $this->load->view('templates/dashboard-admin', [
          'content'    => $this->load->view('adm_dosen/main', ['dosen' => $dosen, 'fakultas' => $fakultas], true),
          'add_css'    => $this->load->view('adm_dosen/add_css', null, true),
          'add_script' => $this->load->view('adm_dosen/add_script', null, true),
          'own_script' => $this->load->view('adm_dosen/main_script', null, true),
          'set'        => [
            'title'          => 'Update Dosen',
            'content'        => 'Update Dosen',
            'sidebar'        => $this->sidebar,
            'active-sidebar' => ['Dashboard', 'bg-dark', 'Dosen'],
            'breadcrumb'     => [
              'Dashboard' => base_url('admin'),
              'Dosen'     => base_url('dosen'),
              'Update'    => 'active',
            ],
          ],
        ]);
      } else {
        $this->dosen->updateDosen($id_dosen, 'adm_dosen', 'adm_dosen/update/' . $id_dosen);
      }
    } else {
      redirect('dosen');
    }
  }


  public function delete()
  {
    if ($this->input->post('delete-dosen')) {
      $this->dosen->deleteDosen($this->input->post('id_dosen'), 'adm_dosen');
    } else {
      $this->session->set_flashdata('alert', ['danger', 'icon fas fa-exclamation-triangle', 'Data Gagal di Eksekusi!', 'Ada kesalahan pada query, Silahkan cek lagi!!']);
      redirect('dosen');
    }
  }


  public function get_data()
  {
    $this->dosen->getData();
  }
}
