<?php
require_once($_SERVER['DOCUMENT_ROOT']."/models/user.php");
session_start();
error_reporting( E_ALL );
?>
  
<!DOCTYPE html>
<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script type="text/javascript" src="js/cleave.min.js"></script>
  <script type="text/javascript" src="js/cleave-phone.us.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="icon" sizes="192x192" href="img/iconsquare.png">
	<link rel="apple-touch-icon" href="img/iconsquare.png">
  <link rel="stylesheet" href="css/style.php?p=styles.scss" />
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <meta name="theme-color" content="green"/>
	<meta name="mobile-web-app-capable" content="yes">
  <meta charset="UTF-8">

<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/components/component.php");
require_once($_SERVER['DOCUMENT_ROOT']."/components/common.php");
function login_modal() {
  $modal = new Modal([
    "id" => "login",
    "title" => "Login",
    "template" => "header/login_modal",
    "activator" => (
      '<a class="row info item" href="#">
        <img src="img/login.png" class="small_icon round"/>
      </a>'
      ),
  ]);
  return new Tooltip([
    "focus" => $modal->get_component(),
    "position" => "left",
    "content" => "Login",
    "extra_classes" => "right"
  ]);
}

function icon_and_logout($user) {
  require_once($_SERVER['DOCUMENT_ROOT']."/controls/get/user_icon.php");
  require_once($_SERVER['DOCUMENT_ROOT']."/controls/user/page_link.php");
  $icon = user_icon($user->username);
  $link = page_link($user->username);
  return "
    <a class=\"right row item info\" href=\"$link\">
      <img src=\"$icon\" class=\"small_icon round\"/>
    </a>
    <a class=\"item\" href=\"#\">
      <i class=\"fa fa-sign-out\" id=\"logout\" aria-hidden=\"true\"></i>
    </a>
  ";
}

class Header extends Component {
  protected $component_class = "header";
  public $title = "The New England Fuzz";
  public $extra_keywords = [];
  public $links = [];
  public $author = "Meep";
  public $description = "A website for hosting and discovering furry meets in New England";
  public $meta_tags = [];

  public function get_component() {
    $extra_keywords = ""; 
    foreach ($this->extra_keywords as $keyword) {
      $extra_keywords .= ", $keyword";
    }
    $meta_tags = "";
    foreach ($this->meta_tags as $name => $content) {
      $meta_tags .= "<meta name=\"$name\" content=\"$content\"/>\n";
    }
    $links = "";
    foreach ($this->links as $rel => $href) {
      $links .= "<link rel=\"$rel\" href=\"$href\"/>\n";
    }
  
    return "
        <meta name=\"keywords\" content=\"new england, new, england, massachussetts,
          boston, harftord, conneticut, vermont, new hampshire, rhode island,
          providence, maine, furry, fur, furmeet, furbowl, mascot, anthropomorphic,
          meet, meets, meetup, convention $extra_keywords\">
        <meta name=\"author\" content=\"$this->author\">
      	$meta_tags
        <title>$this->title</title>
        <meta name=\"description\" content=\"$this->description\">
        $links
      </head>
      <body>
        <header>
          <div class=\"hidden_bumper\"></div>
          <div class=\"site_banner\">
            <img class=\"logo\" src='img/nefuzzicon.png'/>
            <img class=\"name\" src='img/fuzztext.png'/>
          </div>
          <div class=\"nav_bar\" id=\"main-nav-bar\">
            <a class=\"item\" href=\"/\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i><span class=\"desktop margin_left_small\">Home</span></a>
            <a class=\"item\" href=\"#\"><i class=\"fa fa-list\" aria-hidden=\"true\"></i><span class=\"desktop margin_left_small\">Meets</span></a>
            <a class=\"item\" href=\"#\"><i class=\"fa fa-calendar\" aria-hidden=\"true\"></i><span class=\"desktop margin_left_small\">Calendar</span></a>
            <a class=\"item\" href=\"#\"><i class=\"fa fa-map\" aria-hidden=\"true\"></i><span class=\"desktop margin_left_small\">Map</span></a>
            <a class=\"item\" href=\"#\"><i class=\"fa fa-search\" aria-hidden=\"true\"></i><span class=\"desktop margin_left_small\">Search</span></a> " .
            (isset($_SESSION['user']) ? icon_and_logout($_SESSION['user']) : login_modal()) . "
          </div>
          <script>
          $(document).ready(function() {
            //Nav Bar Scroll
            $(window).scroll(function () {
              if ($(window).scrollTop() > 100) {
                $('#main-nav-bar').addClass('nav_fixed');
                $('.hidden_bumper').show();
              }
              if ($(window).scrollTop() < 101) {
                $('#main-nav-bar').removeClass('nav_fixed');
                $('.hidden_bumper').hide();
              }
            });
            //Open right to login
            var hash = window.location.hash;
            if (hash.substring(1) == 'login') {
              $('#login.modal').css('display', 'block');
            }
            $('#logout').click(function() {
              $.ajax({
                type: 'POST',
                url: 'controls/header/logout.php?ajax=true',
                success: function() {
                  location.reload();
                }
              });
            });
          });
          </script>
        </header>
        <main>
    ";
  }
}