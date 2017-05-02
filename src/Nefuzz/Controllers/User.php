<?php
require_once($_SERVER['DOCUMENT_ROOT']."/controllers/controller.php");
require_once($_SERVER['DOCUMENT_ROOT']."/models/user.php");
require_once($_SERVER['DOCUMENT_ROOT']."/views/user.php");

class User_Controller extends Controller {

  protected function page_body() {
    $view = new User_View();
    $view->user = User::get($_GET['username'] ?? "");
    $view->contact_methods = User::get_all_contact_methods();
    if ($view->user && isset($_SESSION['user']->id)) {
      $view->user->is_current_user = ($_SESSION['user']->id === $view->user->id);
    }
    $view->load();
  }
}