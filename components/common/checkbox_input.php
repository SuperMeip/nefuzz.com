<?php
require_once("components/input_component.php");

class Checkbox_Input extends Input_Component {
  protected $component_class = "checkbox_input";
  public $true_text = "Yes";
  public $false_text = "No";
  public $is_checked = false;
  public $true_symbol = "check";
  public $false_symbol = "times";
  
  public function get_component() {
    $checked = ($this->is_checked ? "checked" : "");
    $this->label_classes .= "label";
  
  return "
      <div {$this->class()} {$this->id()}>
        <div class=\"label_container\">
          <label>
            <input type=\"checkbox\" {$this->name()} $checked/>
            <div class=\"value_text\">
              <div class=\"true\">
                <span>$this->true_text</span>
                <i class=\"fa fa-$this->true_symbol\" aria-hidden=\"true\"></i>
              </div>
              <div class=\"false\">
                <span>$this->false_text</span>
                <i class=\"fa fa-$this->false_symbol\" aria-hidden=\"true\"></i>
              </div>
            </div>
          </label>
        </div>
        <div {$this->label_class()} {$this->required()}>
          $this->label
        </div>
      </div>
    ";
  }
}
