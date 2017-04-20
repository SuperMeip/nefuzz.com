<?php
require_once($_SERVER['DOCUMENT_ROOT']."/php/common.php");
require_once($_SERVER['DOCUMENT_ROOT']."/models/user.php");

if(!isset($_GET["username"])) {
    echo json_encode([]);
    return;
}
$user = User::get($_GET["username"]);
if (!$user) {
    echo json_encode([]);
    return;
}
if(isset($_SESSION['user'])) {
    if ($user->id == $_SESSION['user']->id) {
        $user->is_current_user = true;
    }
}

echo json_encode([
    "address" => ($user->is_current_user ? $user->location->address : false),
    "city" => $user->location->city,
    "state" => $user->location->state
]);
?>