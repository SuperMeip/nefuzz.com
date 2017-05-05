<?php

namespace Nefuzz\Components;

class Tooltip extends \Nefuzz\Components\Base_Component {
  protected $component_class = "tooltip_container";
  public $focus = "";
  public $content = "";
  public $position = "";
  public $is_error = false;
  
  private $positions = [
    "top",
    "bottom",
    "left",
    "right"
  ];

  public function get_component() {
    $positon = "";
    if(in_array($this->position, $this->positions)) {
      $position = $this->position;
    } else {
      $position = "bottom";
    }
    $tooltip_class = "class=\"tooltip " . $position . ($this->is_error ? " error" : " hover") . "\"";

    return "
      <div {$this->class()} {$this->id()}>
        $this->focus
        <div $tooltip_class>
          $this->content
        </div>
      </div>
    ";
  }
  
}