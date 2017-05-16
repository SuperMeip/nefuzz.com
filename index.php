<?php
require "vendor/autoload.php";
session_start();

////////////////////////////////////////////////////////////
//UTILITY
////////////////////////////////////////////////////////////

/**
 * 404
 */
Flight::map('notFound', function(){
  (new \Nefuzz\Controllers\Not_Found())->load();
  http_response_code(404);
  return true;
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
 * Other =========================================
 */
//used for API/Ajax requests to a controller
Flight::route("/@controller/request/@action(/@argument)", function($controller, $action, $argument) {
  $controller_class = "\\Nefuzz\\Controllers\\" . str_replace(" ", "_" , ucwords(str_replace("_", " ", strtolower($controller))));
  if (class_exists($controller_class)) {
    $result = (new $controller_class())->request($action, isset($argument) ? strtolower($argument) : null);
    if (!$result) {
      return true;
    }
  } else {
    return true;
  }
});

//Used for page navigation.
Flight::route("/@controller(/@argument)", function($controller, $argument) {
  $controller_class = "\\Nefuzz\\Controllers\\" . str_replace(" ", "_" , ucwords(str_replace("_", " ", strtolower($controller))));
  if (class_exists($controller_class)) {
    $load_controller = new $controller_class();
    if ($argument) {
      $result = $load_controller->set_argument(strtolower($argument));
      if (!$result) {
        return true;
      }
    }
    $load_controller->load();
  } else {
    return true;
  }
});

//================================================

Flight::start();