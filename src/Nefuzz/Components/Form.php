<?php
require_once("components/component.php");

class Form_Open extends Component {
    $action = "";
    $method = "POST";
    
    public function get_component() {
        return "
        <form action=\"$this->action\" method=\"$this->method\">
        ";
    }
}