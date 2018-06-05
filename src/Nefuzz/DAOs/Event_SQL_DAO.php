<?php
namespace Nefuzz\DAOs;

use Nefuzz\Php\DBC;

/**
* Class Em_Info_SQL_DAO
* The sql dao for accessing emergency info
*
* @package Nefuzz\DAOs
*/
class Event_SQL_DAO extends Base_DAO {

  /**
   * Get the base event info from the id
   *
   * @param int $event_id - The id of the desired event
   *
   * @return array - The general event info as an array
   */
  public static function get_general_info($event_id) {
    $query = "
      SELECT
        id,
        meet,
        edition,
        details,
        is_draft,
        start_time,
        end_time,
        created_time,
        modified_time,
        posted_time,
        canceled_time
      FROM events
      WHERE
        id = ?;
    ";
    $results = (new DBC())->query_to_array($query, "i", [$event_id]);
    return $results[0];
  }

  /**
   * Get all the events for a certain meet
   *
   * @param int $meet_id - The id of the meet to grab the events of
   *
   * @return array - The details to populate the events from the meet id
   */
  public static function get_events_for_meet($meet_id) {
    $query = "
      SELECT
        id,
        meet,
        edition,
        details,
        is_draft,
        start_time,
        end_time,
        created_time,
        modified_time,
        posted_time,
        canceled_time
      FROM events
      WHERE
        meet = ?;
    ";
    $results = (new DBC())->query_to_array($query, "i", [$event_id]);
    return $results;
  }
}