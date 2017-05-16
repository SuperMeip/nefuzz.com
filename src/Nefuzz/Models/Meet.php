<?php

namespace Nefuzz\Models;

class Meet extends \Nefuzz\Models\Base_Model {
  public $id = 0;                   //int
  public $user = 0;                 //int
  public $group = 0;                //int
  public $details = 0;              //int
  public $name = "";                //string
  public $rrule = "";               //string
  public $overview = "";            //string
  public $is_con = 0;               //bool(int)
  public $created_time = "";        //date(string)
  
  public $events = [];              //array[int]
  
  public function __construct($meet_info, $event_list) {
    foreach ($meet_info as $key => $value) {
      if (isset($this->{$key})) {
        $this->{$key} = $value;
      }
    }
    $this->events = $event_list;
  }
  
  public static function get($meet_id) {
    
  }
  
  public function get_events() {
    
  }
  
  public function get_future_events() {
    
  }
  
  public function get_event_count() {
    
  }
  
  public function get_default_details() {
    
  }
  
  public function get_dates() {
    
  }
  
  public function get_next_date() {
    
  }
  
  public function get_user() {
    
  }
  
  public function build_rrule() {
    
  }
  
  public function get_group() {
    
  }
}
?>