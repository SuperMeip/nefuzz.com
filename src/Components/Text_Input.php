<?php

class Text_Input extends Input_Component {

  /**
   * The top level class name for this input
   *
   * @var string
   */
  protected $component_class = "text_input";

  /**
   * The regex pattern required for this input
   *
   * @var string
   */
  public $pattern = "";

  /**
   * Any cleave settings for this input
   *
   * @var array
   */
  public $cleave = [];

  /**
   * If this is a password input
   * @var bool
   */
  public $is_password = false;

  /**
   * If this input is a text area
   *
   * @var bool
   */
  public $is_textarea = false;

  /**
   * The amount of rows if this is a text area
   *
   * @var int
   */
  public $rows = 0;

  /**
   * The max number of characters for this input
   *
   * @var int
   */
  public $max_characters = 0;

  /**
   * A custom error message to show in a tooltip if any values entered do not match requirements
   *
   * @var string
   */
  public $error_message = "";

  /**
   * The default value of the input
   *
   * @var string
   */
  public $value = "";

  /**
   * The invalid message for this input, uses built in browser error system
   *
   * @var string
   */
  public $invalid_message = "";

  public function get_component() {
    $invalid_message = !empty($this->invalid_message) ? "oninvalid=\"this.setCustomValidity('$this->invalid_message')\"
    oninput=\"setCustomValidity('')\"" : "";
    $max_characters = !empty($this->max_characters) ? "maxLength=\"$this->max_characters\"" : "";
    $pattern = !empty($this->pattern) ? "pattern=\"$this->pattern\"" : "";
    $element_type = ($this->is_textarea ? "textarea" : "input");
    $textarea_close = ($this->is_textarea ? ">$this->value</textarea>" : "value=\"$this->value\"/>");
    $type = "type=" . ($this->is_password ? "\"password\"" : "\"text\"");
    $error_tooltip = !empty($this->error_message) ? new Tooltip([
      "id" => $this->id . "-error",
      "content" => $this->error_message,
      "focus" => $this->label,
      "is_error" => true,
      "position" => "right",
      ""
    ]) : "$this->label";
    if(!empty($this->cleave['datePattern'])) {
      $this->cleave['datePattern'] = json_encode($this->cleave['datePattern']);
    }
    if(!empty($this->cleave['delimeters'])) {
      $this->cleave['delimeters'] = json_encode($this->cleave['delimeters']);
    }
    if(!empty($this->cleave['blocks'])) {
      $this->cleave['blocks'] = json_encode($this->cleave['blocks']);
    }
    $cleave = (!empty($this->cleave) ? "
    <script>
      $(document).ready(function(){
        var cleave = new Cleave('#$this->id', {" . 
          (!empty($this->cleave['phone']) ? "phone: true," : "") .
          (!empty($this->cleave['phoneRegionCode']) ? "phoneRegionCode: '{$this->cleave['phoneRegionCode']}'," : "") .
          (!empty($this->cleave['numeral']) ? "numeral: true," : "") .
          (!empty($this->cleave['date']) ? "date: true," : "") .
          (!empty($this->cleave['datePattern']) ? "datePattern: {$this->cleave['datePattern']}," : "") .
          (!empty($this->cleave['prefix']) ? "prefix: '{$this->cleave['prefix']}'," : "") .
          (!empty($this->cleave['numericOnly']) ? "numericOnly: true," : "") .
          (!empty($this->cleave['delimeters']) ? "delimeters: {$this->cleave['delimeters']}," : "") .
          (!empty($this->cleave['blocks']) ? "blocks: {$this->cleave['blocks']}," : "") .
          (!empty($this->cleave['uppercase']) ? "uppercase: true" : "uppercase: false") . "
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