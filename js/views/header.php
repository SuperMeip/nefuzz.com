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
  //logout button
  $('#logout').click(function() {
    $.ajax({
      type: 'POST',
      url: 'controllers/login_logout.php?action=logout',
      success: function() {
        location.reload();
      }
    });
  });
});
</script>