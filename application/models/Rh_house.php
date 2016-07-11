<?php if (! defined('BASEPATH')) exit('No direct script access allowed.');

class Rh_house extends CI_Model {

  protected $tb_name = 'rh_house';

  public function __construct() {
    // Call the CI_Model constructor
    parent::__construct();

    $this->load->database();
    // $this->load->dbutil();
  }

  // fetch just one record detail info
  public function one_detail($house_id) {
    $this->db->select('id, s_date, pub_time, ukey, community, popo, phone,
      room_num, room_type, rent_type,
      man, animal, price, xy_point, other')
      ->from($this->tb_name)
      ->where('id', $house_id)
      ->limit(1);
    $query = $this->db->get();
    if ($query && $query->num_rows() > 0) {
      return $query->row_array();
    }
    return [];
  }

  // fetch all house in cur month
  public function fetch_all_pos() {
    $where = array(
      's_date >=' => date('Y-m-d'),
      'status' => 1,
    );

    $this->db->select('id, s_date, pub_time, community, room_num, room_type, price, xy_point')
      ->from($this->tb_name)
      ->where($where)
      ->limit(50);
    $query = $this->db->get();
    if ($query && $query->num_rows() > 0) {
      return $query->result_array();
    }
    return [];
  }

  // fetch just zoon
  public function fetch_zoon($zoon_name) {
    $this->db->select('id, s_date, pub_time, community, room_num, room_type, price, xy_point')
      ->from($this->tb_name)
      ->where(array(
        's_date >=' => date('Y-m-d'),
        'status' => 1,
      ))
      ->like('community', $zoon_name)
      ->limit(50);
    $query = $this->db->get();
    if ($query && $query->num_rows() > 0) {
      return $query->result_array();
    }
    return [];
  }

  // save the publish house record
  public function save_item($s_date, $ukey, $community, $popo, $phone, $room_num,
    $room_type, $rent_type, $man, $animal, $price, $xy_point, $other) {
    $data = array(
      's_date' => $s_date,
      'status' => 1,
      'pub_time' => date('Y-m-d H:i:s'),
      'ukey' => $ukey,
      'community' => $community,
      'popo' => $popo,
      'phone' => $phone,
      'room_num' => $room_num,
      'room_type' => $room_type,
      'rent_type' => $rent_type,
      'man' => $man,
      'animal' => $animal,
      'price' => $price,
      'xy_point' => $xy_point,
      'other' => $other,
    );

    log_message('debug', 'Save house item: ' . json_encode($data));
    // print_r($data); return true;
    return $this->db->insert($this->tb_name, $data);
  }

  // public function has() {
  //   if ($this->dbutil->database_exists('rh')) {
  //     echo "Yes</br>";
  //     echo $this->db->version();
  //     echo "</br>";
  //     echo $this->db->platform();
  //     return;
  //   }
  //   echo "No";
  // }
  //
}
