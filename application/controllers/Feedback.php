<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback extends CI_Controller {

  public function __construct() {
    parent::__construct();

    $this->load->model('rh_advice');
    // $this->load->library('lib_redis');
  }

  public function index() {
    $email = $this->session->userdata('email');
    if (! $email) {
      $this->load->view('pls_login');
      return;
    }

    // fetch the latest 10 items
    $feeds = $this->rh_advice->fetch_10();

    $this->load->view('feedback', array(
      'advice' => $feeds,
    ));
  }

  public function advice() {
    $email = $this->session->userdata('email');
    if (! $email) {
      $this->load->view('pls_login');
      return;
    }

    $nick = trim($this->input->post('net_nick'));
    // $popo = $this->input->post('popo');
    $say = trim($this->input->post('say'));
    $say = substr($say, 0, 140);
    $popo = explode('@', $email)[0];

    $ret = $this->rh_advice->save_item($nick, $popo, $say);
    if ($ret) {
      $this->load->view('feedback');
      return;
    }
    $this->load->view('pub_failed');
  }

}
