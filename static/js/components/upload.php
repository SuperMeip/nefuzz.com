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
      input[0].reportValidity()
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