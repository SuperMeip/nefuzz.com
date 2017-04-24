<?php
require_once($_SERVER['DOCUMENT_ROOT']."/views/view.php");

class Header_View extends View {
  
  public $user = null;
  public $title = "The New England Fuzz";
  public $extra_keywords = [];
  public $links = [];
  public $author = "Meep";
  public $description = "A website for hosting and discovering furry meets in New England";
  public $meta_tags = [];

  public function login_or_logout() {
    if ($this->user) {
      return $this->icon_and_logout();
    } else {
      return $this->login_modal();
    }
  }

  private function login_modal() {
      $modal = new Modal([
        "id" => "login",
        "title" => "Login",
        "content" => new Login_Modal_Header_View(),
        "activator" => (
          '<a class="row info item" href="#">
            <img src="img/login.png" class="small_icon round"/>
          </a>'
          ),
      ]);
      return new Tooltip([
        "focus" => $modal,
        "position" => "left",
        "content" => "Login",
        "extra_classes" => "right"
      ]);
    }

  private function icon_and_logout() {
    $icon = $this->user->get_icon();
    $link = $this->user->get_page_link();
    return "
      <a class=\"right row item info\" href=\"$link\">
        <img src=\"$icon\" class=\"small_icon round\"/>
      </a>
      <a class=\"item\" href=\"#\">
        <i class=\"fa fa-sign-out\" id=\"logout\" aria-hidden=\"true\"></i>
      </a>
    ";
  }

  public function extra_keywords() {
    $extra_keywords = ""; 
    foreach ($this->extra_keywords as $keyword) {
      $extra_keywords .= ", $keyword";
    }
    return $extra_keywords;
  }
  
  public function links() {
    $links = "";
    foreach ($this->links as $rel => $href) {
      $links .= "<link rel=\"$rel\" href=\"$href\"/>\n";
    }
    return $links;
  }
  
  public function meta_tags() {
    $meta_tags = "";
    foreach ($this->meta_tags as $name => $content) {
      $meta_tags .= "<meta name=\"$name\" content=\"$content\"/>\n";
    }
    return $meta_tags;
  }
  
  protected function preload() {
    error_reporting( E_ALL );
    require_once($_SERVER['DOCUMENT_ROOT']."/views/header/login_modal.php");
  }
  
  protected function js() {
    return ["header"];
  }
  
  protected function template() {
    return "header";
  }
}