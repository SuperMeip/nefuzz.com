<?php
require_once("components/common.php");
?>

<div class="row center">
  <p class="info">
    This emergency info will only be shared
    with hosts of meets who you are attending
    if they request such information. It is
    entirely optional.
  </p>
</div>
<div class="row mobile_column">
  <?=new Text_Input([
    "label" => "Emergency Contact 1 Name",
    "name" => "em_name_1",
    "max_characters" => 30
  ]);?>
  <?=new Text_Input([
    "label" => "Emergency Contact 1 Phone#",
    "name" => "em_phone_1",
    "max_characters" => 30
  ]);?>
</div>
<div class="row mobile_column">
  <?=new Text_Input([
    "label" => "Emergency Contact 2 Name",
    "name" => "em_name_2",
    "max_characters" => 30
  ]);?>
  <?=new Text_Input([
    "label" => "Emergency Contact 2 Phone#",
    "name" => "em_phone_2",
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
    "name" => "bee_allergy",
    "size" => "mini"
  ]);?>
  <?=new Checkbox_Input([
    "label" => "Food Allergy",
    "name" => "food_allergy",
    "size" => "mini"
  ]);?>
</div>