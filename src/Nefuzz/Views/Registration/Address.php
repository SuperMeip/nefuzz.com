<?php

namespace Nefuzz\Views\Registration;

use \Nefuzz\Models\Location as Location;

class Address extends \Nefuzz\Views\Base_View {
  function region_options() {
    $raw_regions = Location::get_all_regions();
    $regions = [];
    foreach ($raw_regions as $region) {
      $regions[$region['state']] = $region['id'];
    }
    return array_merge(["" => ""], $regions);
  }
  
  protected function template() {
    return "registration/address";
  }
}