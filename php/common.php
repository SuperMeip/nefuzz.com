<?php
function use_control($name) {
    $url = "https://www.nefuzz.com/controls/" . $name . ".php";
    $curl_handle = curl_init();
    curl_setopt( $curl_handle, CURLOPT_URL, $url );
    curl_setopt( $curl_handle, CURLOPT_RETURNTRANSFER, true );
    $text = json_decode(curl_exec( $curl_handle ), true);
    curl_close( $curl_handle );
    return $text;
}