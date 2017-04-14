<?php
require_once("models/location.php");
require_once("models/Em_Info.php");
require_once("php/db.php");

class User {
  public $id = -1;                    //int
  public $is_current_user = false;    //bool
  public $username = "";              //string
  public $has_icon = false;           //bool
  public $fur_name = "";              //string
  public $real_name = "";             //string
  public $contact_method = "";        //string
  public $is_admin = false;           //bool
  public $joined_time = 0;            //object(datetime)

  public $location = [];              //object(Location)
  public $contact_information = [];   //assoc[$contact_method=>contact_info(string)]
  public $emergency_info  = [];       //object(Em_Info)
  public $event_info = [];            //assoc[$event_id=>attendee_type(string)]
  public $meets = [];                 //array[int]
  public $groups = [];                //assoc[$group_id=>role(string)]
  
  private $DB = false                //object(DBC)
  
  
  /**
   * Builds a User object from the provided arrays
   * 
   * @param $user_info assoc[$DBColumn=>int|bool|string] - array containing the basic info from the user table in the DB
   * @param $meet_info array[int] - array containing the IDs of the meets this user is a host of.
   * @param $event_info assoc[$event_id=>attendee_type(string)] - an array of the user's involvement in events.
   * @param $contact_info assoc[contact_method=>contact_info(string)] - an array of contact_methods, the method is the key.
   * @param $location_info assoc[$LocationPart=>string] - the array used to create a Location object.
   * @param $group_info assoc[group_id=>role(string)] - an array of the roles this member has in groups, the group IDs being the keys
   * @param $emergency_info assoc[$DBColumn=>string|bool] - an array of emergency info from the database used to create an Em_Info object.
   */
  public function __construct($user_info, $meet_info, $event_info, $contact_info, $location_info, $group_info, $emergency_info) {
      
  }
  
  /**
   * Get user from the DB by name
   * 
   * @param $username string - the username to grab
   * @param $password string|bool - add the password to grab all private info as well, false to just grab normal info.
   * 
   * @return object(User)
   */
  public static function get($username, $password = false) {
    //connect to DB and verify user
    $DB = new DBC();
    if (!self::exists($username, $password)) {
      return false;
    }
    $is_current_user = $password ? true : false;
    
    //grab all parts of the user data from DB
    $user_info = get_user_info($username);
    $user_info['is_current_user'] = $is_current_user;
    $location_array = get_location($username);
    $meet_info = get_meet_info($username);
    $event_info = get_event_info($username);
    $contact_info = get_contact_info($username);
    $group_info = get_group_info($username);
    $em_info = get_emergency_info($username);
    
    //close DB connection and return a constructed User
    $DB->close();
    return new User(
      $user_info, 
      $meet_info, 
      $event_info, 
      $contact_info, 
      $location_info, 
      $group_info, 
      $emergency_info
    );
  }
  
  /**
   * Get Functions
   *    Each is used to grab a part of the user object, each takes the username and connects to the
   *    DB to get the required info as an assoc array
   */
  private function get_user_info($username) {
    $query = "
      SELECT
        id,
        username,
        has_icon,
        fur_name,
        real_name,
        contact_method,
        is_admin,
        joined_time
      FROM users
      WHERE
        u.username = ?;
    ";
    $results = $this->DB->query_to_array($query, "s", $username);
    return $result[0];
  }
  
  private function get_location($username) {
    $query = "
      SELECT
        u.address,
        u.city,
        r.state,
        r.name as region
      FROM users u
        JOIN regions r on r.id = u.region
      WHERE
        u.username = ?;
    ";
    $results = $this->DB->query_to_array($query, "s", $username);
    return $result[0];
  }
  
  private function get_meet_info($username) {
    $query = "
      SELECT
        m.id
      FROM meets m
        JOIN users u on u.id = m.user
      WHERE
        u.username = ?;
    ";
    $results_solo = $this->DB->query_to_array($query, "s", $username);
    $ids_solo = [];
    foreach($results_solo as $result) {
      array_push($id_solo, $result["id"];
    }
    $query = "
      SELECT
        m.id
      FROM user_group_roles ugr
        JOIN groups g on g.id = ugr.group
        JOIN users u on u.id = ugr.user
        JOIN group_roles gr on gr.id = ugr.role
        JOIN meets m on m.user = ugr.user
      WHERE
        u.username = ? AND gr.id < 3;
    ";
    $results_groups = $this->DB->query_to_array($query, "s", $username);
    $ids_groups = [];
    foreach($results_groups as $result) {
      array_push($id_groups, $result["id"];
    }
    return array_unique(array_merge($ids_groups, $ids_solo), SORT_REGULAR);
  }
  
  private function get_event_info($username) {
    $query = "
      SELECT
        e.id,
        at.name
      FROM events e
        JOIN event_attendees ea on ea.event = e.id
        JOIN users u on u.id = ea.user
        JOIN attendee_types at on at.id = ea.attendee_type
      WHERE
        u.username = ?;
    ";
    $results = $this->DB->query_to_array($query, "s", $username);
    $event_info = [];
    foreach($results as $result) {
      $event_info[$result["id"]] = $result["name"];
    }
    return $event_info;
  }
  
  private function get_contact_info($username) {
    $query = "
      SELECT
        cm.name,
        ucm.method_info
      FROM user_contact_methods ucm
        JOIN contact_methods cm on cm.id = ucm.method
        JOIN users u on u.id = ucm.user
      WHERE
        u.username = ?;
    ";
    $results = $this->DB->query_to_array($query, "s", $username);
    $contact_info = [];
    foreach($results as $result) {
      $contact_info[$result["name"]] = $result["method_info"];
    }
    return $contact_info;
  }
  
  private function get_emergency_info($username) {
    $query = "
      SELECT
        ei.*
      FROM emergency_info ei
        JOIN users u on u.id = ei.user
      WHERE
        u.username = ?;
    ";
    $results = $this->DB->query_to_array($query, "s", $username);
    return $results[0];
  }
  
  private function get_group_info($username) {
    $query = "
      SELECT
        g.name AS `group`,
        gr.name AS role
      FROM user_group_roles ugr
        JOIN groups g on g.id = ugr.group
        JOIN users u on u.id = ugr.user
        JOIN group_roles gr on gr.id = ugr.role
      WHERE
        u.username = ?;
    ";
    $results = $this->DB->query_to_array($query, "s", $username);
    $group_info = [];
    foreach($results as $result) {
      $contact_info[$result["group"]] = $result["role"];
    }
    return $group_info;
  }
  
  
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
    //this will be done as a control
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
    //this will be done as a control
  }
  
  /**
   * Checks if the user with the username exists, if a password is provided this also can be used to
   *    authorize a username/password combination.
   * 
   * @param $username string - the username to look up
   * @param $password string|bool - the password to test against the username(false if only checking name)
   */
  public static function exists ($username, $password = false) {
    $DB = new DBC();
    if ($password === false) {
      $result = $DB->query_to_array(
        'SELECT username from users where username = ?;',
        's',
        [$username]
      );
    } else {
      require_once('php/auth.php');
      $result = $DB->query_to_array(
        'SELECT username from users where auth = ?;',
        's',
        [makeHash($username,$password)]
      );
    }
    $DB->quit();
    if (!isset($result[0])) {
      return false;
    }
    if (strtolower($result[0]['username']) == strtolower($username)) {
      return true;
    } else {
      return false;
    }
  }
}