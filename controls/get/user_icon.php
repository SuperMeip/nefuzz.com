<?php
require_once($_SERVER['DOCUMENT_ROOT']."/models/user.php");
if (!isset($_GET["username"])) {
    echo "NONE.php";
    return;
}
$user = User::get($_GET["username"]);

if ($user) {
    echo json_encode($user->has_icon ? "img/user/icon/$user->id.png" : "img/user/icon/NONE.png");
} else {
    echo json_encode("img/user/icon/NONE.php");
}
?>