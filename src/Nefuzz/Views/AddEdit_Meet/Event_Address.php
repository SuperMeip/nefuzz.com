<?php
require_once($_SERVER['DOCUMENT_ROOT']."/views/view.php");

class Event_Address_View extends View {
    
  public function region_options() {
    require_once($_SERVER['DOCUMENT_ROOT']."/models/location.php");
    $raw_regions = Location::get_all_regions();
    $regions = [];
    foreach ($raw_regions as $region) {
      $regions[$region['state']] = $region['id'];
    }
    return array_merge(["" => ""], $regions);
  }
  
  protected function template() {
    return 'addedit_meet/event_address';
  }
  
  /*protected function js() {
    return ['addedit_meet/event_address'];
  }*/
}