<?php
/**
 * @file
 * Project settings form.
 */

function smo_custom_site_settings_form() {
  $form = array();

  $form['social'] = array(
    '#type' => 'fieldset',
    '#title' => t('Social Links'),
    '#weight' => 1,
    '#collapsible' => FALSE,
    '#collapsed' => FALSE,
  );

  $social_names = smo_custom_socials_keys();
  foreach ($social_names as $name) {
    $form['social'][$name] = array(
      '#type' => 'textfield',
      '#title' => $name,
      '#default_value' => variable_get($name, ''),
      '#size' => 80,
      '#maxlength' => 128,
    );
  }

  $form['settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Other settings'),
    '#weight' => 1,
    '#collapsible' => FALSE,
    '#collapsed' => FALSE,
  );

  $form['settings']['tickets'] = array(
    '#type' => 'textfield',
    '#title' => t('Tickets url'),
    '#description' => t('Url for tickets page.'),
    '#default_value' => variable_get('tickets', ''),
    '#size' => 80,
    '#maxlength' => 128,
  );

  $form['settings']['donation'] = array(
    '#type' => 'textfield',
    '#title' => t('Donation url'),
    '#description' => t('Url for donation page.'),
    '#default_value' => variable_get('donation', ''),
    '#size' => 80,
    '#maxlength' => 128,
  );


  $form['settings']['location'] = array(
    '#type' => 'textfield',
    '#title' => t('Location'),
    '#description' => t('Footer Location text.'),
    '#default_value' => variable_get('location', ''),
    '#size' => 80,
    '#maxlength' => 128,
  );

  $form['settings']['phone'] = array(
    '#type' => 'textfield',
    '#title' => t('Phone'),
    '#description' => t('Footer Phone text.'),
    '#default_value' => variable_get('phone', ''),
    '#size' => 80,
    '#maxlength' => 128,
  );

  return system_settings_form($form);
}