<?php
require "vendor/autoload.php";

Flight::route("/", function() {
    (new \Nefuzz\Controllers\Home())->load();
});

Flight::start();