<?php
require_once($_SERVER['DOCUMENT_ROOT']."/views/view.php");

class Footer_View extends View {
    
    protected function template() {
        return 'footer';
    }
}