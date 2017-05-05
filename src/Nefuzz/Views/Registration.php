<?php

namespace Nefuzz\Views;

class Registration extends \Nefuzz\Views\Base_View {

  public function redirect() {
    if (isset($_SESSION["user"])){
      echo "
        <script>
          window.location = \"https://nefuzz.com\";
        </script>
      ";
    }
  }

  protected function js() {
    return ["registration"];
  }
  
  protected function template() {
    return "registration";
  }
}