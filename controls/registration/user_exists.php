<?php
//checks if a user exists from the username
require_once($_SERVER['DOCUMENT_ROOT']."/php/db.php");

if (!isset($_POST['username'])) {
    echo false;
    return;
}

$query = "
    SELECT username
    FROM users
    WHERE username = ?
";

$result = (new DBC())->query($query, "s", [$_POST["username"]]);
if ($result->fetch_object()) {
    echo 1;
} else {
    echo 0;
}
?>