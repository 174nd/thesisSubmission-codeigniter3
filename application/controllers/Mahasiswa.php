<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{
  protected $sidebar;
  public function __construct()
  {
    parent::__construct();
    $this->sidebar = set_sidebar('admin');
    $this->load->model('Auth_model', 'auth');
    $this->load->model('Mahasiswa_model', 'mahasiswa');
    kicked('mahasiswa');
  }

  public function index()
  {
    if ($this->input->post('u-password')) $this->auth->changePasswordUser();
    if ($this->input->post('u-foto')) $this->auth->uploadPhotoUser();
    $this->db->join('user', 'id_user');
    $this->db->join('prodi', 'id_prodi');
    $mahasiswa = $this->db->get_where("mahasiswa", ['id_user' => $this->session->userdata('id_user')])->row_array();

    $this->load->view('templates/dashboard-mahasiswa', [
      'content'    => $this->load->view('mahasiswa/main', ['mahasiswa' => $mahasiswa], true),
      'add_css'    => $this->load->view('mahasiswa/add_css', null, true),
      'add_script' => $this->load->view('mahasiswa/add_script', null, true),
      'own_script' => $this->load->view('mahasiswa/main_script', null, true),
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
    $this->mahasiswa->getData();
  }
}
