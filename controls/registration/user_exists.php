<?php
//checks if a user exists from the username

function user_exists($username) {
  require_once($_SERVER['DOCUMENT_ROOT']."/models/user.php");
  
  if (!$username) {
    return false;
  }
  
  $query = "
    SELECT username
    FROM users
    WHERE username = ?
  ";
  
  $result = User::exists($username);
  if ($result) {
    return true;
  } else {
    return false;
  }
}

if (isset($_GET['ajax'])) {
  echo json_encode(user_exists($_POST['username'] ?? ""));
}
?>