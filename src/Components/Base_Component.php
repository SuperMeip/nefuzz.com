<?php

/**
 * The base class for components
 *
 * Class Base_Component
 */
abstract class Base_Component {

  /**
   * The class for the component, necessary
   *
   * @var string
   */
  protected $component_class = "change_me";

  /**
   * name/path of the js file related to the component
   * ROOT: nefuzz.com/static/js/component
   *
   * @var string
   */
  protected $js;

  /**
   * Extra classes to add to the container of this component
   *
   * @var string
   */
  public $extra_classes;

  /**
   * An id to add to the main component(ex. the actual input)
   *
   * @var string
   */
  public $id;

  /**
   * The id to add to the container of the component
   *
   * @var string
   */
  public $container_id;

  /**
   * Base_Component constructor.
   *
   * @param array $args - an assoc array of the values for this component
   */
  function __construct($args){
    foreach ($args as $key => $val) {
      $name = $key;
      if (!empty($this->{$name})) {
        $this->{$name} = $val;
      }
    }
    if (!empty($this->js)) {
      require_once($_SERVER['DOCUMENT_ROOT'] . "/static/js/components/$this->js.php");
    }
  }

  /**
   * Get the HTML id text
   *
   * @param string $prefix
   *
   * @return string
   */
  protected function id($prefix = "") {
      return (!empty($this->id) ? "id=\"$this->id\"" : "");
  }

  /**
   * Get the container id HTML text
   *
   * @param string $prefix
   *
   * @return string
   */
  protected function container_id($prefix = "") {
      return (!empty($this->container_id) ? "id=\"$this->container_id\"" : "");
  }

  /**
   * Get the compiled HTML class attribute
   *
   * @return string
   */
  protected function class() {
    return "class=\"$this->component_class" . (!empty($this->extra_classes) ? " " . $this->extra_classes : "") . "\"";
  }

  /**
   * Magical get by attribute
   *
   * @param string $attribute - Name of the attribute to get
   *
   * @return mixed|null
   */
  /*public function __get($attribute) {
    return $this->{$attribute} ?? null;
  }*/

  /**
   * Magical set by attribute
   *
   * @param string $attribute - The attribute to set
   * @param mixed  $value     - The value to set
   */
  /*public function __set($attribute, $value) {
    if (!empty($this->{$attribute})) {
      $this->{$attribute} = $value;
    }
  }*/

  /**
   * Gets the component as a string
   *
   * @return string
   */
  public function __toString() {
    return $this->get_component();
  }

  /**
   * Renders the component (echos)
   */
  public function render() {
    echo $this->get_component();
  }

  /**
   * The function that builds and returns the HTML of the component
   *
   * @return string
   */
  abstract protected function get_component();

  /**
   * Gets the template by name and returns the template as a processed HTML string
   *
   * @param string $name - The name/path of the template
   *                         ROOT: nefuzz.com/static/templates
   *
   * @return string - The template rendered as text
   */
  public static function get_template($name){
    ob_start();
    include("static/templates/$name.php");
    return ob_get_clean();
  }
}