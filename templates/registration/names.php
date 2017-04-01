<?php
require_once ("components/common.php");
?>

<div class="row">
  <?=new Text_Input([
    "label" => "Username",
    "name" => "username",
    "is_required" => true,
    "max_characters" => 20,
    "id" => "username"
  ]);?>
  <?=new Text_Input([
    "label" => "Email Address",
    "name" => "email",
    "is_required" => true,
    "max_characters" => 50,
    "id" => "email"
  ]);?>
</div>
<div class="row">
  <?=new Text_Input([
    "label" => "Password",
    "name" => "password",
    "id" => "password",
    "is_password" => true,
    "is_required" => true,
    "max_characters" => 20
  ]);?>
  <?=new Text_Input([
    "label" => " Repeat Password",
    "id" => "repeat-password",
    "is_password" => true,
    "is_required" => true,
    "max_characters" => 20
  ]);?>
</div>
<div class="row">
  <?=new Text_Input([
    "label" => "Real Name",
    "name" => "realname",
    "max_characters" => 40
  ]);?>
  <?=new Text_Input([
    "label" => "Fur Name",
    "name" => "furname",
    "max_characters" => 30
  ]);?>
</div>