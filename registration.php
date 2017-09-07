<?php
require_once($_SERVER['DOCUMENT_ROOT']."/controllers/registration.php");
?>

<?=(new Registration_Controller())->load();?>