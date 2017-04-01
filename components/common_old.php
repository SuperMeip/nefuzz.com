<?php

const IS_REQUIRED = 1;
const LARGE_INPUT = 2;
const PASSWORD = 4;
const CLOSEABLE = 8;
const CLOSED = 16;

function get_id($title = false, $tag = false) {
  $id = '';
  if ($title) {
    $id =  str_replace([' ', "'"], '-', $label) . ($tag ? $tag . '-' : '');
  }
}

function text_input ($label, $name, $max_characters = "", $options = 0) {
  return '
    <div class="text_input' . ($options & LARGE_INPUT ? '_large' : '') . '">
      <input type="' . ($options & PASSWORD ? 'password' : 'text') . '" name="' . $name . '" maxlength="' . $max_characters . '" ' . ($options & IS_REQUIRED ? 'required' : '') . '/>
      <label>' . $label . '<span id="' . $name . '-error" class="right"></span></label>
    </div>
  ';
}

function button($label, $submit = false, $extra_classes="") {
  $id =  str_replace([' ', "'"], '-', $label) . '-button';
  return '<button id="' . $id . '" ' . ($submit ? 'type="submit"' : '') . ' class="button ' . $extra_classes .'">' . $label . '</button>';
}

function modal ($title, $content, $activator = false, $extra_classes="") {
  $id =  str_replace([' ', "'"], '-', $title);
  return (
    $activator ?
    '<div class="' . $extra_classes . '" id="' . $id . '-open">'
      . $activator . '
    </div>' :
    '') . '
    <div class="modal" id="' . $id . '">
      <div class="content">
        <div class="header"> 
          <span class="close right" id="' . $id . '-close">
            <i class="fa fa-times"></i>
          </span>
          <h1 class="header_small">' . $title . '</h1>
        </div>
        <div class="body">'
          . $content .
        '</div>
      </div>
    </div>
    <script>
      $(document).ready(function(){
        $("#' . $id . '-open").click(function(){
          $("#' . $id . '").css("display", "block");
        });
      });
      $(document).ready(function(){
        $("#' . $id . '-close").click(function(){
          $("#' . $id . '").css("display", "none");
        });
      });
    </script>
  ';
}

function block($title = false, $content = false, $options = 0, $extra_classes = '') {
  return '
    <div class="block ' . $extra_classes . '">' .
      ($title ? '<div class="header"> 
        <div>
          <h1 class="header_small"> . $title . </h1>' . 
          ($options & CLOSEABLE ? '<span class="extend unselectable">+</span>' : '') . '
        </div>
      </div>'  : '') . '
      <div class="body ' . ($options & CLOSED ? 'hidden' : '') . '">
      </div>
    </div>' . 
    ($options & CLOSEABLE ? '<script type="text/javascript">
      $(".block .extend").click(function() {
        $(this).toggleClass("rotated");
        $(".block .body").slideToggle();
      });
    </script>' : '')
  ;
}
?>