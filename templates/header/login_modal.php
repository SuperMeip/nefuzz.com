<?php
require_once("components/common.php")
?>

<div class="center_column">
  <form>
    <div class="row center">
      <?=new Text_Input([
        "label" => "Username",
        "name" => "username",
        "max_characters" => 20,
        "size" => "full",
        "is_required" =>  true
      ]);?>
    </div>
    <div class="row center">
      <?=new Text_Input([
        "label" => "Password",
        "name" => "password",
        "max_characters" => 20,
        "size" => "full",
        "is_required" =>  true,
        "is_password" => true
      ]);?>
    </div>
    <div class="center">
      <?=new Button([
        "label" => "Login",
        "is_submit" => true,
        "extra_classes" => "right"
      ]);?>
    </div>
  </form>
</div>