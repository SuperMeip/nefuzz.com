<?php
require_once("components/input_component.php");

class Select_Input extends Input_Component {
  protected $component_class = "select_input";
  public $options = [];
  
  public function get_component() {
    $options = "";
    foreach ($this->options as $text => $value) {
      $options .= "<option value=\"$value\">$text</option>\n";
    }

    return "
      <div {$this->class()} {$this->id()}>
        <select {$this->name()} {$this->required()}>
          $options
        </select>
        <label {$this->label_class()}>
          $this->label
        </label>
      </div>
    ";
  }
}