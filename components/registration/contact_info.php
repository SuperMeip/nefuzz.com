<?php
require_once("components/common.php");

$GLOBALS["contact_methods"] = [
  "Email" => "email",
  "Telegram" => "telegram",
  "Phone" => "phone",
  "Skype" => "skype",
  "Twitter" => "twitter",
  "FurAffinity" => "furaffinity"
];

function contact_options() {
   return array_merge(["" => ""], $GLOBALS["contact_methods"]);
}

function contact_inputs() {
  $count = 0;
  $output = "<div class=\"row center\">\n";
  foreach ($GLOBALS["contact_methods"] as $text => $value) {
    if (($count % 3) == 0) {
      $output .= "</div>\n<div class=\"row center\">\n";
    }
    if($value != "email") {
      $output .= new Text_Input([
        "name" => $value,
        "label" => $text,
        "size" => "medium",
        "max_characters" => 20
      ]) . "\n";
      $count++;
    }
  }
  $output .= "</div>";
  return $output;
}

?>