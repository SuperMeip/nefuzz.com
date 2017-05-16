<div class="row center">
  <p class="info">
    When you create an event based on this meet,
    these details will be the ones that automatically
    fill in the fields of the event. Keep in mind, these
    details can be changed for each individual event
    on creation without changing the meet overall, these
    are simply defaults.
  </p>
</div>
<div class="row">
  <?=new Text_Input([
    "label" => "description",
    "name" => "description",
    "is_textarea" => true,
    "is_required" => true,
    "size" => "full",
    "max_characters" => 2000
  ]);?>
</div>
<div class="row mobile_column">
  <?=new Text_Input([
    "label" => "Blurb (for Tweet)",
    "name" => "short_info",
    "max_characters" => 20,
  ]);?>
  <?=new Text_Input([
    "label" => "Max Attendees",
    "name" => "max_attendees",
    "max_characters" => 5
  ]);?>
</div>
<div class="row">
  <?=new Text_Input([
    "label" => "Link",
    "size" => "big",
    "name" => "url",
    "max_characters" => 256
  ]);?>
  <?=new Checkbox_Input([
    "label" => "Must RSVP",
    "size" => "small",
    "name" => "must_rsvp"
  ]);?>
</div>