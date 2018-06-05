<?php

namespace Nefuzz\Models;

/**
 * Class Attendee
 * The user model
 *
 * @package Nefuzz\Models
 */
class Attendee extends User {

  /**
   * Types of meet attendance
   *
   * @var int
   */
  const HOST = 1;
  const ATTENDEE = 2;
  const INVITED = 3;

  /**
   * The type of attendee this is
   *
   * @var int
   */
  public $attendee_type;

  /**
   * The id of the event this user is attending
   *
   * @var int
   */
  public $meet_id;
}