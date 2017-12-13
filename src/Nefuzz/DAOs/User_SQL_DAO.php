<?php

namespace Nefuzz\DAOs;

use Nefuzz\Php\DBC;

/**
 * The sql dao for the user model
 *
 * Class User_SQL_DAO
 */
class User_SQL_DAO extends Base_DAO {

  /**
   * Gets the user by username or ID
   *
   * @param string|int $user - The username or ID to fetch user data for
   *
   * @return array - The user data as an assoc array
   */
  public static function get_general_info($user) {
    if(is_int($user)) {
      $lookup_column = 'id';
    } elseif (is_string($user)) {
      $lookup_column = 'username';
    } else {
      return [];
    }

    $query = "
      SELECT
        id,
        username,
        has_icon,
        fur_name,
        real_name,
        bio,
        species,
        contact_method,
        is_admin,
        joined_time,
        location
      FROM users
      WHERE
        $lookup_column = ?;
    ";
    $results = (new DBC())->query_to_array($query, $lookup_column === 'username' ? "s" : "i", [$user]);
    return $results[0] ?? [];
  }


  /**
   * Checks if the user with the username exists, if a password is provided this also can be used to authorize a username/password combination.
   *
   * @param string $username      - the username to look up
   * @param string|bool $password - the password to test against the username(false if only checking name)
   *
   * @return bool - if succeeded
   */
  public static function exists($username, $password = false) {
    if ($password === false) {
      $result = (new DBC())->query_to_array(
        'SELECT username from users where username = ?;',
        's',
        [$username]
      );
    } else {
      $result = (new DBC())->query_to_array(
        'SELECT
          username
        FROM users
        WHERE auth = ?;',
        's',
        [\Nefuzz\Php\Auth::make_hash($username,$password)]
      );
    }
    if (empty($result)) {
      return false;
    }
    if (strtolower($result[0]['username']) == strtolower($username)) {
      return true;
    } else {
      return false;
    }
  }

  /**
   * Get all the attendees of an event
   *
   * @param int $event_id - The id of the event to get attendees of
   *
   * @return array - The attendee information for this event
   */
  public static function get_attendees_for_event($event_id) {
    $query = "
      SELECT
        id,
        username,
        has_icon,
        fur_name,
        real_name,
        bio,
        species,
        contact_method,
        is_admin,
        joined_time,
        location,
        attendee_type
      FROM users
      JOIN event_attendees ON users.id = event_attendees.user;
      WHERE
        ea.event = ?;
    ";
    $results = (new DBC())->query_to_array($query, "i", [$event_id]);
    return $results;
  }
}