<?php

/**
 * @file
 * Customize the display of a complete webform.
 *
 * This file may be renamed "webform-form-[nid].tpl.php" to target a specific
 * webform on your site. Or you can leave it "webform-form.tpl.php" to affect
 * all webforms on your site.
 *
 * Available variables:
 * - $form: The complete form array.
 * - $nid: The node ID of the Webform.
 *
 * The $form array contains two main pieces:
 * - $form['submitted']: The main content of the user-created form.
 * - $form['details']: Internal information stored by Webform.
 *
 * If a preview is enabled, these keys will be available on the preview page:
 * - $form['preview_message']: The preview message renderable.
 * - $form['preview']: A renderable representing the entire submission preview.
 */
?>
<?php

  // Print out the progress bar at the top of the page
  print drupal_render($form['progressbar']);
hide($form['submitted']['email_address']['subscribe']);
$form['submitted']['email_address']['subscribe']['#title'] = 'YES, <strong>Send me updates.</strong>';
?>
  <div class="inner">
    <?php
    // Print out the preview message if on the preview page.
    if (isset($form['preview_message'])) {
      print '<div class="messages warning">';
      print drupal_render($form['preview_message']);
      print '</div>';
    }
    ?>
    <div class="item-content">
      <div class="form form-newsletter valign">
        <h4>NEWSLETTER SIGN UP</h4>
        <div class="form-group">
          <div class="width-33">
            <div class="form-item form-type-text">
              <?php print render($form['submitted']['email_address']);?>
            </div>
          </div>
          <div class="width-33">
            <div class="form-item form-type-text">
              <?php print render($form['submitted']['first_name']);?>
            </div>
          </div>
          <div class="width-33">
            <div class="form-item form-type-text">
              <?php print render($form['submitted']['last_name']);?>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="width-33">
            <div class="form-item form-type-text">
              <?php print render($form['submitted']['city']);?>
            </div>
          </div>
          <div class="width-20">
            <div class="form-item form-type-select">
              <?php print render($form['submitted']['state']);?>
            </div>
          </div>
          <div class="width-29">
              <?php print render($form['submitted']['email_address']['subscribe']); ?>
          </div>
          <div class="width-17">
            <?php hide($form['actions']);?>
            <div class="form-actions btns-wrap style-purple">
                <?php print drupal_render($form['actions']['submit']); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
    // Print out the main part of the form.
    // Feel free to break this up and move the pieces within the array.
    print drupal_render($form['submitted']);

    // Always print out the entire $form. This renders the remaining pieces of the
    // form that haven't yet been rendered above (buttons, hidden elements, etc).
    print drupal_render_children($form);
    ?>
  </div>

