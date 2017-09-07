<?php

namespace Nefuzz\Controllers;

/**
 * Class User
 * The controller for the user page
 *
 * @package Nefuzz\Controllers
 */
class User extends \Nefuzz\Controllers\Base_Controller {

  /**
   * The user model for this page
   *
   * @var \Nefuzz\Models\User
   */
  private $user = null;

  protected function page_body() {
    $user = \Nefuzz\Models\User::get($this->user ?? ($_GET['username'] ?? ""));
    if ($user) {
      $view = new \Nefuzz\Views\User();
      $view->user = $user;
      $view->contact_methods = \Nefuzz\Models\User::get_all_contact_methods();
      if ($view->user && isset($_SESSION['user']->id)) {
        $view->user->is_current_user = ($_SESSION['user']->id === $view->user->id);
      }
    } else {
      $view = new \Nefuzz\Views\User\Not_Found();
    }
    $view->load();
  }
  
  public function set_argument($argument) {
    $this->user = $argument;
    return true;
  }
}