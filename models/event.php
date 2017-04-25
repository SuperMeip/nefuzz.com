<?php
require_once($_SERVER['DOCUMENT_ROOT']."/php/common.php");
require_once($_SERVER['DOCUMENT_ROOT']."/php/db.php");
require_once($_SERVER['DOCUMENT_ROOT']."/model/event_detals.php");

class Event {
  public $id = 0;                 //int
  public $meet = 0;               //int
  public $edition = "";           //string
  public $details = 0;            //int
  public $is_draft = 0;           //bool(int)
  public $start_time = "";        //date(string);
  public $end_time = "";          //date(string);
  public $created_time = "";      //date(string);
  public $modified_time = "";     //date(string);
  public $posted_time = "";       //date(string);
  public $canceled_time = "";     //date(string);

  public $details_obj = "";       //obj(event_details)
  public $attendees = [];         //assoc[$user_id=>$attendee_type]

  public function __construct($event_info, $attendee_info, $with_details = false) {
    foreach ($event_info as $key => $value) {
      if (isset($this->{$key})) {
        $this->{$key} = $value;
      }
    }
    $this->attendees = $attendee_info;

    if ($with_details) {
      $this->load_details();
    }
  }

  public static function get($event_id) {
    $DB = new DBC();
    $query = "
      SELECT *
      FROM events
      WHERE id = ?;
    ";
    $event_info = $DB->query_to_array($query, "i", $event_id)[0];
    
    $query = "
      SELECT
        user,
        attendee_type
      FROM event_attendees
      WHERE event = ?;
    ";
    $result = $DB->query_to_array($query, "i", $event_id);
    $attendee_info = [];
    foreach($results as $result) {
      $attendee_info[$result["id"]] = $result["name"];
    }
    
    return new Event($event_info, $attendee_info);
  }

  public function load_details() {
    $this->details_obj = Event_Details::get($this->details);
  }

  public function ical() {
    
  }
}
?>