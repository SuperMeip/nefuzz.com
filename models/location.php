<?php

class Location {
  public $name = "";          //string
  public $address = "";       //string
  public $city = "";          //string
  public $region = "";        //string
  public $state = "";         //string
  public $zip = "";           //string
  public $country = "";       //string
  
  function __construct($location_array) {
    foreach ($location_array as $key => $value) {
      if (isset($this->{$key})) {
        $this->{$key} = $value;
      }
    }
  }

  function full_string() {
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
  function dist($other_loc) {
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
}

//var_dump((new Location('TN'))->dist(new Location('Ma', 'Boston', 'State st')));

?>