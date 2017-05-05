<?php

namespace Nefuzz\Models;

class Base_Model {
  protected function validate($value, $validation, $error, $DBC = false) {
    if (strpos($value, "<") !== false) {
      throw new Exception("$error, an illegal character, '<', was detected");
    }
    //if string it's regex
    if (is_string($validation)) {
      if (preg_match("/$validation/", $value)) {
        return $value; 
      } else {
        if ($DBC) {
          $DBC->query("ROLLBACK");
          $DBC->quit();
        }
        throw new Exception("$error, did not match the required pattern");
      }
    //if int it's max-length
    } elseif (is_int($validation)) {
      if (strlen($value) <= $validation) {
        return $value;
      } else {
        if ($DBC) {
          $DBC->query("ROLLBACK");
          $DBC->quit();
        }
        throw new Exception("$error, incorrect character length > $validation");
      }
    //if bool it must be changed/ is required
    } elseif (is_bool($validation)) {
      if ($value) {
        return $value;
      } else {
        if ($DBC) {
          $DBC->query("ROLLBACK");
          $DBC->quit();
        }
        throw new Exception("$error, field is required");
      }
    //else I have no idea
    } else {
      if ($DBC) {
        $DBC->query("ROLLBACK");
        $DBC->quit();
      }
      throw new Exception("$error, unknown data error");
    }
  }
}