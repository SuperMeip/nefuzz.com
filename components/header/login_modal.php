<script>
$(document).ready(function(){
  $("#login-form input").keyup(function() {
    $("#login-password")[0].setCustomValidity("");
  });
  $("#login-form").submit(function() {
    $theForm = $(this);
    
    $.ajax({
      type: $theForm.attr("method"),
      url: $theForm.attr("action") + "?ajax=true",
      data: $(this).serialize(),
      dataType: "json",
      success: function(data) {
        if (data) {
          location.reload();
        } else {
          $("#login-password")[0].setCustomValidity("Inncorrect username or password");
          $("#login-password")[0].reportValidity();
        }
      }
    });
    
    return false;
  });
});
</script>