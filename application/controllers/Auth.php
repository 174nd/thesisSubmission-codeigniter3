<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->model('Auth_model', 'auth');
  }

  public function index()
  {
    $this->form_validation->set_rules('username', 'Username', 'required|trim');
    $this->form_validation->set_rules('password', 'Password', 'required|trim');
    if ($this->form_validation->run() == FALSE) {
      $this->load->view('templates/auth', [
        'content' => $this->load->view('auth/login', null, true),
        'set'     => ['title' => 'Login'],
      ]);
    } else {
      $this->auth->logMeIn();
    }
  }


  public function logout()
  {
    $this->auth->logMeOut();
  }


  public function error()
  {
    $this->load->view('templates/auth', [
      'content' => $this->load->view('auth/error', null, true),
      'set'     => ['title' => 'Error!'],
    ]);
  }
}
