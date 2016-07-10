<?php if (! defined('BASEPATH')) exit('No direct script access allowed.');

class Rh_advice extends CI_Model {

  protected $tb_name = 'rh_advice';

  public function __construct() {
    // Call the CI_Model constructor
    parent::__construct();

    $this->load->database();
  }

  public function fetch_10() {
    $this->db->select('id, nick, popo, say, pub_time')
      ->from($this->tb_name)
      ->where('status', 1)
      ->order_by('pub_time', 'DESC')
      ->limit(10);

      $query = $this->db->get();
      if ($query && $query->num_rows() > 0) {
        return $query->result_array();
      }
      return [];
  }

  public function save_item($nick, $popo, $say) {
    $data = array(
      'nick' => $nick,
      'popo' => $popo,
      'say' => $say,
      'pub_time' => date('Y-m-d H:i:s'),
    );

    return $this->db->insert($this->tb_name, $data);
  }

}
