<?php

class Select_Input extends Input_Component {
  protected $component_class = "select_input";
  public $multiple = false;
  public $options = [];
  
  public function get_component() {
    $options = "";
    $multiple = ($this->multiple ? "multiple" : "");
    foreach ($this->options as $text => $value) {
      $options .= "<option value=\"$value\">$text</option>\n";
    }

    return "
      <div {$this->container_id()} {$this->class()}>
        <select $multiple {$this->name()} {$this->id()} {$this->required()}>
          $options
        </select>
        <label {$this->label_class()}>
          $this->label
        </label>
      </div>
    ";
  }
}