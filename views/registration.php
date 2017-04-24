<?php
require_once($_SERVER['DOCUMENT_ROOT']."/views/view.php");

class Registration_View extends View {

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
