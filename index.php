<?php
require_once($_SERVER['DOCUMENT_ROOT']."/controllers/home.php");
?>

<?=(new Home_Controller())->load();?>