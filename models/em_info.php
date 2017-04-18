<?php

class Em_Info {
    public $emergency_contacts = [];   //array[assoc[name=>string, phone_number=>string]]
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
}