<?php

namespace Nefuzz\Models;

use Nefuzz\Collections\Contact_Method_Collection;
use Nefuzz\DAOs\Contact_Method_SQL_DAO;
use Nefuzz\DAOs\User_SQL_DAO as SQL_DAO;

/**
 * Class User
 * The user model
 *
 * @package Nefuzz\Models
 *
 * @property Location                  location
 * @property Em_Info                   emergency_info
 * @property Contact_Method_Collection contact_info
 */
class User extends Base_Model {

  /**
   * The user id
   *
   * @var int
   */
  public $id;

  /**
   * If this user is the current user
   *
   * @var bool
   */
  public $is_current_user = false;

  /**
   * The username
   *
   * @var string
   */
  public $username;

  /**
   * If the user has an icon
   *
   * @var bool
   */
  public $has_icon = false;

  /**
   * The user's furry name
   *
   * @var string
   */
  public $fur_name;

  /**
   * The user's real name
   *
   * @var string
   */
  public $real_name;

  /**
   * The user's bio information
   *
   * @var string
   */
  public $bio;

  /**
   * The user's species
   *
   * @var string
   */
  public $species;

  /**
   * The contact method this user uses
   *
   * @var int
   */
  public $contact_method;

  /**
   * If the user is an admin
   *
   * @var bool
   */
  public $is_admin = false;

  /**
   * The join date/time of the user
   *
   * @var int
   */
  public $joined_time;

  /**
   * The user's location/location_id
   *
   * @var int|Location
   */
  private $location;

  /**
   * The user's contact information
   *
   * @var Contact_Method_Collection
   */
  private $contact_info;

  /**
   * The user's Emergency Info
   *
   * @var Em_Info
   */
  private $emergency_info;

  /**
   * Attendance info
   *
   * @var \Nefuzz\Collections\Event_Collection
   */
  private $events_attending;

  /**
   * A collection of meets managed/hosted by the user
   *
   * @var \Nefuzz\Collections\Event_Collection
   */
  private $events_hosting;

  /**
   * The groups this user is a member of
   *
   * @var \Nefuzz\Collections\Group_Collection
   */
  private $groups;

  /**
   * Get user from the DB by name or ID
   *
   * @param $user     string|int  - the username/user ID to grab the user for
   * @param $password string|bool - add the password to grab this user as the current user for authorization.
   *
   * @return \Nefuzz\Models\User
   */
  public static function get($user, $password = false) {
    $user_model = new User();
    $user_model->populate(SQL_DAO::get_general_info($user));
    if (!is_numeric($user) && !empty($password)) {
      $user_model->is_current_user = SQL_DAO::exists($user, $password);
    }
    return $user_model;
  }

  /**
   * Get magic method for the location
   *
   * @return Location
   */
  public function getLocation() {
    if (!empty($this->location) && is_int($this->location)) {
      $this->location = Location::get($this->location);
    }
    return $this->location;
  }

  /**
   * Get magic method for the emergency info
   *
   * @return Em_Info
   */
  public function getEmergency_info() {
    if (empty($this->emergency_info)) {
      $this->emergency_info = Em_Info::get($this->id);
    }
    return $this->emergency_info;
  }

  /**
   * Get magic method for the contact info
   *
   * @return Contact_Method_Collection'
   */
  public function getContact_info() {
    if(get_class($this->contact_info) !== "Contact_Method_Collection") {
      $this->contact_info = new Contact_Method_Collection();
      $this->contact_info->populate(Contact_Method_SQL_DAO::get_contact_methods_for_user($this->id));
    }
    return $this->contact_info;
  }

  public function getAttendance_info() {

  }
}