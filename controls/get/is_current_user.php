<?php
//returns true if the given user is the current user

function is_current_user($username) {
  require_once($_SERVER['DOCUMENT_ROOT']."/models/user.php");
  if(!$username) {
    return false;
  }
  $user = User::get($username);
  if (!$user) {
    return false;
  }
  return ($user->id == ($_SESSION['user']->id ?? ""));
}

if (isset($_GET['ajax'])) {
  session_start();
  echo json_encode(is_current_user($_POST['username'] ?? ""));
}
?>