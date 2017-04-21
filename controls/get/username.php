<?php
//Gets the proper capitalized version of the username

function username($username) {
  require_once($_SERVER['DOCUMENT_ROOT']."/models/user.php");
  if(!$username) {
    return false;
  }
  $user = User::get($username);
  if (!$user) {
    return false;
  }
  return $user->username;
}

if (isset($_GET['ajax'])) {
  echo json_encode(username($_POST['username'] ?? ""));
}
?>