<?php


/**
 * @file
 * Settings forms
 */

/**
 * Create settings form in drupal configuration settings section for module.
 */
function smo_calendar_admin_settings($form, &$form_state) {

  $form['#tree'] = TRUE;

  if (empty($form_state['num_days'])) {
    $form_state['num_days'] = variable_get('smo_calendar_holidays_num_days', 0);
  }

  $form['smo_calendar_holidays'] = array(
    '#type' => 'fieldset',
    '#title' => t('Holidays'),
    '#collapsible' => TRUE,
  );

  $today = date("Y-m-d H:i:s");

  for ($i = 1; $i <= $form_state['num_days']; $i++) {
    $form['smo_calendar_holidays']['smo_calendar_holidays_' . $i] = array(
      '#type' => 'date_popup',
      '#default_value' => variable_get('smo_calendar_holidays_' . $i, $today),
      '#date_type' => DATE_DATETIME,
      '#date_timezone' => date_default_timezone(),
      '#date_format' => 'm/d/Y',
      '#date_increment' => 1,
      '#date_year_range' => '-3:+3',
    );
  }

  $form['smo_calendar_holidays']['add_day'] = array(
    '#type' => 'submit',
    '#value' => t('Add day'),
    '#submit' => array('smo_calendar_add_day'),
  );

  if ($form_state['num_days'] >= 1) {
    $form['smo_calendar_holidays']['remove_day'] = array(
      '#type' => 'submit',
      '#value' => t('Remove latest day'),
      '#submit' => array('smo_calendar_remove_day'),
      '#limit_validation_errors' => array(),
    );
  }

  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => 'Submit',
  );

  return $form;
}

/**
 * Submit handler for "Add day".
 */
function smo_calendar_add_day($form, &$form_state) {
  $form_state['num_days']++;
  $form_state['rebuild'] = TRUE;
}

/**
 * Submit handler for "Remove day" button.
 */
function smo_calendar_remove_day($form, &$form_state) {
  if ($form_state['num_days'] >= 1) {
    $form_state['num_days']--;
  }
  $form_state['rebuild'] = TRUE;
}

/**
 * Submit function.
 */
function smo_calendar_admin_settings_submit($form, &$form_state) {
  for ($i = 1; $i <= $form_state['num_days']; $i++) {
    $value = $form_state['values']['smo_calendar_holidays']['smo_calendar_holidays_' . $i];
    variable_set('smo_calendar_holidays_' . $i, $value);
  }

  $prev_num = variable_get('smo_calendar_holidays_num_days', 0);
  if ($form_state['num_days'] < $prev_num) {
    for ($i = $form_state['num_days'] + 1; $i <= $prev_num; $i++) {
      variable_del('smo_calendar_holidays_' . $i);
    }
  }
  variable_set('smo_calendar_holidays_num_days', $form_state['num_days']);
}