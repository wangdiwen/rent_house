<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class House extends CI_Controller {

  public function __construct() {
    parent::__construct();

    $this->load->model('rh_house');
    // $this->load->library('lib_redis');
  }

  // public function db() {
  //   return $this->rh_house->has();
  // }

  public function modify() {
    $id = $this->input->get('id');
    if (is_numeric($id)) {
      $detail = $this->rh_house->one_detail($id);
      if ($detail) {
        log_message('debug', 'modify detail = ' . json_encode($detail));
        $this->load->view('modify', array(
          'info' => $detail,
          'id' => $id,
        ));
        return;
      }
    }

    $this->load->view('error');
  }

  public function pub_mod() {
    $id = $this->input->get('id');
    $post = $this->input->post();
    log_message('debug', 'pub_mod: ' . $id);
    log_message('debug', 'pub_mod: ' . json_encode($post));

    if (is_numeric($id) && $post['community'] && $post['room_num']
      && $post['room_type'] && $post['rent_type']
      && $post['man'] && $post['price'] && $post['s_date']) {
      $ret = $this->rh_house->update_byid($id, $post['s_date'], $post['community'],
        $post['phone'], $post['room_num'], $post['room_type'], $post['rent_type'],
        $post['man'], $post['price'], $post['other_info']);
      if ($ret) {
        $this->load->view('pub_success');
        return;
      }
    }
    $this->load->view('error');
  }

  // search the small zoon
  public function search() {
    $zoon_name = trim($this->input->post('zoon_name'));
    log_message('debug', 'Search zoon name = ' . $zoon_name);

    // fetch just this zoon data
    $all_pos = $this->rh_house->fetch_zoon($zoon_name);
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

  // lookup the detail info of the house
  public function detail() {
    $house_id = $this->input->get('id');
    $detail = $this->rh_house->one_detail($house_id);
    if ($detail) {
      if ($detail['animal']) {
        $tmp = explode(',', $detail['animal']);
        $new = array();
        foreach ($tmp as $key => $value) {
          if ($value == 'cat') $new[] = '喵星人';
          elseif ($value == 'dog') $new[] = '汪星人';
        }
        $detail['animal'] = $new;
      }

      unset($detail['xy_point']);

      // fetch the image file path list
      $detail['imgs'] = array();
      $img_dir = 'data/' . $detail['popo'] . '/' . $detail['ukey'];
      if (is_dir($img_dir)) {
        $dir = dir($img_dir);
        while (($file = $dir->read()) !== false) {
          if ($file !== '.' && $file !== '..')
            $detail['imgs'][] = '/' . $img_dir . '/' . $file;
        }
        $dir->close();
      }

      unset($detail['ukey']);
    }

    // print_r($detail);
    $this->load->view('detail', array(
      'detail' => $detail,
    ));
  }

  // recv the house publish params
  public function pub() {
    $community = trim($this->input->post('community'));   // * xxx
    $popo = trim($this->input->post('popo'));             // * xxx
    $phone = trim($this->input->post('phone'));     //   132xxx
    $room_num = $this->input->post('room_num');     // * 3
    $room_type = $this->input->post('room_type');   // * master|slave|single
    $rent_type = $this->input->post('rent_type');   // * long|short
    $man = $this->input->post('man');               // * girl|boy|no
    $animal = $this->input->post('animal');         //   cat|dog|no
    $price = $this->input->post('price');           // * 1500
    $other = $this->input->post('other_info');      //   xxx
    $xy_point = $this->input->post('xy_point');     // * 120.3432254,30.3434343
    $s_date = $this->input->post('s_date');         // * 2016-07-08
    $ukey = $this->input->post('ukey');             // * 1467896311543

    log_message('debug', 'House pub post params: ' . json_encode($this->input->post()));

    if ($other)
      $other = substr($other, 0, 139);

    $animal_str = '';
    if ($animal) $animal_str = implode(',', $animal);

    $page = 'pub_failed';
    if ($community && $popo && $xy_point) {
      $ret = $this->rh_house->save_item($s_date, $ukey, $community, $popo, $phone, $room_num,
        $room_type, $rent_type, $man, $animal_str, $price, $xy_point, $other);
      if ($ret)
        $page = 'pub_success';
    }

    // echo $page;
    $this->load->view($page);
  }

}
