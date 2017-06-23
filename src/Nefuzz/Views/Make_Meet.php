<?php

namespace Nefuzz\Views;

class Make_Meet extends \Nefuzz\Views\Base_View {
    
  public $meet = 0;
    
  protected function preload() {
  }
  
  protected function template() {
    return 'make_meet';
  }
  
  protected function js() {
    return ['make_meet'];
  }
  
  public function redirect() {
    if (!isset($_SESSION["user"])){
      echo "
        <script>
          window.location = \"https://nefuzz.com\";
        </script>
      ";
    }
  }
}