<?php
require_once($_SERVER['DOCUMENT_ROOT']."/controllers/controller.php");
require_once($_SERVER['DOCUMENT_ROOT']."/models/user.php");
require_once($_SERVER['DOCUMENT_ROOT']."/views/map/everyone_map.php");

class Map_Controller extends Controller {

  protected function page_body() {
    $view = new Everyone_Map_View();
    $users_and_locations = [];
    foreach (User::get_all_usernames() as $username) {
      $location = User::get_location_obj($username);
      if ($location->city) {
        $info = [];
        $info['username'] = $username;
        $info['location'] = "$location->city, $location->state";
        array_push($users_and_locations, $info);
      }
    }
    $view->users_and_locations = $users_and_locations;
    $view->load();
  }
  
  public static function get_user_icons($user_list) {
    $counter = 0;
    $html = "
      <div class=\"map_city_icon_list\">
        <div class=\"map_city_icon_row\">
    ";
    foreach($user_list as $username) {
      $counter++;
      $icon_url = User::get_icon_by_username($username);
      $page_url = User::get_page_link_from_username($username);
      $html .= "
        <a href=\"$page_url\">
          <img class=\"small_icon round\" title=\"$username\" src=\"$icon_url\"/>
        </a>
      ";
      if (($counter%5)==0) {
        $html .= "
          </div>
          <div class=\"map_city_icon_row\">
        ";
      }
    }
    $html .= "
        </div>
      </div>
    ";
    return $html;
  }
} 

//AJAX HANDLER

if (isset($_GET['action'])) {
  if ($_GET['action'] == "get_user_icons") {
    echo json_encode(Map_Controller::get_user_icons($_POST['user_list'] ?? []));
  }
}