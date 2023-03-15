<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
  protected $sidebar;
  public function __construct()
  {
    parent::__construct();
    $this->sidebar = set_sidebar('admin');
    $this->load->model('Auth_model', 'auth');
    $this->load->model('Admin_model', 'admin');
    kicked('admin');
  }

  public function index()
  {
    if ($this->input->post('u-password')) $this->auth->changePasswordUser();
    if ($this->input->post('u-foto')) $this->auth->uploadPhotoUser();

    $this->load->view('templates/dashboard-admin', [
      'content'    => $this->load->view('admin/dashboard', null, true),
      'add_css'    => $this->load->view('admin/add_css', null, true),
      'add_script' => $this->load->view('admin/add_script', null, true),
      'own_script' => $this->load->view('admin/dashboard_script', null, true),
      'set'        => [
        'title'          => 'Dashboard',
        'content'        => 'Dashboard',
        'sidebar'        => $this->sidebar,
        'active-sidebar' => ['Dashboard', 'bg-dark'],
        'breadcrumb'     => [
          'Dashboard' => 'active',
        ],
      ],
    ]);
  }

  public function kirimEmail()
  {
    $this->load->library('email', [


      'protocol' => 'smtp',
      'smtp_host' => 'ssl://smtp.googlemail.com',
      'smtp_port' => 465,
      'smtp_user'   => 'sample@uis.ac.id',
      'smtp_pass'   => '11ramos91',
      'mailtype' => 'html',
      'charset' => 'iso-8859-1',
      'wordwrap' => TRUE


      // 'mailtype'    => 'html',
      // 'charset'     => 'utf-8',
      // 'protocol'    => 'smtp',
      // 'smtp_host'   => 'smtp.gmail.com',
      // 'smtp_user'   => 'sample@uis.ac.id',
      // 'smtp_pass'   => '11ramos91',
      // 'smtp_crypto' => 'ssl',
      // 'smtp_port'   => 465,
      // 'crlf'        => "\r\n",
      // 'newline'     => "\r\n"
    ]);

    $this->email->from('no-reply@uis.ac.id', 'Universitas Ibnu Sina');
    $this->email->to('andilewispratama11@gmail.com');
    $this->email->subject('Hasil Pengajuan Judul Skripsi | Universitas Ibnu Sina');
    $this->email->message("Diterima");
    if ($this->email->send()) {
      echo 'Sukses! email berhasil dikirim.';
    } else {
      echo 'Error! email tidak dapat dikirim.';
    }
  }


  public function get_data()
  {
    $this->admin->getData();
  }
}
