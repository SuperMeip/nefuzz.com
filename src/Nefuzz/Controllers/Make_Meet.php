<?php

namespace Nefuzz\Controllers;

use \Nefuzz\Models\Meet as Meet;

class Make_Meet extends \Nefuzz\Controllers\Base_Controller {
  
  private $meet_id = null;

  protected function page_body() {
    $view = new \Nefuzz\Views\Make_Meet();
    if (isset($this->meet_id)) {
        $view->meet = Meet::get($this->meet_id);
    }
    $view->load();
  }
  
  public function set_argument($argument) {
    $this->meet_id = $argument;
    return true;
  }
  
  public function request ($action, $argument) {
    if ($action == "add_new_meet") {
      echo json_encode(self::add_new_meet($_POST ?? []));
      return true;
    }
    return false;
  }
  
  public static function add_new_meet($data) {
    if (empty($data)) {
      return "No information received";
    }
    if (!isset($_SESSION['user']->id)) {
      return "You don't seem to be logged in";
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
      ];
      $WM = $data['frequency'] == "monthly" ? "_m" : "_w"; 
      $rrule_info['INTERVAL'] = $data["interval$WM"] ?? null;
      if ($WM == "_m") {
        $bysetpos = $data["bysetpos"] ? true : false;
        //$rrule_info['test'] = $data["bysetpos"];
        if ($bysetpos) {
          $rrule_info['BYSETPOS'] = $data["bysetpos"] ?? null;
          $rrule_info['BYDAY'] = $data["byday$WM"] ?? null;
          $rrule_info['BYMONTHDAY'] = null;
        } else {
          $rrule_info['BYDAY'] = null;
          $rrule_info['BYSETPOS'] = null;
          $rrule_info['BYMONTHDAY'] = $data['bymonthday'] ?? null;
        }
      } else {
        $rrule_info['BYDAY'] = $data["byday$WM"] ?? null;
      }
    } else {
      $rrule_info = [];
    }
    $event_list = [];
    
    $meet = new Meet($meet_info, $event_list, $rrule_info);
    
    $dates = [];
    $rset = $meet->RRule();
    $i = 10;
    foreach($rset as $date) {
      $i--;
      $dates[] = $date;
      if ($i<1) {
        break;
      }
    }
    
    return $dates;
    
    $details_info = [
      
    ];
  }
}