<?php
require_once($_SERVER['DOCUMENT_ROOT']."/php/common.php");
require_once($_SERVER['DOCUMENT_ROOT']."/php/db.php");
require_once($_SERVER['DOCUMENT_ROOT']."/model/location.php");

class Event_Details {
  public $id = 0;
  public $has_icon = 0;
  public $description = "";
  public $short_info = "";
  public $url = "";
  public $tags = [];
  public $must_rsvp = 0;
  public $max_attendees = 0;
  
  public $location = "";
  public $alt_host_info = [];
  
  public function __construct($event_details_info, $location_obj, $alt_host_info) {
    foreach ($event_info as $key => $value) {
      if (isset($this->{$key})) {
        $this->{$key} = $value;
      }
    }
    $this->location = $location_obj;
    $this->alt_host_info = $alt_host_info;
  }
  
  public static function get($event_details_id) {
    $DB = new DBC();
    $query = "
      SELECT
        e.*,
        r.name AS region_name,
        r.state AS state
      FROM events e
      JOIN regions r ON e.region = r.id
      WHERE id = ?;
    ";
    $event_details_info = $DB->query_to_array($query, "i", $event_id)[0];
    
    $location_obj = new Location([
      "name" => $event_info['location_name'],
      "address" => $event_info['address'],
      "city" => $event_info['city'],
      "region_id" => $event_info['region'],
      "zip" => $event_info['zip'],
      "country" => $event_info['country'],
      "region" => $event_info['region_name'],
      "state" => $event_info['state'],
    ]);
    
    $alt_host_info = [];
    if ($event_info['has_alt_host']) {
      $alt_host_info = [
        "name" => $event_info['alt_name'],
        "contact_info" => $event_info['alt_contact'],
        "contact_method" => $event_info['alt_method']
      ];
    }
    
    return new Event_Details($event_details_info, $location_obj, $alt_host_info);
  }
}