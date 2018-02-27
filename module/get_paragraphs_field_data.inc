<?php

/**
 * @file Examples for accessing paragraphs field data.
 *
 * $my_paragraph  // Top-level paragraph entity. This is available in the render array.
 * ->field_something  // Access whatever field or property you're trying to get directly. This returns a `FieldItemList`
 * ->get(3) // Get the 3rd value for a multi-value field. You can also use `first()` if you only want one value
 * ->getValue() // This returns the value of the field. Entity references you can use `getEntity()` instead and keep tunneling
 *
 * $value = $my_paragraph->field_something->get(3)->value
 *
 * Caveat is to avoid changing paragraphs field data in twig templates, because you can introduce major gaps in your caching and other bubbleable metadata.
 *
 * look at the API docs for these classes:
 * • `FieldableEntityInterface`
 * • `FieldItemList`
 * • `FieldItemBase`
 * When you get into more specific field types and different info you need for them, look for the corresponding `FieldItem` implementation.
 */

// Access whatever field or property you're trying to get directly. This returns a `FieldItemList`.
$field = $my_paragraph->field_something;

// This returns the value of the field. Entity references you can use `getEntity()` instead and keep tunneling.
$field_value = $my_paragraph->field_something->getValue();

// Get the 3rd value for a multi-value field. You can also use `first()` if you only want one value.
$third_field_value = $my_paragraph->field_something->get(3);

// Using magic methods.
$value = $my_paragraph->field_something->get(3)->value;
