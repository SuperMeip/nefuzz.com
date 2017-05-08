<?php

abstract class Base_Component {
  protected $component_class = "change_me";
  protected $js = false;
  public $extra_classes = "";
  public $id = "";
  public $container_id = "";

  function __construct($args){
    foreach ($args as $key => $val) {
      $name = $key;
      if (isset($this->{$name})) {
        $this->{$name} = $val;
      }
    }
    if ($this->js) {
      require_once($_SERVER['DOCUMENT_ROOT']."/static/js/components/$this->js.php");
    }
  }
  
  protected function id($prefix = "") {
      return ($this->id ? "id=\"$this->id\"" : "");
  }
  
  protected function container_id($prefix = "") {
      return ($this->container_id ? "id=\"$this->container_id\"" : "");
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

  public static function get_template($name){
    ob_start();
    include("static/templates/" . $name . ".php");
    return ob_get_clean();
  }
}