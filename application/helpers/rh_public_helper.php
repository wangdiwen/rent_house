<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (! function_exists('rh_get')) {
  function rh_get($url = '', $params = array()) {
      if ($url) {
          $curl_obj = curl_init();

          $curl_params = '';
          if ($params) {
              $tmp_array = array();
              foreach ($params as $key => $value) {
                  if ($key && $value) {
                      $tmp_array[] = $key.'='.$value;
                  }
              }
              $curl_params = implode('&', $tmp_array);
          }

          if ($curl_params)
            $url .= '?'.$curl_params;

          curl_setopt($curl_obj, CURLOPT_URL, $url);
          curl_setopt($curl_obj, CURLOPT_TIMEOUT, 30);
          curl_setopt($curl_obj, CURLOPT_HEADER, false);  // 不返回头，just body
          curl_setopt($curl_obj, CURLOPT_RETURNTRANSFER, true);

          $ret_data = curl_exec($curl_obj);
          curl_close($curl_obj);

          return $ret_data;
      }
      return false;
  }
}

// Ps. 如果params为字符post数据，pure_data设置为true
if (! function_exists('rh_post')) {
  function rh_post($url = '', $params = array(), $pure_data = false, $header = array()) {
    if ($url && $params) {
        $curl_obj = curl_init();

        $curl_params = '';
        if ($params && ! $pure_data) {
            $tmp_array = array();
            foreach ($params as $key => $value) {
                $tmp_array[] = $key.'='.$value;
            }
            $curl_params = implode('&', $tmp_array);
        }
        else
          $curl_params =& $params;

        curl_setopt($curl_obj, CURLOPT_URL, $url);
        if ($pure_data && $header)
          curl_setopt($curl_obj, CURLOPT_HTTPHEADER, $header);
        elseif ($pure_data && ! $header) {
          $header = array(
            'Content-Length: ' . strlen($curl_params)
          );
          curl_setopt($curl_obj, CURLOPT_HTTPHEADER, $header);
        }

        curl_setopt($curl_obj, CURLOPT_HEADER, false);  // 不返回头，just body
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
