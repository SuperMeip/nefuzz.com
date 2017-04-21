<?php
include_once($_SERVER['DOCUMENT_ROOT']."/php/auth.php");
/*
function use_control($name, $get = [], $decode = true) {
  $get_string = "";
  if (!empty($get)) {
      $get_string = "?" . http_build_query($get);
  }
  $url = "https://www.nefuzz.com/controls/" . $name . ".php" . $get_string;
  $curl_handle = curl_init();
  curl_setopt( $curl_handle, CURLOPT_URL, $url );
  curl_setopt( $curl_handle, CURLOPT_RETURNTRANSFER, true );
  curl_setopt( $curl_handle, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
  curl_setopt( $curl_handle, CURLOPT_USERPWD, "{$GLOBALS['REST_AUTH_USER']}:{$GLOBALS['REST_AUTH_PW']}");
  $text = "";
  if ($decode) {
    $text = json_decode(curl_exec( $curl_handle ), true);
  } else {
    $text = curl_exec( $curl_handle );
  }
  curl_close( $curl_handle );
  return $text;
}*/