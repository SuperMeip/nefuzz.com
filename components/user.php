<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/components/common.php");
require_once($_SERVER['DOCUMENT_ROOT']."/models/user.php");
require_once($_SERVER['DOCUMENT_ROOT']."/controls/user/get_user_contact_methods.php");
require_once($_SERVER['DOCUMENT_ROOT']."/controls/user/get_user_bio_info.php");
require_once($_SERVER['DOCUMENT_ROOT']."/controls/user/get_user_location_info.php");
require_once($_SERVER['DOCUMENT_ROOT']."/controls/get/user_icon.php");
require_once($_SERVER['DOCUMENT_ROOT']."/controls/get/username.php");

function user_page_icon($username) {
  return user_icon($username);
}

function user_page_name($username) {
  $name = username($username);
  if ($name) {
    return $name;
  } else {
    echo "
      <script>
        window.location = \"https://nefuzz.com\";
      </script>
    ";
  }
}

function contact_info_grid_block($username) {
  $contact_data = get_user_contact_methods($username);
  
  $table = new Info_Table([
    "values" => $contact_data
  ]);
  return new Grid_Block([
    "title" => "Contact Info",
    "width" => "normal",
    "height" => "big",
    "content" => $table
  ]);
}

function user_info_grid_block($username) {
  $user_data = get_user_bio_info($username);
  
  $table = new Info_Table([
    "values" => $user_data
  ]);
  return new Grid_Block([
    "title" => "User Info",
    "width" => "full",
    "height" => "large",
    "content" => $table
  ]);
}
/*
function location_grid_item() {
  $location_data = get_user_location_info($username);
}

echo use_control("get/user_location", ['username' => "meep"]);*/
?>