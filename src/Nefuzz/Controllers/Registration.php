<?php

namespace Nefuzz\Controllers;

use \Nefuzz\Models\User as User;

class Registration extends \Nefuzz\Controllers\Base_Controller {

  protected function page_body() {
    $view = new \Nefuzz\Views\Registration();
    $view->load();
  }
  
  public function request($action, $argument) {
    if ($action == "add_new_user") {
      if (empty($_POST)) {
        return false;
      };
      echo json_encode(self::add_new_user($_POST ?? ""));
      return true;
    }
    elseif ($action == "user_exists") {
      echo json_encode(self::user_exists($argument ?? ($_POST['username'] ?? "")));
      return true;
    } else {
      return false;
    }
  }
  
  public static function user_exists($username) {
    if (!$username) {
      return false;
    }
    
    $query = "
      SELECT username
      FROM users
      WHERE username = ?
    ";
    
    $result = User::exists($username);
    if ($result) {
      return true;
    } else {
      return false;
    }
  }
  
  public static function add_new_user($data) {
    $user_info = [
      "username" => $data["username"],
      "has_icon" => ($_FILES["icon"]["tmp_name"] ? 1 : 0),
      "fur_name" => $data["fur_name"] ?? "",
      "real_name" => $data["real_name"] ?? "",
      "contact_method" => $data["contact_method"]
    ];
    
    $location_obj = new \Nefuzz\Models\Location([
      "address" => $data["address"] ?? "",
      "city" => $data["city"] ?? "",
      "region" => $data["region"]
    ]);
    
    $emergency_obj = new \Nefuzz\Models\Em_Info([
      "em_phone_1" => $data["em_phone_1"] ?? "",
      "em_phone_2" => $data["em_phone_2"] ?? "",
      "em_name_1" => $data["em_name_1"] ?? "",
      "em_name_2" => $data["em_name_2"] ?? "",
      "medical_issues" => $data["medical_issues"] ?? "",
      "allergies" => $data["allergies"] ?? "",
      "bee_allergy" => (isset($data["bee_allergy"]) ? 1 : 0),
      "food_allergy" => (isset($data["food_allergy"]) ? 1 : 0),
    ]);
    
    $contact_info = [];
    
    if (
      (empty($_POST['contact_method_' . $_POST['contact_method']]) ||
      ($_POST['contact_method_' . $_POST['contact_method']] == "@")) &&
      ($_POST['contact_method'] > 1)
    ) {
      return "Prefered contact ({$_POST['contact_method']}) not filled in";
    }
    
    foreach ($data as $name => $value) {
      if(strpos($name, "method_")) {
        if (($value != "@") && !empty($value)){
          $id = explode('_', $name)[2];
          $contact_info[$id] = $value;
        }
      }
    }
    $contact_info["1"] = $data["email"];
    
    $new_user = new User(
      $user_info,
      [],
      [],
      $contact_info,
      $location_obj,
      [],
      $emergency_obj
    );
    
    try {
      $new_id = $new_user->add($data['password']);
    } catch (Exception $e) {
      return $e->getMessage();
    }  
    
    if (!$new_id) {
      return "The Database rejected your submission for unknown reasons!";
    }
    
    $target_path = $_SERVER['DOCUMENT_ROOT']."/static/img/user/icon/$new_id.png";
    move_uploaded_file($_FILES["icon"]["tmp_name"], $target_path);
    return $new_id;
  }
  
}