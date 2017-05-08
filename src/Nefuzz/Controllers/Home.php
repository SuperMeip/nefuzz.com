<?php

namespace Nefuzz\Controllers;

class Home extends \Nefuzz\Controllers\Base_Controller {

  protected function page_body() {
    echo "";
  }
  
  public function request($action, $argument) {
    if ($action == "login") {
      echo json_encode(self::login($_POST['username'] ?? "", $_POST['password'] ?? ""));
      return true;
    }
    elseif ($action == "logout") {
      self::logout();
      echo "
        <script>
          window.location = \"https://nefuzz.com\";
        </script>
      ";
      return true;
    } else {
      return false;
    }
  }
  
  public static function login($username, $password) {
    if ((!$username) || (!$password)) {
      return false;
    }
    $user = \Nefuzz\Models\User::get($username, $password);
    
    if ($user) {
      $_SESSION['user'] = $user;
      return true;
    } else {
      return false;
    }
  }
  
  public static function logout() {
    $_SESSION['user'] = null;
    session_destroy();
  }
}