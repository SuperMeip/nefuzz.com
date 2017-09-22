<?php

namespace Nefuzz\DAOs;

use Nefuzz\Models\Coordinates;
use Nefuzz\Php\DBC;

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
    $results = (new DBC())->query_to_array($query, "i", [$id]);
    if (!empty($results[0])) {
      $results = $results[0];
      $results['coordinates'] = new Coordinates($results['lat'], $results['lng']);
      return $results;
    } else {
      return [];
    }
  }

  /**
   * Update the location data for the provided location
   *
   * @param \Nefuzz\Models\Location $location - The location to update
   *
   * @return int - if the update succeeded the id of the location, else 0
   */
  public static function update($location) {
    $query = "
      UPDATE locations
        SET
          name = ?,
          address = ?,
          city = ?,
          region = ?,
          lat = ?,
          lng = ?
      FROM locations
      WHERE
        id = ?;
    ";
    $DB = new DBC();
    $DB->query(
      $query,
      "sssissi",
      [
        $location->name,
        $location->address,
        $location->city,
        $location->region->id,
        $location->coordinates->lat,
        $location->coordinates->lng,
        $location->id
      ]
    );
    return $DB->get_affected_rows() != -1 ? $location->id : 0;
  }

  /**
   * Adds a new location to the DB
   *
   * @param \Nefuzz\Models\Location $location $location - The new location
   *
   * @return int - The id of the new location
   */
  public static function add($location) {
    $query = "
      INSERT INTO locations
        name, address, city, region, lat, lng
        VALUES (?, ?, ?, ?, ?, ?);
    ";
    $DB = new DBC();
    $DB->query(
      $query,
      "sssiss",
      [
        $location->name,
        $location->address,
        $location->city,
        $location->region->id,
        $location->coordinates->lat,
        $location->coordinates->lng
      ]
    );
    return $DB->get_insert_id();
  }
}