<?php

namespace Nefuzz\DAOs;

use Nefuzz\Php\DBC as DB;

/**
 * The sql dao for the region model
 *
 * Class Region_SQL_DAO
 */
class Region_SQL_DAO extends Base_DAO {

  /**
   * Get a region by id
   *
   * @param int $id
   *
   * @return array - Assoc array with the column names=>values
   */
  public static function get_by_id($id) {
      $query = "
      SELECT
        id,
        area,
        region,
        state,
        state_name,
        country
      FROM regions
      WHERE
        id = ?;
    ";
      $results = (new DB())->query_to_array($query, "i", [$id]);
      return !empty($results) ? $results : [];
  }

  /**
   * Get all the states from the DB
   *
   * @param bool $full_name - If you should grab the full name of the state instead of the abbreviation
   *
   * @return array - All the states in the selected format
   */
  public static function get_all_states($full_name = false){
    $lookup_column = "state";
    if ($full_name) {
      $lookup_column = "state_name";
    }
    $query = "
      SELECT DISTINCT
        $lookup_column
      FROM regions
    ";
    $results = (new DB())->query_to_array($query);
    if (!empty($results)) {
      $states = [];
      foreach ($results as $row) {
        $states[] = $row[$lookup_column];
      }
      return $states;
    }
    return [];
  }
}