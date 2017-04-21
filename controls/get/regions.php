<?php
//gets an array of all regions from the DB

function regions() {
  require_once($_SERVER['DOCUMENT_ROOT']."/php/db.php");

  $result = (new DBC())->query_to_array("
      SELECT *
      FROM regions;
  ",'',[]);
  return $result;
}

if (isset($_GET['ajax'])) {
  echo json_encode(regions());
}
?>