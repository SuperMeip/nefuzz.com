<?php

namespace Nefuzz\Components;

class Button extends \Nefuzz\Components\Base_Component {
  protected $component_class = "button";
  public $label = "";
  public $is_submit = false;
  public $link = "";

  public function get_component() {
    if ($this->link) {
      return "
      <a href=\"$this->link\" {$this->id()} {$this->class()}>$this->label</a>
      ";
    }
    $type = ($this->is_submit ? "type=\"submit\"" : "");

    return "
      <button {$this->id()} {$this->class()} $type>$this->label</button>
    ";
  }
}