<?php
require_once("components/input_component.php");

class Text_Input extends Input_Component {
  protected $component_class = "text_input";
  public $pattern = "";
  public $cleave = [];
  public $is_password = false;
  public $max_characters = 0;
  public $error_message = "";

  public function get_component() {
    $max_characters = ($this->max_characters ? "maxLength=\"$this->max_characters\"" : "");
    $pattern = ($this->pattern ? "pattern=\"$this->pattern\"" : "");
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
      <input {$this->id()} data-validation=\"true\" $type {$this->name()} $pattern $max_characters {$this->required()}/>
      <label {$this->label_class()}>
        $error_tooltip
      </label>
    </div>
  ";
  }
}