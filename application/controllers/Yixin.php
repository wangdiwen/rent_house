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

  public function pubapi() {
    $xml = file_get_contents('php://input');
    log_message('debug', 'Recv Yixin xml data: ' . $xml);

    // parse the xml
    $oxml = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
    $my = $oxml->ToUserName;
    $user = $oxml->FromUserName;
    $msg_type = $oxml->MsgType;
    $event = $oxml->Event;
    $e_key = $oxml->EventKey;

    log_message('debug', 'my=' . $my . ', user=' . $user . ', msg_type=' .
      $msg_type . ', event=' . $event . ', e_key=' . $e_key);

    if ($msg_type == 'text') {
      $respose_text = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[%s]]></MsgType>
<Content><![CDATA[%s]]></Content>
</xml>";

      $dt = sprintf($respose_text, $user, $my, time(), 'text', 'Hello World！');
      log_message('debug', 'Response to user: ' . $dt);
      echo $dt;
      return;
    }

    echo '';
  }

  // 创建自定义易信菜单
  public function setmenu() {
    $atk = $this->_get_atk();
    $url = 'https://api.yixin.im/cgi-bin/menu/create?access_token=' . $atk;

    $menu = array(
      'button' => array(
        array(
          'name' => '菜单一',
          'type' => 'click',
          'key' => '/menu1'
        ),
        array(
          'name' => '菜单二',
          'type' => 'click',
          'key' => '/menu2'
        ),
        array(
          'name' => '菜单三',
          'type' => 'click',
          'key' => '/menu3'
        ),
        array(
          'name' => '其他',
          'sub_button' => array(
            array(
              'name' => '其他一',
              'type' => 'click',
              'key' => '/other1'
            ),
            array(
              'name' => '其他',
              'type' => 'click',
              'key' => '/other2'
            ),
            array(
              'name' => '其他3',
              'type' => 'click',
              'key' => '/other3'
            ),
          )
        ),
      )
    );

    $dt = json_encode($menu);
    $hd = array(
      'Content-Type: text/html; charset=UTF-8',
      'Content-Length: ' . strlen($dt),         // must set it
      'Cache-Control: no-cache'
    );
    log_message('debug', 'Set Yixin Menu: ' . $dt);

    $res = rh_post($url, $dt, true, $hd);
    log_message('debug', 'set yixin menu res: ' . $res);
    $jres = json_decode($res, true);
    if ($jres['errcode'] === 0) {
      log_message('debug', 'Set Yixin Menu ok');
      return true;
    }
    else
      log_message('debug', 'Set Yixin Menu failed: ' . $jres['errmsg']);
    return false;
  }

  // 删除自定义易信菜单
  public function delmenu() {
    $url = 'https://api.yixin.im/cgi-bin/menu/delete?access_token=' . $this->_get_atk();
    $res = rh_get($url);
    $jres = json_decode($res, true);
    log_message('debug', 'Del Yixin menu response: ' . $res);
    if ($jres['errcode'] === 0) {
      log_message('debug', 'del yixin menu ok');
      return true;
    }
    else
      log_message('debug', 'del yixin menu failed: ' . $jres['errmsg']);
    return false;
  }

  // Yixin的Token获取接口，私有，在需要发起易信接口调用的时候使用
  private function _get_atk() {
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

  // Yixin开发者接入调试接口 -- donnot change it !!
  // public function pubapi() {
  //   $signature = $this->input->get('signature');
  //   $timestamp = $this->input->get('timestamp');
  //   $nonce = $this->input->get('nonce');
  //   $echostr = $this->input->get('echostr');
  //   log_message('debug', json_encode($this->input->get()));
  //
  //   $a = array(
  //     'token' => 'yizuyimai87v5',
  //     'timestamp' => $timestamp,
  //     'nonce' => $nonce,
  //   );
  //
  //   sort($a);
  //   $en_str = '';
  //   foreach ($a as $key => $value) {
  //     $en_str .= $value;
  //   }
  //
  //   log_message('debug', 'encrypt str = ' . $en_str);
  //   $en_str = sha1($en_str);
  //   log_message('debug', 'encrypted   = ' . $en_str);
  //
  //   if ($en_str === $signature)
  //     echo $echostr;
  //   else
  //     echo '';
  // }

}
