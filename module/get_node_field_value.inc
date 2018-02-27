<?php

/**
 * @file Example of how to get node field data.
 */


use Drupal\node\Entity\Node;

function mymodule_node_process($entity) {
  $id = $entity->id();
  if ($id) {
    $node = Node::load($id);
    if (!is_null($node)) {
      $myfield = $node->field_myfield->getValue();
      if ($myfield[0]['value'] == 'A Value') {
        // Do something.
      }
    }
  }
}
