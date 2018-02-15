<?php
/**
 * @file
 * acomp-blog--news-sidebar.tpl.php
 * theme sidebar blog
 */
?>


<?php if (isset($archive)): ?>
  <aside class="sidebar">
    <?php if (isset($contact) && !empty($contact)): ?>
      <div class="contacts">
        <h6><?php print t('MEDIA INQUIRIES'); ?></h6>
        <?php print $contact; ?>
      </div>
    <?php endif; ?>

    <?php if (isset($tags) && !empty($tags)): ?>
      <h6><?php print t('SORT BY CATEGORY'); ?></h6>
      <?php print $tags; ?>
    <?php endif; ?>

    <h6><?php print t('SORT BY Date'); ?></h6>
    <?php print $archive; ?>

  </aside>
<?php endif; ?>