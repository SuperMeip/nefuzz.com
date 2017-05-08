<?php

class Upload extends Input_Component {
  protected $component_class = "upload";
  protected $js = "upload";
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