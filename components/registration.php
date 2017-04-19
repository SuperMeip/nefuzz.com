<?php
if (isset($_SESSION["user"])){
  echo "
    <script>
      window.location = \"https://nefuzz.com\";
    </script>
  ";
}
?>
<script>
//submit the form
$(document).ready(function(){
  $("#registration-form").submit(function() {
    $theForm = $(this);
    
    $.ajax({
      type: $theForm.attr("method"),
      url: $theForm.attr("action"),
      data: new FormData( this ),
      //dataType: "json",
      processData: false,
      contentType: false,
      success: function(data) {
        if (data) {
          $("#registration-success.modal").css("display", "block");
          setTimeout(function(){
            window.location = "https://nefuzz.com/#login";
          }, 3000);
        } else {
          $("#registration-failed.modal").css("display", "block");
        }
      }
    });
    
    return false;
  });
});
</script>