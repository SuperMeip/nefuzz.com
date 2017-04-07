<?php
require_once("components/common.php");
?>

<form class="main">
  <?=new Block([
    "title" => "Name and Password",
    "template" => "registration/names"
  ]);?>
  
  <?=new Block([
    "title" => "Upload an Icon",
    "template" => "registration/upload_icon",
    "is_expandable" => true,
    "starts_closed" => true
  ]);?>
  
  <?=new Block([
    "title" => "Address",
    "template" => "registration/address"
  ]);?>
  
  <?=new Block([
    "title" => "Contact Information",
    "template" => "registration/contact_info"
  ]);?>
  
  <?=new Block([
    "title" => "Emergency Information",
    "template" => "registration/emergency_info",
    "is_expandable" => true,
    "starts_closed" => true
  ]);?>
  
  <?=new Button([
    "is_submit" => true,
    "label" => "Submit",
    "extra_classes" => "large lone"
  ]);?>
</form>