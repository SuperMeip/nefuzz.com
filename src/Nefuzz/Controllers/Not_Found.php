<?php

namespace Nefuzz\Controllers;

class Not_Found extends \Nefuzz\Controllers\Base_Controller {

  protected function page_body() {
    $view = new \Nefuzz\Views\Not_Found();
    $view->load();
  }
}