<?php

/**
 * A standard checkbox
 *
 * Class Checkbox_Input
 */
class Checkbox_Input extends Input_Component {

  /**
   * The name of the class for this component
   *
   * @var string
   */
  protected $component_class = "checkbox_input";

  /**
   * The text for when the checkbox is ticked
   *
   * @var string
   */
  private $true_text = "Yes";

  /**
   * The text for when the checkbox is not ticked
   *
   * @var string
   */
  private $false_text = "No";

  /**
   * The starting value of the checkbox
   *
   * @var bool
   */
  private $is_checked = false;

  /**
   * The symbol for when the box is checked(taken from fontawesome)
   *
   * @var string
   */
  private $true_symbol = "check";

  /**
   * The symbol for when the box is unchecked(taken from fontawesome)
   *
   * @var string
   */
  private $false_symbol = "times";

  /**
   * Get the HTML for this component
   *
   * @return string
   */
  public function get_component() {
    $checked = ($this->is_checked ? "checked" : "");
    $this->label_classes .= " label";
  
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
