<?php

namespace Nefuzz\Views\Map;

class Everyone_Map extends  \Nefuzz\Views\Base_View {
  
  public $users_and_locations = [];
  
  protected function template() {
    return 'map/everyone_map';
  }
  
  protected function js() {
    return ['map/everyone_map'];
  }
  
  public function user_coords() {
    
  }
}