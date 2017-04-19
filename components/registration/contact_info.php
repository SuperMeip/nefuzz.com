<script>
$(document).ready(function(){
  //make selected contact_method required
  $("#contact_method").change(function() {
    $("#contact_method option").each(function(name, val) {
      var method = val.text;
      var input_id = method.replace(" ", "-") + "Input";
      $("#" + input_id).attr("required", false);
      $("#" + input_id).siblings("label").toggleClass("required", false);
    });
    var method = $("#contact_method option:selected").text();
    var input_id = method.replace(" ", "-") + "Input";
    $("#" + input_id).attr("required", true);
    $("#" + input_id).siblings("label").toggleClass("required", true);
  });
});
</script>

<?php
require_once("components/common.php");
require_once("php/common.php");


$GLOBALS["contact_methods"] = [];
$raw_methods = use_control("get/contact_methods");

foreach ($raw_methods as $method) {
  $GLOBALS["contact_methods"][$method['name']] = $method['id'];
}

function contact_options() {
   return array_merge(["" => ""], $GLOBALS["contact_methods"]);
}

function contact_inputs() {
  $count = 0;
  $output = "<div class=\"row center\">\n";
  foreach ($GLOBALS["contact_methods"] as $name => $id) {
    if (($count % 3) == 0) {
      $output .= "</div>\n<div class=\"row center mobile_column\">\n";
    }
    $cleave = [];
    if($name == "Phone Number") {
      $cleave = [
        "phone" => true,
        "phoneRegionCode" => "US"
      ];
    }
    if(($name == "Twitter") || ($name == "Telegram")){
      $cleave = [
        "prefix" => "@"
      ];
    }
    if($name != "Email") {
      $output .= new Text_Input([
        "id" => str_replace(" ", "-", $name."Input"),
        "name" => "contact_method_" . $id,
        "pattern" => ($name == "Discord" ? ".*#[0-9]{4,6}" : ""),
        "label" => $name,
        "cleave" => $cleave,
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