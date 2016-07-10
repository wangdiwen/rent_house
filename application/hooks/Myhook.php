<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Myhook {
  public function __construct() {
        // $this->CI =& get_instance();
        // $this->CI->load->helper('url');
        // $this->CI->load->helper('public');
  }

  public function add_hits() {
    $df = 'hits.dat';
    $hits = NULL;
    $content = file_get_contents($df);
    // print_r($content);
    if (! $content) $hits = 1;
    else $hits = (int)$content + 1;

    if (! $fp = @fopen($df, 'w')) return false;
    @flock($fp, LOCK_EX);
    @fwrite($fp, $hits);
    @flock($fp, LOCK_UN);
    fclose($fp);
    // return $hits;
    return true;
  }

}
