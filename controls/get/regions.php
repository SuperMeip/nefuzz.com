<?php
require_once($_SERVER['DOCUMENT_ROOT']."/php/db.php");
/**
 * Generates a json of all the regions and their IDs
 */

$result = (new DBC())->query_to_array("
    SELECT *
    FROM regions;
",'',[]);
echo json_encode($result);
?>