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
    "name" => "rr_repeat",
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
    "id" => "datetimepicker",
    "label" => "Every X Weeks",
    "name" => "rr_interval_weeks",
    "size" => "mini",
    "max_characters" => 1
  ]);?>
  <?=new Select_Input([
    "extra_classes" => "only_show_on_large",
    "label" => "On",
    "multiple" => true,
    "name" => "rr_days_of_week",
    "size" => "large",
    "options" => $this->weekdays,
  ]);?>
  <?=new Select_Input([
    "extra_classes" => "only_show_on_small",
    "label" => "On",
    "multiple" => true,
    "name" => "rr_days_of_week",
    "size" => "large",
    "options" => $this->weekdays_small,
  ]);?>
</div>
<div class="rr_monthly hide">
  <div class="row center">
    <?=new Text_Input([
      "label" => "Every X months",
      "name" => "rr_interval_months",
      "size" => "normal",
      "max_characters" => 1
    ]);?>
    <?=new Text_Input([
      "label" => "On Date... Or",
      "name" => "rr_by_month_day",
      "size" => "normal",
      "max_characters" => 2
    ]);?>
  </div>
  <div class="row center">
    <?=new Select_Input([
      "extra_classes" => "only_show_on_large",
      "label" => "Position",
      "name" => "rr_by_month_pos",
      "size" => "mini",
      "options" => $this->day_position,
    ]);?>
    <?=new Select_Input([
      "extra_classes" => "only_show_on_small",
      "label" => "On The",
      "name" => "rr_by_month_pos",
      "size" => "mini",
      "options" => $this->day_position_small,
    ]);?>
    <?=new Select_Input([
      "extra_classes" => "only_show_on_large",
      "label" => "Day Of Week",
      "multiple" => true,
      "name" => "rr_days_of_week",
      "size" => "large",
      "options" => $this->weekdays,
    ]);?>
    <?=new Select_Input([
      "extra_classes" => "only_show_on_small",
      "label" => "Day Of Week",
      "multiple" => true,
      "name" => "rr_days_of_week",
      "size" => "large",
      "options" => $this->weekdays_small,
    ]);?>
  </div>
</div>
