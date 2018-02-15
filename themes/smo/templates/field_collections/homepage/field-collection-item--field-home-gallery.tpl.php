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
$url = !empty($content['field_home_gallery_link'][0]['#element']['url']) ? $content['field_home_gallery_link'][0]['#element']['url'] : '#';

$url_attributes = (!empty($content['field_home_gallery_link']) &&
  !empty($content['field_home_gallery_link']['#items'][0]['attributes'])) ?
  $content['field_home_gallery_link']['#items'][0]['attributes'] : array();

$img_url = !empty($content['field_home_gallery_image']['#items'][0]['uri']) ? file_create_url($content['field_home_gallery_image']['#items'][0]['uri']) : '';
?>

  <header class="item-header">
    <h2><a href="<?php print $url; ?>" <?php print drupal_attributes($url_attributes); ?>><?php print render($content['field_home_gallery_title']);?></a></h2>
    <?php if(!empty($content['field_home_gallery_description'])): ?>
      <div class="desc"><a href="<?php print $url; ?>" <?php print drupal_attributes($url_attributes); ?>><?php print render($content['field_home_gallery_description']);?></a></div>
    <?php endif; ?>
  </header>
  <div class="inner">
    <div class="item-content">
      <a href="<?php print $url; ?>" <?php print drupal_attributes($url_attributes); ?>>
        <?php $content['field_home_gallery_image'][0]['#item']['attributes']['class'][] = 'img'?>
        <span style="background-image: url('<?php print $img_url; ?>');" class="img"></span>
      </a>
    </div>
  </div>

