<?php
require_once("components/component.php");

class Button extends Component {
  protected $component_class = "button";
  public $label = "";
  public $is_submit = false;

  public function get_component() {
    $type = ($this->is_submit ? "type=\"submit\"" : "");

    return "
      <button {$this->id()} {$this->class()} $type>$this->label</button>
    ";
  }
}