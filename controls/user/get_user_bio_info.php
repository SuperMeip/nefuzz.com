<?php
//gets the user's contact info via get

function get_user_bio_info($username) {
  require_once($_SERVER['DOCUMENT_ROOT']."/models/user.php");
  require_once($_SERVER['DOCUMENT_ROOT']."/controls/get/contact_methods.php");
  if(!$username) {
    return [];
    return;
  }
  $user = User::get($username);
  if (!$user) {
    return [];
    return;
  }
  if(isset($_SESSION['user'])) {
    if ($user->id == $_SESSION['user']->id) {
      $user->is_current_user = true;
    }
  }
  
  $contact_methods = contact_methods();
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
  
  return $bio_info;
}

if (isset($_GET['ajax'])) {
  session_start();
  echo json_encode(get_user_bio_info($_POST['username'] ?? ""));
}
?>