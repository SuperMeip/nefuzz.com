<?php

namespace Nefuzz\Models;

use Nefuzz\Collections\Event_Collection;
use Nefuzz\DAOs\Event_SQL_DAO;
use Nefuzz\DAOs\Meet_SQL_DAO as SQL_DAO;
use RRule\RRule;

/**
 * Class User
 * The user model
 *
 * @package Nefuzz\Models
 *
 * @property User          user    The user who owns this meet
 * @property Group         group   The group that owns this meet
 * @property Event_Details details The default event details
 */
class Meet extends Base_Model {

  /**
   * The Meet id
   *
   * @var int
   */
  public $id;

  /**
   * The name of the meet
   *
   * @var string
   */
  public $name;

  /**
   * A breif description of the Meet
   *
   * @var string
   */
  public $overview;

  /**
   * If this is a convention
   *
   * @var bool
   */
  public $is_con;

  /**
   * The time this meet was created
   *
   * @var string
   */
  public $created_time;

  /**
   * If the rrule for this meet has been approved
   *
   * @var bool
   */
  public $rrule_approved;

  /**
   * The user who owns the meet
   *
   * @var int|User
   */
  private $user;

  /**
   * The group that owns the meet
   *
   * @var int|Group
   */
  private $group;

  /**
   * The RRule for this meet
   *
   * @var string|\RRule\RSet
   */
  private $rrule;

  /**
   * The default event details for this meet
   *
   * @var array
   */
  private $details;

  /**
   * The events created from this meet
   *
   * @var \Nefuzz\Collections\Event_Collection
   */
  private $events;

  /**
   * Get a meet by id
   *
   * @param $meet_id - The id of the meet to grab
   *
   * @return Meet - The meet with the requested id
   */
  public static function get($meet_id) {
    $meet_model = new Meet();
    $meet_model->populate(SQL_DAO::get_general_info($meet_id));
    return $meet_model;
  }

  /**
   * Magic method for getting the user
   *
   * @return User
   */
  public function getUser() {
    if(!empty($this->user) && is_int($this->user)) {
      $this->user = User::get($this->user);
    }
    return $this->user;
  }

  /**
   * Magic method for getting the group
   * @TODO: inpliment when groups are implimented
   *
   * @return null
   */
  public function getGroup() {
    return null;
  }

  /**
   * Magic method for getting the rrule object
   *
   * @return \RRule\RSet
   */
  public function getRrule() {
    if (!empty($this->rrule) && is_string($this->rrule)) {
      $this->rrule = self::gen_rrule_obj($this->rrule);
    }
    return $this->rrule;
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
   * Get magic method for the events for this meet
   *
   * @return \Nefuzz\Collections\Event_Collection
   */
  public function getEvents() {
    if (get_class($this->events) !== 'Event_Collection') {
      $this->events = new Event_Collection();
      $this->events->populate(Event_SQL_DAO::get_events_for_meet($this->id));
    }
    return $this->events;
  }

  public function get_future_events() {

  }

  public function get_event_count() {

  }

  public function get_default_details() {

  }

  public function get_dates() {

  }

  public function get_next_date() {

  }

  public function build_rrule_string($rrule_info, $ex_dates = []) {
    if (empty($rrule_info)) {
      return "";
    }
    $rset = new \RRule\RSet();
    $rset->addRRule($rrule_info);
    foreach ($ex_dates as $ex_date) {
      $rset->addExDate($ex_date);
    }
    $RRString = $rset->getRRules()[0]->rfcString($include_timezone = true);
	  $ExDateStrings = [];
	  foreach($rset->getEXDates() as $Ex) {
		  array_push($ExDateStrings, $Ex->format("U"));
	  }
	  $RRString .= " EXDATES:" . implode(",", $ExDateStrings);

    $this->rrule = $RRString;
	  return $RRString;
  }

  public static function gen_rrule_obj($rrule_string) {
    $parts = explode(" ", $rrule_string);
  	$rset = new \RRule\RSet();
  	$rset->addRRule($parts[0]);
  	$ex_dates = explode(",", explode(":",$parts[1])[1]);
  	foreach($ex_dates as $ex_date) {
  		$rset->addExDate($ex_date);
  	}
  	return $rset;
  }
}
?>