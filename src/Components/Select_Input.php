<?php

/**
 * A select input
 *
 * Class Select_Input
 */
class Select_Input extends Input_Component {

  /**
   * The top level class name for this component
   *
   * @var string
   */
  protected $component_class = "select_input";

  /**
   * If this is a multiselect
   *
   * @var bool
   */
  public $multiple = false

  /**
   * The options, done as $text => $value
   *
   * @var array
   */
  public $options = [];

  /**
   * Get the html for this component
   *
   * @return string
   */
  public function get_component() {
    $options = "";
    $multiple = $this->multiple ? "multiple" : "";
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