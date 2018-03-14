/**
 * @file
 * Example of conditional show/hide functionality for a field group form tab.
 */
(function ($, Drupal) {

  'use strict';

  Drupal.behaviors.showHide = {
    attach: function (context, settings) {

      // Get the li for the tab we want to show/hide.
      var $my_tab_li = $('.horizontal-tab-button').find("strong:contains('MyTab')").parent().parent();

      // Hide or show the form tab depending on the value of a select field.
      if ($('#edit-field-subtype option:selected').text() === 'Hide It') {
        $my_tab_li.hide();
      }

      $('#edit-field-subtype').on('change', function () {
        if ($('#edit-field-subtype option:selected').text() === 'Show It') {
          $my_tab_li.show();
        }
        else {
          $my_tab_li.hide();
        }
      });
    }
  };

})(jQuery, Drupal);
