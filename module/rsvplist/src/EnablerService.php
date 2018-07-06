<?php

/**
 * @file
 * Contains \Drupal\rsvplist\EnablerService
 */

namespace Drupal\rsvplist;

use Drupal\Core\Database\Database;
use Drupal\node\Entity\Node;

/**
 * Defines a service for managing RSVP list enabled for nodes.
 */
class EnablerService {

  /**
   * Constructor.
   */
  public function __construct() {

  }

  /**
   * Sets an individual node to be RSVP enabled.
   *
   * @param \Drupal\node\Entity\Node $node
   *   The node object to enable.
   */
  public function setEnabled(Node $node) {
    if (!$this->isEnabled($node)) {
      $insert = Database::getConnection()->insert('rsvplist_enabled');
      $insert->fields(['nid'], [$node->id()]);
      $insert->execute();
    }
  }

  /**
   * Checks if an individual node is RSVP enabled.
   *
   * @param \Drupal\node\Entity\Node $node
   *   The node object to enable.
   *
   * @return bool
   *   Whether the node is enabled for RSVP.
   */
  public function isEnabled(Node $node) {
    if ($node->isNew()) {
      return FALSE;
    }
    $select = Database::getConnection()->select('rsvplist_enabled', 're');
    $select->fields('re', ['nid']);
    $select->condition('nid', $node->id());
    $results = $select->execute();
    return !empty($results->fetchCol());
  }

  /**
   * Deletes enabled setting for an individual node.
   *
   * @param \Drupal\node\Entity\Node $node
   *   The node object to delete settings for.
   */
  public function delEnabled(Node $node) {
    if ($node->isNew()) {
      return FALSE;
    }
    $delete = Database::getConnection()->delete('rsvplist_enabled');
    $delete->condition('nid', $node->id());
    $delete->execute();
  }

}
