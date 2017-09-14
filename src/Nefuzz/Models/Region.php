<?php

namespace Nefuzz\Models;

class Region extends Base_Model {

  /**
   * The region id
   *
   * @var int
   */
  public $id;

  /**
   * The greater area name
   *
   * @var string
   */
  public $area;

  /**
   * The smaller region name
   *
   * @var string
   */
  public $region;

  /**
   * The abbreviation of the state
   *
   * @var string
   */
  public $state;

  /**
   * The full name of the state
   *
   * @var string
   */
  public $state_name;

  /**
   * The name of the country
   *
   * @var string
   */
  public $country;
}