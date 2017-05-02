<?php
require_once($_SERVER['DOCUMENT_ROOT']."/views/view.php");

class Login_Modal_Header_View extends View {

  protected function js() {
    return ["header/login_modal"];
  }
  
  protected function template() {
    return "header/login_modal";
  }
}