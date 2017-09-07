<?php

/**
 * The base class for input components
 *
 * Class Input_Component
 */
abstract class Input_Component extends Base_Component {

  /**
   * Different sizes used for input components
   */
  const MINI = 'mini';
  const SMALL = 'small';
  const MEDIUM = 'medium';
  const NORMAL = 'normal';
  const LARGE = 'large';
  const BIG = 'big';
  const FULL = 'full';

  /**
   * The width of the input component. Taken from self::sizes
   *
   * @var string
   */
	protected $size = "";

  /**
   * The name of the input
   *
   * @var string
   */
  protected $name = "";

  /**
   * The label text for the input
   *
   * @var string
   */
  protected $label = "";

  /**
   * The classes for the label text
   *
   * @var string
   */
  protected $label_classes = "";

  /**
   * If this input is a required field
   *
   * @var bool
   */
  protected $is_required = false;

  /**
   * The sizes, used for validation checks
   *
   * @var array
   */
	private $sizes = [
	  self::MINI,
	  self::SMALL,
	  self::MEDIUM,
    self::NORMAL,
	  self::LARGE,
	  self::BIG,
	  self::FULL
	];

  /**
   * Validate the size, if it isn't recognized it chooses normal
   *
   * @return string
   */
	private function check_size() {
    if(in_array($this->size, $this->sizes)) {
      return $this->size;
    } else {
      return self::NORMAL;
    }
	}

  /**
   * Get the class html
   *
   * @return string
   */
	protected function class() {
    $size = $this->check_size();
	  return "class=\"$this->component_class input_$size" . ($this->extra_classes ? " $this->extra_classes" : "") . "\"";
	}

  /**
   * Get the required html
   *
   * @return string
   */
	protected function required() {
	  return ($this->is_required ? "required" : "");
	}

  /**
   * Get the name html
   *
   * @return string
   */
  protected function name() {
    return ($this->name ? "name=\"$this->name\"" : "");
  }

  /**
   * Get the html for the label's classes
   *
   * @return string
   */
  protected function label_class() {
    $text = "class =\"" . ($this->is_required ? "required" : "") . ($this->label_classes ? " $this->label_classes" : "") . "\"";
    return (strlen($text) > 7 ? $text : "");
  }
}