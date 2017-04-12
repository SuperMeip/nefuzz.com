<?php
require_once ("components/common.php");
?>
<div class="row center">
  <p class="info">
    Your username must be unique and may only
    contain alphanumeric characters and underscores. 
    Your password must be 8 letters and contain at
    least one number. Your real name will only be shared
    if a meet requires it, if a meet does require your
    real name you cannot RSVP without it set.
  </p>
</div>
<div class="row mobile_column">
  <?=new Text_Input([
    "label" => "Username",
    "name" => "username",
    "is_required" => true,
    "max_characters" => 20,
    "id" => "username",
    "error_message" => "Username is taken"
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
<div class="row mobile_column">
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