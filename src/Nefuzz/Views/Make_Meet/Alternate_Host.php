<?php

namespace Nefuzz\Views\Make_Meet;

class Alternate_Host extends \Nefuzz\Views\Base_View {
    
  public function __construct() {
    $raw_methods = \Nefuzz\Models\User::get_all_contact_methods();

    foreach ($raw_methods as $method) {
      $this->contact_methods[$method['name']] = $method['id'];
    }
  }
  
  function contact_options() {
    return array_merge(["" => ""], $this->contact_methods);
  }
  
  protected function template() {
    return "make_meet/alternate_host";
  }
}