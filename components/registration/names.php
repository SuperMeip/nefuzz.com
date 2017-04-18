<script>
$(document).ready(function(){
  //check if username exists already
  $("#username").keyup(function() {
     $.ajax({
      type: "POST",
      url: "controls/registration/user_exists.php",
      data: {username: $(this).val()},
      success: function(data) {
        console.log(data);
        if (data === "0") {
          $("#username")[0].setCustomValidity('');
        } else {
          $("#username")[0].setCustomValidity('This username is already taken');
        }
      }
    });
  });
  //verify password and repeat are the same
  $("#repeat-password").change(function() {
    if($(this).val() !== $("#password").val()) {
      $("#password")[0].setCustomValidity('Passwords do not match!')
    } else {
      $("#password")[0].setCustomValidity('')
    }
  });
});
</script>
