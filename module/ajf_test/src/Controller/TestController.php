<?php

namespace Drupal\ajf_test\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;

/**
 * Controller for AJF test page.
 */
class TestController extends ControllerBase {

  /**
   * Used to run adhoc tests.
   *
   * @return array
   *   Render array for page output.
   */
  public function test() {
    $content = [];
    $message = '';

    // Adds a conditional memory increase.
    if (isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], 'admin/ajf-test') !== false ) {
      ini_set('memory_limit', '128M');
      ini_set('max_input_vars', '4000');
    }

    $message = '$_SERVER[\'REQUEST_URI\']' . ': ' . $_SERVER['REQUEST_URI'] . '<br>';
    $memory_limit = ini_get('memory_limit');
    $max_input_vars = ini_get('max_input_vars');
    $message .= 'Memory Limit: ' . $memory_limit . '<br>';
    $message .= 'Max Input Vars: ' . $max_input_vars . '<br>';

    $content['message'] = [
      '#markup' => $this->t($message),
    ];

    // Don't cache this page.
    $content['#cache']['max-age'] = 0;
    return $content;
  }

}
