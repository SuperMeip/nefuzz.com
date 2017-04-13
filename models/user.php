<?php
require_once("models/location.php");
require_once("models/Em_Info.php");

class User {
  public $id = -1;                    //int
  public $is_current_user = false;     //bool
  public $username = "";              //string
  public $has_icon = false;           //bool
  public $fur_name = "";              //string
  public $real_name = "";             //string
  public $contact_method = "";        //string
  public $is_admin = false;           //bool
  public $location = [];               //object(Location)
  public $contact_information = [];   //assoc[$contact_method=>contact_info(string)]
  public $emergency_info  = [];       //object(Em_Info)
  public $joined_time = 0;            //object(datetime)
  public $event_info = [];            //assoc[$event_id=>attendee_type(string)]
  public $meets = [];                 //array[int]
  public $groups = [];                //assoc[$group_id=>role(string)]
  
  
  /**
   * Builds a User object from the provided arrays
   * 
   * @param $user_info assoc[$DBColumn=>int|bool|string] - array containing the basic info from the user table in the DB
   *    -real_name is witheld unless password was provided
   * @param $meet_info array[int] - array containing the IDs of the meets this user is a host of.
   * @param $event_info assoc[$event_id=>attendee_type(string)] - an array of the user's involvement in events.
   * @param $contact_info assoc[contact_method=>contact_info(string)] - an array of contact_methods, the method is the key.
   *    -email option is witheld unless password was provided or the user has email as their default contact method
   * @param $location_array assoc[$LocationPart=>string] - the array used to create a Location object.
   *    -address is witheld unless password was provided
   * @param $group_info assoc[group_id=>role(string)] - an array of the roles this member has in groups, the group IDs being the keys
   * @param em_info assoc[$DBColumn=>string|bool] - an array of emergency info from the database used to create an Em_Info object.
   *    -this is entirely withheld unless password was provided.
   */
  public function __construct($user_info, $meet_info, $event_info, $contact_info, $location_array, $group_info, $em_info = false) {
      
  }
  
  /**
   * Get user from the DB by name
   * 
   * @param $username string - the username to grab
   * @param $password string - !optional, add the password to grab all private info as well.
   * 
   * @return object(User)
   */
  public static function get($username, $password) {
      
  }
  
  public function get_user_info($username, $is_current_user) {}
  public function get_location($username, $is_current_user) {}
  public function get_meet_info($username) {}
  public function get_event_info($username) {}
  public function get_contact_info($username, $is_current_user) {}
  public function get_em_info($username, $is_current_user) {}
  public function get_group_info($username) {}
  
  public function save_user_info() {}
  public function save_location() {}
  public function save_contact_info() {}
  public function save_em_info() {}
  public function save_group_info() {}
  
  /**
   * Adds this user to the DB as a new user with the specified password.
   */
  public function add($password) {
      
  }
  
  /**
   * Requst a user's emergency info as a host
   * 
   * @param $user string - The username you want the em_info from
   * @param $requester string - The username of the person requesting the information, to verify this user has a meet
   *    with propper permission to view this information.
   * 
   * @return object(Em_Info) - The user's emergency info.
   */
  public static function request_em_info($user, $requester) {
    
  }
  
  /**
   * Requst a user's real name as a host
   * 
   * @param $user string - The username you want the real name from
   * @param $requester string - The username of the person requesting the information, to verify this user has a meet
   *    with propper permission to view this information.
   * 
   * @return string - The user's real name.
   */
  public static function request_real_name($user, $requester) {
    
  }
}