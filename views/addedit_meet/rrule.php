<?php
require_once($_SERVER['DOCUMENT_ROOT']."/views/view.php");

class RRule_View extends View {
    
  public $weekdays = [
    "Sunday" => "SU",
    "Monday" => "MO",
    "Tuesday" => "TU",
    "Wednesday" => "WE",
    "Thursday" => "TH",
    "Friday" => "FR",
    "Saturday" => "SA"
  ];
  
  public $weekdays_small = [
    "Sun" => "SU",
    "Mon" => "MO",
    "Tue" => "TU",
    "Wed" => "WE",
    "Thu" => "TH",
    "Fri" => "FR",
    "Sat" => "SA"
  ];
  
  public $day_position = [
    "First" => 1,
    "Seccond" => 2,
    "Third" => 3,
    "Fourth" => 4,
    "Last" => -1
  ];
  
  public $day_position_small = [
    "1st" => 1,
    "2nd" => 2,
    "3rd" => 3,
    "4th" => 4,
    "Last" => -1
  ];
  
  protected function template() {
    return 'addedit_meet/rrule';
  }
  
  protected function js() {
    return ['addedit_meet/rrule'];
  }
}