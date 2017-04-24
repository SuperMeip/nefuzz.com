<?php

class Location {
  public $name = "";          //string
  public $address = "";       //string
  public $city = "";          //string
  public $region = "";        //string
  public $region_id = 1;      //int
  public $state = "";         //string
  public $zip = "";           //string
  public $country = "";       //string
  
  /**
   * constructs a new Location object using an array
   * 
   * @param $location_array assoc - an associative array with keys named for 
   *    the properties in the location.
   */
  public function __construct($location_array) {
    foreach ($location_array as $key => $value) {
      if (isset($this->{$key})) {
        $this->{$key} = $value;
      }
    }
  }

  /**
   * Returns the location as a standard address string
   * 
   * @return string - the address as a string
   */
  public function full_string() {
    $loc_string = "";
    $loc_string .= ($this->name ? $this->name . ', ' : '');
    $loc_string .= ($this->address ? $this->address . ', ' : '');
    $loc_string .= ($this->city ? $this->city . ', ' : '');
    $loc_string .= ($this->state ? $this->state . ' ' : '');
    $loc_string .= ($this->zip ? $this->zip : '');
    $loc_string .= ($this->country ? ', ' . $this->country : '');
    return $loc_string;
  }

  /*
   * Finds the distance between this location and another
   *
   * @return array | false
   *  The array contains 2 elements , length and time, which each have a text, and value option.
   *  Returns false if something goes wrong
   */
  public function distance($other_loc) {
    if ($this->city == false || $other_loc->city == false) {
      return false;
    }
    $origin = ($this->address ? str_replace(' ', '+', $this->address) : '') . '+' . $this->city . '+' . $this->state;
    $destination = ($other_loc->address ? str_replace(' ', '+', $other_loc->address) : '') . '+' . $other_loc->city . '+' . $other_loc->state;
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=" . $origin . "&destinations=" . $destination . "&key=AIzaSyAVHaRFclrSmQusTzLrdYa_CQrJdLeFxcU";
    $curl_handle = curl_init();
    curl_setopt( $curl_handle, CURLOPT_URL, $url );
    curl_setopt( $curl_handle, CURLOPT_RETURNTRANSFER, true );
    $distance_info = json_decode(curl_exec( $curl_handle ));
    curl_close( $curl_handle );
    if (!isset($distance_info->rows[0]->elements[0]->distance)) {
      return false;
    }
    return [
      'time' => $distance_info->rows[0]->elements[0]->duration,
      'length' => $distance_info->rows[0]->elements[0]->distance
    ];
  }
  
  public static function get_all_regions() {
    require_once($_SERVER['DOCUMENT_ROOT']."/php/db.php");
    $DB = new DBC();
    $result = ($DB)->query_to_array("
      SELECT *
      FROM regions;
    ",'',[]);
    $DB->quit();
    return $result;
  }
  
  /**
   * serialize the object as a json string
   * 
   * @return string - the json string representing this object
   */
  public function serialize() {
    return json_encode($this);
  }
  
  /**
   * get a new location object from a json
   * 
   * @param $json string = the string to get the location from
   * 
   * @return obj(Location) - the location built from the json
   */
  public static function deserialize() {
    return new Location(json_decode($json, true));
  }
}

//var_dump((new Location('TN'))->dist(new Location('Ma', 'Boston', 'State st')));