<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Release extends CI_Controller {

  public function __construct() {
    parent::__construct();

    // $this->load->model('rh_house');
    // $this->load->library('lib_redis');
  }

  public function index() {
    $this->load->view('releaselog');
  }

}
