<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

  public function __construct() {
    parent::__construct();

    $this->load->model('rh_house');
    $this->load->helper('rh_public');
    // $this->load->library('lib_redis');
  }

  public function login() {
    $openid_info = $this->input->get();
    log_message('debug', '/home/login recv data: ' . json_encode($openid_info));
    log_message('debug', '/home/login recv data: email=' . $openid_info['openid_sreg_email']);
    log_message('debug', '/home/login recv data: nickname=' . $openid_info['openid_sreg_nickname']);
    log_message('debug', '/home/login recv data: fullname=' . $openid_info['openid_sreg_fullname']);

    // check the Openid server data
    $sig = $openid_info['openid_sig'];
    $signed = $openid_info['openid_signed'];
    $signed_list = explode(',', $signed);

  }

  // default index entry
  public function index() {
    // fetch this mouth house data
    $all_pos = $this->rh_house->fetch_all_pos();
    log_message('debug', 'Fetch all pos: ' . json_encode($all_pos));

    foreach ($all_pos as $key => $value) {
      $tmp = explode(',', $all_pos[$key]['xy_point']);
      $new = array();
      foreach ($tmp as $k => $v) {
        $new[] = (float)$v;
      }
      $all_pos[$key]['xy_point'] = $new;
    }
    log_message('debug', 'New pos: ' . json_encode($all_pos));

    $hits_num = file_get_contents('hits.dat');

    $this->load->view('home', array(
      'pos' => $all_pos,
      'hit' => $hits_num,
    ));
  }

  public function about() {
    $this->load->view('about');
  }

  public function publish() {
    $this->load->view('publish');
  }

  public function pos() {
    $this->load->view('pos');
  }

  public function pub_ok() {
    $this->load->view('pub_success');
  }
  public function pub_error() {
    $this->load->view('pub_failed');
  }

  // Redirect to NE-Openid
  public function neid() {
    // doc: https://login.netease.com/download/ntes_openid_dev.pdf

    $params = array(
      'openid.mode' => 'associate',
      'openid.assoc_type' => 'HMAC-SHA256',
      'openid.session_type' => 'no-encryption',
    );

    $url = 'https://login.netease.com/openid/';

    $post_ret = rh_post($url, $params);
    // echo $post_ret;
    $line_list = explode("\n", $post_ret);
    // print_r($line_list);
    $post_arr = [];
    foreach ($line_list as $key => $value) {
      $l = trim($value);
      if ($l) {
        $l_list = explode(':', $l);
        $post_arr[$l_list[0]] = $l_list[1];
      }
    }
    // print_r($post_arr);
    log_message('debug', 'OpenID Server response : ' . json_encode($post_arr));

    $jump_param = array(
      'openid.ns' => 'http://specs.openid.net/auth/2.0',
      'openid.mode' => 'checkid_setup',
      'openid.assoc_handle' => $post_arr['assoc_handle'],
      'openid.return_to'  => base_url() . 'home/login',
      'openid.claimed_id' => 'http://specs.openid.net/auth/2.0/identifier_select',
      'openid.identity'  => 'http://specs.openid.net/auth/2.0/identifier_select',
      'openid.realm' => base_url() . 'home/openid',
      'openid.ns.sreg' => 'http://openid.net/extensions/sreg/1.1',
      'openid.sreg.required' => 'nickname,email,fullname',
    );

    $url .= '?openid.mode=' . $jump_param['openid.mode'];
    $url .= '&openid.ns=' . $jump_param['openid.ns'];
    $url .= '&openid.realm' . $jump_param['openid.realm'];
    $url .= '&openid.sreg.required=' . $jump_param['openid.sreg.required'];
    $url .= '&openid.assoc_handle=' . $jump_param['openid.assoc_handle'];
    $url .= '&openid.return_to=' . $jump_param['openid.return_to'];
    $url .= '&openid.ns.sreg=' . $jump_param['openid.ns.sreg'];
    $url .= '&openid.identity=' . $jump_param['openid.identity'];
    $url .= '&openid.claimed_id=http://specs.openid.net/auth/2.0/identifier_select';

    header("Location: " . $url);
  }
}
