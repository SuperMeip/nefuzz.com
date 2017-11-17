<?php

namespace Nefuzz\DAOs;

use Nefuzz\Php\DBC;

/**
 * The model to contain contact method data
 *
 * Class Contact_Method
 *
 * @package Nefuzz\Models
 */
class Contact_Method_SQL_DAO extends Base_DAO {

  /**
   * Gets the contact method info for a user by username or ID
   *
   * @param string|int $user - The username or ID to fetch user data for
   *
   * @return array - The contact method data as an array of assoc arrays
   */
  public static function get_contact_methods_for_user($user) {
    if(is_int($user)) {
      $lookup_column = 'id';
    } elseif (is_string($user)) {
      $lookup_column = 'username';
    } else {
      return [];
    }

    $query = "
      SELECT
        c.method,
        c.method_info AS value,
        u.username AS contact_name
      FROM user_contact_methods c
      JOIN users u ON u.id = c.user
      WHERE
        $lookup_column = ?;
    ";
    $results = (new DBC())->query_to_array($query, $lookup_column === 'username' ? "s" : "i", [$user]);
    return $results;
  }
}