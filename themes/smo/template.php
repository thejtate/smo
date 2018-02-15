<?php
/**
 * @file
 * template.php
 *
 * Contains theme override functions and preprocess functions for the theme.
 */

define('SMO_NEWSLETTER_WEBFORM_NID', 3);
define('SMO_OMN_NEWSLETTER_WEBFORM_NID', 82);
// Stage
// define('SMO_NEWS_NID', 98);
define('SMO_NEWS_NID', 127);

/**
 * Implements hook_preprocess_html().
 */
function smo_preprocess_html(&$vars) {

  $viewport = array(
    '#tag' => 'meta',
    '#attributes' => array(
      'name' => 'viewport',
      'content' => 'user-scalable=yes, width=device-width',
    ),
  );

  // Setup IE meta tag to force IE rendering mode.
  $meta_ie_render_engine = array(
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#attributes' => array(
      'http-equiv' => 'X-UA-Compatible',
      'content' => 'IE=edge',
    ),
    '#weight' => '-99999',
    '#prefix' => '<!--[if IE]>',
    '#suffix' => '<![endif]-->',
  );

  $html5 = array(
    '#tag' => 'script',
    '#attributes' => array(
      'src' => drupal_get_path('theme', 'smo') . '/js/lib/html5.js',
    ),
    '#prefix' => '<!--[if (lt IE 9) & (!IEMobile)]>',
    '#suffix' => '</script><![endif]-->',
  );

  drupal_add_html_head($meta_ie_render_engine, 'meta_ie_render_engine');
  drupal_add_html_head($viewport, 'viewport');
  drupal_add_html_head($html5, 'smo_html5');
  drupal_add_css(drupal_get_path('module', 'ckeditor') . '/css/ckeditor.css');

  $node = menu_get_object();
  if (!empty($node)) {
    $vars['classes_array'][] = 'page-' . str_replace('_', '-', $node->type);
    try {
      /** @var EntityMetadataWrapper **/
      $wrap = entity_metadata_wrapper('node', $node);

      //check field_basic_content_blocks
      if($wrap->__isset('field_basic_content_blocks')) {

        /** @var EntityListWrapper **/
        $block_fc_wrap = $wrap->field_basic_content_blocks;

        if($cont = $wrap->field_basic_content_blocks->count()) {
          //last block type
          $last_block_type = $wrap->field_basic_content_blocks[$block_fc_wrap->count() - 1]->field_basic_content_color_scheme->value();
          if($last_block_type !== 'default') {
            $vars['classes_array'][] = 'without-bottom-padding';
          }
        }
      }
    }
    catch (EntityMetadataWrapperException $exc) {
      watchdog('template', 'EntityMetadataWrapper exception in %function() <pre>@trace</pre>', array('%function' => __FUNCTION__, '@trace' => $exc->getTraceAsString()), WATCHDOG_ERROR);
    }

    switch($node->type) {
      case 'science_live':
        $vars['classes_array'][] = 'page-history';
        $vars['classes_array'][] = 'without-bottom-padding';
      break;
      case 'page_image_block':
        $vars['classes_array'][] = 'page-event-rentals';
      break;
      case 'omn_outreach':
        $vars['classes_array'][] = 'page-outreach';
      break;
    }

    switch ($node->nid) {
      case SMO_NEWS_NID:
        $without_bottom = array_search('without-bottom-padding', $vars['classes_array']);
        if ($without_bottom) {
          unset($vars['classes_array'][$without_bottom]);
        }
        break;
    }
  }

}

/**
 * Implements hook_preprocess_page().
 */
function smo_preprocess_page(&$vars) {
//kpr($vars);
  $vars['content_class'] = 'content-wrapper';
  $vars['container_class'] = 'container';

  if (isset($vars['node'])) {
    $node = $vars['node'];

    //top image for rendering in page template
    if(!empty($node->field_basic_head_image)) {
      //$vars['top_image'] = field_view_field('node', $node, 'field_basic_head_image', 'default');
      $vars['top_image'] = file_create_url($node->field_basic_head_image[LANGUAGE_NONE][0]['uri']);
    }
    if(isset($node->field_basic_mobile_head_image) && !empty($node->field_basic_mobile_head_image)) {
//      $vars['mobile_top_image'] = file_create_url($node->field_basic_mobile_head_image[LANGUAGE_NONE][0]['uri']);
      $vars['mobile_top_image'] = field_view_field('node', $node, 'field_basic_mobile_head_image', 'default');
    }
    //logo image for rendering in page template
    if(!empty($node->field_head_logo_image)) {     
      $vars['logo_image'] = field_view_field('node', $node, 'field_head_logo_image', 'default');
    }
    
    //Sub titles (above, below)
    if(!empty($node->field_page_form_above_title)) {
      $vars['above_title_text'] = field_view_field('node', $node, 'field_page_form_above_title', 'default');
    }
    if(!empty($node->field_page_form_below_title)) {
      $vars['below_title_text'] = field_view_field('node', $node, 'field_page_form_below_title', 'default');
    }

    try {
      $node_wrapper = entity_metadata_wrapper('node', $node);
      $properties = $node_wrapper->getPropertyInfo();

      if (array_key_exists('field_hide_title', $properties)) {
        $vars['hide_title'] = $node_wrapper->field_hide_title->value();
      }
      if (array_key_exists('field_disable_parallax', $properties)) {
        $vars['disable_parallax'] = $node_wrapper->field_disable_parallax->value();
      }
    }
    catch (EntityMetadataWrapperException $exc) {
      watchdog('native_theme', 'See ' . __FUNCTION__ . '() <pre>' . $exc->getTraceAsString() . '</pre>', NULL, WATCHDOG_ERROR);
    }

    switch ($node->type) {
      case 'homepage':
        $vars['content_class'] = '';
        $vars['container_class'] = '';
        $vars['title'] = '';
        break;
      case 'news':
        $parent_node = node_load(SMO_NEWS_NID);
        if(!empty($parent_node->field_basic_head_image)) {
          $vars['top_image'] = file_create_url($parent_node->field_basic_head_image[LANGUAGE_NONE][0]['uri']);
          $vars['title'] = t('News');
        }
        break;
      case 'omn_home':
        $block = block_load('webform', 'client-block-' . SMO_OMN_NEWSLETTER_WEBFORM_NID);
        $block = _block_render_blocks(array($block));
        $block_build = _block_get_renderable_array($block);

        $vars['page']['content_bottom'] =  $block_build;
        break;
    }
  }

  $social_names = smo_custom_socials_keys();
  foreach ($social_names as $name) {
    $vars['social_links'][$name] = variable_get($name, '');
  }

  $vars['location'] = variable_get('location', '');
  $vars['phone'] = variable_get('phone', '');
  $vars['tickets'] = url(variable_get('tickets', ''));
  $vars['donation'] = url(variable_get('donation', ''));

  if (drupal_is_front_page()) {
    $pixel_js = "var ssaUrl = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'pixel.sitescout.com/iap/9e660585d265e47d';";
    $pixel_js .= "new Image().src = ssaUrl;";

    drupal_add_js($pixel_js, array('type' => 'inline'));
  }
}

/**
 * Implements hook_preprocess_node().
 */
function smo_preprocess_node(&$vars) {
  $node = $vars['node'];
  if (!$vars['page']) {
    $vars['theme_hook_suggestions'][] = 'node__' . $vars['type'] . '__' . $vars['view_mode'];
  }
  //hide top image. We will display it in the page template
  if(!empty($vars['content']['field_basic_head_image'])) {
    hide($vars['content']['field_basic_head_image']);
  }
  if(!empty($vars['content']['field_basic_mobile_head_image'])) {
    hide($vars['content']['field_basic_mobile_head_image']);
  }
  //hide logo image. We will display it in the page template
  if(!empty($vars['content']['field_head_logo_image'])) {
    hide($vars['content']['field_head_logo_image']);
  }
  //hide subtitle. We will display it in the page template
  if(!empty($vars['content']['field_page_form_above_title'])) {
    hide($vars['content']['field_page_form_above_title']);
  }
  //hide subtitle. We will display it in the page template
  if(!empty($vars['content']['field_page_form_below_title'])) {
    hide($vars['content']['field_page_form_below_title']);
  }
  if(isset($vars['content']['field_hide_title']) && !empty($vars['content']['field_hide_title'])) {
    hide($vars['content']['field_hide_title']);
  }
  if(isset($vars['content']['field_disable_parallax']) && !empty($vars['content']['field_disable_parallax'])) {
    hide($vars['content']['field_disable_parallax']);
  }

//  dsm($node->type);
  switch($node->type) {
    case 'homepage':
      $vars['content']['newsletter_block'] = array('#markup' => smo_get_renderd_block('webform', 'client-block-3'));

      $vars['content']['calendar'] = array('#markup' => smo_get_renderd_block('views', 'calendar-block_3'));

      $vars['content']['calendar_month'] = array('#markup' => smo_get_renderd_block('views', 'calendar-block_1'));

      $vars['content']['hours'] = array('#markup' => smo_get_renderd_block('bean', SMO_MUSEUM_HOURS_BEAN_ID));

      $vars['tickets'] = url(variable_get('tickets', ''));

      break;
    case 'location':
      $vars['content']['hours'] = array('#markup' => smo_get_renderd_block('bean', SMO_MUSEUM_HOURS_BEAN_ID));

      $address_field = field_view_field('node', $node, 'field_loc_address');
      if ($address_field) {
        $map_link = 'http://maps.google.com/?q=' . $address_field['#items'][0]['thoroughfare'] .
          ', ' . $address_field['#items'][0]['locality'] . ', ' . $address_field['#items'][0]['administrative_area'] .
          ' ' . $address_field['#items'][0]['postal_code'] . ', ' . $address_field['#items'][0]['country'];

        $vars['map_link'] = l(t('Click to view on map'), $map_link, array('attributes' => array('class' => 'mobile-only btn style-blue', 'target'=>'_blank')));
      }
      break;
    case 'page':
      drupal_add_js(drupal_get_path('theme', 'smo') . '/js/eventsVideoPlayer.js', 'file');

      switch ($node->nid) {
        case SMO_NEWS_NID:
          $vars['theme_hook_suggestions'][] = 'node__page__news';

          $sidebar = block_load('smo_blog', 'smo_blog_news_sidebar_block');
          $sidebar_render_array = _block_get_renderable_array(_block_render_blocks(array($sidebar)));
          $vars['sidebar'] = drupal_render($sidebar_render_array);

          $news = block_load('views', 'news-block_1');
          $news_render_array = _block_get_renderable_array(_block_render_blocks(array($news)));
          $vars['news'] = drupal_render($news_render_array);
          break;
      }
      break;
    case 'news':
      $sidebar = block_load('smo_blog', 'smo_blog_news_sidebar_block');
      $sidebar_render_array = _block_get_renderable_array(_block_render_blocks(array($sidebar)));
      $vars['sidebar'] = drupal_render($sidebar_render_array);
      break;

    case 'educators':
      $vars['mobile_museum_bg'] = file_create_url($node->field_edu_museum_first_image[LANGUAGE_NONE][0]['uri']);
      break;
  }
}

/**
 * Implements template_preprocess_field().
 */
function smo_preprocess_field(&$vars) {
//  kpr($vars);
  $node = menu_get_object();
  $element = $vars['element'];
  switch ($element['#field_name']) {
    case 'field_home_gallery':
      if(!empty($vars['element']['#object']->field_home_show_messages[LANGUAGE_NONE][0]['value'])) {
        //attach mesages
        $messages_node_field = field_view_field('node', $vars['element']['#object'], 'field_home_gallery_messages', 'default');
        $vars['messages_field_render'] = render($messages_node_field);
      }
      break;

    case 'field_sc_live_years':
      $vars['classes_array'][] = 'history-list';
      break;

    case 'field_page_form_above_title':
      $vars['classes_array'][] = 'subtitle';
      if ($node->type == 'omn'){
        $vars['classes_array'][] = 'style-a';
      }
      break;

    case 'field_page_form_below_title':
      $vars['classes_array'][] = 'subtitle';
      break;

    case 'field_admiss_table_cell1_value':
    case 'field_admiss_table_cell2_value':
    case 'field_admiss_table_cell3_value':
      $vars['theme_hook_suggestions'][] = 'field__field_admiss_table_cell1_value__field_admiss_table';
      break;

    case 'field_admiss_table_cell1_member':
    case 'field_admiss_table_cell2_member':
    case 'field_admiss_table_cell3_member':
      $vars['theme_hook_suggestions'][] = 'field__field_admiss_table_cell1_member__field_admiss_table';
      break;

    case 'field_admiss_table_cell1_suffix':
    case 'field_admiss_table_cell2_suffix':
    case 'field_admiss_table_cell3_suffix':
      $vars['theme_hook_suggestions'][] = 'field__field_admiss_table_cell1_suffix__field_admiss_table';
      break;
    case 'field_basic_content_block_table':
      if (!empty($vars['items'])) {
        $vars['classes_array'][] = 'table-wrapper-p';
        $table = &$vars['items'][0];
        $table['#attributes']['align'] = 'center';
        $table['#attributes']['border'] = 1;
        $table['#attributes']['cellpadding'] = 1;
        $table['#attributes']['cellspacing'] = 1;
        $table['#attributes']['class'][] = 'style-a';

        foreach ($table['#rows'] as &$row) {
          foreach ($row as &$cell) {
            if (!empty($cell['data'])) {
              $cell['class'][] = 'rtecenter';
              $cell['data'] = '<span class="text-large">' . $cell['data'].  '</span>';
            }
          }
        }
      }
      break;
  }
}


/**
 * Implements hook_preprocess().
 */
function smo_preprocess(&$vars, $hook) {
//  dsm($hook);
  if($hook == 'block') {
//    dsm($vars);
  }
}

/**
 * Implements template_preprocess_block().
 */
function smo_preprocess_block(&$vars) {
  if($vars['block']->module == 'views' && $vars['block']->delta == 'omn_calendar-block_1') {
    $vars['day_view'] = array('#markup' => smo_get_renderd_block('views', 'omn_calendar-block_3'));
  }
}

/**
 * Implements hook_form_alter().
 */
function smo_form_alter(&$form, &$form_state, $form_id) {

  switch($form_id) {
    case 'webform_client_form_' . SMO_NEWSLETTER_WEBFORM_NID:
    case 'webform_client_form_' . SMO_OMN_NEWSLETTER_WEBFORM_NID:
      $form['submitted']['email_address']['cc_email_address']['#attributes']['placeholder'] = t('Email');
      $form['submitted']['first_name']['#attributes']['placeholder'] = $form['submitted']['first_name']['#title'];
      $form['submitted']['last_name']['#attributes']['placeholder'] = $form['submitted']['last_name']['#title'];
      $form['submitted']['city']['#attributes']['placeholder'] = $form['submitted']['city']['#title'];
      break;
  }
}

function smo_wrap_item(&$element, $classes) {
  if (!empty($element)) {
    $element['#prefix'] = '<div class="' . $classes . '">' . (array_key_exists('#prefix', $element) ? $element['#prefix'] : '');
    $element['#suffix'] = (array_key_exists('#suffix', $element) ? $element['#suffix'] : '') . '</div>';
  }
}

/**
 * Implements theme_date_nav_title()
 * Theme the calendar title.
 */
function smo_date_nav_title($params) {
  $title  = '';
  $granularity = $params['granularity'];
  $view = $params['view'];
  $date_info = $view->date_info;
  $link = !empty($params['link']) ? $params['link'] : FALSE;
  $format = !empty($params['format']) ? $params['format'] : NULL;
  $format_with_year = variable_get('date_views_' . $granularity . '_format_with_year', 'l, F j, Y');
  $format_without_year = variable_get('date_views_' . $granularity . '_format_without_year', 'l, F j');
  switch ($granularity) {
    case 'year':
      $title = $date_info->year;
      $date_arg = $date_info->year;
      break;

    case 'month':
      $format = !empty($format) ? $format : (empty($date_info->mini) ? $format_with_year : $format_without_year);
      $title = date_format_date($date_info->min_date, 'custom', 'F Y');
      $date_arg = $date_info->year . '-' . date_pad($date_info->month);
      break;

    case 'day':
      $format = !empty($format) ? $format : (empty($date_info->mini) ? $format_with_year : $format_without_year);
      $title = date_format_date($date_info->min_date, 'custom', $format);
      $date_arg = $date_info->year;
      $date_arg .= '-';
      $date_arg .= date_pad($date_info->month);
      $date_arg .= '-';
      $date_arg .= date_pad($date_info->day);
      break;

    case 'week':
      $format = !empty($format) ? $format : (empty($date_info->mini) ? $format_with_year : $format_without_year);
      $title = t('Week of @date', array(
        '@date' => date_format_date($date_info->min_date, 'custom', $format),
      ));
      $date_arg = $date_info->year . '-W' . date_pad($date_info->week);
      break;
  }
  return $title;
}

/**
 * Implements theme_date_all_day_label().
 */
function smo_date_all_day_label() {
  return t('All Day', array(), array('context' => 'datetime'));
}

/**
 * Get full block html with contextual links.
 *
 * @param $module
 *   Name of the module that implements the block to load.
 * @param $delta
 *   Unique ID of the block within the context of $module. Pass NULL to return
 *   an empty block object for $module.
 *
 * @return string Block html
 */
function smo_get_renderd_block($module, $block_delta) {
  $block = block_load($module, $block_delta);
  if(!empty($block)) {
    $render_block = _block_render_blocks(array($block));
    $render_block_array = _block_get_renderable_array($render_block);
    return drupal_render($render_block_array);
  } else {
    return '';
  }
}

/**
 * Theme function for OFFICE_HOURS field formatter.
 * Implements theme_hours_field_formatter_default().
 */
function smo_office_hours_field_formatter_default($vars) {

  $days = $vars['days'];
  $settings = $vars['settings'];
  $daynames = $vars['daynames'];
  $open = $vars['open'];
  $short_daynames = array(
    'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'
  );
  switch ($settings['hoursformat']) {
    case 2:
      // 24hr with leading zero.
      $timeformat = 'H:i';
      break;

    case 0:
      // 24hr without leading zero.
      $timeformat = 'G:i';
      break;

    case 1:
      // 12hr ampm without leading zero.
      $timeformat = 'g:ia';
      break;
  }

  // Minimum width for day labels. Adjusted when adding new labels.
  $max_label_length = 3;

  $html_hours = '';
  $html_current_status = '';
  foreach ($days as $day => &$info) {
    // Format the label.
    $label = isset($info['endday']) ? $short_daynames[$info['startday']] : $daynames[$info['startday']];
    $label .= !isset($info['endday']) ? '' : $settings['separator_grouped_days'] . $short_daynames[$info['endday']];
    $label .= $settings['separator_day_hours'];
    $max_label_length = max($max_label_length, drupal_strlen($label));

    // Format the time.
    if (!$info['times']) {
      $times = filter_xss(t($settings['closedformat']));
    }
    else {
      $times = array();
      foreach ($info['times'] as $block_times) {
        $times[] = theme(
          'office_hours_time_range',
          array(
            'times'       => $block_times,
            'format'      => $timeformat,
            'separator'   => $settings['separator_hours_hours'],
          )
        );
      }
      $times = implode($settings['separator_more_hours'], $times);
    }

    $info['output_label'] = $label;
    $info['output_times'] = $times;
  }

  // Start the loop again - only now we have the correct $max_label_length.
  foreach ($days as $day => &$info) {
    // Remove unwanted lines.
    switch ($settings['showclosed']) {
      case 'all':
        break;

      case 'open':
        if (!isset($info['times'])) {
          continue 2;
        }
        break;

      case 'next':
        if (!$info['current'] && !$info['next']) {
          continue 2;
        }
        break;

      case 'none':
        continue 2;
        break;
    }

    // Generate HTML for Hours.
    $html_hours .= ''
      . '<span class="days">'
      . $info['output_label']
      . '</span> '
      . '<strong class="oh-display-times oh-display-' . (!$info['times'] ? 'closed' : 'hours')
      . ($info['current'] ? ' oh-display-current' : '')
      . '">'
      . $info['output_times'] . $settings['separator_days']
      . '</strong>'
      . '';
  }

  $html_hours = '' . $html_hours . '';

  // Generate HTML for CurrentStatus.
  if ($open) {
    $html_current_status = '<div class="oh-current-open">' . t($settings['current_status']['open_text']) . '</div>';
  }
  else {
    $html_current_status = '<div class="oh-current-closed">' . t($settings['current_status']['closed_text']) . '</div>';
  }

  switch ($settings['current_status']['position']) {
    case 'before':
      $html = $html_current_status . $html_hours;
      break;

    case 'after':
      $html = $html_hours . $html_current_status;
      break;

    case 'hide':
    default: // Not shown.
      $html = $html_hours;
      break;
  }

  return $html;
}

/**
 * Theme function for formatter: time ranges in OFFICE_HOURS module.
 * Implements theme_hours_time_range();
 */
function smo_office_hours_time_range($vars = array()) {
  // Add default values to $vars if not set already.
  $vars += array(
    'times' => array(
      'start' => '',
      'end' => '',
    ),
    'format' => 'G:i',
    'separator' => '-',
  );

  $starttime = _office_hours_time_format($vars['times']['start'], $vars['format']);
  $endtime = _office_hours_time_format($vars['times']['end'], $vars['format']);
  if ($endtime == '0:00' || $endtime == '00:00') {
    $endtime = '24:00';
  }
  $result = str_replace(':00', '', $starttime) . $vars['separator'] . str_replace(':00', '', $endtime);
  return $result;
}
