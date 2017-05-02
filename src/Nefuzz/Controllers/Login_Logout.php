<?php
require_once($_SERVER['DOCUMENT_ROOT']."/controllers/controller.php");

class Login_Logout_Controller extends Controller {

  protected function page_body() {
    echo "";
  }
  
  public static function login($username, $password) {
    require_once($_SERVER['DOCUMENT_ROOT']."/models/user.php");
    if ((!$username) || (!$password)) {
      return false;
    }
    $user = User::get($username, $password);
    
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

//AJAX HANDLER

if (isset($_GET['action'])) {
  if ($_GET['action'] == "login") {
    session_start();
    echo json_encode(Login_Logout_Controller::login($_POST['username'] ?? "", $_POST['password'] ?? ""));
  }
  if ($_GET['action'] == "logout") {
    session_start();
    Login_Logout_Controller::logout();
  }
}