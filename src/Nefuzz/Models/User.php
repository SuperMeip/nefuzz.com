<?php

namespace Nefuzz\Models;

use Nefuzz\Php\DBC as DBC;

class User extends \Nefuzz\Models\Base_Model {
  public $id = -1;                    //int
  public $is_current_user = false;    //bool
  public $username = "";              //string
  public $has_icon = false;           //bool
  public $fur_name = "";              //string
  public $real_name = "";             //string
  public $bio = "";                   //string
  public $species = "";               //string
  public $contact_method = 1;         //int
  public $is_admin = false;           //bool
  public $joined_time = 0;            //object(datetime)

  public $location = [];              //object(Location)
  public $contact_info = [];          //assoc[$contact_method=>contact_info(string)]
  public $emergency_info  = [];       //object(Em_Info)
  public $event_info = [];            //assoc[$event_id=>attendee_type(string)]
  public $meet_info = [];             //array[int]
  public $group_info = [];            //assoc[$group_id=>role(string)]
  
  private static $DB = false;         //object(DBC)
  
  
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
  public function __construct(
      $user_info,
      $meet_info,
      $event_info,
      $contact_info,
      $location_obj,
      $group_info,
      $emergency_obj
  ) {
    foreach ($user_info as $key => $value) {
      if (isset($this->{$key})) {
        $this->{$key} = $value;
      }
    }
    
    $this->location = $location_obj;
    $this->meet_info = $meet_info;
    $this->event_info = $event_info;
    $this->contact_info = $contact_info;
    $this->group_info = $group_info;
    $this->emergency_info = $emergency_obj;
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
    $GLOBALS["DB"] = new DBC();
    if (!self::exists($username, $password)) {
      return false;
    }
    $is_current_user = $password ? true : false;
    
    //grab all parts of the user data from DB
    $user_info = self::get_user_info($username);
    $user_info['is_current_user'] = $is_current_user;
    $location_obj = self::get_location_obj($username, false);
    $meet_info = self::get_meet_info($username);
    $event_info = self::get_event_info($username);
    $contact_info = self::get_contact_info($username);
    $group_info = self::get_group_info($username);
    $emergency_obj = self::get_emergency_obj($username);
    
    //close DB connection and return a constructed User
    $GLOBALS["DB"]->quit();
    return new User(
      $user_info, 
      $meet_info, 
      $event_info, 
      $contact_info, 
      $location_obj, 
      $group_info, 
      $emergency_obj
    );
  }
  
 /*///////////////////////////////////////////////////////////////////////*/
  /**
   * Get Sub-Functions
   *    Each is used to grab a part of the user object, each takes the username and connects to the
   *    DB to get the required info as an assoc array
   */
  private static function get_user_info($username) {
    $query = "
      SELECT
        id,
        username,
        has_icon,
        fur_name,
        real_name,
        bio,
        species,
        contact_method,
        is_admin,
        joined_time
      FROM users
      WHERE
        username = ?;
    ";
    $results = $GLOBALS["DB"]->query_to_array($query, "s", [$username]);
    return $results[0];
  }
  
  public static function get_location_obj($username, $DB = true) {
    if ($DB) {
      $GLOBALS["DB"] = new DBC();
    }
    $query = "
      SELECT
        u.address,
        u.city,
        u.region AS region_id,
        r.state,
        r.name as region
      FROM users u
        JOIN regions r on r.id = u.region
      WHERE
        u.username = ?;
    ";
    $results = $GLOBALS["DB"]->query_to_array($query, "s", [$username]);
    
    $query = "
      SELECT
        c.lat,
        c.lng,
      FROM coordinates c
        JOIN users u on u.id = c.user
      WHERE
        u.username = ?;
    ";
    $lat_lng = $GLOBALS["DB"]->query_to_array($query, "s", [$username])[0];
    $results[0]["lng"] = $lat_lng["lng"];
    $results[0]["lat"] = $lat_lng["lat"];
    return new Location($results[0]);
    if ($DB) {
      $GLOBALS["DB"]->quit();
    }
  }
  
  private static function get_meet_info($username) {
    $query = "
      SELECT
        m.id
      FROM meets m
        JOIN users u on u.id = m.user
      WHERE
        u.username = ?;
    ";
    $results_solo = $GLOBALS["DB"]->query_to_array($query, "s", [$username]);
    $ids_solo = [];
    foreach($results_solo as $result) {
      array_push($id_solo, $result["id"]);
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
    $results_groups = $GLOBALS["DB"]->query_to_array($query, "s", [$username]);
    $ids_groups = [];
    foreach($results_groups as $result) {
      array_push($id_groups, $result["id"]);
    }
    return array_unique(array_merge($ids_groups, $ids_solo), SORT_REGULAR);
  }
  
  private static function get_event_info($username) {
    $query = "
      SELECT
        e.id,
        at.id
      FROM events e
        JOIN event_attendees ea on ea.event = e.id
        JOIN users u on u.id = ea.user
        JOIN attendee_types at on at.id = ea.attendee_type
      WHERE
        u.username = ?;
    ";
    $results = $GLOBALS["DB"]->query_to_array($query, "s", [$username]);
    $event_info = [];
    foreach($results as $result) {
      $event_info[$result["id"]] = $result["name"];
    }
    return $event_info;
  }
  
  private static function get_contact_info($username) {
    $query = "
      SELECT
        cm.id,
        ucm.method_info
      FROM user_contact_methods ucm
        JOIN contact_methods cm on cm.id = ucm.method
        JOIN users u on u.id = ucm.user
      WHERE
        u.username = ?;
    ";
    $results = $GLOBALS["DB"]->query_to_array($query, "s", [$username]);
    $contact_info = [];
    foreach($results as $result) {
      $contact_info[$result["id"]] = $result["method_info"];
    }
    return $contact_info;
  }
  
  private static function get_emergency_obj($username) {
    $query = "
      SELECT
        ei.*
      FROM emergency_info ei
        JOIN users u on u.id = ei.user
      WHERE
        u.username = ?;
    ";
    $results = $GLOBALS["DB"]->query_to_array($query, "s", [$username]);
    return new Em_Info($results[0]);
  }
  
  private static function get_group_info($username) {
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
    $results = $GLOBALS["DB"]->query_to_array($query, "s", [$username]);
    $group_info = [];
    foreach($results as $result) {
      $contact_info[$result["group"]] = $result["role"];
    }
    return $group_info;
  }
  
  /*///////////////////////////////////////////////////////////////////////*/
  
  public function save_user_info($old_password = false, $new_password = false) {
    $GLOBALS["DB"] = new DBC();
    $new_password_line = ($new_password ? ", auth = ? " : "");
    $new_password_letter = ($new_password ? "s" : "");
    $query = "
      UPDATE users
      SET
        has_icon = ?,
        fur_name = ?,
        real_name = ?,
        bio = ?,
        species = ?,
        contact_method = ?
        $new_password_line
      WHERE
        username = ?;
    ";
    $values = [
      $this->validate(),
      $this->validate(),
      $this->validate(),
      $this->validate(),
      $this->validate(),
      $this->validate(),
    ];
    if ($new_password) {
      array_push($values, \Nefuzz\Php\Auth::make_hash($this->username, $new_password));
    }
    array_push($values, $this->username);
    $results = $GLOBALS["DB"]->query($query, "iss$new_password_letter", $values);
    $GLOBALS["DB"]->quit();
    return $results;
  }
  public function save_location() {}
  public function save_contact_info() {}
  public function save_em_info() {}
  public function save_group_info() {}
  
  /**
   * Adds this user to the DB as a new user with the specified password.
   * 
   * @param $password string - the new user's password
   * 
   * @return int - user.id if successfully added, 0 if failed
   */
  public function add($password) {
    $DB = new DBC();
    
    $DB->query("START TRANSACTION");
    $auth = makeHash(
      $this->validate($this->username, "^[a-zA-Z0-9_]{1,20}$", "Problem in Username field", $DB),
      $this->validate($password, "^(?=.*\d).{8,20}$", "Problem in Password field", $DB)
    );
    $query = "
      INSERT INTO users(
        username,
        auth,
        has_icon,
        fur_name,
        real_name,
        contact_method,
        address,
        region,
        city
      ) VALUES (
        ?,?,?,?,?,?,?,?,?
      );
    ";
    $worked = $DB->query($query, "ssissisis", [
      $this->username,
      $auth,
      $this->has_icon,
      $this->validate($this->fur_name, 50, "Problem in Fur Name field", $DB),
      $this->validate($this->real_name, 50, "Problem in Real Name field", $DB),
      $this->validate($this->contact_method, true, "Problem with Prefered Contact Method Selection", $DB),
      $this->validate($this->location->address, 50, "Problem with Address field", $DB),
      $this->validate($this->location->region_id, true, "Problem with state selection", $DB),
      $this->validate($this->location->city, 25, "Problem with City field", $DB)
    ]);
    
    if(!$worked){
      $DB->query("ROLLBACK");
      $DB->quit();
      return 0;
    }
    
    $id = $DB->get_insert_id();
    
    if ($this->location->gen_coords) {
      $query = "
        INSERT INTO coordinates(
          user_not_event,
          user,
          lat,
          lng
        ) VALUES (
          1,?,?,?
        );
      ";
      $worked = $DB->query($query, "iss", [
        $id,
        $this->location->lat,
        $this->location->lng
      ]);
      
      if(!$worked){
        $DB->query("ROLLBACK");
        $DB->quit();
        return 0;
      }
    }
    
    $values = [];
    $types = "";
    $query = "
    INSERT INTO user_contact_methods(
        user,
        method,
        method_info
      ) VALUES 
    ";
    foreach ($this->contact_info as $method => $method_info) {
      if ($method == 1) {
        $this->validate($method_info, "^[^@]+@[^@]+\.[^@]+$", "Problem in Email field", $DB);
      }
      $query .= "(?, ?, ?),";
      array_push(
        $values,
        $id,
        $method,
        $this->validate($method_info, 40, "Problem in Contact Method field #$method", $DB)
      );
      $types .= "iis";
    }
    $query = rtrim($query ,",");
    $query .= ";";
    $worked = $DB->query($query, $types, $values);
    
    if(!$worked) {
      $DB->query("ROLLBACK");
      $DB->quit();
      return 0;
    }
    
    $query = "
      INSERT INTO emergency_info(
        user,
        em_name_1,
        em_name_2,
        em_phone_1,
        em_phone_2,
        allergies,
        medical_issues,
        bee_allergy,
        food_allergy
      ) VALUES (
        ?, ?, ?, ?, ?, ?, ?, ?, ?
      );
    ";
    $worked = $DB->query($query, "issssssii", [
      $id,
      $this->validate($this->emergency_info->emergency_contacts[0]["name"], 50, "Problem in Name for Emergency Contact 1", $DB),
      $this->validate($this->emergency_info->emergency_contacts[0]["phone_number"], 20, "Problem in Phone Number for Emergency Contact 1", $DB),
      $this->validate($this->emergency_info->emergency_contacts[1]["name"], 50, "Problem in Name for Emergency Contact 2", $DB),
      $this->validate($this->emergency_info->emergency_contacts[1]["phone_number"], 20, "Problem in Phone Number for Emergency Contact 2", $DB),
      $this->validate($this->emergency_info->allergies, 50 , "Problem in Allergies field", $DB),
      $this->validate($this->emergency_info->medical_issues, 50 , "Problem in Medical Issues field", $DB),
      $this->emergency_info->bee_allergy,
      $this->emergency_info->food_allergy
    ]);
    
    if(!$worked) {
      $DB->query("ROLLBACK");
      $DB->quit();
      return 0;
    }
    
    $DB->query("COMMIT");
    
    $DB->quit();
    return($id);
  }
  
  /**
   * Get the user's icon address
   * 
   * @return string - the address of the user icon as a string.
   */
  public function get_icon() {
    return ($this->has_icon ? "/static/img/user/icon/$this->id.png" : "/static/img/user/icon/NONE.png");
  }
  
  public function get_icon_by_username($username) {
    $DB = new DBC();
    $query = "
      SELECT 
        has_icon,
        id
      FROM users
      WHERE username = ?
    ";
    $result = $DB->query_to_array($query, 's', [$username])[0];
    return ($result['has_icon'] ? "/static/img/user/icon/{$result['id']}.png" : "/static/img/user/icon/NONE.png");
  }
  
  /**
   * Get this user's user page link
   * 
   * @return string - returns the link addess to this user's page
   */
  public function get_page_link() {
    return "/user/$this->username";
  }
  
  public function get_page_link_from_username($username) {
    return "/user/$username";
  }
  
  /**
   * Get's a list of all contact methods a user can have
   * 
   * @return array - returns an array of associative arrays [[name=>$method_name][id=>$method_id]]
   */
  public static function get_all_contact_methods() {
     
    $DB = new DBC();
    $result = ($DB)->query_to_array("
        SELECT *
        FROM contact_methods;
    ",'',[]);
    $DB->quit();
    return $result;
   }
  
  public static function get_all_usernames() {
    $DB = new DBC();
    $query = "
      SELECT username
      FROM users
    ";
    $result = $DB->query_to_array($query);
    $list = [];
    foreach ($result as $name) {
      array_push($list, $name['username']);
    }
    return $list;
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
      $result = $DB->query_to_array(
        'SELECT
          username
        FROM users
        WHERE auth = ?;',
        's',
        [\Nefuzz\Php\Auth::make_hash($username,$password)]
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
  
  /**
   * Serializes the current user to json transferable format
   * 
   * @return string - a json containing all of the info from this
   *    user, this is able to be made into a User object via 
   *    user::deserialize()
   */
  public function serialize() {
    $copy = clone $this;
    
    $raw = [];
    $raw["emergency_info"] = $copy->emergency_info->serialize();
    $copy->emergency_info = null;
    $raw["meet_info"] = $copy->meet_info;
    $copy->meet_info = null;
    $raw["event_info"] = $copy->event_info;
    $copy->event_info = null;
    $raw["location_info"] = $copy->location_info->serialize();
    $copy->location_info = null;
    $raw["group_info"] = $copy->group_info;
    $copy->group_info = null;
    
    $user_info = [];
    foreach ($copy as $key => $value) {
      if (isset($value)) {
        $user_info[$key] = $value;
      }
    }
    $raw["user_info"] = $user_info;
    return json_encode($raw);
  }
  
  /**
   * Creates a User object from a serialized json of a user object
   * 
   * @param $json string - the json string to parse.
   * 
   * @return objecr(User) - returns the json as a User object
   */
  public static function deserialize($json){
    $raw = json_decode($json, true);
    if(!$raw || ($raw === "false")) {
      return false;
    }
    return new User(
      $raw['user_info'],
      $raw['meet_info'],
      $raw['event_info'],
      $raw['contact_info'],
      Location::deserialize($raw['location_info']),
      $raw['group_info'],
      Em_Info::deserialize($raw['emergency_info'])
    );
  }
}