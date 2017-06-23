<?php

namespace Nefuzz\Views\Make_Meet;

class RRule extends \Nefuzz\Views\Base_View {
    
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
    "" => 0,
    "First" => 1,
    "Seccond" => 2,
    "Third" => 3,
    "Fourth" => 4,
    "Last" => -1
  ];
  
  public $day_position_small = [
    "" => 0,
    "1st" => 1,
    "2nd" => 2,
    "3rd" => 3,
    "4th" => 4,
    "Last" => -1
  ];
  
  protected function template() {
    return 'make_meet/rrule';
  }
  
  protected function js() {
    return ['make_meet/rrule'];
  }
}