<?php
require_once($_SERVER['DOCUMENT_ROOT']."/controllers/user.php");
?>

<?=(new User_Controller())->load();?>