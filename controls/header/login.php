<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/models/user.php");
if ((!isset($_POST["username"])) || (!isset($_POST["password"]))) {
    echo json_encode(false);
    return;
}
$user = User::get($_POST["username"], $_POST["password"]);

if ($user) {
    echo json_encode(true);
    $_SESSION['user'] = $user;
} else {
    echo json_encode(false);
}
?>