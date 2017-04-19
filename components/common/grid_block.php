<?php
require_once("components/component.php");

class Grid_Block extends Component {
  protected $component_class = "grid_block";
  public $title = "";
  public $content = "";
  public $template = "";
  public $height = "normal";
  public $width = "normal";
  
  public function get_component() {
    $header = ($this->title ? "
      <div class=\"header\">
        <h1>$this->title</h1>
      </div>" : ""
    );
    $sizes = [
      "big",
      "large",
      "normal",
      "medium",
      "small",
      "mini"
    ];
    $height = (in_array($this->height, $sizes) ? "h_$this->height" : "h_normal");
    $width = (((in_array($this->width, $sizes)) || ($this->width == "full")) ? "w_$this->width" : "w_normal");
    $this->extra_classes .= " $width $height";
    $content = ($this->template ? Template($this->template) : $this->content);

    return "
      <div {$this->class()} {$this->id()}>
        $header
        <div class=\"body\">
          $content
        </div>
      </div>
    ";
  }
}