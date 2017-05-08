<?php

namespace Nefuzz\Models;

class Em_Info {
  public $emergency_contacts = [];    //array[assoc[name=>string, phone_number=>string]]
  public $allergies = "";             //string
  public $bee_allergy = false;        //int(bool)
  public $food_allergy = false;       //int(bool)
  public $medical_issues = "";        //string
  
  public function __construct($em_info_array) {
    array_push($this->emergency_contacts, [
      "phone_number" => $em_info_array["em_phone_1"],
      "name" => $em_info_array["em_name_1"],
    ]);
    array_push($this->emergency_contacts, [
      "phone_number" => $em_info_array["em_phone_2"],
      "name" => $em_info_array["em_name_2"],
    ]);
    $this->bee_allergy = $em_info_array["bee_allergy"];
    $this->food_allergy = $em_info_array["food_allergy"];
    $this->medical_issues = $em_info_array["medical_issues"];
    $this->allergies = $em_info_array["allergies"];
  }
  
  public function get_as_array($human_readable = false) {
    $array = [];
    $array[($human_readable ? 'Contact 1 Name' : 'em_name_1')] = $this->emergency_contacts[0]['name'];
    $array[($human_readable ? 'Contact 1 Phone' : 'em_phone_1')] = $this->emergency_contacts[0]['phone_number'];
    $array[($human_readable ? 'Contact 2 Name' : 'em_name_2')] = $this->emergency_contacts[1]['name'];
    $array[($human_readable ? 'Contact 2 Phone' : 'em_phone_2')] = $this->emergency_contacts[1]['phone_number'];
    $array[($human_readable ? 'Medical Issues' : 'medical_issues')] = $this->medical_issues;
    $array[($human_readable ? 'Allergies' : 'allergies')] = $this->allergies;
    $array[($human_readable ? 'Food Allergy' : 'food_allergy')] = ($human_readable ? ($this->food_allergy ? "yes" : "no") :$this->food_allergy);
    $array[($human_readable ? 'Bee Allergy' : 'bee_allergy')] = ($human_readable ? ($this->bee_allergy ? "yes" : "no") :$this->bee_allergy);
    return $array;
  }
}