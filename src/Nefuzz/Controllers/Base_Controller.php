<?php

namespace Nefuzz\Controllers;

abstract class Base_Controller {
  protected $header_arguments = [];
  
  protected function page_header() {
    require_once($_SERVER['DOCUMENT_ROOT']."/src/Nefuzz/Models/User.php");
    //session_start();
    $header = new \Nefuzz\Views\Header();
    $header->user = ($_SESSION['user'] ?? null);
    foreach ($this->header_arguments as $key => $val) {
      if (isset($header->{$key})) {
        $this->{$key} = $val;
      }
    }
    $header->load();
  }
  
  protected abstract function page_body();
  
  public function request($action, $argument) {
    return false;
  }
  
  public function set_argument($argument) {
    return false;
  }
  
  protected function page_footer() {
    $footer = new \Nefuzz\Views\Footer();
    $footer->load();
  }
  
  public function load() {
    $this->page_header();
    $this->page_body();
    $this->page_footer();
  }
}