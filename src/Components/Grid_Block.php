<?php

/**
 * A class for content blocks used with the grid layout
 *
 * Class Grid_Block
 */
class Grid_Block extends Base_Component {
  
  /**
   * Height and Width dimensions for grid blocks
   */
  const SMALL_WIDTH = 'small';
  const MEDIUM_WIDTH = 'medium';
  const NORMAL_WIDTH = 'normal';
  const LARGE_WIDTH = 'large';
  const BIG_WIDTH = 'big';
  const FULL_WIDTH = 'full';

  const MINI_HEIGHT = 'mini';
  const SMALL_HEIGHT = 'small';
  const MEDIUM_HEIGHT = 'medium';
  const NORMAL_HEIGHT = 'normal';
  const LARGE_HEIGHT = 'large';
  const BIG_HEIGHT = 'big';

  /**
   * The class name for the component
   *
   * @var string
   */
  protected $component_class = "grid_block";

  /**
   * The title text of the block, there's no title banner if this is empty
   *
   * @var string
   */
  public $title = "";

  /**
   * The html content of the block's body
   *
   * @var string
   */
  public $content = "";

  /**
   * The name of a template to use as the html content of the block instead
   *
   * @var string
   */
  public $template = "";

  /**
   * The html content of the body, less restrictive than content, replaces the body div to make content borderless
   *
   * @var string
   */
  public $body = "";

  /**
   * The height of the grid block
   *
   * @var string
   */
  public $height = self::NORMAL_HEIGHT;

  /**
   * The width of the grid block
   * @var string
   */
  public $width = self::NORMAL_WIDTH;

  /**
   * An extra icon/button for the top right corner. Taken by fontawesome name
   *
   * @var string
   */
  public $extra_icon = "";

  /**
   * An id for the extra icon
   *
   * @var string
   */
  public $extra_icon_id = "";

  /**
   * Get the html of this component
   *
   * @return string
   */
  public function get_component() {
    $extra_icon_id = $this->extra_icon_id ? "id=\"$this->extra_icon_id\"" : "";
    $extra_icon = $this->extra_icon ? "
      <i $extra_icon_id class=\"fa fa-$this->extra_icon\" aria-hidden=\"true\"></i> 
    " : "";
    $header = $this->title ? "
      <div class=\"header\">
        <h1>$this->title</h1>
        $extra_icon
      </div>" : "";

    $widths = [
      self::SMALL_WIDTH,
      self::MEDIUM_WIDTH,
      self::NORMAL_WIDTH,
      self::LARGE_WIDTH,
      self::BIG_WIDTH,
      self::FULL_WIDTH
    ];
    
    $heights = [
      self::MINI_HEIGHT,
      self::SMALL_HEIGHT,
      self::MEDIUM_HEIGHT,
      self::NORMAL_HEIGHT,
      self::LARGE_HEIGHT,
      self::BIG_HEIGHT
    ];
    
    $height = in_array($this->height, $heights) ? "h_$this->height" : "h_normal";
    $width = in_array($this->width, $widths) ? "w_$this->width" : "w_normal";
    $this->extra_classes .= " $width $height";
    $content = $this->template ? self::get_template($this->template) : $this->content;
    $body = $this->body ? $this->body : "
      <div class=\"body\">
        $content
      </div>
    ";

    return "
      <div {$this->class()} {$this->id()}>
        $header
        $body
      </div>
    ";
  }
}