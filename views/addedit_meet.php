<?php
require_once($_SERVER['DOCUMENT_ROOT']."/views/view.php");

class AddEdit_Meet_View extends View {
    
  public $meet = "";
  
  public function add_or_edit() {
    return ($this->meet ? "add_meet" : "edit_meet");
  }
    
  protected function preload() {
    require_once($_SERVER['DOCUMENT_ROOT']."/components/common.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/views/addedit_meet/names_addedit_meet.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/views/addedit_meet/basic_event_details.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/views/addedit_meet/event_address.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/views/addedit_meet/alternate_event_host.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/views/addedit_meet/rrule.php");
  }
  
  protected function template() {
    return 'addedit_meet';
  }
  
  protected function js() {
    return ['addedit_meet'];
  }
}