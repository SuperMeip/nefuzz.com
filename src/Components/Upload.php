<?php

/**
 * The component for uploading files
 *
 * Class Upload
 */
class Upload extends Input_Component {

  /**
   * The base class name of the component
   *
   * @var string
   */
  protected $component_class = "upload";

  /**
   * The name of the js file for this component
   *
   * @var string
   */
  protected $js = "upload";

  /**
   * The file types accepted for this select
   *
   * @var bool
   */
  public $file_types = [];

  /**
   * If it needs to be an image
   *
   * @var bool
   */
  public $is_image = false;

  /**
   * The max file size accepted
   */
  public $file_size = 0;

  /**
   * A custom error message for if it fails
   *
   * @var string
   */
  public $error_message = "";

  /**
   * An array containing the required image dimensions
   *
   * @var array
   */
  public $image_dimensions = [];
  /*[
      "width" => 0,         //absolute
      "height" => 0,        //absolute
      "max-height" => 0,
      "max-width" => 0
  ];*/

  public function get_component() {
    $file_types = json_encode($this->file_types);
    $is_image = json_encode($this->is_image);
    $image_dimensions = json_encode($this->image_dimensions);
    $error_tooltip = !empty($this->error_message) ? new Tooltip([
      "content" => $this->error_message,
      "focus" => $this->label,
      "is_error" => true,
      "position" => Tooltip::BOTTOM,
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