<?php

/**
 * @file
 * Custom drush commands.
 */

/**
 * Implements hook_drush_command().
 */
function ajf_test_drush_command() {
  $items['do-something'] = [
    'description' => 'Do some processing.',
    'arguments' => [
      'file' => 'The file to load',
    ],
    'drupal dependencies' => ['ajf_test'],
    'aliases' => ['dsg'],
  ];
  return $items;
}

/**
 * Call back function drush_ajf_test_do_something().
 *
 * The call back function name in the  following format:
 *   drush_{module_name}_{item_id_for_command}()
 */
function drush_ajf_test_do_something($file = '') {
  drush_print('Doing something ' . $file);
}
