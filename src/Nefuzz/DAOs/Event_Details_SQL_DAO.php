<?php

namespace Nefuzz\DAOs;

use Nefuzz\Php\DBC;

/**
 * The sql dao for the event details model
 *
 * Class User_SQL_DAO
 */
class Event_Details_SQL_DAO extends Base_DAO {

  public static function get_general_info($event_details_id) {
    $query = "
      SELECT
        id,
        description,
        has_icon,
        short_info,
        url,
        tag_bitwise,
        location,
        has_alt_host,
        alt_method,
        alt_contact,
        alt_name,
        must_rsvp,
        max_attendees
      FROM event_details
      WHERE
        id = ?;
    ";
    $results = (new DBC())->query_to_array($query, "i", [$event_details_id]);
    return $results[0] ?? [];
  }
}