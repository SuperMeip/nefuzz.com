<?php

namespace Nefuzz\Models;

use Nefuzz\Collections\Attendee_Collection;
use Nefuzz\DAOs\Event_SQL_DAO as SQL_DAO;
use Nefuzz\DAOs\User_SQL_DAO;

/**
 * Class Event
 * The event model
 *
 * @package Nefuzz\Models
 *
 * @property Meet            meet
 * @property Event_Details   details
 * @property User_Collection attendees
 *
 * @property string          name
 */
class Event extends Base_Model {

  /**
   * The event id
   *
   * @var int
   */
  public $id;

  /**
   * The edition/number this event is of it's meet
   *
   * @var string
   */
  public $edition;

  /**
   * If this is a draft
   *
   * @var bool
   */
  public $is_draft;

  /**
   * The start time
   *
   * @var int
   */
  public $start_time;

  /**
   * The end time
   *
   * @var int
   */
  public $end_time;

  /**
   * The time this was created
   *
   * @var int
   */
  public $created_time;

  /**
   * The time this was last modified
   *
   * @var int
   */
  public $modified_time;

  /**
   * The time this was posted as a string (YYY-MM-DD HH:MM:SS)
   *
   * @var int|null
   */
  public $posted_time;

  /**
   * The time this meet was canceled if it was canceled
   *
   * @var int|null
   */
  public $canceled_time;

  /**
   * The meet this is an event of/meet_id
   *
   * @var int|Meet
   */
  private $meet;

  /**
   * The details for this event/event_details_id
   *
   * @var int|Event_Details
   */
  private $details;

  /**
   * The attending users
   *
   * @var \Nefuzz\Collections\Attendee_Collection
   */
  public $attendees;

  public static function get($event_id) {
    $event_model = new Event();
    $event_model->populate(SQL_DAO::get_general_info($event_id));
    return $event_model;
  }

  /**
   * Get magic method for the Meet
   *
   * @return Meet
   */
  public function getMeet() {
    if (!empty($this->meet) && is_int($this->meet)) {
      $this->meet = Meet::get($this->meet);
    }
    return $this->meet;
  }

  /**
   * Get magic method for the event details
   *
   * @return Event_Details
   */
  public function getDetails() {
    if (!empty($this->details) && is_int($this->details)) {
      $this->details = Event_Details::get($this->details);
    }
    return $this->details;
  }

  /**
   * Get magic method for the attendee info
   *
   * @return \Nefuzz\Collections\Attendee_Collection
   */
  public function getAttendees() {
    if (get_class($this->attendees) != 'User_Collection') {
      $attendee_collection = new Attendee_Collection();
      $attendee_collection->populate(User_SQL_DAO::get_attendees_for_event($this->id));
      $this->attendees = $attendee_collection;
    }
    return $this->attendees;
  }

  public function getName() {
    return $this->getMeet()->name ?? '';
  }

  public function to_ical() {
    
  }
}
?>