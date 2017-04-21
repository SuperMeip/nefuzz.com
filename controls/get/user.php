<?php
//gets a user based on username information
//  disabled

/*
function user($username, $password) {
  require_once($_SERVER['DOCUMENT_ROOT']."/models/user.php");
  if(!$username) {
      return false;
  }
  $user = User::get($username, $password ?? false);
  
  return $user;
}

if (isset($_GET['ajax'])) {
  $result = user($_POST['username'] ?? "",  $_POST["password"] ?? false);
  if ($result) {
    echo user()->serialize();
  } else {
    echo json_encode(false);
  }
}*/
?>