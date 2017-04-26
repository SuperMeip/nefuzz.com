<?php
require_once($_SERVER['DOCUMENT_ROOT']."/controllers/map.php");
?>

<?=(new Map_Controller())->load();?>