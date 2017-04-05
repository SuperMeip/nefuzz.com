<?php
include_once('location.php');
include_once('db.php');

class User {
  const BY_NAME = 0;
  const BY_ID = 1;

  public $is_current_user;
  public $username;
  public $group_id;
  public $id;
  public $real_name;
  public $fur_name;
  public $admin;
  public $social_networks;
  public $owner;
  public $contact_method;
  public $contact_info;
  public $location;
  public $meets;

  public function __construct($user_data, $events) {
    var_dump($user_data);
    $this->is_current_user = $user_data['is_current_user'];
    $this->username = $user_data['Username'];
    $this->group_id = $user_data['GroupID'];
    $this->id = $user_data['UserID'];
    $this->real_name = $user_data['RealName'] ?? '' ;
    $this->fur_name = $user_data['FurName'] ?? '';
    $this->admin = $user_data['IsAdmin'];
    $this->owner = $user_data['IsOwner'];
    $this->contact_method = $user_data['contactmethod'];
    $this->contact_info = [
      'email' => $user_data['email'] ?? '',
      'telegram' => $user_data['telegram'] ?? '',
      'skype' => $user_data['skype'] ?? '',
      'phone' => $user_data['phone'] ?? '',
    ];
    $this->social_networks = [
      'twitter' => $user_data['twitter'] ?? '',
      'furaffinity' => $user_data['furaffinity'] ?? '',
      'furrynetwork' => $user_data['furnetwork'] ?? '',
    ];
    $this->location = new Location(
      $user_data['state'],
      $user_data['city'] ?? '',
      $user_data['address'] ?? '',
      false,
      $user_data['zip'] ?? ''
    );
    
    $this->meets = array();

    $this->meets['hosting'] = [];
    $this->meets['attending'] = [];
    $this->meets['invited'] = [];

    foreach ($events as $event) {
      if ($event['AttendeeType'] == 1) {
        array_push($this->meets->hosting, $event);
      }
      if ($event['AttendeeType'] < 4) {
        array_push($this->meets->attending, $event);
      } else {
        array_push($this->meets->invited, $event);
      }
    }
  }

  public static function get($id_or_name, $username, $password = false){
    if ($password) {
      $is_current_user = User::login($username, $password);
      if (!$is_current_user) {
        return false;
      }
    } else {
      $is_current_user = false;
    }
    
    $DB = new DBC();
    $query = '
      SELECT 
        UserID,
        GroupID,
        FurName,
        IsAdmin,
        IsOwner,
        twitter,
        furaffinity,
        furnetwork,
        contactmethod,
        state,
        hidelocation
      FROM ev_users
      WHERE ' . ($id_or_name ? 'UserID' : 'Username') . ' = ?;
    ';

    $result = $DB->query_to_array($query, 's', [$username]);
    if(!isset($result[0])) {
      return false;
    }
    $user_data = $result[0];
    $user_data['is_current_user'] = $is_current_user;
    $contact_method = $user_data['contactmethod'];
    $show_city = $user_data['hidelocation'];

    $query = '
      SELECT ' .
        ($contact_method == 'telegram' ? 'telegram, ' : '') .
        ($contact_method == 'skype' ? 'skype, ' : '') .
        ($contact_method == 'phone' ? 'phone, ' : '') .
        ($contact_method == 'email' ? 'email' : '') . 
        ($show_city ? 'city, ' : '') .
        'Username
      FROM ev_users
      WHERE UserID = ?;
    ';
    $user_data = array_merge(
      $user_data,
      $DB->query_to_array($query, 's', [$user_data['UserID']])[0]
    );

    $query = '
      SELECT *
      FROM ev_assoc_user_event
      WHERE UserID = ?
    ';
    $events = $DB->query_to_array($query, 's', [$user_data['UserID']]);

    if (!$is_current_user) {
      return new User($user_data, $events);
    }

    $query = '
      SELECT
        RealName, ' .
        ($contact_method != 'telegram' ? 'telegram, ' : '') .
        ($contact_method != 'skype' ? 'skype, ' : '') .
        ($contact_method != 'phone' ? 'phone, ' : '') .
        ($contact_method != 'email' ? 'email, ' : '') . 
        (!$show_city ? 'city, ' : '') .
        'address,
        zip
        FROM ev_users
        WHERE UserID = ?
    ';
    $user_data = array_merge(
      $user_data,
      $DB->query_to_array($query, 's', [$user_data['UserID']])[0]
    );

    return new User($user_data, $events);
  }

  /*
   * Incomplete
   */
  public static function get_emergency_info($username, $requester) {
    if(true) {
      $emergency_info->contacts = [
        [
          'name' => $emergency_info['EmContact1_Name'],
          'phone' => $emergency_info['EmContact1_Phone']
        ],
        [
          'name' => $emergency_info['EmContact2_Name'],
          'phone' => $emergency_info['EmContact2_Phone']
        ]
      ];
      $emergency_info->allergies->bees = $emergency_info['BeeAllergy'];
      $emergency_info->allergies->food = $emergency_info['FoodAllergy'];
      $emergency_info->allergies->list = $emergency_info['Allergies'];
    }
  }
  
  public static function login ($username, $password) {
    include_once('auth.php');
    $DB = new DBC();
    $result = $DB->query_to_array(
      'SELECT username from ev_users where AuthKey = ? ;',
      's',
      [makeHash($username,$password)]
    );
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
?>