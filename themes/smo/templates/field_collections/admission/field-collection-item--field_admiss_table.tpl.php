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
<?php
$table_hidden = !empty($content['field_admiss_table_hidden']) ?
  $content['field_admiss_table_hidden']['#items'][0]['value'] : 0;
?>
<?php if (!$table_hidden): ?>
<div class="b-table style-a">
  <table>
    <thead>
    <tr>
      <th colspan="3"><?php print render($content['field_admiss_table_head']);?></th>
    </tr>
    </thead>
    <tbody>
    <tr>
      <td>
        <?php print render($content['field_admiss_table_cell1_title']);?>
        <h3>
          <?php print render($content['field_admiss_table_cell1_value']); ?>
          <?php print render($content['field_admiss_table_cell1_suffix']); ?>
        </h3>
        <?php print render($content['field_admiss_table_cell1_member']); ?>
      </td>
      <td>
        <?php print render($content['field_admiss_table_cell2_title']); ?>
        <h3>
          <?php print render($content['field_admiss_table_cell2_value']); ?>
          <?php print render($content['field_admiss_table_cell2_suffix']); ?>
        </h3>
        <?php print render($content['field_admiss_table_cell2_member']); ?>
      </td>
      <td>
        <?php print render($content['field_admiss_table_cell3_title']); ?>
        <h3>
          <?php print render($content['field_admiss_table_cell3_value']); ?>
          <?php print render($content['field_admiss_table_cell3_suffix']); ?>
        </h3>
        <?php print render($content['field_admiss_table_cell3_member']); ?>
      </td>
    </tr>
    </tbody>
    <?php if(!empty($content['field_admiss_table_foot'])): ?>
      <tfoot>
        <tr>
          <td colspan="3">
            <?php print htmlspecialchars_decode(render($content['field_admiss_table_foot']));?>
          </td>
        </tr>
      </tfoot>
    <?php endif; ?>
  </table>
  <?php
  hide($content['field_admiss_table_hidden']);
  print render($content);
  ?>
</div>
<?php endif; ?>

