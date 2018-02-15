<?php

/**
 * @file
 * Settings forms
 */

/**
 * Create settings form in drupal configuration setings section for module.
 */
function smo_blog_admin_settings() {
  $form['smo_blog_settings_archive'] = array(
    '#type' => 'fieldset',
    '#title' => t('Blog Archive'),
    '#collapsible' => TRUE,
  );

  $form['smo_blog_settings_archive']['smo_blog_settings_month'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show month in Archive?'),
    '#default_value' => variable_get('smo_blog_settings_month', 0),
    '#description' => t('Select "Yes" for show month in archive tree.'),
  );

  $form['smo_blog_settings_archive']['smo_blog_settings_nodes'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show post titles in Archive?'),
    '#default_value' => variable_get('smo_blog_settings_nodes', 0),
    '#description' => t('Select "Yes" for show node titles in archive tree.'),
  );

  $form['smo_blog_settings_archive']['smo_blog_settings_count_nodes'] = array(
    '#type' => 'textfield',
    '#size' => 3,
    '#title' => t('Number of post titles in Archive'),
    '#description' => t('0 - show all titles.'),
    '#default_value' => variable_get('smo_blog_settings_count_nodes', 10),
  );

  $form['smo_blog_settings_archive']['smo_blog_settings_contact'] = array(
    '#type' => 'textarea',
    '#title' => t('MEDIA INQUIRIES'),
    '#cols' => 60,
    '#rows' => 5,
    '#default_value' => variable_get('smo_blog_settings_contact', ''),
  );

  return system_settings_form($form, TRUE);
}