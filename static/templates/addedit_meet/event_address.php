<div class="row center">
  <p class="info">
    This will be the default location for
    each event based on this meet. This location
    can be changed for each indivisual event 
    if needed.
  </p>
</div>
<div class="row">
  <?=new Text_Input([
    "label" => "Location Name",
    "name" => "location_name",
    "size" => "big",
    "max_characters" => 200
  ]);?>
  <?=new Checkbox_Input([
    "label" => "Undisclosed",
    "size" => "small",
    "name" => "undisclosed_location"
  ]);?>
</div>
<div class="row">
  <?=new Text_Input([
    "label" => "Street Address",
    "name" => "address",
    "size" => "full",
    "max_characters" => 200
  ]);?>
</div>
<div class="row center">
  <?=new Text_Input([
    "label" => "City",
    "name" => "city",
    "size" => "big",
    "max_characters" => 30
  ]);?>
  <?=new Select_Input([
    "label" => "State",
    "name" => "region",
    "size" => "small",
    "options" => $this->region_options(),
    "is_required" => true
  ]);?>
</div>