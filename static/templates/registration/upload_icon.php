<div class="row center">
  <p class="info">
    Icons must be .png image files with dimensions
    less than 600x600 and a file size less than 300kb.
    The image will be stretched to a 1:1(square) aspect ratio
    so keep that in mind as well.
  </p>
</div>
<div class="row center">
    <?=new Upload([
      "label" => "Upload Icon",
      "name" => "icon",
      "file_types" => ["image/png"],
      "is_image" => true,
      "file_size" => 300000,
      "image_dimensions" => [
        "max_width" => 600,
        "max_height" => 600
      ]
    ]);?>
</div>