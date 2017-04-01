<?php
require_once ("components/common.php");
?>
<div class="row">
  <?=new Text_Input([
    "label" => "Street Address",
    "name" => "address",
    "size" => "full",
    "max_characters" => 200
  ]);?>
</div>
<div class="row center">
  <?=new Text_Input([
    "label" => "City",
    "name" => "city",
    "size" => "big",
    "max_characters" => 30
  ]);?>
  <?=new Text_Input([
    "label" => "State",
    "name" => "state",
    "size" => "small",
    "max_characters" => 2,
    "is_required" => true
  ]);?>
</div>