<?php
session_start();
//gets the user's contact info via get
require_once($_SERVER['DOCUMENT_ROOT']."/models/user.php");
require_once($_SERVER['DOCUMENT_ROOT']."/php/common.php");
if(!isset($_GET["username"])) {
  echo json_encode("/index.php");
  return;
}
$user = User::get($_GET["username"]);
if (!$user) {
  echo json_encode("/index.php");
  return;
}
echo json_encode("/user.php?username=$user->username");
