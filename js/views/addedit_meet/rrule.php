


<script>
$(document).ready(function() {
  $("#rrule-type-select").change(function() {
    var value = $(this).val();
    if(value === "monthly") {
      $(".rr_monthly").toggleClass("hide", false);
      $(".rr_weekly").toggleClass("hide", true);
    }
    if(value === "weekly") {
      $(".rr_monthly").toggleClass("hide", true);
      $(".rr_weekly").toggleClass("hide", false);
    }
  })
  var picker = new MaterialDatetimePicker({})
      .on('submit', function(d) {
        console.log(d.format('dddd'));
        $('#datetimepicker').val(d);
      });
  var el = document.querySelector('#datetimepicker');
  el.addEventListener('click', function() {
    picker.open(moment());
  }, false);
});
</script>