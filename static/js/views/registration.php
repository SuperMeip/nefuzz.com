<script>
//submit the form
$(document).ready(function(){
  $("#registration-form").submit(function() {
    $theForm = $(this);
    
    $.ajax({
      type: $theForm.attr("method"),
      url: $theForm.attr("action") + "?action=add_new_user",
      data: new FormData( this ),
      dataType: "json",
      processData: false,
      contentType: false,
      success: function(data) {
        if (data && (typeof data !== "string")) {
          $("#registration-success.modal").css("display", "block");
          setTimeout(function(){
            window.location = "https://nefuzz.com/#login";
          }, 3000);
        } else {
          $("#registration-failed.modal").css("display", "block");
          $("#registration-failed.modal .error_message p").html(data);
        }
      }
    });
    
    return false;
  });
});
</script>