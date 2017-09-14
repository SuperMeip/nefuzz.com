<?php

namespace Nefuzz\Models;

use Nefuzz\DAOs\Region_SQL_DAO;

/**
 * Location data on a regional level(state, area, region, etc)
 *
 * Class Region
 */
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

  /**
   * Get a region by id
   *
   * @param int $id
   *
   * @return Region
   */
  public static function get($id) {
    $region = new Region();
    $region->populate(Region_SQL_DAO::get_by_id($id));
    return $region;
  }

  /**
   * Get all the states from the DB
   *
   * @param bool $full_name - If you should grab the full name of the state instead of the abbreviation
   *
   * @return array - All the states in the selected format
   */
  public static function get_all_states($full_name = false) {
    return Region_SQL_DAO::get_all_states($full_name);
  }
}