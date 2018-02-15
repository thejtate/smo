<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<?php
$events_after_close = isset($events_after_close) ? $events_after_close : '';
?>

<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>
<?php foreach ($rows as $id => $row): ?>
    <?php print $row; ?>
<?php endforeach; ?>

<?php if(!empty($close_time) && empty($events_after_close)): ?>
  <div class="item-row">
    <div class="time"><?php print $close_time?></div>
    <div class="text">
      <span>
        <div class="desc">
          <p><?php print t('Museum Closed'); ?></p>
        </div>
      </span>
    </div>
  </div>
<?php endif; ?>