<?php
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
    //gets the user's contact info via get
    if (!isset($_GET["username"])) {
        echo json_encode([]);
        return;
    }
    $user = User::get($_GET["username"]);
    if (!$user) {
        echo json_encode([]);
        return;
    }
    
    echo $user->location->serialize();
  }
}
?>