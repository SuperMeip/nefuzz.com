<?php

namespace Nefuzz\Views\Make_Meet;

class Address extends \Nefuzz\Views\Base_View {
    
  public function region_options() {
    $raw_regions = \Nefuzz\Models\Location::get_all_regions();
    $regions = [];
    foreach ($raw_regions as $region) {
      $regions[$region['state']] = $region['id'];
    }
    return array_merge(["" => ""], $regions);
  }
  
  protected function template() {
    return 'make_meet/address';
  }
  
  /*protected function js() {
    return ['make_meet/address'];
  }*/
}