<script type="text/javascript">
//Block open/close
$(document).ready(function(){
  $('.block .extend').click(function() {
    $(this).toggleClass('rotated');
    $(this).closest('.header').siblings('.body').slideToggle();
  });
});
</script>

<?php
require_once("components/component.php");

class Block extends Component {
  protected $component_class = "block";
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
    $content = ($this->template ? Template($this->template) : $this->content);

    return "
    <div {$this->class()} {$this->id()}>
      $header
      <div $body_class>
        $content
      </div>
    </div>";
  }
}
