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
  if (hash.substring(1) == "login") {
    $("#login.modal").css('display', 'block');
  }
  $("#logout").click(function() {
    $.ajax({
      type: "POST",
      url: "controls/header/logout.php",
      success: function() {
        location.reload();
      }
    });
  });
});
</script>

<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/components/common.php");
require_once($_SERVER['DOCUMENT_ROOT']."/models/user.php");
require_once($_SERVER['DOCUMENT_ROOT']."/php/common.php");

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
  $icon = use_control("get/user_icon", ['username' => $user->username]);
  $link = use_control("user/link", ['username' => $user->username]);
  return "
    <a class=\"right row item info\" href=\"$link\">
      <img src=\"$icon\" class=\"small_icon round\"/>
    </a>
    <a class=\"item\" href=\"#\">
      <i class=\"fa fa-sign-out\" id=\"logout\" aria-hidden=\"true\"></i>
    </a>
  ";
}