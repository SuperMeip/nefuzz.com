<?php
$directory = __DIR__ . "/scss";

require "scss.inc.php";
scss_server::serveFrom($directory);
?>