<?php
require_once($_SERVER['DOCUMENT_ROOT']."/views/view.php");

class Everyone_Map_View extends View {
    
  protected function preload() {
    require_once($_SERVER['DOCUMENT_ROOT']."/php/auth.php");
  }
  
  protected function template() {
    return 'map/everyone_map';
  }
  
  protected function js() {
    return ['map/everyone_map'];
  }
}

$view = new Everyone_Map_View();
$view ->load();