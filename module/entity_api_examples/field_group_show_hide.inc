<?php

/**
 * @file An example of how to show/hide a field group parent tab.
 */

/**
 * Implements hook_form_FORM_ID_alter() for the FORM_ID() form.
 */
function mymodule_form_node_my_contenttype_edit_form_alter(&$form, FormStateInterface $form_state, $form_id) {
  $my_awesome_condition = TRUE;

  if ($my_awesome_condition) {
    // Allow access to the Featured group to show the tab.
    foreach ($form['#fieldgroups']['group_mygroup']->children as $form_element_id) {
      $form[$form_element_id]['#access'] = TRUE;
    }
  }
  else {
    // Remove access to the Featured group to hide the tab.
    foreach ($form['#fieldgroups']['group_mygroup']->children as $form_element_id) {
      $form[$form_element_id]['#access'] = FALSE;
    }
  }

}
