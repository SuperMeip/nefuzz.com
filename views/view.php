<?php

abstract class View {
    
  public function load() {
    $template = template();
    require_once($_SERVER['DOCUMENT_ROOT']."/templates/$template.php");
    $js_files = js();
    foreach ($js_files as $file) {
      require_once($_SERVER['DOCUMENT_ROOT']."/js/views/$file.php");
    }
  }
    
  protected function js() {
    return [];    
  }
  
  abstract protected function template();
}