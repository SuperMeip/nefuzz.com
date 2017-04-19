<script>
$(document).ready(function(){
  //check if username exists already
  $("#username").keyup(function() {
     $.ajax({
      type: "POST",
      url: "controls/registration/user_exists.php",
      data: {username: $(this).val()},
      success: function(data) {
        if (data === "0") {
          $("#username")[0].setCustomValidity('');
        } else {
          $("#username")[0].setCustomValidity('This username is already taken');
        }
        $("#username")[0].reportValidity();
      }
    });
  });
  //verify password and repeat are the same
  $("#repeat-password").keyup(function() {
    if($(this).val() !== $("#password").val()) {
      $("#repeat-password")[0].setCustomValidity('Passwords do not match!');
    } else {
      $("#repeat-password")[0].setCustomValidity('');
    }
    $("#repeat-password")[0].reportValidity();
  });
});
</script>
