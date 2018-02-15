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
//dsm($content);
?>

<?php
$type = (isset($content['field_pib_img_blocks_type']) &&
  isset($content['field_pib_img_blocks_type']['#items'][0]['value'])) ?
  $content['field_pib_img_blocks_type']['#items'][0]['value'] : '';

$color = (isset($content['field_pib_img_blocks_color']) &&
  isset($content['field_pib_img_blocks_color']['#items'][0]['rgb'])) ?
  $content['field_pib_img_blocks_color']['#items'][0]['rgb'] : '';

$icon = (isset($content['field_pib_img_blocks_icon']) &&
  isset($content['field_pib_img_blocks_icon']['#items'][0]['value'])) ?
  $content['field_pib_img_blocks_icon']['#items'][0]['value'] : '';

$image_url = (isset($content['field_pib_img_blocks_image']) &&
  isset($content['field_pib_img_blocks_image']['#items'][0]['uri'])) ?
  file_create_url($content['field_pib_img_blocks_image']['#items'][0]['uri']) : '';

$link_url = (isset($content['field_pib_img_blocks_link']) &&
  isset($content['field_pib_img_blocks_link']['#items'][0]['url'])) ?
  $content['field_pib_img_blocks_link']['#items'][0]['url'] : '';

$link_attributes = (!empty($content['field_pib_img_blocks_link']) &&
  !empty($content['field_pib_img_blocks_link']['#items'][0]['attributes'])) ?
  $content['field_pib_img_blocks_link']['#items'][0]['attributes'] : array();

$title_prefix = ($link_url) ? '<a href="' . $link_url . '" ' . drupal_attributes($link_attributes) . '>' : '';
$title_suffix = ($link_url) ? '</a>' : '';

$id = (!empty($content['field_pib_img_blocks_title']) && !empty($content['field_pib_img_blocks_title']['#items'])) ?
  urlencode($content['field_pib_img_blocks_title']['#items'][0]['value']) : '';
?>
<a id="<?php print $id; ?>" href="#"></a>
<?php switch ($type): ?>
<?php case 'image': ?>
    <?php print $title_prefix; ?>
    <div class="img" style="<?php print $image_url ? "background-image: url('" . $image_url . "')" : ''; ?>">
      <?php print render($content['field_pib_img_blocks_image']); ?>
    </div>
    <?php print $title_suffix; ?>
<?php break; ?>
<?php case 'icon': ?>
    <?php print $title_prefix; ?>
    <div class="img ss-icon" style="<?php print $color ? "background-color: " . $color : ''; ?>">
      <?php if ($icon): ?>
      <span class="ico"><?php print $icon; ?></span>
      <?php endif; ?>
    </div>
    <?php print $title_suffix; ?>
<?php break;?>
<?php endswitch ?>

<div class="text">
  <h3>
  <?php print $title_prefix; ?>
  <?php print render($content['field_pib_img_blocks_title']);?>
  <?php print $title_suffix; ?>
  </h3>
  <?php print render($content['field_pib_img_blocks_desc']);?>
</div>

<?php hide($content['field_pib_img_blocks_type']); ?>
<?php hide($content['field_pib_img_blocks_color']); ?>
<?php hide($content['field_pib_img_blocks_icon']); ?>
<?php hide($content['field_pib_img_blocks_image']); ?>
<?php hide($content['field_pib_img_blocks_link']); ?>
<?php print render($content); ?>

