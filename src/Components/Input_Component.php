<?php

abstract class Input_Component extends Base_Component {
	public $size = "";
  public $name = "";
  public $label = "";
  public $label_classes = "";
  public $is_required = false;
	
	private $sizes = [
	  "mini",
	  "small",
	  "medium",
	  "normal",
	  "large",
	  "big",
	  "full"
	];

	private function check_size() {
    if(in_array($this->size, $this->sizes)) {
      return $this->size;
    } else {
      return "normal";
    }
	}
	
	protected function class() {
    $size = $this->check_size();
	  return "class=\"$this->component_class input_$size" . ($this->extra_classes ? " $this->extra_classes" : "") . "\"";
	}
	
	protected function required() {
	  return ($this->is_required ? "required" : "");
	}
  
  protected function name() {
    return ($this->name ? "name=\"$this->name\"" : "");
  }
  
  protected function label_class() {
    $text = "class =\"" . ($this->is_required ? "required" : "") . ($this->label_classes ? " $this->label_classes" : "") . "\"";
    return (strlen($text) > 7 ? $text : "");
  }
}