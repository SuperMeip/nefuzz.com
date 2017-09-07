<?php

namespace Nefuzz\Controllers;

/**
 * Class Not_Found
 * The page not found page 404
 *
 * @package Nefuzz\Controllers
 */
class Not_Found extends \Nefuzz\Controllers\Base_Controller {

  protected function page_body() {
    $view = new \Nefuzz\Views\Not_Found();
    $view->load();
  }
}