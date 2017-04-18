<?php
require_once("components/common.php");
require_once("components/registration/contact_info.php");
?>

<div class="row center">
  <p class="info">
    You must provide at least one contact method
    (you can select your email for this as well),
    this contact information will be made public
    on your page and listed as the contact information
    under meets you host. If you provide multiple 
    forms they will also be posted on your user page.
  </p>
</div>
<div class="row">
  <?=new Select_Input([
    "id" => "contact_method",
    "size" => "full",
    "name" => "contact_method",
    "options" => contact_options(),
    "label" => "Prefered Contact Method",
    "is_required" => true
  ]);?>
</div>
<?=contact_inputs();?>