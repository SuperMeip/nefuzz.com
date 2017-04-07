<?php
require_once("components/common.php");
?>

<div class="row center">
    <?=new Upload([
      "label" => "Upload Icon",
      "file_types" => ["image/png"],
      "is_image" => true,
      "file_size" => 300000,
      "image_dimensions" => [
        "max_width" => 600,
        "max_height" => 600
      ]
    ]);?>
</div>