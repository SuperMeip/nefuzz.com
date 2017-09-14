<?php

namespace Nefuzz\Models;

/**
 * A model for coordinate pairs
 *
 * Class Coordinates
 */
class Coordinates extends Base_Model {

  /**
   * Longitude
   *
   * @var string
   */
  public $lng;

  /**
   * Latitude
   *
   * @var string
   */
  public $lat;

  /**
   * Coordinates constructor.
   *
   * @param string $lat         - The latitude
   * @param string $lng         - The longitude
   */
  public function __construct($lat, $lng) {
    $this->lat = $lat;
    $this->lng = $lng;
  }
}