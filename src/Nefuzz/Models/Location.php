<?php

namespace Nefuzz\Models;
use Nefuzz\DAOs\Location_SQL_DAO as SQL_DAO;

/**
 * Class Location
 * Model for locations
 *
 * @package Nefuzz\Models
 *
 * @property Region region
 * @property int    regionID
 */
class Location extends Base_Model {

  /**
   * The exception code for going over the Google Query Limit for geoencoding
   *
   * @var int - 8888 for google 0001 for error message number
   */
  const EXCEPTION_GOOGLE_COORDINATES_OVER_QUERY_LIMIT = 88880001;

  /**
   * The location id
   *
   * @var int
   */
  public $id;

  /**
   * The name of the location
   *
   * @var string
   */
  public $name;

  /**
   * The street address
   *
   * @var string
   */
  public $address;

  /**
   * The town/city
   *
   * @var string
   */
  public $city;

  /**
   * Coordinates for this location
   *
   * @var Coordinates
   */
  private $coordinates;

  /**
   * The region id/object for this location
   *
   * @var int|Region
   */
  private $region;

  /**
   * Get a location by id
   *
   * @param int $id
   *
   * @return Location
   */
  public static function get($id) {
    $location = new Location();
    $location->populate(SQL_DAO::get_by_id($id));
    return $location;
  }

  /**
   * Save the location to the DB
   *
   * @return int - The id of the saved location, 0 if failed
   */
  public function save() {
    return !empty($this->id) ? SQL_DAO::update($this) : SQL_DAO::add($this);
  }

  /**
   * Returns the location as a standard address string
   * 
   * @return string - the address as a string
   */
  public function __toString() {
    $this->getRegion();
    $loc_string = !empty($this->name) ? $this->name . ', ' : '';
    $loc_string .= !empty($this->address) ? $this->address . ', ' : '';
    $loc_string .= !empty($this->city) ? $this->city . ', ' : '';
    $loc_string .= !empty($this->region->state) ? $this->region->state . ', ' : '';
    $loc_string .= !empty($this->region->country) ? ', ' . $this->region->country : '';
    return $loc_string;
  }

  /**
   * Set function for coordinates
   *
   * @param Coordinates $value
   */
  protected function setCoordinates($value) {
    $this->coordinates = $value;
  }

  /**
   * Get magic method for coordinates.
   *    - Gets the coordinates from google if none are set
   *
   * @return Coordinates|null - The coordinate object or null if failed for any reason
   */
  protected function getCoordinates() {
    if(empty($this->city)) {
      return null;
    }
    if (empty($this->coordinates->lat) || empty($this->coordinates->lng)) {
      $success = $this->resolve_coordinates();
    }
    return !empty($success) ? $this->coordinates : null;
  }

  /**
   * Magic method for setting the region
   *
   * @param Region $value
   */
  protected function setRegion($value) {
    $this->region = $value;
  }

  /**
   * Magic method for getting the region
   *    - Checks if the region is an id or the object, if it's not the object grab it via the
   *
   * @return Region
   */
  protected function getRegion() {
    if (!empty($this->region) && is_int($this->region)) {
      $this->region = Region::get($this->region);
    }
    return $this->region;
  }

  /**
   * Get the id of the region without making a call to the DB if necessary
   *
   * @return int - The region ID
   */
  public function getRegionID() {
    if (!empty($this->region->id)) {
      return $this->region->id;
    }
    return $this->region;
  }

  /**
   * Finds the distance between this location and another
   *
   * @param Location $other_loc - the location to check distance against 
   *
   * @return array|false - The array contains 2 elements , length and time, which each have a text, and value option. Returns false if something goes wrong
   */
  public function distance($other_loc) {
    if (empty($this->city)|| empty($other_loc->city)) {
      return false;
    }
    $this->getRegion();
    $origin = ($this->address ? str_replace(' ', '+', $this->address) : '') . '+' . $this->city . '+' . $this->region->state;
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
   * @param Location $checkpoint - the added stop between this and the destination
   * @param Location $destination - the final destination after the checkpoint
   * 
   * @return array|bool - The array contains 2 elements , length and time, which each have a text, and value option. Returns false if something goes wrong.
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
   * A function to generate and store the coordinates of the location in the location object, this uses google's geocoder api.
   * 
   * @param bool $city_only - calculates from the city level as opposed to the address level. This is true by default to protect user locations.
   * 
   * @return bool - this returns an associative array with the 'lat' and 'lng' of the location, or false if it failed for any reason.
   *
   * @throws \Exception - EXCEPTION_GOOGLE_COORDINATES_OVER_QUERY_LIMIT if google says query limit reached
   */
  public function resolve_coordinates($city_only = true) {
    if (!$this->city) {
      return false;
    }
    $this->getRegion();
    $place = "";
    if (!$city_only) {
      $place .= !empty($this->name) ? "$this->name " : "";
      $place .= !empty($this->address) ? "$this->address " : "";
    }
    $address = urlencode("$place$this->city {$this->region->state}");
    $google_api_key = \Nefuzz\Php\Auth::GOOGLE_MAPS_KEY;
    $url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&key=$google_api_key";
    $curl_handle = curl_init();
    curl_setopt($curl_handle, CURLOPT_URL, $url);
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
    $choord_info = json_decode(curl_exec($curl_handle), true);
    curl_close($curl_handle);
    if ($choord_info["status"] === "OK") {
      $result = $choord_info['results'][0]['geometry']['location'];
      $this->coordinates = new Coordinates($result["lat"], $result["lng"]);
    } elseif ($choord_info["status"] === "OVER_QUERY_LIMIT") {
      // This is thrown if too many addresses are queried at once
      throw new \Exception(
        "Attempted to grab coordinates for location id# $this->id, but Google returned OVER QUERY LIMIT",
        self::EXCEPTION_GOOGLE_COORDINATES_OVER_QUERY_LIMIT
      );
    } else {
      return false;
    }
  }
}