<?php

abstract class Component {
  public $extra_classes = "";
  public $id = "";

  function __construct($args){
    foreach ($args as $key => $val) {
      $name = $key;
      if (isset($this->{$name})) {
        $this->{$name} = $val;
      }
    }
    $this->id_text = ($this->id ? "id=\"$this->id\"" : "");
  }
  
  private function id($prefix) {
      return ($this->id ? "id=\"$this->id\"" : "");
  }
  
  private function class() {
    return "class=\"$this->component_class" . ($this->extra_classes ? " " . $this->extra_classes : "") . "\"";
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