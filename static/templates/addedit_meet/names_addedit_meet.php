<div class="row center">
  <p class="info">
    This is the general info for this meet
    that will be the same for all events based
    off it. The name must be unique.
  </p>
</div>
<div class="row">
  <?=new Text_Input([
    "label" => "Meet Name",
    "name" => "name",
    "size" => "full",
    "is_required" => true,
    "max_characters" => 30,
    "pattern" => "^[a-zA-Z0-9_ \-!?&+:,\/\(\)]{1,30}$",
    "id" => "meet-name",
  ]);?>
  <?=new CheckBox_Input([
    "size" => "small",
    "label" => "Is a Con?",
    "name" => "is_con"
  ]);?>
</div>
<div class="row">
  <?=new Text_Input([
    "label" => "Meet Overview",
    "is_textarea" => true,
    "name" => "overview",
    "size" => "full",
    "is_required" => true,
    "max_characters" => 265
  ]);?>
</div>