<script>
//File validations based on settings
var _URL = window.URL || window.webkitURL;
$(document).ready(function(){
  $(".file_upload").change(function(e) {
    var errorList = "";
    var files = this.files;
    var fileName = $(this).siblings(".value_text").find("span");
    var input = $(this);
    validate(e, files, $(this), function(error) {
      if (error) {
        errorList += "\n" + error;
      }
      input[0].setCustomValidity(errorList);
      fileName.html(files[0].name);
    });
  });
});

function validate(e, files, jThis, callback) {
  var types  = jThis.data("file-types");
  var size = jThis.data("file-size");
  var isImage = jThis.data("is-image");
  var dimensions = jThis.data("image-dimensions");
  var image, file;
  
  if ((file = files[0])) { 
    var fileType = file["type"];
    if (types) {
      if ($.inArray(fileType, types) < 0) {
        callback("Inncorect file type.");
      }
    }
    var validImageTypes = ["image/gif", "image/jpeg", "image/png"];
    if (($.inArray(fileType, validImageTypes) < 0) && isImage) {
      callback("File is not an image.");
    }
    if (size) {
      if (file.size > size) {
        callback("File is too big.");
      }
    }
    if (isImage && dimensions) {
      image = new Image();
      image.onload = function() {
        if (dimensions.max_height) {
          if (dimensions.max_height < this.height) {
            callback("File height is too big.");
          }
        }
        if (dimensions.max_width) {
          if (dimensions.max_width < this.width) {
            callback("File width is too big.");
          }
        }
        if (dimensions.height) {
          if (dimensions.height !== this.height) {
            callback("Incorrect file height.");
          }
        }
        if (dimensions.width) {
          if (dimensions.width !== this.width) {
            callback("Incorrect file width.");
          }
        }
        callback("");
      };
      image.src = _URL.createObjectURL(file);
    } else {
      callback("");
    }
  }
}
</script>

<?php
require_once("components/input_component.php");

class Upload extends Input_Component {
  protected $component_class = "upload";
  public $file_types = false; //[]
  public $is_image = false;
  public $file_size = false; //max
  public $image_dimensions = false;
  /*[
      "width" => 0,
      "height" => 0,
      "max-height" => 0,
      "max-width" => 0
  ];*/
  public $error_message = "Incorrect File Type or Size";

  public function get_component() {
    $file_types = json_encode($this->file_types);
    $is_image = json_encode($this->is_image);
    $image_dimensions = json_encode($this->image_dimensions);
    $error_tooltip = $this->error_message ? new Tooltip([
      "content" => $this->error_message,
      "focus" => $this->label,
      "is_error" => true,
      "position" => "bottom",
      ""
    ]) : "$this->label";
    $this->label_classes .= "label";
    
    return "
      <div {$this->class()}>
        <div class=\"label_container\">
          <label>
            <input
              class=\"file_upload\"
              type=\"file\"
              {$this->id()}
              name=\"$this->name\"
              data-file-types='$file_types'
              data-file-size=\"$this->file_size\"
              data-is-image='$is_image'
              data-image-dimensions='$image_dimensions'
              data-validation=\"true\"
              />
            <div class=\"value_text\">
              <div>
                <span>None Selected</span>
                <i class=\"fa fa-upload\" aria-hidden=\"true\"></i>
              </div>
            </div>
          </label>
        </div>
        <div {$this->label_class()} {$this->required()}>
          $error_tooltip
        </div>
      </div>
    ";
  }
}