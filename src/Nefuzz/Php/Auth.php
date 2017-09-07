<?php

namespace Nefuzz\Php;

class Auth {
  const DBservername = "localhost";
  const DBusername = "nefuzz";
  const DBpassword = "thefuzzrules";
  const DBname = "the_fuzz";
  const google_maps_key = "AIzaSyDcq9lG4k1SwnfbyqyD4655hCW-003ParE";
  
  public static function make_hash($username,$password){
  	return hash("sha256", strtolower($username) . $password);
  }
}