<?php

/**
 * The base collection class
 *
 * Class Base_Collection
 */
class Base_Collection {

  /**
   * The name of the model this is a collection of
   *
   * @var string
   */
  protected $model_name = 'change me!';

  /**
   * The models this collection contains
   *
   * @var
   */
  public $models;

  /**
   * Set at index for array
   *
   * @param $offset
   * @param $value
   */
  public function offsetSet($offset, $value) {
    if (is_null($offset)) {
      $this->models[] = $value;
    } else {
      $this->models[$offset] = $value;
    }
  }

  /**
   * The array isset
   *
   * @param $offset
   *
   * @return bool
   */
  public function offsetExists($offset) {
    return isset($this->models[$offset]);
  }

  /**
   * The array unset
   *
   * @param $offset
   */
  public function offsetUnset($offset) {
    unset($this->models[$offset]);
  }

  /**
   * Get the value at the offset
   *
   * @param $offset
   *
   * @return null|mixed
   */
  public function offsetGet($offset) {
    return isset($this->models[$offset]) ? $this->models[$offset] : null;
  }

  /**
   * Get the amount of models in this collection
   *
   * @return int
   */
  public function count() {
    return count($this->models);
  }

  /**
   * Populate this collection with an array values
   *
   * @param array $values - The values to populate the models with
   */
  public function populate($values) {
    $parts = explode('_', get_class($this));
    unset($parts[count($parts) - 1]);
    $model_name = implode('_', $parts);
    foreach ($values as $column) {
      $this->models[] = new \Nefuzz\Models\{$model_name}($column);
    }
  }
}