<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

  public function __construct() {
    parent::__construct();

    $this->load->model('rh_house');
    // $this->load->library('lib_redis');
  }

  public function recv_openid() {
    $openid_info = $this->input->get();
    log_message('debug', '/home/login recv data: ' . json_encode($openid_info));
    log_message('debug', '/home/login recv data: email=' . $openid_info['openid_sreg_email']);
    log_message('debug', '/home/login recv data: nickname=' . $openid_info['openid_sreg_nickname']);
    log_message('debug', '/home/login recv data: fullname=' . $openid_info['openid_sreg_fullname']);

    // check the Openid server data
    $sig = $openid_info['openid_sig'];
    $signed = $openid_info['openid_signed'];
    $signed_list = explode(',', $signed);

    log_message('debug', 'OpenID server res = ' . json_encode($this->session->userdata('neid')));
    $neid_data = $this->session->userdata('neid');
    $mac_key = $neid_data['mac_key'];

    if ($openid_info['openid_mode'] !== 'id_res'
      || $openid_info['openid_assoc_handle'] !== $neid_data['assoc_handle']
      || strpos($openid_info['openid_identity'], 'https://login.netease.com/openid/') !== 0
      || strpos($openid_info['openid_claimed_id'], 'https://login.netease.com/openid/') !== 0
      ) {
      log_message('debug', $openid_info['openid_mode']);
      log_message('debug', $openid_info['openid_assoc_handle']);
      log_message('debug', $neid_data['assoc_handle']);
      log_message('debug', strpos($openid_info['openid_identity'], 'https://login.netease.com/openid/'));
      log_message('debug', strpos($openid_info['openid_claimed_id'], 'https://login.netease.com/openid/'));
      echo "Invalid OpenID !!!";
      return false;
    }

    $sig_str = 'assoc_handle:' . $openid_info['openid_assoc_handle'] . "\n";
    $sig_str .= 'ax.mode:' . $openid_info['openid_ax_mode'] . "\n";
    $sig_str .= 'claimed_id:' . $openid_info['openid_claimed_id'] . "\n";
    $sig_str .= 'identity:' . $openid_info['openid_identity'] . "\n";
    $sig_str .= 'mode:id_res' . "\n";
    $sig_str .= 'ns:http://specs.openid.net/auth/2.0' . "\n";
    $sig_str .= 'ns.ax:http://openid.net/srv/ax/1.0' . "\n";
    $sig_str .= 'ns.sreg:http://openid.net/extensions/sreg/1.1' . "\n";
    $sig_str .= 'op_endpoint:https://login.netease.com/openid/' . "\n";
    $sig_str .= 'response_nonce:' . $openid_info['openid_response_nonce'] . "\n";
    $sig_str .= 'return_to:' . $openid_info['openid_return_to'] . "\n";
    $sig_str .= 'signed:' . $openid_info['openid_signed'] . "\n";
    $sig_str .= 'sreg.email:' . $openid_info['openid_sreg_email'] . "\n";
    $sig_str .= 'sreg.fullname:' . $openid_info['openid_sreg_fullname'] . "\n";
    $sig_str .= 'sreg.nickname:' . $openid_info['openid_sreg_nickname'] . "\n";

    $new_sig = base64_encode(hash_hmac('sha256', $sig_str, base64_decode($mac_key), true));
    log_message('debug', 'Old sig = ' . $sig);
    log_message('debug', 'New sig = ' . $new_sig);
    if ($sig !== $new_sig) {
      echo "Invalid OpenID !!!";
      return false;
    }

    // set this user session
    $this->session->unset_userdata('neid');
    $this->session->set_userdata(array(
      'email' => $openid_info['openid_sreg_email'],
      'nickname' => $openid_info['openid_sreg_nickname'],
      'fullname' => $openid_info['openid_sreg_fullname'],
    ));

    $open_page = $this->session->userdata('open_page');
    if ($open_page == 'home') {
      redirect('/home/index', 'location', 302);
    }
    else
      $this->load->view($open_page, array(
        'email' => explode('@', $openid_info['openid_sreg_email'])[0],
      ));
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

  public function login() {
    return $this->_redirect2neid('/home/login', 'home');
  }

  public function clean() {
    $this->session->sess_destroy();

    redirect('/home/index', 'location', 302);
  }

  public function publish() {
    $email = $this->session->userdata('email');
    if (! $email) {
      return $this->_redirect2neid('/home/publish', 'publish');
    }
    else {
      // $nickname = $this->session->userdata('nickname');
      // log_message('debug', 'publish page: ' . 'email=' . $email . ', nickname=' . $nickname);
      $this->load->view('publish', array(
        // 'email' => explode('@', $email)[0],
        'email' => explode('@', $email)[0],
      ));
    }
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
  public function _redirect2neid($from_which_url = '/home/index', $page = 'publish') {
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

    $u_session = array(
      'neid' => $post_arr,
      'open_page' => $page,
    );
    $this->session->set_userdata($u_session);

    $jump_param = array(
      'openid.ns' => 'http://specs.openid.net/auth/2.0',
      'openid.mode' => 'checkid_setup',
      'openid.assoc_handle' => $post_arr['assoc_handle'],
      'openid.return_to'  => base_url() . 'home/recv_openid',
      'openid.claimed_id' => 'http://specs.openid.net/auth/2.0/identifier_select',
      'openid.identity'  => 'http://specs.openid.net/auth/2.0/identifier_select',
      'openid.realm' => base_url() . substr($from_which_url, 1),
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
  public function timeline()
  {
  		$timelinedata= $all_pos = $this->rh_house->fetch_timeline();
  		log_message('debug', 'Fetch Timeline Data: ' . json_encode($timelinedata));

  		$hits_num = file_get_contents('hits.dat');
	    $this->load->view('timeline', array(
	      'pos' => $timelinedata,
	      'hit' => $hits_num,
	    ));
  }
  public function list2map ($id)
  {
  
    log_message('debug', 'Search House ID = ' . $id);

    $all_pos = $this->rh_house->fetch_id($id);
    log_message('debug', 'Search all pos: ' . json_encode($all_pos));

    foreach ($all_pos as $key => $value) {
      $tmp = explode(',', $all_pos[$key]['xy_point']);
      $new = array();
      foreach ($tmp as $k => $v) {
        $new[] = (float)$v;
      }
      $all_pos[$key]['xy_point'] = $new;
    }
    log_message('debug', 'Search new pos: ' . json_encode($all_pos));
	
 	$this->load->view('home', array(
      'pos' => $all_pos,
    ));
  }
}
