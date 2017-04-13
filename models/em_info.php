<?php

class Em_Info {
    public $emergency_contacts = [] ;   //array[assoc[name=>string, phone_number=>string]]
    public $allergies = "";             //string
    public $bee_allergy = false;        //bool
    public $food_allergy = false;       //bool
    public $medical_issues = "";        //string
    
    public function __construct($em_info_array) {
        array_push($emergency_contacts, [
            "phone_number" => $em_info_array["em_phone_1"],
            "name" => $em_info_array["em_name_1"],
        ]);
        array_push($emergency_contacts, [
            "phone_number" => $em_info_array["em_phone_2"],
            "name" => $em_info_array["em_name_2"],
        ]);
        $bee_allergy = $em_info_array["bee_allergy"];
        $food_allergy = $em_info_array["food_allergy"];
        $medical_issues = $em_info_array["medical_issues"];
        $allergies = $em_info_array["allergies"];
    }
}