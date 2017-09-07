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
  });
  swapOut($(window).width());
  $(window).resize(function() {
    swapOut($(window).width());
  });
  /*var picker = new MaterialDatetimePicker({})
      .on('submit', function(d) {
        console.log(d.format('dddd'));
        $('#datetimepicker').val(d);
      });
  var el = document.querySelector('#datetimepicker');
  el.addEventListener('click', function() {
    picker.open(moment());
  }, false);*/
});

function swapOut(screenWidth) {
  var largeInputW = `<?=new Select_Input([
    "extra_classes" => "only_show_on_large",
    "label" => "On",
    "multiple" => true,
    "name" => "byday_w[]",
    "size" => "large",
    "options" => $this->weekdays,
  ]);?>`;
  var smallInputW = `<?=new Select_Input([
    "extra_classes" => "only_show_on_small",
    "label" => "On",
    "multiple" => true,
    "name" => "byday_w[]",
    "size" => "large",
    "options" => $this->weekdays_small,
  ]);?>`;
  var largeInputM = `<?=new Select_Input([
    "extra_classes" => "only_show_on_large",
    "label" => "On",
    "multiple" => true,
    "name" => "byday_m[]",
    "size" => "large",
    "options" => $this->weekdays,
  ]);?>`;
  var smallInputM = `<?=new Select_Input([
    "extra_classes" => "only_show_on_small",
    "label" => "On",
    "multiple" => true,
    "name" => "byday_m[]",
    "size" => "large",
    "options" => $this->weekdays_small,
  ]);?>`;
  var smallDropDown = `<?=new Select_Input([
      "extra_classes" => "only_show_on_small",
      "label" => "On The",
      "name" => "bysetpos",
      "size" => "mini",
      "options" => $this->day_position_small,
    ]);?>`;
  var largeDropDown = `<?=new Select_Input([
      "extra_classes" => "only_show_on_large",
      "label" => "On The",
      "name" => "bysetpos",
      "size" => "mini",
      "options" => $this->day_position,
    ]);?>`
  if (screenWidth < 766) {
    $("#bysetpos_picker").html(smallDropDown);
    $("#day_picker_w").html(smallInputW);
    $("#day_picker_m").html(smallInputM);
  } else {
    $("#bysetpos_picker").html(largeDropDown);
    $("#day_picker_w").html(largeInputW);
    $("#day_picker_m").html(largeInputM);
  }
}
</script>