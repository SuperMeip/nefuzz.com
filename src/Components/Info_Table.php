<?php

/**
 * A basic title, value 2 by X table
 *
 * Class Info_Table
 */
class Info_Table extends Base_Component {

  /**
   * The top level class for this component
   *
   * @var string
   */
  protected $component_class = "info_table";

  /**
   * The values arranged in n associative array
   *
   * @var array
   */
  public $values = [];

  /**
   * Get the html of the component
   *
   * @return string
   */
  public function get_component() {
    $table = "<table {$this->class()} {$this->id()} >";
    if (empty($this->values)) {
      return "";
    }
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