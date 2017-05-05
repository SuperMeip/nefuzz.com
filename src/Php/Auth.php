<?php

namespace Nefuzz/Php;

class Auth {
  public static $DBservername = "localhost";
  public static $DBusername = "nefuzz";
  public static $DBpassword = "thefuzzrules";
  public static $DBname = "the_fuzz";
  public static $google_maps_key = "AIzaSyDcq9lG4k1SwnfbyqyD4655hCW-003ParE";
  
  public static function make_hash($username,$password){
  	return hash("sha256", strtolower($username) . $password);
  }
}