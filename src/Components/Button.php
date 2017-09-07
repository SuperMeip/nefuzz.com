<?php

/**
 * A standard button
 *
 * Class Button
 */
class Button extends Base_Component {

  /**
   * The name of the class for this component
   *
   * @var string
   */
  protected $component_class = "button";

  /**
   * The label for the button
   *
   * @var string
   */
  public $label = "";

  /**
   * If it is a submit button
   *
   * @var bool
   */
  public $is_submit = false;

  /**
   * If it's a link the link
   *
   * @var string
   */
  public $link;

  /**
   * Get the HTML for this component
   *
   * @return string
   */
  public function get_component() {
    if (!empty($this->link)) {
      return "
      <a href=\"$this->link\" {$this->id()} {$this->class()}>$this->label</a>
      ";
    }
    $type = $this->is_submit ? "type=\"submit\"" : "";

    return "
      <button {$this->id()} {$this->class()} $type>$this->label</button>
    ";
  }
}