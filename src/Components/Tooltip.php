<?php

class Tooltip extends Base_Component {

  /**
   * Positions for the tooltip to appear in relative to the focus
   */
  const TOP = 'top';
  const BOTTOM = 'bottom';
  const LEFT = 'left';
  const RIGHT = 'right';

  /**
   * The base class for this component
   *
   * @var string
   */
  protected $component_class = "tooltip_container";

  /**
   * The focus of the tooltip, the object it will attach to.
   *
   * @var string
   */
  public $focus = "";

  /**
   * The content of the tooltip (html/text)
   *
   * @var string
   */
  public $content = "";

  /**
   * The position of the tooltip, use the provided consts for this class
   *
   * @var string
   */
  public $position = "";

  /**
   * If this is an error alert tooltip
   *
   * @var bool
   */
  public $is_error = false;

  /**
   * The positions in an array for validation
   *
   * @var array
   */
  private $positions = [
    self::TOP,
    self::BOTTOM,
    self::LEFT,
    self::RIGHT
  ];

  /**
   * Get the component as HTML
   *
   * @return string
   */
  public function get_component() {
    if(in_array($this->position, $this->positions)) {
      $position = $this->position;
    } else {
      $position = self::BOTTOM;
    }
    $tooltip_class = "class=\"tooltip " . $position . ($this->is_error ? " error" : " hover") . "\"";

    return "
      <div {$this->class()} {$this->id()}>
        $this->focus
        <div $tooltip_class>
          $this->content
        </div>
      </div>
    ";
  }
}