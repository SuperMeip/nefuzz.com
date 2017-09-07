<?php

namespace Nefuzz\Models;

/**
 * Class Base_Model
 *
 * The base class for models
 * @package Nefuzz\Models
 */
class Base_Model {
  /**
   * Provides backend validation for values depending on how the type of the validation passed
   *
   * @param string $value             - The value to validate
   * @param $validation               - The validation. Can be length(int) regex(string) or required(bool)
   * @param $error                    - Error message for this value
   * @param \Nefuzz\Php\DBC|bool $DBC - A database connection to rollback changes if the field is invalid
   *
   * @return mixed - The value if the validation succeeds
   *
   * @throws \Exception - with the message dictated in $error when the validation fails
   */
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