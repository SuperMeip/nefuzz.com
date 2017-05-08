<?php

namespace Nefuzz\Views;

class User extends \Nefuzz\Views\Base_View {
  
  public $user = null;
  public $contact_methods = [];
  public $attendee_types = []; // CHANGE
  
  public function username() {
    return $this->user->username;
  }
  
  public function user_icon() {
    $icon_url = $this->user->get_icon();
    return "
      <div class=\"user_icon_container" . ($this->user->is_current_user ? " is_current_user" : "") . "\"
        style=\"
          box-shadow: 2px 6px 10px darkgrey;
          width: 179px;
          height: 179px;
          border-radius: 100px;
          display:flex
        \"
      >
        <img class=\"large_icon round\" src=\"$icon_url\" /> " .
        ($this->user->is_current_user ? "
        <div class=\"overlay\">
          <i id=\"edit-icon-info\" class=\"fa fa-pencil\" aria-hidden=\"true\"></i>
        </div>" : "") . "
      </div>
    ";
  }
  
  public function meets_attended() {
    $attended = 0;
    foreach ($this->user->event_info as $id => $attendee_type) {
      if ($attendee_type < 3) {
        $attended++;
      }
    }
    $body = "
      <div id=\"user_meets_attended\">
        <div class=\"number\">
          <p>$attended</p>
        </div>
        <div class=\"title\">
          Meets Attended
        </div>
      </div>
    ";
    return new \Grid_Block([
      "height" => "mini",
      "width" => "full",
      "body" => $body
    ]);
  }
  
  public function meets_hosted() {
    $hosted = 0;
    foreach ($this->user->event_info as $id => $attendee_type) {
      if ($attendee_type == 1) {
        $hosted++;
      }
    }
    $body = "
      <div id=\"user_meets_hosted\">
        <div class=\"title\">
          Meets Hosted
        </div>
        <div class=\"number\">
          <p>$hosted</p>
        </div>
      </div>
    ";
    return new \Grid_Block([
      "height" => "mini",
      "width" => "full",
      "body" => $body
    ]);
  }
  
  public function group_membership() {
    $groups = count($this->user->group_info);
    $body = "
      <div id=\"user_member_groups\">
        <div class=\"number\">
          <p>$groups</p>
        </div>
        <div class=\"title\">
          Groups I'm In
        </div>
      </div>
    ";
    return new \Grid_Block([
      "height" => "mini",
      "width" => "full",
      "body" => $body
    ]);
  }
  
  public function redirect() {
    if(!$this->user) {
      echo "
        <script>
          window.location = \"https://nefuzz.com\";
        </script>
      ";
    }
  }
  
  public function contact_info_grid_block() {
    $display_methods = [];
    foreach ($this->user->contact_info as $method_id => $method_info) {
      foreach ($this->contact_methods as $method) {
        if ($method['id'] == $method_id) {
          $method_name = $method['name'];
        }
      }
      if (
        ($method_name != "Email") ||
        (($method_name == "Email") && ($this->user->is_current_user)) ||
        (($method_name == "Email") && ($this->user->contact_method == $method_id))
      ) {
        $display_methods[$method_name] = $method_info;
      }
    }
    
    $table = new \Info_Table([
      "values" => $display_methods
    ]);
    return new \Grid_Block([
      "title" => "Contact Info",
      "width" => "normal",
      "height" => "big",
      "content" => $table,
      "extra_icon" => ($this->user->is_current_user ? "pencil" : ""),
      "extra_icon_id" => "edit-contact-info"
    ]);
  }
  
  public function user_info_grid_block() {
    foreach ($this->contact_methods as $method) {
      if ($method['id'] == $this->user->contact_method) {
        $contact_method = $method['name'];
        break;
      }
    }
    $bio_info = [];
    $bio_info["Fur Name:"] = $this->user->fur_name;
    if ($this->user->is_current_user) {
      $bio_info["Real Name:"] = $this->user->real_name;
    }
    $bio_info["Prefered Contact:"] = $contact_method;
    $bio_info["Species:"] = $this->user->species;
    $bio_info["Bio:"] = $this->user->bio;
    
    $table = new \Info_Table([
      "values" => $bio_info
    ]);
    return new \Grid_Block([
      "title" => "User Info",
      "width" => "full",
      "height" => "large",
      "content" => $table,
      "extra_icon" => ($this->user->is_current_user ? "pencil" : ""),
      "extra_icon_id" => "edit-user-info"
    ]);
  }
  
  public function location_grid_item() {
    $address = ($this->user->is_current_user ? $this->user->location->address : "") ;
    $address = ($address ? "<div class=\"address\">$address</div>" : "");
    $city = $this->user->location->city;
    $state = $this->user->location->state;
    $body = "
      <div id=\"user_location\">
        <div class=\"address_city\">
          $address
          <div class=\"city\">$city</div>
        </div>
        <div class = \"state" . ($this->user->is_current_user ? " is_current_user" : "") . "\">
          <p>$state</p>" .
          ($this->user->is_current_user ? "
          <div class=\"overlay\">
            <i id=\"edit-location-info\" class=\"fa fa-pencil\" aria-hidden=\"true\"></i>
          </div>" : "") . "
        </div>
      </div>
    ";
    return new \Grid_Block([
      "width" => "full",
      "height" => "mini",
      "body" => $body
    ]);
  }
  
  public function em_info_grid_block() {
    if ($this->user->is_current_user) {
      $em_info = $this->user->emergency_info->get_as_array(true);
      $table = new \Info_Table([
        "values" => $em_info
      ]);
      return new \Grid_Block([
        "title" => "Emergency Info",
        "width" => "large",
        "height" => "large",
        "content" => $table,
        "extra_icon" => ($this->user->is_current_user ? "pencil" : ""),
        "extra_icon_id" => "edit-user-info"
      ]);
    } else {
      return "";
    }
  }

  protected function js() {
    return ["user"];
  }
  
  protected function template() {
    return "user";
  }
}