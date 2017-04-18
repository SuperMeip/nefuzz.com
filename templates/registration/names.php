<?php
require_once ("components/common.php");
require_once ("components/registration/names.php");
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
    "pattern" => "[a-zA-Z0-9_]{3,20}",
    "id" => "username",
  ]);?>
  <?=new Text_Input([
    "label" => "Email Address",
    "name" => "email",
    "pattern" => "^[^@]+@[^@]+\.[^@]+$",
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
    "pattern" => "^(?=.*\d).{8,20}$",
    "is_password" => true,
    "is_required" => true,
    "max_characters" => 20,
  ]);?>
  <?=new Text_Input([
    "label" => " Repeat Password",
    "id" => "repeat-password",
    "pattern" => "^(?=.*\d).{8,20}$",
    "is_password" => true,
    "is_required" => true,
    "max_characters" => 20
  ]);?>
</div>
<div class="row mobile_column">
  <?=new Text_Input([
    "label" => "Real Name",
    "name" => "real_name",
    "max_characters" => 40
  ]);?>
  <?=new Text_Input([
    "label" => "Fur Name",
    "name" => "fur_name",
    "max_characters" => 30
  ]);?>
</div>