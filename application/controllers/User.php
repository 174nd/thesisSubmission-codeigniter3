<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
  protected $sidebar;
  public function __construct()
  {
    parent::__construct();
    $this->sidebar = set_sidebar('admin');
    $this->load->model('User_model', 'user');
    kicked('admin');
  }

  public function index()
  {
    $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]');
    $this->form_validation->set_rules('password', 'password', 'required|trim');
    if ($this->input->post('akses') == 'admin') $this->form_validation->set_rules('nm_user', 'Nama User', 'required|trim');
    // $this->form_validation->set_rules('akses', 'Akses', 'required|trim');
    if ($this->form_validation->run() == FALSE) {
      $this->db->order_by('nm_mahasiswa', 'asc');
      $mahasiswa = $this->db->get_where('mahasiswa', 'id_user IS NULL')->result_array();

      $this->db->order_by('nm_dosen', 'asc');
      $dosen = $this->db->get_where('dosen', 'id_user IS NULL')->result_array();


      $this->load->view('templates/dashboard-admin', [
        'content'    => $this->load->view('user/main', ['user' => null, 'mahasiswa' => $mahasiswa, 'dosen' => $dosen], true),
        'add_css'    => $this->load->view('user/add_css', null, true),
        'add_script' => $this->load->view('user/add_script', null, true),
        'own_script' => $this->load->view('user/main_script', null, true),
        'set'        => [
          'title'          => 'User',
          'content'        => 'User',
          'sidebar'        => $this->sidebar,
          'active-sidebar' => ['Dashboard', 'bg-dark', 'User'],
          'breadcrumb'     => [
            'Dashboard' => base_url('admin'),
            'User'      => 'active',
          ],
        ],
      ]);
    } else {
      $this->user->insertUser();
    }
  }


  public function update()
  {
    $id_user = $this->uri->segment(3);
    if ($id_user != '') {
      $this->form_validation->set_rules('username', 'Username', "required|trim|is_unique[user.id_user!='$id_user' AND username=]");
      $this->form_validation->set_rules('password', 'password', 'required|trim');
      if ($this->input->post('akses') == 'admin') $this->form_validation->set_rules('nm_user', 'Nama User', 'required|trim');
      // $this->form_validation->set_rules('akses', 'Akses', 'required|trim');
      if ($this->form_validation->run() == FALSE) {
        $this->db->join('dosen', 'id_user', 'left');
        $this->db->join('mahasiswa', 'id_user', 'left');
        $user = $this->db->get_where('user', ['id_user' => $id_user])->row_array();

        $this->db->order_by('nm_mahasiswa', 'asc');
        $mahasiswa = $this->db->get_where('mahasiswa', "id_user IS NULL OR id_user='$id_user'")->result_array();
        $this->db->order_by('nm_dosen', 'asc');
        $dosen = $this->db->get_where('dosen', "id_user IS NULL OR id_user='$id_user'")->result_array();


        $this->load->view('templates/dashboard-admin', [
          'content'    => $this->load->view('user/main', ['user' => $user, 'mahasiswa' => $mahasiswa, 'dosen' => $dosen], true),
          'add_css'    => $this->load->view('user/add_css', null, true),
          'add_script' => $this->load->view('user/add_script', null, true),
          'own_script' => $this->load->view('user/main_script', null, true),
          'set'        => [
            'title'          => 'Update User',
            'content'        => 'Update User',
            'sidebar'        => $this->sidebar,
            'active-sidebar' => ['Dashboard', 'bg-dark', 'User'],
            'breadcrumb'     => [
              'Dashboard' => base_url('admin'),
              'User'      => base_url('user'),
              'Update'    => 'active',
            ],
          ],
        ]);
      } else {
        $this->user->updateUser($id_user, 'user', 'user/update/' . $id_user);
      }
    } else {
      redirect('user');
    }
  }


  public function delete()
  {
    if ($this->input->post('delete-user')) {
      $this->user->deleteUser($this->input->post('id_user'), 'user');
    } else {
      $this->session->set_flashdata('message', $this->lang->line('alert-failed'));
      redirect('user');
    }
  }


  public function get_data()
  {
    $this->user->getData();
  }
}
