<?php
require_once($_SERVER['DOCUMENT_ROOT']."/php/db.php");
/**
 * Generates a json of all the contact_methods and their IDs
 */

$result = (new DBC())->query_to_array("
    SELECT *
    FROM contact_methods;
",'',[]);
echo json_encode($result);
?>