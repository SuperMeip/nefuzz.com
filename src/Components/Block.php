<?php

class Block extends Base_Component {
  protected $component_class = "block";
  protected $js = "block";
  public $title = "";
  public $is_expandable = false;
  public $starts_closed = false;
  public $content = "";
  public $template = "";

  public function get_component() {
    $header = (
      $this->title ? 
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
    $content = ($this->template ? self::get_template($this->template) : $this->content);

    return "
    <div {$this->class()} {$this->id()}>
      $header
      <div $body_class>
        $content
      </div>
    </div>";
  }
}
