<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dosen extends CI_Controller
{
  protected $sidebar;
  public function __construct()
  {
    parent::__construct();
    $this->sidebar = set_sidebar('admin');
    $this->load->model('Auth_model', 'auth');
    $this->load->model('Dosen_model', 'dosen');
    kicked('dosen');
  }

  public function index()
  {
    if ($this->input->post('u-password')) $this->auth->changePasswordUser();
    if ($this->input->post('u-foto')) $this->auth->uploadPhotoUser();
    $this->db->join('user', 'id_user');
    $this->db->join('fakultas', 'id_fakultas');
    $dosen = $this->db->get_where("dosen", ['id_user' => $this->session->userdata('id_user')])->row_array();

    $this->load->view('templates/dashboard-dosen', [
      'content'    => $this->load->view('dosen/main', ['dosen' => $dosen], true),
      'add_css'    => $this->load->view('dosen/add_css', null, true),
      'add_script' => $this->load->view('dosen/add_script', null, true),
      'own_script' => $this->load->view('dosen/main_script', null, true),
      'set'        => [
        'title'          => 'Dashboard',
        'content'        => 'Dashboard',
        'active-sidebar' => ['Dashboard', 'bg-dark'],
        'breadcrumb'     => [
          'Dashboard' => 'active',
        ],
      ],
    ]);
  }


  public function get_data()
  {
    $this->dosen->getData();
  }
}
