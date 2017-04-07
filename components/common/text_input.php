<?php
require_once("components/input_component.php");

class Text_Input extends Input_Component {
  protected $component_class = "text_input";
  public $is_password = false;
  public $max_characters = 0;
  public $error_message = "";

  public function get_component() {
    $max_characters = ($this->max_characters ? "maxLength=\"$this->max_characters\"" : "");
    $type = "type=" . ($this->is_password ? "\"password\"" : "\"text\"");
    $error_tooltip = $this->error_message ? new Tooltip([
      "content" => $this->error_message,
      "focus" => $this->label,
      "is_error" => true,
      "position" => "right",
      ""
    ]) : "$this->label";

    return "
    <div {$this->class()} {$this->id()}>
      <input data-validation=\"true\" $type {$this->name()} $max_characters {$this->required()}/>
      <label {$this->label_class()}>
        $error_tooltip
      </label>
    </div>
  ";
  }
}