<?php

class User_SQL_DAO extends Base_DAO {

  public function get_general_info($user) {
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
        joined_time
      FROM users
      WHERE
        $lookup_column = ?;
    ";
    $results = self::$DBO->query_to_array($query, "s", [$user]);
    return $results[0];
  }
}