<?php

namespace Nefuzz\Models;

use Nefuzz\DAOs\Event_Details_SQL_DAO as SQL_DAO;

/**
 * Class Event_Details
 * Model for a set of event details
 *
 * @package Nefuzz\Models
 */
class Event_Details extends Base_Model {

  /**
   * The id of this set of event details
   *
   * @var int
   */
  public $id;

  /**
   * If this event has an icon
   *
   * @var int
   */
  public $has_icon;

  /**
   * The event description
   *
   * @var string
   */
  public $description;

  /**
   * The short blurb about the event
   *
   * @var string
   */
  public $short_info;

  /**
   * The owner provided url for the event
   *
   * @var string
   */
  public $url;

  /**
   * The tags for this event
   * @TODO: Implement tag model and tags
   *
   * @var array
   */
  public $tags;

  /**
   * If rsvp is required for this event
   *
   * @var bool
   */
  public $must_rsvp;

  /**
   * The max number of attendees for this event
   *
   * @var int
   */
  public $max_attendees;

  /**
   * The alternate host information
   *
   * @var Contact_Method
   */
  public $alt_host;

  /**
   * The location of this event
   *
   * @var int|Location
   */
  public $location;

  /**
   * Get the event details by detail id
   *
   * @param $event_details_id - The id of the event details to get
   *
   * @return Event_Details - The object containing the event details
   */
  public static function get($event_details_id) {
    $event_details_model = new Event_Details();
    $event_details_info = SQL_DAO::get_general_info($event_details_id);
    $alt_host = new Contact_Method();
    $alt_host->contact_name = $event_details_info['alt_name'];
    $alt_host->value = $event_details_info['alt_contact'];
    $alt_host->method = $event_details_info['alt_method'];
    $event_details_info['alt_host'] = $alt_host;
    $event_details_model->populate($event_details_info);

    return $event_details_model;
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
}