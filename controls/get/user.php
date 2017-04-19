<?php
require_once($_SERVER['DOCUMENT_ROOT']."/models/user.php");
if(!isset($_POST("username"))) {
    echo "false";
    return;
}
$user = User::get($_POST("username"), $_POST("password") ?? false);

echo $user->serialize();
?>