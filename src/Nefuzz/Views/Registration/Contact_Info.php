<?php

namespace Nefuzz\Views\Registration;

class Contact_Info extends \Nefuzz\Views\Base_View {
    
  private $contact_methods = [];
  
  public function __construct() {
    $raw_methods = \Nefuzz\Models\User::get_all_contact_methods();

    foreach ($raw_methods as $method) {
      $this->contact_methods[$method['name']] = $method['id'];
    }
  }
  
  function contact_options() {
    return array_merge(["" => ""], $this->contact_methods);
  }
  
  function contact_inputs() {
    $count = 0;
    $output = "<div class=\"row center\">\n";
    foreach ($this->contact_methods as $name => $id) {
      if (($count % 3) == 0) {
        $output .= "</div>\n<div class=\"row center mobile_column\">\n";
      }
      $cleave = [];
      if($name == "Phone Number") {
        $cleave = [
          "phone" => true,
          "phoneRegionCode" => "US"
        ];
      }
      if(($name == "Twitter") || ($name == "Telegram")){
        $cleave = [
          "prefix" => "@"
        ];
      }
      if($name != "Email") {
        $output .= new \Text_Input([
          "id" => str_replace(" ", "-", $name."Input"),
          "name" => "contact_method_" . $id,
          "pattern" => ($name == "Discord" ? ".*#[0-9]{4,6}" : ""),
          "label" => $name,
          "cleave" => $cleave,
          "size" => "medium",
          "max_characters" => 20
        ]) . "\n";
        $count++;
      }
    }
    $output .= "</div>";
    return $output;
  }

  protected function js() {
    return ["registration/contact_info"];
  }
  
  protected function template() {
    return "registration/contact_info";
  }
}