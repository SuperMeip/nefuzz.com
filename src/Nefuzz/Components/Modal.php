<?php

namespace Nefuzz\Components;

class Modal extends \Nefuzz\Components\Base_Component {
  protected $component_class = "modal";
  protected $js = "modal";
  public $title = "";
  public $activator = "";
  public $content = "";
  public $template = "";
  public $activator_classes = "";
  public $container_classes = "";
  public $uncloseable = false;

  public function get_component() {
    $title = (
        $this->title ? 
        "<h1 class=\"header_small\">
          $this->title
        </h1>" : 
        ""
      );
    $activator_class = "class=\"activator" . ($this->activator_classes ? " " . $this->activator_classes : "") . "\"";
    $container_class = "class=\"modal_container" .  ($this->container_classes ? " " . $this->container_classes : "") . "\"";
    $content = ($this->template ? Template($this->template) : $this->content);
    $close = ($this->uncloseable ? "" : "
    <span class=\"close right\">
        <i class=\"fa fa-times\"></i>
    </span>");

    return "
      <div $container_class>
        <div $activator_class>
          $this->activator
        </div>
        <div {$this->class()} {$this->id()}>
          <div class=\"content\">
            <div class=\"header\"> 
              $close
              $title
            </div>
            <div class=\"body\">
              $content
            </div>
          </div>
        </div>
      </div>
    ";
  }
}