<?php
require_once("components/common.php");
?>

<div class="row mobile_column">
  <?=new Text_Input([
    "label" => "Emergency Contact 1 Name",
    "name" => "emname1",
    "max_characters" => 30
  ]);?>
  <?=new Text_Input([
    "label" => "Emergency Contact 1 Phone#",
    "name" => "emphone1",
    "max_characters" => 30
  ]);?>
</div>
<div class="row mobile_column">
  <?=new Text_Input([
    "label" => "Emergency Contact 2 Name",
    "name" => "emname2",
    "max_characters" => 30
  ]);?>
  <?=new Text_Input([
    "label" => "Emergency Contact 2 Phone#",
    "name" => "emphone2",
    "max_characters" => 30
  ]);?>
</div>
<div class="row">
  <?=new Text_Input([
    "label" => "Relevant Medical Issues",
    "name" => "medical_issues",
    "size" => "full",
    "max_characters" => 200
  ]);?>
</div>
<div class="row">
  <?=new Text_Input([
    "label" => "Allergies",
    "name" => "allergies",
    "size" => "big",
    "max_characters" => 200
  ]);?>
  <?=new Checkbox_Input([
    "label" => "Bee Allergy",
    "name" => "beeallergy",
    "size" => "mini"
  ]);?>
  <?=new Checkbox_Input([
    "label" => "Food Allergy",
    "name" => "foodallergy",
    "size" => "mini"
  ]);?>
</div>