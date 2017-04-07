<?php 
require_once('common.php');

function login_modal() {
  $modal = new Modal([
    "title" => "Login",
    "template" => "header/login_modal",
    "activator" => (
      '<a class="row info" href="#">
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

function icon_and_logout($user_id) {
  return "
    <a class=\"right row info\" href=\"#\">
      <img src=\"img/user_icon/$user_id.png\" class=\"small_icon round\"/>
    </a>
    <a href=\"#\">
      <i class=\"fa fa-sign-out\" aria-hidden=\"true\"></i>
    </a>
  ";
}
?>

<script type="text/javascript">
//Nav Bar Scroll
  $(document).ready(function() {
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
  });
</script>