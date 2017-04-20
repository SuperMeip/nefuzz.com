<?php
//Gets the proper capitalized version of the username
require_once($_SERVER['DOCUMENT_ROOT']."/models/user.php");
if(!isset($_GET["username"])) {
    echo json_encode(false);
    return;
}
$user = User::get($_GET["username"]);
if (!$user) {
    echo json_encode(false);
    return;
}
echo json_encode($user->username);
?>