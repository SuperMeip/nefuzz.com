<?php
require_once("components/common.php");
require_once("components/registration/contact_info.php");
?>

<div class="row">
  <?=new Select_Input([
    "size" => "full",
    "options" => contact_options(),
    "label" => "Prefered Contact Method",
    "is_required" => true
  ]);?>
</div>
<?=contact_inputs();?>