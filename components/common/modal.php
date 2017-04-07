<script type="text/javascript">
//modal open/close
$(document).ready(function(){
  $('.modal_container .activator').click(function() {
    $(this).siblings('.modal').css('display', 'block');
  });
  $('.modal_container .close').click(function() {
    $(this).closest ('.modal').css ('display', 'none');
  });
});
</script>

<?php
require_once("components/component.php");

class Modal extends Component {
  protected $component_class = "modal";
  public $title = "";
  public $activator = "";
  public $content = "";
  public $template = "";
  public $activator_classes = "";
  public $container_classes = "";

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

    return "
      <div $container_class {$this->id()}>
        <div $activator_class>
          $this->activator
        </div>
        <div {$this->class()}>
          <div class=\"content\">
            <div class=\"header\"> 
              <span class=\"close right\">
                <i class=\"fa fa-times\"></i>
              </span>
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