<?php
require_once($_SERVER['DOCUMENT_ROOT']."/views/view.php");

class Names_AddEdit_Meet_View extends View {
    
  protected function template() {
    return 'addedit_meet/names_addedit_meet';
  }
  
  /*protected function js() {
    return ['addedit_meet/names_addedit_meet'];
  }*/
}