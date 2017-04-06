<?php
require_once('component.php');

abstract class Input_Componenet extends Componenet {
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
	
	private function class() {
    $size =$this->check_size();
	  $class = "class=\"text_input input_$size" . ($this->extra_classes ? " $this->extra_classes" : "") . "\"";
	}
	
	private function required() {
	  return ($this->is_required ? "required" : "");
	}
  
  private function name() {
    return ($this->name ? "name=\"$this->name\"" : "");
  }
  
  private function label_class() {
    $text = "class =\"" . ($this->is_required ? "required" : "") . ($this->label_classes ? " $this->label_classes" : "") . "\"";
    return (strlen($text) > 8 ? $text : "");
  }
}