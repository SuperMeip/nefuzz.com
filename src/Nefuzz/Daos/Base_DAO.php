<?php

class Base_DAO {

  /**
   * A DBO to use for the DAO
   *
   * @var \Nefuzz\Php\DBC
   */
  public static $DBO;

  /**
   * Base_DAO constructor
   */
  public function __construct() {
    self::$DBO = new \Nefuzz\Php\DBC();
  }
}