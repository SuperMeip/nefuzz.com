<?php

abstract class Component {
  public $extra_classes = "";
  public $id = "";
  public $id_text = "";
  public $class_text = "";
  public $component_class = "";

  function __construct($args){
    foreach ($args as $key => $val) {
      $name = $key;
      if (isset($this->{$name})) {
        $this->{$name} = $val;
      }
    }
    $this->id_text = ($this->id ? "id=\"$this->id\"" : "");
    $this_>class_text = "class=\"$this->component_class" . ($this->extra_classes ? " " . $this->extra_classes : "") . "\"";
   
  }

  public function __get($attribute) {
    return $this->{$attribute} ?? null;
  }

  public function __set($attribute, $value) {
    if (isset($this->{$attribute})) {
      $this->{$attribute} = $val;
    }
  }

  public function __toString() {
    return $this->get_component();
  }

  public function render() {
    echo $this->get_component();
  }

  abstract public function get_component();
}

class Text_Input extends Component {
  public $name = "";
  public $label = "";
  public $is_password = false;
  public $is_required = false;
  public $size = "normal";
  public $max_characters = 0;
  public $error_message = "";

  public function get_component() {
    $max_characters = ($this->max_characters ? "maxLength=\"$this->max_characters\"" : "");
    $type = "type=" . ($this->is_password ? "\"password\"" : "\"text\"");
    $size = "";
    switch ($this->size) {
      case "small":
        $size = "small";
        break;
      case "big":
        $size = "big";
        break;
      case "full":
        $size = "full";
        break;
      case "mini":
        $size = "mini";
        break;
      case "medium":
        $size = "medium";
        break;
      default:
        $size = "normal";
        break;
    }
    $class = "class=\"text_input" . ($size ? " input_$size" : "") . ($this->extra_classes ? " $this->extra_classes" : "") . "\"";
    $required = ($this->is_required ? "required" : "");
    $name = ($this->name ? "name=\"$this->name\"" : "");
    $label_class = ($this->is_required ? "class =\"required\"" : "");
    $error_tooltip = $this->error_message ? new Tooltip([
      "content" => $this->error_message,
      "focus" => $this->label,
      "is_error" => true,
      "position" => "right",
      ""
    ]) : "$this->label";

    return "
    <div $class $this->id_text>
      <input $type $name $max_characters $required/>
      <label $label_class>
        $error_tooltip
      </label>
    </div>
  ";
  }
}

class Button extends Component{
  public $label = "";
  public $is_submit = false;

  public function get_component() {
    $class = " class=\"button" . ($this->extra_classes ? " $this->extra_classes" : "") . "\"";
    $type = ($this->is_submit ? "type=\"submit\"" : "");

    return "
      <button $this->id_text $class $type>$this->label</button>
    ";
  }
}

class Modal extends Component {
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
    $class = "class=\"modal" . ($this->extra_classes ? " " . $this->extra_classes : "") . "\"";
    $activator_class = "class=\"activator" . ($this->activator_classes ? " " . $this->activator_classes : "") . "\"";
    $container_class = "class=\"modal_container" .  ($this->container_classes ? " " . $this->container_classes : "") . "\"";
    $content = ($this->template ? Template($this->template) : $this->content);

    return "
      <div $container_class $this->id_text>
        <div $activator_class>
          $this->activator
        </div>
        <div $class>
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

class Block extends Component {
  public $title = "";
  public $is_expandable = false;
  public $starts_closed = false;
  public $content = "";
  public $template = "";

  public function get_component() {
    $class = "class=\"block" . ($this->extra_classes ? " " . $this->extra_classes : "") . "\"";
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
    <div $class $this->id_text>
      $header
      <div $body_class>
        $content
      </div>
    </div>";
  }
}

class Select_Input extends Component {
  public $size = "normal";
  public $options = [];
  public $label = "";
  public $is_required = false;
  public $name = "";

  public function get_component() {
    $size = "";
    switch ($this->size) {
      case "small":
        $size = "small";
        break;
      case "big":
        $size = "big";
        break;
      case "full":
        $size = "full";
        break;
      case "mini":
        $size = "mini";
        break;
      case "medium":
        $size = "medium";
        break;
      default:
        $size = "";
        break;
    }
    $class = "class=\"select_input" . ($size ? " input_$size" : "") . ($this->extra_classes ? " $this->extra_classes" : "") . "\"";
    $name = ($this->name ? "name=\"$this->name\"" : "");
    $options = "";
    $required = ($this->is_required ? "required" : "");
    $label_class = ($this->is_required ? "class =\"required\"" : "");
    foreach ($this->options as $text => $value) {
      $options .= "<option value=\"$value\">$text</option>\n";
    }

    return "
      <div $class $this->id_text>
        <select $name $required>
          $options
        </select>
        <label $label_class>
          $this->label
        </label>
      </div>
    ";
  }
}

class Check_Input extends Component {
  public $true_text = "Yes";
  public $false_text = "No";
  public $is_checked = false;
  public $label = "";
  public $true_symbol = "check";
  public $false_symbol = "times";
  public $size = "normal";
  public $name = "";

  public function get_component() {
    $size = "";
    switch ($this->size) {
      case "small":
        $size = "small";
        break;
      case "big":
        $size = "big";
        break;
      case "full":
        $size = "full";
        break;
      case "mini":
        $size = "mini";
        break;
      case "medium":
        $size = "medium";
        break;
      default:
        $size = "";
        break;
    }
    $name = ($this->name ? "name=\"$this->name\"" : "");
    $class = "class=\"check_input" . ($size ? " input_$size" : "") . ($this->extra_classes ? " $this->extra_classes" : "") . "\"";
    $checked = ($this->is_checked ? "checked" : "");
    $label_class = "class =\"label " . ($this->is_required ? " required" : "") . "\"";

    return "
      <div $class $this->id_text>
        <div class=\"label_container\">
          <label>
            <input type=\"checkbox\" $name $checked/>
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
        <div $label_class>
          $this->label
        </div>
      </div>
    ";
  }
}

class Tooltip extends Component{
  public $focus = "";
  public $content = "";
  public $position = "";
  public $is_error = false;
  
  private $positions = [
    "top",
    "bottom",
    "left",
    "right"
  ];

  public function get_component() {
    $positon = "";
    if(in_array($this->position, $this->positions)) {
      $position = $this->position;
    } else {
      $position = "bottom";
    }
    $tooltip_class = "class=\"tooltip " . $position . ($this->is_error ? " error" : "") . "\"";
    $class = "class=\"tooltip_container" . ($this->extra_classes ? " " . $this->extra_classes : "") . "\"";

    return "
      <div $class>
        $this->focus
        <div $tooltip_class>
          $this->content
        </div>
      </div>
    ";
  }
}


function Template($name){
  ob_start();
  include("templates/" . $name . ".php");
  return ob_get_clean();
}
?>

<script src="components/common.js"></script>