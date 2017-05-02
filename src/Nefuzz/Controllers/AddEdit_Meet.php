<?php
require_once($_SERVER['DOCUMENT_ROOT']."/controllers/controller.php");
require_once($_SERVER['DOCUMENT_ROOT']."/views/addedit_meet.php");
require_once($_SERVER['DOCUMENT_ROOT']."/models/meet.php");

class AddEdit_Meet_Controller extends Controller {

  protected function page_body() {
    $view = new AddEdit_Meet_View();
    if (isset($_POST['meet_id'])) {
        $view->meet = Meet::get($_POST['meet_id']);
    }
    $view->load();
  }
  
  public static function add_meet() {
    
  }
}