<?php

namespace Nefuzz\Models;

use Nefuzz\DAOs\User_SQL_DAO as SQL_DAO;

/**
 * Class User
 * The user model
 *
 * @package Nefuzz\Models
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
   * @var array
   */
  private $contact_info;

  /**
   * The user's Emergency Info/Em_Info_id
   * @var int|Em_Info
   */
  private $emergency_info;

  /**
   * Attendance info
   *
   * @var Nefuzz\Collections\Attendance_Collection
   */
  private $attendance_info;

  /**
   * A collection of meets managed/hosted by the user
   *
   * @var Nefuzz\Collections\Hosting_Collection
   */
  private $meet_info;

  /**
   * The groups this user is a member of
   *
   * @var Nefuzz\Collections\Group_Collection
   */
  private $group_info;

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
}