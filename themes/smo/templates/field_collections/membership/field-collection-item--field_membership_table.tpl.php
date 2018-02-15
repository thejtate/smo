<?php

/**
 * @file
 * Default theme implementation for field collection items.
 *
 * Available variables:
 * - $content: An array of comment items. Use render($content) to print them all, or
 *   print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $title: The (sanitized) field collection item label.
 * - $url: Direct url of the current entity if specified.
 * - $page: Flag for the full page state.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. By default the following classes are available, where
 *   the parts enclosed by {} are replaced by the appropriate values:
 *   - entity-field-collection-item
 *   - field-collection-item-{field_name}
 *
 * Other variables:
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 *
 * @see template_preprocess()
 * @see template_preprocess_entity()
 * @see template_process()
 */
?>
<div class="b-table style-b">
  <table>
    <thead>
    <tr>
      <th colspan="2"><?php print render($content['field_membership_table_title']);?></th>
    </tr>
    </thead>
    <tbody>
    <tr>
      <td>
        <table>
          <tbody>
          <tr>
            <td>
              <?php print render($content['field_membership_col1_ro1']);?>
            </td>
          </tr>
          <tr>
            <td>
              <?php print render($content['field_membership_col1_ro2']);?>
            </td>
          </tr>
          <tr class="mobile">
            <td>
              <?php print render($content['field_membership_col1_ro3']);?>
            </td>
          </tr>
          </tbody>
        </table>
      </td>
      <td>
        <table>
          <thead>
          <tr>
            <th><?php print render($content['field_membership_col2_ro1']);?></th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td>
              <?php print render($content['field_membership_col2_ro2']);?>
            </td>
          </tr>
          </tbody>
        </table>
      </td>
    </tr>
    </tbody>
    <tfoot>
    <tr>
      <td>
        <?php print render($content['field_membership_col1_ro3']);?>
      </td>
      <td>
        <?php print render($content['field_membership_col2_ro3']);?>
      </td>
    </tr>
    <?php print render($content['field_membership_more_rows']);?>
    </tfoot>
  </table>
</div>

    <?php
      print render($content);
    ?>

