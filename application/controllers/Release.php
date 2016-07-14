<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Release extends CI_Controller {

  public function __construct() {
    parent::__construct();

    // $this->load->model('rh_house');
    // $this->load->library('lib_redis');
  }

  public function index() {
    $has_login = false;
    if ($this->session->userdata('email'))
      $has_login = true;

    $this->load->view('releaselog', array(
      'has_login' => $has_login,
    ));
  }

}
