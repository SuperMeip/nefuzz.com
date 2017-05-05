<?php

namespace Nefuzz\Views\Header;

class Login_Modal extends \Nefuzz\Views\Base_View {

  protected function js() {
    return ["header/login_modal"];
  }
  
  protected function template() {
    return "header/login_modal";
  }
}