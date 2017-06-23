<div class="row center">
  <p class="info">
    This is for advanced users only, an RRule
    is a formula to calculate reoccuring event dates.
    This rule will be applied to the meet and updated every
    time the meet occurs, only use these settings if your
    meet is likely to occur regularly with almost no
    chance of delay or cancelation. This setting also
    requires admin approval.
  </p>
</div>
<div class="row">
  <?=new Select_Input([
    "id" => "rrule-type-select",
    "label" => "Repeat",
    "name" => "frequency",
    "size" => "big",
    "options" => [
      "Weekly" => "weekly",
      "Monthly" => "monthly"
    ]
  ]);?>
  <?=new Checkbox_Input([
    "label" => "Has RRule",
    "size" => "small",
    "name" => "has_rrule"
  ]);?>
</div>
<div class="row center rr_weekly">
  <?=new Text_Input([
    //"id" => "datetimepicker",
    "label" => "Every X Weeks",
    "name" => "interval_w",
    "size" => "mini",
    "max_characters" => 1
  ]);?>
  <div id="day_picker_w"></div>
</div>
<div class="rr_monthly hide">
  <div class="row center">
    <?=new Text_Input([
      "label" => "Every X months",
      "name" => "interval_m",
      "size" => "normal",
      "max_characters" => 1
    ]);?>
    <?=new Text_Input([
      "label" => "On Date... Or",
      "name" => "bymonthday",
      "size" => "normal",
      "max_characters" => 2
    ]);?>
  </div>
  <div class="row center">
    <div id="bysetpos_picker"></div>
    <div id="day_picker_m"></div>
  </div>
</div>
