<?php

/**
 * A modal with custom content
 *
 * Class Modal
 */
class Modal extends Base_Component {

  /**
   * The top level class for this component
   *
   * @var string
   */
  protected $component_class = "modal";

  /**
   * The js file name for this component
   *
   * @var string
   */
  protected $js = "modal";

  /**
   * The title text for the modal, there will be no title bar if this is left empty
   *
   * @var string
   */
  public $title = "";

  /**
   * The activation button/onclick html to appear where this component is placed.
   *   If this is blank nothing will be shown.
   *
   * @var string
   */
  public $activator = "";

  /**
   * The html content of the modal
   *
   * @var string
   */
  public $content = "";

  /**
   * A template name to render as the content of the modal instead.
   *
   * @var string
   */
  public $template = "";

  /**
   * Classes for the modal's activator
   *
   * @var string
   */
  public $activator_classes = "";

  /**
   * Classes for the modal's container
   *
   * @var string
   */
  public $container_classes = "";

  /**
   * If this modal cannot be closed.
   *
   * @var bool
   */
  public $uncloseable = false;

  /**
   * Get the html of this component
   *
   * @return string
   */
  public function get_component() {
    $title = (
        !empty($this->title) ?
        "<h1 class=\"header_small\">
          $this->title
        </h1>" : 
        ""
      );
    $activator_class = "class=\"activator" . (!empty($this->activator_classes) ? " " . $this->activator_classes : "") . "\"";
    $container_class = "class=\"modal_container" .  (!empty($this->container_classes) ? " " . $this->container_classes : "") . "\"";
    $content = !empty($this->template) ? self::get_template($this->template) : $this->content;
    $close = $this->uncloseable ? "" : "
    <span class=\"close right\">
        <i class=\"fa fa-times\"></i>
    </span>";

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