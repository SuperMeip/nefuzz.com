<?php

namespace Nefuzz\Views\User;

class Upload_New_Icon extends \Nefuzz\Views\Base_View {

  protected function js() {
    return ["user/upload_new_icon"];
  }
  
  protected function template() {
    return "user/upload_new_icon";
  }
}