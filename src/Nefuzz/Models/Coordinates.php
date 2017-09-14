<?php

namespace Nefuzz\Models;

class Coordinates extends Base_Model {

  /**
   * The id of the location these coordinates belong to
   *
   * @var int
   */
  public $location_id;

  /**
   * Longitude
   *
   * @var string
   */
  private $lng;

  /**
   * Latitude
   *
   * @var string
   */
  private $lat;

  /**
   * Coordinates constructor.
   *
   * @param int    $location_id - The id of the location these coordinates belong to
   * @param string $lat         - The latitude
   * @param string $lng         - The longitude
   */
  public function __construct($location_id, $lat, $lng) {
    $this->location_id = $location_id;
    $this->lat = $lat;
    $this->lng = $lng;
  }

  /**
   * Get magic method for $lat
   *
   * @return string
   */
  protected function getLat() {
    return $this->lat;
  }

  protected function getLng() {
    return $this->lng;
  }

}