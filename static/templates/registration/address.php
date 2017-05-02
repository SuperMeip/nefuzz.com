
<div class="row center">
  <p class="info">
    You must provide at least your state here. 
    Your address will never be made public, it
    is only used along with City to calculate
    and make distances more accurate.
    You must provide at least a City 
    to use distance information.
  </p>
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