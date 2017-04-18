<script>
$(document).ready(function(){
  $("form").submit(function() {
    /*$('input[data-validation]').each(function() {
      console.log([$(this).data("validation"), $(this)]);
      if (!$(this).data("validation")) {
        console.log("didn't send");
        alert("There are still validation errors on the page");
        return false;
      }
    });*/
    console.log("sent ajax");
    /*$theForm = $(this);
    
    // send xhr request
    $.ajax({
      type: $theForm.attr("method"),
      url: $theForm.attr("action"),
      data: new FormData( this ),
      processData: false,
      contentType: false,
      success: function(data) {
        console.log(data);
      }
    });*/
    
    // prevent submitting again
    return false;
  });
});
</script>