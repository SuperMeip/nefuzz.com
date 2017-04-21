<?php
//gets the user's displayed location data

function get_user_location_info($username) {
  require_once($_SERVER['DOCUMENT_ROOT']."/php/common.php");
  require_once($_SERVER['DOCUMENT_ROOT']."/models/user.php");
  
  if(!$username) {
    return [];
  }
  $user = User::get($_GET["username"]);
  if (!$user) {
    return [];
  }
  if(isset($_SESSION['user'])) {
    if ($user->id == $_SESSION['user']->id) {
      $user->is_current_user = true;
    }
  }
  
   return [
    "address" => ($user->is_current_user ? $user->location->address : false),
    "city" => $user->location->city,
    "state" => $user->location->state
  ];
}

if (isset($_GET['ajax'])) {
  session_start();
  echo json_encode(get_user_location_info($_POST['username'] ?? ""));
}
?>