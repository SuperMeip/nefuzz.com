<?php

namespace Nefuzz\DAOs;

use Nefuzz\Collections\Contact_Method_Collection;
use Nefuzz\Models\Contact_Method;
use Nefuzz\Php\DBC;

/**
 * Class Em_Info_SQL_DAO
 * The sql dao for accessing emergency info
 *
 * @package Nefuzz\DAOs
 */
class Em_Info_SQL_DAO extends Base_DAO {

  /**
   * Grab the emergency info for a specific user
   *
   * @param int $user_id - The id of the user to grab info for
   *
   * @return array - The emergency info as a populate-able array
   */
  public static function get_by_user_id($user_id) {
    $query = "
      SELECT *
      FROM emergency_info
      WHERE user = ?;
    ";

    $results = (new DBC())->query_to_array($query, "i", [$user_id]);
    if (!empty($results[0])) {
      $results = $results[0];
    } else {
      return [];
    }
    $emergency_contacts = new Contact_Method_Collection();
    $emergency_contacts->models = [
      Contact_Method::build([
        "contact_name" => $results["em_name_1"],
        "method"       => Contact_Method::PHONE_NUMBER,
        "value"        => $results["em_phone_1"]
      ]),
      Contact_Method::build([
        "contact_name" => $results["em_name_2"],
        "method"       => Contact_Method::PHONE_NUMBER,
        "value"        => $results["em_phone_2"]])
    ];
    $results['emergency_contacts'] = $emergency_contacts;

    return $results;
  }
}