<?php
require_once($_SERVER['DOCUMENT_ROOT']."/views/view.php");

class Everyone_Map_View extends View {
  
  public $users_and_locations = [];
    
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