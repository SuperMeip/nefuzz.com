<script>
$(document).ready(function(){
  //make selected contact_method required
  $("#contact_method").change(function() {
    $("#contact_method option").each(function(name, val) {
      var method = val.text;
      var input_id = method.replace(" ", "-") + "Input";
      $("#" + input_id).attr("required", false);
      $("#" + input_id).siblings("label").toggleClass("required", false);
    });
    var method = $("#contact_method option:selected").text();
    var input_id = method.replace(" ", "-") + "Input";
    $("#" + input_id).attr("required", true);
    $("#" + input_id).siblings("label").toggleClass("required", true);
  });
});
</script>