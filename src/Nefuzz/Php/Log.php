<?php

namespace Nefuzz\Php;

class Log {

  const LOG_DIVIDER = "|%|%|%|%|%|%|";
  const DATA_DIVIDER = "/%/%/%/%/%/%/";

  function add($text, $data = []) {
    $log_text = "$text\n" . self::DATA_DIVIDER . "\n" ;
    if (!empty($data)) {
      ob_flush();
      ob_start();
      var_dump($data);
      $log_text.= ob_get_flush() . "\n";
    } else {
      $log_text.= "No Logged Data\n";
    }
    file_put_contents("log.txt", $log_text . self::LOG_DIVIDER, FILE_APPEND);
  }

  function get_logs($number) {
    return "";
  }
}