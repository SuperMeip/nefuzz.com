<?php
//used to log the user in by verifying username and PW

function login($username, $password) {
  require_once($_SERVER['DOCUMENT_ROOT']."/models/user.php");
  if ((!$username) || (!$password)) {
    return false;
  }
  $user = User::get($username, $password);
  
  if ($user) {
    $_SESSION['user'] = $user;
    return true;
  } else {
    return false;
  }
}

if (isset($_GET['ajax'])) {
  session_start();
  echo json_encode(login($_POST['username'] ?? "", $_POST['password'] ?? ""));
}
?>