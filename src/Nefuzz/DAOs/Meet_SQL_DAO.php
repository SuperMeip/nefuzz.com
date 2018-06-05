<?php

namespace Nefuzz\DAOs;

use Nefuzz\Php\DBC;

/**
 * The sql dao for the meet model
 *
 * Class User_SQL_DAO
 */
class Meet_SQL_DAO extends Base_DAO {

  /**
   * Get general meet info by id
   *
   * @param int $meet_id - The id of the meet to grab info for
   *
   * @return array - The info for this meet
   */
  public static function get_general_info($meet_id) {
    $query = "
      SELECT
        id,
        `user`,
        `group`,
        details,
        name,
        rrule,
        rrule_approved,
        overview,
        is_con,
        created_time
      FROM meets
      WHERE
        id = ?;
    ";
    $results = (new DBC())->query_to_array($query, "i", [$meet_id]);
    return $results[0] ?? [];
  }
}