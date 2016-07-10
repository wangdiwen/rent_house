<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upimgs extends CI_Controller {
  public function __construct() {
    parent::__construct();

  }

  // receive the upload images
  public function recv() {
    // this iface just adapt for bootstrap-fileinput asnyc model
    $user_corp = $this->input->post('popo');      // corp Email name
    $ukey = $this->input->post('ukey');           // msec
    $user_corp = trim($user_corp);
    log_message('debug', 'Upload imgs: user_corp = [' . $user_corp . '], ukey=' . $ukey);

    // check params error
    if (! $user_corp || ! $ukey) {
      echo json_encode(array(
        'error' => 'Upload Error: Your Corp Email is NULL!',
      ));
      return;
    }

    if (empty($_FILES['multi_imgs']['name'])) {
      echo json_encode(array(
        'error' => 'Upload Error: Photo is NULL!',
      ));
      return;
    }

    // create the first dir
    $img_dir = 'data/' . $user_corp;
    if (! is_dir($img_dir)) {
      @mkdir($img_dir, 0755);
    }
    // create the second dir
    $img_dir .= '/' . $ukey;
    if (! is_dir($img_dir)) {
      @mkdir($img_dir, 0755);
    }

    log_message('debug', json_encode($_FILES));

    $p1 = $p2 = [];

    for ($i=0; $i < count($_FILES['multi_imgs']['name']); $i++) {
      $suffix = pathinfo($_FILES['multi_imgs']['name'][$i], PATHINFO_EXTENSION);
      $tmp_file = $_FILES['multi_imgs']['tmp_name'][$i];
      $key = 'rh-' . time() . '-' . rand(1024, 4096) . '-' . $i;
      $dest = $img_dir . '/' . $key . '.' . $suffix;
      log_message('debug', 'tmp_file=' . $tmp_file . ', dest_file=' . $dest);

      // save the file
      $ret = move_uploaded_file($tmp_file, $dest);

      $p1[$i] = base_url() . $dest;
      $p2[$i] = array(
        'caption' => $_FILES['multi_imgs']['name'][$i],
        'size' => $_FILES['multi_imgs']['size'][$i],
        'width' => '120px',
        'url' => base_url() . $dest,
        'key' => $key,
      );
    }

    // build success response struct
    $output = json_encode(array(
      'initialPreview' => $p1,
      'initialPreviewConfig' => $p2,
      'append' => true,
    ));
    log_message('debug', $output);
    echo $output;
  }

}
