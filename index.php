<?php
require "vendor/autoload.php";
////////////////////////////////////////////////////////////
//UTILITY
////////////////////////////////////////////////////////////

/**
 * 404
 */
Flight::map('notFound', function(){
  (new \Nefuzz\Controllers\Not_Found())->load();
  http_response_code(404);
});

/**
 * SCSS
 */ 
Flight::route("/style.css", function() {
  require ("src/sass/style.php");
});


////////////////////////////////////////////////////////////
//PAGES
////////////////////////////////////////////////////////////

/**
 * Homepage ======================================
 */
Flight::route("/", function() {
  (new \Nefuzz\Controllers\Home())->load();
});
//================================================


/**
 * Registration ==================================
 */
Flight::route("/registration", function() {
  (new \Nefuzz\Controllers\Registration())->load();
});

//---------------------------------
//Ajax


//---------------------------------


//================================================


Flight::start();