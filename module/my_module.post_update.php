<?php

/**
 * @file
 * Run updates after updatedb has completed.
 * @see https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Core%21Extension%21module.api.php/function/hook_post_update_NAME
 */

use Drupal\node\Entity\Node;


/**
 * Populate new field with default value.
 */
function my_module_post_update_subtype_field() {
  $eq = \Drupal::entityQuery('node');
  $nids = $eq->condition('type', 'org_page')->execute();
  /** @var Drupal\node\Entity\Node[] $nodes */
  $nodes = Node::loadMultiple($nids);
  foreach ($nodes as $node) {
    $node->field_new->setValue('A Default Value');
    $node->save();
  }
}
