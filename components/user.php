<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/components/common.php");
require_once($_SERVER['DOCUMENT_ROOT']."/models/user.php");
require_once($_SERVER['DOCUMENT_ROOT']."/php/common.php");

function user_icon($username) {
  return use_control("get/user_icon", ['username' => $username]);
}

function user_name($username) {
  $name = use_control("get/username", ["username" => $username]);
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
  $contact_data = use_control(
    'user/get_user_contact_methods',
    ['username' => $username]
  );
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
  $user_data = use_control(
    'user/get_user_bio_info',
    ['username' => $username]
  );
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
  $user_location = use_control(
    'get/user_location_info',
    ['username' => $username]
  );
}

echo use_control("get/user_location", ['username' => "meep"]);*/
?>