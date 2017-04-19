<?php
require_once("components/component.php");

class Info_Table extends Component {
  protected $component_class = "info_table";
  public $values = [];
  
  public function get_component() {
    $table = "<table {$this->class()} {$this->id()} >";
    foreach($this->values as $title => $info) {
      $table .= "
        <tr>
          <td class=\"item_title\">$title</td>
          <td class=\"item_value\">$info</td>
        </tr>
      ";
    }
    $table .= "</table>";
    return $table;
  }
} 