<?php

namespace Nefuzz\Controllers;

class Make_Meet extends \Nefuzz\Controllers\Base_Controller {
  
  private $meet_id = null;

  protected function page_body() {
    $view = new \Nefuzz\Views\Make_Meet();
    if (isset($this->meet_id)) {
        $view->meet = \Neuzz\Models\Meet::get($this->meet_id);
    }
    $view->load();
  }
  
  public function set_argument($argument) {
    $this->meet_id = $argument;
    return true;
  }
  
  public static function add_new_meet($data) {
    if (!isset($_SESSION['user']->id)) {
      return "Sorry, you don't seem to be logged in";
    }
    /*if(!$_SESSION['user']->is_a_member_of_group($data['group'])) {
      return "Sorry, you do not have permission to make meets for this group";
    } else {
      user is a mod or owner, approved = 1, else approved = 0 (needs approval);
    }*/
    $meet_info = [
      'user' => $_SESSION['user']->id,
      'group' => null, //temporary
      'overview' => $data['overview'],
      'name' => $data['name'],
      'is_con' => isset($data['is_con'])
    ];
    
    if (isset($data['has_rrule'])) {
      $rrule_info = [
        'FREQ' => $data['frequency'],
        'DTSTART' => strtotime("now"),
        'INTERVAL' => $data['interval']
      ];
    } else {
      $rrule_info = [];
    }
    
    
    $details_info = [
      
    ];
  }
}