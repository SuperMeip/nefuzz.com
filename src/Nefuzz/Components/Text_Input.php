<?php

namespace Nefuzz\Components;

class Text_Input extends \Nefuzz\Components\Input_Component {
  protected $component_class = "text_input";
  public $pattern = "";
  public $cleave = [];
  public $is_password = false;
  public $is_textarea = false;
  public $rows = 0;
  public $max_characters = 0;
  public $error_message = "";
  public $value = "";
  public $invalid_message = "";

  public function get_component() {
    $invalid_message = ($this->invalid_message ? "oninvalid=\"this.setCustomValidity('$this->invalid_message')\"
    oninput=\"setCustomValidity('')\"" : "");
    $max_characters = ($this->max_characters ? "maxLength=\"$this->max_characters\"" : "");
    $pattern = ($this->pattern ? "pattern=\"$this->pattern\"" : "");
    $element_type = ($this->is_textarea ? "textarea" : "input");
    $textarea_close = ($this->is_textarea ? ">$this->value</textarea>" : "value=\"$this->value\"/>");
    $type = "type=" . ($this->is_password ? "\"password\"" : "\"text\"");
    $error_tooltip = $this->error_message ? new Tooltip([
      "id" => $this->id . "-error",
      "content" => $this->error_message,
      "focus" => $this->label,
      "is_error" => true,
      "position" => "right",
      ""
    ]) : "$this->label";
    if(isset($this->cleave['datePattern'])) {
      $this->cleave['datePattern'] = json_encode($this->cleave['datePattern']);
    }
    if(isset($this->cleave['delimeters'])) {
      $this->cleave['delimeters'] = json_encode($this->cleave['delimeters']);
    }
    if(isset($this->cleave['blocks'])) {
      $this->cleave['blocks'] = json_encode($this->cleave['blocks']);
    }
    $cleave = ($this->cleave ? "
    <script>
      $(document).ready(function(){
        var cleave = new Cleave('#$this->id', {" . 
          (isset($this->cleave['phone']) ? "phone: true," : "") .
          (isset($this->cleave['phoneRegionCode']) ? "phoneRegionCode: '{$this->cleave['phoneRegionCode']}'," : "") . 
          (isset($this->cleave['numeral']) ? "numeral: true," : "") .
          (isset($this->cleave['date']) ? "date: true," : "") . 
          (isset($this->cleave['datePattern']) ? "datePattern: {$this->cleave['datePattern']}," : "") .
          (isset($this->cleave['prefix']) ? "prefix: '{$this->cleave['prefix']}'," : "") .
          (isset($this->cleave['numericOnly']) ? "numericOnly: true," : "") . 
          (isset($this->cleave['delimeters']) ? "delimeters: {$this->cleave['delimeters']}," : "") . 
          (isset($this->blocks['blocks']) ? "blocks: {$this->cleave['blocks']}," : "") .
          (isset($this->uppercase['uppercase']) ? "uppercase: true" : "uppercase: false") . "
        });
      });
    </script>
    " : "");
    
    return "
    <div {$this->class()}>
      $cleave
      <$element_type $invalid_message {$this->id()} data-validation=\"true\" $type {$this->name()} $pattern $max_characters {$this->required()} $textarea_close
      <label {$this->label_class()}>
        $error_tooltip
      </label>
    </div>
  ";
  }
}