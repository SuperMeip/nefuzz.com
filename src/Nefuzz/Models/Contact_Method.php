<?php

namespace Nefuzz\Models;

/**
 * The model to contain contact method data
 *
 * Class Contact_Method
 *
 * @package Nefuzz\Models
 */
class Contact_Method extends Base_Model {

  /**
   * Constants for the ids of the contact method types
   *
   * @var int
   */
  const EMAIL = 1;
  const TELEGRAM = 2;
  const TWITTER = 3;
  const FURAFFINITY = 4;
  const SKYPE = 5;
  const PHONE_NUMBER = 6;
  const DISCORD = 7;

  /**
   * Constant for getting the name of a contact method by ID
   *
   * @var array
   */
  const CONTACT_METHOD_NAMES = [
    "None",
    "Email",
    "Telegram",
    "Twitter",
    "FurAffinity",
    "Skype",
    "Phone Number",
    "Discord"
  ];

  /**
   * The method used to contact
   *
   * @var int
   */
  public $method;

  /**
   * The username/number of the contact method, the value used to contact the person through the method
   *
   * @var string
   */
  public $value;

  /**
   * Optional, name of the person the contact method belongs to
   *
   * @var string
   */
  public $contact_name;

  /**
   * If this method is the default contact method in a collection
   *
   * @var bool
   */
  public $is_default_method = false;
}