<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Yixin extends CI_Controller {

  public function __construct() {
    parent::__construct();

    // $this->load->model('rh_house');
    // $this->load->library('lib_redis');
  }

  public function pubapi() {
    $signature = $this->input->get('signature');
    $timestamp = $this->input->get('timestamp');
    $nonce = $this->input->get('nonce');
    $echostr = $this->input->get('echostr');
    log_message('debug', json_encode($this->input->get()));

    $a = array(
      'token' => 'yizuyimai87v5',
      'timestamp' => $timestamp,
      'nonce' => $nonce,
    );

    sort($a);
    $en_str = '';
    foreach ($a as $key => $value) {
      $en_str .= $value;
    }

    log_message('debug', 'encrypt str = ' . $en_str);
    $en_str = sha1($en_str);
    log_message('debug', 'encrypted   = ' . $en_str);

    if ($en_str === $signature)
      echo $echostr;
    else
      echo '';
  }

}
