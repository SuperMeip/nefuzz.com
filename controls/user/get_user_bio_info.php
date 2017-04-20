<?php
session_start();
//gets the user's contact info via get
require_once($_SERVER['DOCUMENT_ROOT']."/models/user.php");
require_once($_SERVER['DOCUMENT_ROOT']."/php/common.php");
if(!isset($_GET["username"])) {
  echo json_encode([]);
  return;
}
$user = User::get($_GET["username"]);
if (!$user) {
  echo json_encode([]);
  return;
}
if(isset($_SESSION['user'])) {
  if ($user->id == $_SESSION['user']->id) {
    $user->is_current_user = true;
  }
}

$contact_methods = use_control("get/contact_methods");
foreach ($contact_methods as $method) {
  if ($method['id'] == $user->contact_method) {
    $contact_method = $method['name'];
    break;
  }
}

$bio_info = [];
$bio_info["Fur Name:"] = $user->fur_name;
if ($user->is_current_user) {
  $bio_info["Real Name:"] = $user->real_name;
}
$bio_info["Prefered Contact:"] = $contact_method;
$bio_info["Species:"] = $user->species;
$bio_info["Bio:"] = $user->bio;

echo json_encode($bio_info);
?>