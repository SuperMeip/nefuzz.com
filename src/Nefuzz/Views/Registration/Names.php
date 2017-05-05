<?php

namespace Nefuzz\Views\Registration;

class Names extends \Nefuzz\Views\Base_View {
  
  protected function js() {
    return ["registration/names"];
  }
  
  protected function template() {
    return "registration/names";
  }
}