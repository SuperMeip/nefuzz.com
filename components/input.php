<?php
require_once('component.php');

abstract class Input extends Componenet {
	public $size = "";
	
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
}
?>