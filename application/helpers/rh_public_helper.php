<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (! function_exists('rh_post')) {
  function rh_post($url = '', $params = array()) {
    if ($url && $params) {
        $curl_obj = curl_init();

        $curl_params = '';
        if ($params) {
            $tmp_array = array();
            foreach ($params as $key => $value) {
                $tmp_array[] = $key.'='.$value;
            }
            $curl_params = implode('&', $tmp_array);
        }

        curl_setopt($curl_obj, CURLOPT_URL, $url);
        curl_setopt($curl_obj, CURLOPT_HEADER, false);
        curl_setopt($curl_obj, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl_obj, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_obj, CURLOPT_POST, true);
        if ($curl_params) {
            curl_setopt($curl_obj, CURLOPT_POSTFIELDS, $curl_params);
        }

        $ret_data = curl_exec($curl_obj);
        curl_close($curl_obj);

        return $ret_data;
    }
    return false;
  }
}
