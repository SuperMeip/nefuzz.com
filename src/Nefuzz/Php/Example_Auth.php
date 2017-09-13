<?php

namespace Nefuzz\Php;

/**
 * Secret auth stuff, remove Example from your real file
 *
 * Class Auth
 */
class Example_AuthAuth {

  /**
   * The DB's server address
   *
   * @var string
   */
  const DB_SERVER_ADDRESS = "";

  /**
   * The DB username
   *
   * @var string
   */
  const DB_USERNAME = "";

  /**
   * The DB password
   *
   * @var string
   */
  const DB_PASSWORD = "";

  /**
   * The DB name
   *
   * @var string
   */
  const DB_NAME = "";

  /**
   * Google maps api key
   *
   * @var string
   */
  const google_maps_key = "";

  /**
   * Generates the hash for the username and password authorization
   *
   * @param string $username
   * @param string $password
   *
   * @return string          - The auth hash of the user
   */
  public static function make_hash($username,$password){
    return "auth-key";
  }
}
