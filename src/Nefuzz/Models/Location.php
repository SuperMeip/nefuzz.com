<?php

namespace Nefuzz\Models;

class Location {
  public $name = "";          //string
  public $address = "";       //string
  public $city = "";          //string
  public $region = "";        //string
  public $region_id = 1;      //int
  public $state = "";         //string
  public $zip = "";           //string
  public $country = "";       //string
  public $lat = 0;            //float
  public $lng = 0;            //float
  
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
   * @param Location $other_loc - the location to check distance against 
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
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=$origin&destinations=$destination&key={$GLOBALS['google_maps_key']}";
    $curl_handle = curl_init();
    curl_setopt( $curl_handle, CURLOPT_URL, $url );
    curl_setopt( $curl_handle, CURLOPT_RETURNTRANSFER, true );
    $distance_info = json_decode(curl_exec( $curl_handle ), true);
    curl_close( $curl_handle );
    if (!isset($distance_info['rows'][0]['elements'][0]['distance'])) {
      return false;
    }
    return [
      'time' => $distance_info['rows'][0]['elements'][0]['duration'],
      'length' => $distance_info['rows'][0]['elements'][0]['distance']
    ];
  }
  
  /**
   * Returns a list of all available regions from the DB
   * 
   * @return array - a list of available regions
   */
  public static function get_all_regions() {
    $DB = new \Nefuzz\Php\DBC();
    $result = ($DB)->query_to_array("
      SELECT *
      FROM regions;
    ",'',[]);
    $DB->quit();
    return $result;
  }
  
  /**
   * A function that finds the distance added by adding a stop between two points
   *
   * @param \Nefuzz\Models\Location $checkpoint - the added stop between this and the destination 
   * @param \Nefuzz\Models\Location $destination - the final destination after the checkpoint
   * 
   * @return array|bool|string
   *  The array contains 2 elements , length and time, which each have a text, and value option.
   *  Returns false if something goes wrong.
   */
  public function added_distance($checkpoint, $destination) {
    $normal_dist = $this->distance($destination);
    
    $first_leg = $this->distance($checkpoint);
    $second_leg = $checkpoint->distance($destination);
    
    if(!$normal_dist || !$first_leg || !$second_leg) {
      return false;
    }
    
    $added_length = ($first_leg['length']['value'] + $second_leg['length']['value']) - $normal_dist['length']['value'];
    $added_time = ($first_leg['time']['value'] + $second_leg['time']['value']) - $normal_dist['time']['value'];
  
    $miles = round($added_length/1609.34, 1);
    $length_text = "$miles mi";
    $hours = floor($added_time/3600);
    $minuets = floor(($added_time%3600)/60);
    $hours_and_minuets = ($hours ? "$hours hours " : "") . "$minuets mins";
    return [
      "length" => [
        "text" => $length_text,
        "value" => $added_length
      ],
      "time" => [
        "text" => $hours_and_minuets,
        "value" => $added_time
      ]
    ];
  }
  
  /**
   * A function to generate and store the coordinates of the location in the location
   *  object, this uses google's geocoder api.
   * 
   * @param bool $city_only - calculates from the city level as opposed to the
   *  address level. This is true by default to protect user locations.
   * 
   * @return array|bool - this returns an associative aray with the 'lat' and 'lng' of
   *  the location, or false if it failed for any reason.
   */
  public function gen_coords($city_only = true) {
    if (!$this->city) {
      return false;
    }
    $place = "";
    if (!$city_only) {
      $name = str_replace(str_split("_ -/\\&?"), "+", $this->name);
      $address = str_replace(str_split("_ -/\\&?"), "+", $this->address);
      $place = "$name+$address+";
    }
    $address = "$place$this->city+$this->state";
    $google_api_key = \Nefuzz\Php\Auth::google_maps_key;
    $url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&key=$google_api_key";$curl_handle = curl_init();
    curl_setopt( $curl_handle, CURLOPT_URL, $url );
    curl_setopt( $curl_handle, CURLOPT_RETURNTRANSFER, true );
    $choord_info = json_decode(curl_exec( $curl_handle ), true);
    curl_close( $curl_handle );
    if ($choord_info["status"] === "OK") {
      $result = $choord_info['results'][0]['geometry']['location'];
      $this->lat = $result["lat"];
      $this->lng = $result["lng"];
      return $result;
    } elseif ($choord_info["status"] === "OVER_QUERY_LIMIT") {
      // This is thrown if too many addresses are querried at once
      throw new Exception("OVER_QUERY_LIMIT");
    } else {
      return false;
    }
  }
  
  /**
   * This function gets an array of the lat lng coordinates, either returning
   *  them or grabbign them if they are not yet set.
   * 
   * @param bool $city_only - calculates from the city level as opposed to the
   *  address level. This is true by default to protect user locations.
   * 
   * @return array|bool - this returns an associative aray with the 'lat' and 'lng' of
   *  the location, or false if it failed for any reason.
   */
  public function get_coords($city_only = true) {
    if (!$this->city) {
      return false;
    }
    if($this->lat && $this->lng) {
      return [
        "lat" => $this->lat,
        "lng" => $this->lng
      ];
    } else {
      return $this->gen_coords($city_only);
    }
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
   * @return \Nefuzz\Models\Location - the location built from the json
   */
  public static function deserialize() {
    return new Location(json_decode($json, true));
  }
}