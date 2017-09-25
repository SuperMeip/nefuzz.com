<?php

namespace Nefuzz\Models;

use Nefuzz\Collections\Contact_Method_Collection;
use Nefuzz\DAOs\Em_Info_SQL_DAO as SQL_DAO;

/**
 * Class Em_Info
 * The model for emergency info
 *
 * @package Nefuzz\Models
 */
class Em_Info extends Base_Model {

  /**
   * Emergency Contact Info/Methods
   *
   * @var Contact_Method_Collection
   */
  public $emergency_contacts;

  /**
   * List of allergies
   *
   * @var string
   */
  public $allergies;

  /**
   * If they have a bee allergy
   *
   * @var bool
   */
  public $bee_allergy;

  /**
   * If they have a food allergy
   *
   * @var bool|mixed
   */
  public $food_allergy;

  /**
   * List of any applicable medical issues
   *
   * @var string
   */
  public $medical_issues;

  /**
   * Get the emergency info for a specific user
   *
   * @param int $user_id - The id of the user to grab info for
   *
   * @return Em_Info - The emergency info as a populate-able array
   */
  public static function get($user_id) {
    $em_info = new Em_Info();
    $em_info->populate(SQL_DAO::get_by_user_id($user_id));
    return $em_info;
  }

  /**
   * Gets the em info as a 2d array
   *
   * @param bool $human_readable - replace true false with yes no
   *
   * @return array - a 2D array containing the em info
   */
  public function get_as_array($human_readable = false) {
    $array = [];
    $array[($human_readable ? 'Contact 1 Name' : 'em_name_1')] = $this->emergency_contacts[0]->contact_name;
    $array[($human_readable ? 'Contact 1 Phone' : 'em_phone_1')] = $this->emergency_contacts[0]->value;
    $array[($human_readable ? 'Contact 2 Name' : 'em_name_2')] = $this->emergency_contacts[1]->contact_name;
    $array[($human_readable ? 'Contact 2 Phone' : 'em_phone_2')] = $this->emergency_contacts[1]->value;
    $array[($human_readable ? 'Medical Issues' : 'medical_issues')] = $this->medical_issues;
    $array[($human_readable ? 'Allergies' : 'allergies')] = $this->allergies;
    $array[($human_readable ? 'Food Allergy' : 'food_allergy')] = ($human_readable ? (!empty($this->food_allergy) ? "yes" : "no") : $this->food_allergy);
    $array[($human_readable ? 'Bee Allergy' : 'bee_allergy')] = ($human_readable ? (!empty($this->bee_allergy) ? "yes" : "no") : $this->bee_allergy);
    return $array;
  }
}