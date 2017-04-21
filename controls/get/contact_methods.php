<?php
//Gets all the contact_methods and their IDs

function contact_methods() {
  require_once($_SERVER['DOCUMENT_ROOT']."/php/db.php");

  $result = (new DBC())->query_to_array("
      SELECT *
      FROM contact_methods;
  ",'',[]);
  return $result;
}

if (isset($_GET['ajax'])) {
  echo json_encode(contact_methods());
}
?>