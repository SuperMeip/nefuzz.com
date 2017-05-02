<?php
require_once($_SERVER['DOCUMENT_ROOT']."/views/view.php");

class Basic_Event_Details_View extends View {
  
  protected function template() {
    return 'addedit_meet/basic_event_details';
  }
  
  /*protected function js() {
    return ['addedit_meet'];
  }*/
}