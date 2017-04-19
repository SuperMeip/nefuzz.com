<?php
function use_control($name, $get = []) {
  $get_string = "";
  if (!empty($get)) {
      $get_string = "?" . http_build_query($get);
  }
  $url = "https://www.nefuzz.com/controls/" . $name . ".php" . $get_string;
  $curl_handle = curl_init();
  curl_setopt( $curl_handle, CURLOPT_URL, $url );
  curl_setopt( $curl_handle, CURLOPT_RETURNTRANSFER, true );
  $text = json_decode(curl_exec( $curl_handle ), true);
  curl_close( $curl_handle );
  return $text;
}