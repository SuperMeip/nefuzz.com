<?php

namespace Nefuzz\DAOs;

use Nefuzz\Models\Coordinates;
use Nefuzz\Php\DBC as DB;

/**
 * The sql dao for the location model
 *
 * Class User_SQL_DAO
 */
class Location_SQL_DAO extends Base_DAO {

  /**
   * Get the location by id
   *
   * @param int $id
   *
   * @return array - Assoc array with the column names => values
   */
  public static function get_by_id($id) {
    $query = "
      SELECT
        id,
        name,
        address,
        city,
        region,
        lat,
        lng
      FROM locations
      WHERE
        id = ?;
    ";
    $results = (new DB())->query_to_array($query, "i", [$id]);
    if (!empty($results[0])) {
      $results = $results[0];
      $results['coordinates'] = new Coordinates($id, $results['lat'], $results['lng']);
    } else {
      return [];
    }
  }
}