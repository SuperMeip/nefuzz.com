<?php

namespace Nefuzz\Views;

abstract class Base_View {
    
  public function load() {
    $this->preload();
    $template = $this->template();
    require_once($_SERVER['DOCUMENT_ROOT']."/static/templates/$template.php");
    $js_files = $this->js();
    foreach ($js_files as $file) {
      require_once($_SERVER['DOCUMENT_ROOT']."/static/js/views/$file.php");
    }
  }
  
  public function __toString() {
    $this->preload();
    $content = "";
    $template = $this->template();
    $content .= $this->get_file_data($_SERVER['DOCUMENT_ROOT']."/static/templates/$template.php");
    $js_files = $this->js();
    foreach ($js_files as $file) {
       $content .= $this->get_file_data($_SERVER['DOCUMENT_ROOT']."/static/js/views/$file.php");
    }
    return $content;
  }
  
  protected function preload() {}
    
  protected function js() {
    return [];    
  }
  
  private function get_file_data($file) {
    ob_start();
    include($file);
    return ob_get_clean();
  }
  
  abstract protected function template();
}