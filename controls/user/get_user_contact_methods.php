<?php
//gets the contact methods of the requested user, some info witheld if user is 
//  not current one

function get_user_contact_methods($username) {
  require_once($_SERVER['DOCUMENT_ROOT']."/models/user.php");
  require_once($_SERVER['DOCUMENT_ROOT']."/php/common.php");
  require_once($_SERVER['DOCUMENT_ROOT']."/controls/get/contact_methods.php");

  if (!$username) {
    return [];
  }
  $user = User::get($username);
  if (!$user) {
      return [];
  }
  if(isset($_SESSION['user'])) {
      if ($user->id == $_SESSION['user']->id) {
          $user->is_current_user = true;
      }
  }
  $methods = [];
  $method_names = contact_methods();
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
  return $methods;
}

if (isset($_GET['ajax'])) {
  session_start();
  echo json_encode(get_user_contact_methods($_POST['username'] ?? ""));
}
?>