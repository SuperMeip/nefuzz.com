<?php
//gets the link to the user's page

function page_link($username) {
  require_once($_SERVER['DOCUMENT_ROOT']."/models/user.php");
  require_once($_SERVER['DOCUMENT_ROOT']."/php/common.php");
  if($username) {
    return "/index.php";
  }
  $user = User::get($_GET["username"]);
  if (!$user) {
    return "/index.php";
  }
  return "/user.php?username=$user->username";
}

if (isset($_GET['ajax'])) {
  echo json_encode(page_link($_POST['username'] ?? ""));
}
?>