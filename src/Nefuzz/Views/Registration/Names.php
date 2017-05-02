<?php
require_once($_SERVER['DOCUMENT_ROOT']."/views/view.php");

class Names_Registration_View extends View {
  
  protected function js() {
    return ["registration/names"];
  }
  
  protected function template() {
    return "registration/names";
  }
}