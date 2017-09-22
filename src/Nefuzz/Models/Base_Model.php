<?php

namespace Nefuzz\Models;

/**
 * Class Base_Model
 *
 * The base class for models
 * @package Nefuzz\Models
 */
abstract class Base_Model {

  /**
   * Populate the model with data from an array
   *
   * @param array $values - the values of the model as name => value
   */
  protected function populate($values) {
    foreach ($values as $key => $value) {
      if (isset($this->{$key})) {
        $this->{$key} = $value;
      }
    }
  }

  /**
   * Build a new model from the given array of values
   *
   * @param array $values - The values of the model as variable name => value
   *
   * @return self - A model built from the array values
   */
  public static function build($values) {
    $class_name = get_class();
    $model = new $class_name();
    $model->populate($values);

    return $model;
  }

  /**
   * Constructor, optionally populates too
   *
   * @param null $values
   */
  public function _construct($values = null) {
    if (!empty($values)) {
      $this->populate($values);
    }
  }

  /**
   * Magic method get
   *
   * @param string $name
   *
   * @return mixed
   *
   * @throws \Exception - If no getX method is found for the property being called
   */
  public function __get($name)
  {
    $method = sprintf('get%s', ucfirst($name));

    if (!method_exists($this, $method)) {
      throw new \Exception();
    }

    return $this->$method();
  }

  /**
   * Magic methods set
   *
   * @param string $name
   * @param mixed  $value
   *
   * @throws \Exception - If no getX method is found for the property being called
   */
  public function __set($name, $value)
  {
    $method = sprintf('set%s', ucfirst($name));

    if (!method_exists($this, $method)) {
      throw new \Exception();
    }

    $this->$method($value);
  }

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
  public static function validate($value, $validation, $error, $DBC = false) {
    if (strpos($value, "<") !== false) {
      throw new \Exception("$error, an illegal character, '<', was detected");
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
        throw new \Exception("$error, did not match the required pattern");
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
        throw new \Exception("$error, incorrect character length > $validation");
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
        throw new \Exception("$error, field is required");
      }
    //else I have no idea
    } else {
      if ($DBC) {
        $DBC->query("ROLLBACK");
        $DBC->quit();
      }
      throw new \Exception("$error, unknown data error");
    }
  }
}