<?php

namespace Nefuzz\Controllers;

/**
 * Class Base_Controller
 * The base class for controllers
 *
 * @package Nefuzz\Controllers
 */
abstract class Base_Controller {
  /**
   * An array of header arguments to include (for meta tags)
   *
   * @var array
   */
  protected $header_arguments = [];

    /**
     * Renders the page header using any custom arguments in $header_arguments
     *
     * @return void
     */
  protected function page_header() {
    require_once($_SERVER['DOCUMENT_ROOT']."/src/Nefuzz/Models/User.php");
    //session_start();
    $header = new \Nefuzz\Views\Header();
    $header->user = ($_SESSION['user'] ?? null);
    foreach ($this->header_arguments as $key => $val) {
      if (isset($header->{$key})) {
        $this->{$key} = $val;
      }
    }
    $header->load();
  }

    /**
     * Used for rendering the body of this page
     *
     * @return void
     */
  protected abstract function page_body();

  /**
   * A function used to make ajax requests to the controller
   *
   * @param string $action   - Which ajax action for this controller are you requesting
   * @param string $argument - The extra argument sent in the url (optional)
   *
   * @return string   - A json of the data to return to the ajax request
   */
  public function request($action, $argument) {
    return false;
  }

  /**
   * Used by Flight to pass the url argument to the controller
   *
   * @param string $argument - The argument value to set
   *
   * @return bool - if successful
   */
  public function set_argument($argument) {
    return false;
  }

  /**
   * The page footer
   *
   * @return void
   */
  protected function page_footer() {
    $footer = new \Nefuzz\Views\Footer();
    $footer->load();
  }


  /**
   * Load the page for this controller
   *
   * @return void
   */
  public function load() {
    $this->page_header();
    $this->page_body();
    $this->page_footer();
  }
}