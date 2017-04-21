<?php
//gets the url of the icon of the requested user

function user_icon($username) {
  require_once($_SERVER['DOCUMENT_ROOT']."/models/user.php");
  if (!$username) {
    return "img/user/icon/NONE.png";
  }
  
  $user = User::get($username);
  
  if ($user) {
    return ($user->has_icon ? "img/user/icon/$user->id.png" : "img/user/icon/NONE.png");
  } else {
    return "img/user/icon/NONE.png";
  }
}

if (isset($_GET['ajax'])) {
  echo json_encode(user_icon($_POST['username'] ?? ""));
}
?>