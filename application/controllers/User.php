<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

  public function __construct() {
    parent::__construct();

    $this->load->model('rh_house');
    // $this->load->library('lib_redis');
  }

  public function del() {
    $id = trim($this->input->get('id'));

    $email = $this->session->userdata('email');
    if ($id && is_numeric($id) && $email) {
      // delete this house record, not the real delete just set status=0
      $ret = $this->rh_house->set_status($id, explode('@', $email)[0], 0);
      if ($ret)
        redirect('/user/myhouse', 'location', 302);
    }
    // error
    $this->load->view('error');
  }

  // show all my published houses
  public function myhouse() {
    // show all houses of my published
    $email = $this->session->userdata('email');
    $bfx_email = explode('@', $email)[0];
    // echo $bfx_email;

    $h_list = $this->rh_house->get_my_house($bfx_email);
    // print_r($h_list);

    $this->load->view('myhouse', array(
      'houses' => $h_list,
    ));
  }
}
