<?php

/**
 * @file
 * Examples for how to access field data in entities.
 */

// Get a field value.
$value = $node->get('field_author')->getValue();

// Get the first item from a field value.
$node->get('field_name')->first()->getValue();

// Get the field value as a string.
$node->get('field_name')->getString();

// Loading a taxonomy term.
use Drupal\taxonomy\Entity\Term;
$term = Term::load($tid);

// Get the term name/label.
$name = Term::load($tid)->label();
