<?php
//gets the user's location info, if ajax this requires authentication
//  due to sensitive data

user_location($username) {
  if (!$username) {
      return [];
  }
  $user = User::get($username);
  if (!$user) {
      return [];
  }
  
  return $user->location;
}

///GLOBAL PASSWORDS BROKEN
if (isset($_GET["ajax"])) {
  require_once($_SERVER['DOCUMENT_ROOT']."/php/common.php");
  require_once($_SERVER['DOCUMENT_ROOT']."/models/user.php");
  if (!isset($_SERVER['PHP_AUTH_USER'])) {
      header('WWW-Authenticate: Basic realm="My Realm"');
      header('HTTP/1.0 401 Unauthorized');
      echo 0;
      return;
  } else {
    if(
      $_SERVER['PHP_AUTH_USER'] != $GLOBALS['REST_AUTH_USER'] ||
      $_SERVER['PHP_AUTH_PW'] != $GLOBALS['REST_AUTH_PW']
    ) {
      $_SERVER['PHP_AUTH_USER'] = null;
      $_SERVER['PHP_AUTH_PW'] = null;
      header('WWW-Authenticate: Basic realm="My Realm"');
      header('HTTP/1.0 401 Unauthorized');
      echo 0;
      return;
    } else {
      echo json_encode(user_location($_POST["username"] ?? ""));
    }
  }
}
?>