<?php
require_once("php/common.php");

function region_options() {
  $raw_regions = use_control("get/regions");
  $regions = [];
  foreach ($raw_regions as $region) {
    $regions[$region['state']] = $region['id'];
  }
  return array_merge(["" => ""], $regions);
}