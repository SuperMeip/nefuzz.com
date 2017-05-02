<?php

namespace Nefuzz\Controllers;

abstract class Controller {
  protected $header_arguments = [];
  
  protected function page_header() {
    require_once($_SERVER['DOCUMENT_ROOT']."/src/Nefuzz/models/user.php");
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT']."/src/Nefuzz/views/header.php");
    $header = new Header_View();
    $header->user = ($_SESSION['user'] ?? null);
    foreach ($this->header_arguments as $key => $val) {
      if (isset($header->{$key})) {
        $this->{$key} = $val;
      }
    }
    $header->load();
  }
  
  protected abstract function page_body();
  
  protected function page_footer() {
    require_once($_SERVER['DOCUMENT_ROOT']."/src/Nefuzz/views/footer.php");
    $footer = new Footer_View();
    $footer->load();
  }
  
  public function load() {
    $this->page_header();
    $this->page_body();
    $this->page_footer();
  }
}