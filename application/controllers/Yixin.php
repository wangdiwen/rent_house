<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Yixin extends CI_Controller {

  private $appid = 'e34d3d5ad17c4c41b5652a8af3c5bb9f';
  private $appsecret = '912fd7e7430c4fa991f3a6b83626795b';

  public function __construct() {
    parent::__construct();

    // $this->load->model('rh_house');
    // $this->load->library('lib_redis');
  }

  // Yixin的Token获取接口，私有，在需要发起易信接口调用的时候使用
  private function _atk() {
    // read local tk and check the expires_time
    $text = file_get_contents('yixin_tk.dat');
    $jtk = json_decode($text, true);
    if ($jtk['expires_time'] <= time()) {
      $p = array(
        'grant_type' => 'client_credential',
        'appid' => $this->appid,
        'secret' => $this->appsecret,
      );

      $url = 'https://api.yixin.im/cgi-bin/token';
      $tk = rh_get($url, $p);
      // print_r($tk);
      $jtk = json_decode($tk, true);
      $jtk['expires_time'] = time() + $jtk['expires_in'];
      // print_r($jtk);
      // save the Yixin token to file
      @file_put_contents('yixin_tk.dat', json_encode($jtk));
    }
    // else echo "no need<br/>" . $jtk['access_token'];

    return $jtk['access_token'];
  }

  // Yixin开发者接入调试接口
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
