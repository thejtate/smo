<?php
/**
 * @file
 * acomp-blog--post-by-month.tpl.php
 * theme archive blog
 */
?>

<div class="fblog-archive">
  <?php if (isset($archive) && is_array($archive)) : ?>
    <ul class="fblog-archive-list">
      <?php foreach ($archive as $year => $months): ?>
        <?php $month_first = (!empty($months) && is_array($months)) ? reset($months) : ''; ?>
        <li>

          <?php if (!empty($months)) : ?>
            <?php
            $class = "";
            if (current_path() == $blog_base_path . '/all/' . $year) {
              $class = "active";
            }
            ?>
          <?php endif; ?>

          <a href="<?php print url($blog_base_path, array('query' => array('date' => $year))); ?>">
            <?php print $year; ?>
          </a>

          <?php if (!empty($months)) : ?>
            <ul class="<?php print $class; ?>">
              <?php foreach ($months as $month_name => $data): ?>
                <li>
                  <?php if (isset($data->nodes) && is_array($data->nodes)) : ?>
                    <?php
                    $class = "";
                    if (current_path() == $blog_base_path . '/all/' . $data->year . '-' . $data->month_digits) {
                      $class = "active";
                    }
                    ?>
                  <?php endif; ?>

                  <?php print l($month_name, $blog_base_path, array('query' => array('date' => $data->year . '-' . $data->month_digits))); ?>

                  <?php if (isset($data->nodes) && is_array($data->nodes)): ?>
                    <ul class="<?php print $class; ?>">
                      <?php foreach ($data->nodes as $nid => $title): ?>
                        <li><?php print l($title, 'node/' . $nid); ?></li>
                      <?php endforeach; ?>
                    </ul>
                  <?php endif; ?>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>

        </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
</div>