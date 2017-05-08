<?php

class Grid_Block extends Base_Component {
  protected $component_class = "grid_block";
  public $title = "";
  public $content = "";
  public $template = "";
  public $body = "";
  public $height = "normal";
  public $width = "normal";
  public $extra_icon = "";
  public $extra_icon_id = "";
  
  public function get_component() {
    $extra_icon_id = ($this->extra_icon_id ? "id=\"$this->extra_icon_id\"" : "");
    $extra_icon = ($this->extra_icon ? "
      <i $extra_icon_id class=\"fa fa-$this->extra_icon\" aria-hidden=\"true\"></i> 
    " : "");
    $header = ($this->title ? "
      <div class=\"header\">
        <h1>$this->title</h1>
        $extra_icon
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
    $body = ($this->body ? $this->body : "
      <div class=\"body\">
        $content
      </div>
    ");

    return "
      <div {$this->class()} {$this->id()}>
        $header
        $body
      </div>
    ";
  }
}