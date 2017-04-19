<?php
require_once($_SERVER['DOCUMENT_ROOT']."/models/user.php");
require_once($_SERVER['DOCUMENT_ROOT']."/php/common.php");

$data = $_POST;

$user_info = [
    "username" => $data["username"],
    "has_icon" => ($_FILES["icon"]["tmp_name"] ? 1 : 0),
    "fur_name" => $data["fur_name"] ?? "",
    "real_name" => $data["real_name"] ?? "",
    "contact_method" => $data["contact_method"],
];

$location_obj = new Location([
    "address" => $data["address"] ?? "",
    "city" => $data["city"] ?? "",
    "region" => $data["region"]
]);

$emergency_obj = new Em_Info([
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

foreach ($data as $name => $value) {
    if(strpos($name, "method_")) {
        if (($value != "@" && $value)){
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

$new_id = $new_user->add($data['password']);

if (!$new_id) {
    echo 0;
    return;
}
$target_path = $_SERVER['DOCUMENT_ROOT']."/img/user/icon/$new_id.png";
move_uploaded_file($_FILES["icon"]["tmp_name"], $target_path);
echo $new_id;
?>