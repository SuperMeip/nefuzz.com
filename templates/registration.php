<?php
require_once("components/common.php");
?>

<?=new Block([
  "title" => "Name and Password",
  "template" => "registration/names"
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