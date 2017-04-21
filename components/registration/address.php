<?php
require_once("php/common.php");
require_once("controls/get/regions.php");

function region_options() {
  $raw_regions = regions();
  $regions = [];
  foreach ($raw_regions as $region) {
    $regions[$region['state']] = $region['id'];
  }
  return array_merge(["" => ""], $regions);
}