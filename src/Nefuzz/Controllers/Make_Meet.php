<?php

namespace Nefuzz\Controllers;

class Make_Meet extends \Nefuzz\Controllers\Base_Controller {
  
  private $meet_id = null;

  protected function page_body() {
    $view = new \Nefuzz\Views\Make_Meet();
    if (isset($this->meet_id)) {
        $view->meet = \Neuzz\Models\Meet::get($this->meet_id);
    }
    $view->load();
  }
  
  public function set_argument($argument) {
    $this->meet_id = $argument;
    return true;
  }
  
  public static function add_meet() {
    
  }
}