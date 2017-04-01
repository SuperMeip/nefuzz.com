<?php
require_once("components/common.php");
?>

<div class="row">
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
<div class="row">
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
  <?=new Check_Input([
    "label" => "Bee Allergy",
    "size" => "small",
    "name" => "beeallergy",
    "size" => "mini"
  ]);?>
  <?=new Check_Input([
    "label" => "Bee Allergy",
    "size" => "small",
    "name" => "beeallergy",
    "size" => "mini"
  ]);?>
  <?=new Check_Input([
    "label" => "Bee Allergy",
    "size" => "small",
    "name" => "beeallergy",
    "size" => "mini"
  ]);?>
  <?=new Check_Input([
    "label" => "Bee Allergy",
    "size" => "small",
    "name" => "beeallergy",
    "size" => "mini"
  ]);?>
  <?=new Check_Input([
    "label" => "Bee Allergy",
    "size" => "small",
    "name" => "beeallergy",
    "size" => "medium"
  ]);?>
</div>