<?php

abstract class Component {
  protected $component_class = "change_me";
  public $extra_classes = "";
  public $id = "";

  function __construct($args){
    foreach ($args as $key => $val) {
      $name = $key;
      if (isset($this->{$name})) {
        $this->{$name} = $val;
      }
    }
  }
  
  protected function id($prefix = "") {
      return ($this->id ? "id=\"$this->id\"" : "");
  }
  
  protected function class() {
    return "class=\"$this->component_class" . ($this->extra_classes ? " " . $this->extra_classes : "") . "\"";
  }

  public function __get($attribute) {
    return $this->{$attribute} ?? null;
  }

  public function __set($attribute, $value) {
    if (isset($this->{$attribute})) {
      $this->{$attribute} = $value;
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

function Template($name){
  ob_start();
  include("templates/" . $name . ".php");
  return ob_get_clean();
}