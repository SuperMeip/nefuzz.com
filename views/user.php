<?php
require_once($_SERVER['DOCUMENT_ROOT']."/views/view.php");

class User_View extends View {
  
  public $user = null;
  public $contact_methods = [];
  
  public function redirect() {
    if(!$this->user) {
      echo "
        <script>
          window.location = \"https://nefuzz.com\";
        </script>
      ";
    }
  }
  
  function contact_info_grid_block() {
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
    
    $table = new Info_Table([
      "values" => $display_methods
    ]);
    return new Grid_Block([
      "title" => "Contact Info",
      "width" => "normal",
      "height" => "big",
      "content" => $table,
      "extra_icon" => ($this->user->is_current_user ? "pencil" : ""),
      "extra_icon_id" => "edit-contact-info"
    ]);
  }
  
  public function username() {
    return $this->user->username;
  }
  
  public function user_icon() {
    return $this->user->get_icon();
  }
  
  function user_info_grid_block() {
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
    
    $table = new Info_Table([
      "values" => $bio_info
    ]);
    return new Grid_Block([
      "title" => "User Info",
      "width" => "full",
      "height" => "large",
      "content" => $table,
      "extra_icon" => ($this->user->is_current_user ? "pencil" : ""),
      "extra_icon_id" => "edit-user-info"
    ]);
  }
  
  function location_grid_item() {
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
        <div class = \"state\"><p>$state</p></div>
      </div>
    ";
    return new Grid_Block([
      "width" => "full",
      "height" => "mini",
      "body" => $body
    ]);
  }

  protected function js() {
    return ["user"];
  }
  
  protected function template() {
    return "user";
  }
}