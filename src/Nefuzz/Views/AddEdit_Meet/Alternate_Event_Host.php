<?php
require_once($_SERVER['DOCUMENT_ROOT']."/views/view.php");

class Alternate_Event_Host_View extends View {
    
  public function __construct() {
    $raw_methods = User::get_all_contact_methods();

    foreach ($raw_methods as $method) {
      $this->contact_methods[$method['name']] = $method['id'];
    }
  }
  
  function contact_options() {
    return array_merge(["" => ""], $this->contact_methods);
  }
  
  protected function template() {
    return "addedit_meet/alternate_event_host";
  }
}