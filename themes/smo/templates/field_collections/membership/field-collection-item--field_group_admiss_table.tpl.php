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

<div class="b-table style-c">
  <table>
    <thead>
    <tr>
      <th colspan="3"><?php print render($content['field_group_admiss_head']);?><span><?php print render($content['field_group_admiss_head_desc']);?></span></th>
    </tr>
    </thead>
    <tbody>
    <tr>
      <td>
        <?php print render($content['field_group_admiss_cell_1_title']);?>
        <h3><?php print render($content['field_group_admiss_cell_1_value']);?></h3>
      </td>
      <td>
        <?php print render($content['field_group_admiss_cell_2_title']);?>
        <h3><?php print render($content['field_group_admiss_cell_2_value']);?></h3>
      </td>
      <td>
        <?php print render($content['field_group_admiss_cell_3_title']);?>
        <h3><?php print render($content['field_group_admiss_cell_3_value']);?></h3>
      </td>
    </tr>
    </tbody>
    <?php if(!empty($content['field_group_admiss_footer'])): ?>
      <tfoot>
        <tr>
          <td colspan="3">
            <?php print render($content['field_group_admiss_footer']);?>
          </td>
        </tr>
      </tfoot>
    <?php endif; ?>
  </table>
  <?php
  print render($content);
  ?>
</div>


