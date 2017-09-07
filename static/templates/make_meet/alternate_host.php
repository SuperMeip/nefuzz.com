<div class="row center">
  <p class="info">
    If you are not the host and are just the one posting
    this meet/event put the information of the actual
    host here.
  </p>
</div>
<div class="row">
  <?=new Text_Input([
    "label" => "Alternate Host Name",
    "name" => "alt_name",
    "size" => "big",
    "max_characters" => 200
  ]);?>
  <?=new Checkbox_Input([
    "label" => "Has Alt Host",
    "size" => "small",
    "name" => "has_alt_host"
  ]);?>
</div>
<div class="row">
  <?=new Select_Input([
    "label" => "Contact Method",
    "name" => "alt_method",
    "size" => "small",
    "options" => $this->contact_options(),
  ]);?>
  <?=new Text_Input([
    "label" => "Alternate Host Contact Info",
    "name" => "alt_contact",
    "size" => "big",
    "max_characters" => 40
  ]);?>
</div>