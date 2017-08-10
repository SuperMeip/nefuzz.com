<?php

namespace Nefuzz\Models;

class Meet extends \Nefuzz\Models\Base_Model {
  public $id = 0;                   //int
  public $user = 0;                 //int
  public $group = 0;                //int
  public $name = "";                //string
  public $rrule = "";               //string
  public $overview = "";            //string
  public $is_con = 0;               //bool(int)
  public $created_time = "";        //date(string)
  
  public $events = [];              //array[int]
  public $details = [];             //obj(Event_Details)
  public $rrule_obj = [];           //obj(RRule);
  
  public function __construct($meet_info, $event_list, $event_details_obj, $rrule_info = []) {
    foreach ($meet_info as $key => $value) {
      if (isset($this->{$key})) {
        $this->{$key} = $value;
      }
    }
    $this->events = $event_list;
    $this->details = $event_details_obj;
    if (!empty($rrule_info)) {
      $this->rrule = $this->build_rrule_string($rrule_info);
    }
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
  
  public function RRule() {
    if (!$this->rrule) {
      return false;
    }
    if ($this->rrule_obj === []) {
      $this->rrule_obj = self::gen_rrule_obj($this->rrule);
    }
    return $this->rrule_obj;
  }
  
  public function get_user() {
    
  }
  
  public function build_rrule_string($rrule_info, $ex_dates = []) {
    if (empty($rrule_info)) {
      return "";
    }
    $rset = new \RRule\RSet();
    $rset->addRRule($rrule_info);
    foreach ($ex_dates as $ex_date) {
      $rset->addExDate($ex_date);
    }
    $RRString = $rset->getRRules()[0]->rfcString($include_timezone = true);
	  $ExDateStrings = [];
	  foreach($rset->getEXDates() as $Ex) {
		  array_push($ExDateStrings, $Ex->format("U"));
	  }
	  $RRString .= " EXDATES:" . implode(",", $ExDateStrings);

    $this->rrule = $RRString;
	  return $RRString;
  }
  
  public static function gen_rrule_obj($rrule_string) {
    $parts = explode(" ", $rrule_string);
  	$rset = new \RRule\RSet();
  	$rset->addRRule($parts[0]);
  	$ex_dates = explode(",", explode(":",$parts[1])[1]);
  	foreach($ex_dates as $ex_date) {
  		$rset->addExDate($ex_date);
  	}
  	return $rset;
  }
  
  public function get_group() {
    
  }
}
?>