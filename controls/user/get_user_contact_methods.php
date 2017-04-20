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
$methods = [];
$method_names = use_control("get/contact_methods");
foreach ($user->contact_info as $method_id => $method_info) {
  foreach ($method_names as $method) {
    if ($method['id'] == $method_id) {
      $method_name = $method['name'];
    }
  }
  if (
    ($method_name != "Email") ||
    (($method_name == "Email") && ($user->is_current_user)) ||
    (($method_name == "Email") && ($user->contact_method == $method_id))
  ) {
    $methods[$method_name] = $method_info;
  }
}
echo json_encode($methods);
?>