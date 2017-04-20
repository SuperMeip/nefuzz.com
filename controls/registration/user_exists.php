<?php
//checks if a user exists from the username
require_once($_SERVER['DOCUMENT_ROOT']."/models/user.php");

if (!isset($_GET['username'])) {
    echo false;
    return;
}

$query = "
    SELECT username
    FROM users
    WHERE username = ?
";

$result = User::exists($_GET['username']);
if ($result) {
    echo 1;
} else {
    echo 0;
}
?>