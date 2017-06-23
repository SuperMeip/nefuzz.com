<script>
//submit the form
$(document).ready(function(){
  $("#make-meet-form").submit(function() {
    $theForm = $(this);
    
    $.ajax({
      type: $theForm.attr("method"),
      url: "/make_meet/request/add_new_meet",
      data: new FormData( this ),
      //dataType: "json",
      processData: false,
      contentType: false,
      success: function(data) {
          console.log(data);
        /*if (data && (typeof data !== "string")) {
          $("#registration-success.modal").css("display", "block");
          setTimeout(function(){
            window.location = "https://nefuzz.com/#login";
          }, 3000);
        } else {
          $("#registration-failed.modal").css("display", "block");
          $("#registration-failed.modal .error_message p").html(data);
        }*/
      }
    });
    
    return false;
  });
});
</script>