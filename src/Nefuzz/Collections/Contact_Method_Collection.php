<?php

namespace Nefuzz\Collections;

use Nefuzz\Models\Contact_Method;

/**
 * The collection for contact methods
 *
 * Class Contact_Method_Collection
 *
 * @package Nefuzz\Collections
 */
class Contact_Method_Collection extends Base_Collection{

  /**
   * Gets the default contact method in the set.
   *
   * @return Contact_Method|null
   */
  public function get_default_contact_method() {
    foreach ($this->models as $model) {
      if ($model->is_default_method) {
        return $model;
      }
    }
    return null;
  }

  public function get_methods_as_array() {
    $methods = [];
    foreach ($this->models as $model) {
      $methods[$model->method] = $model->value;
    }
  }
}