<?php

/**
 * A standard block for the site.
 *
 * Class Block
 */
class Block extends Base_Component {

  /**
   * The name of the class for this component
   *
   * @var string
   */
  protected $component_class = "block";

  /**
   * The js file for this component
   *
   * @var string
   */
  protected $js = "block";

  /**
   * The title of the block. If left out there will be no green header
   *
   * @var string
   */
  private $title;

  /**
   * If you want this block to open and close
   *
   * @var bool
   */
  private $is_expandable = false;

  /**
   * If you want this block to start closed
   *
   * @var bool
   */
  private $starts_closed = false;

  /**
   * The html content of the block
   *
   * @var string
   */
  private $content = "";

  /**
   * A template to use instead of text content
   *  ROOT: nefuzz.com/static/templates
   *
   * @var string
   */
  private $template;

  /**
   * Get the HTML for this component
   *
   * @return string
   */
  protected function get_component() {
    $header = (
      !empty($this->title) ?
        "<div class=\"header\"> 
          <div>
            <h1 class=\"header_small\">
              $this->title
            </h1>" . (
            $this->is_expandable ?
            "<span class=\"extend unselectable\">+</span>" :
               "") .
          "</div>
        </div>" : "");
    $body_class = "class=\"body" . ($this->starts_closed ? " hidden" : "") . "\"";
    $content = !empty($this->template) ? self::get_template($this->template) : $this->content;

    return "
    <div {$this->class()} {$this->id()}>
      $header
      <div $body_class>
        $content
      </div>
    </div>";
  }
}
