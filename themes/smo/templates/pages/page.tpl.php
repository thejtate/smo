<?php

/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see html.tpl.php
 *
 * @ingroup themeable
 */
$path = base_path() . path_to_theme();
$hide_title = isset($hide_title) ? $hide_title : FALSE;
$disable_parallax = isset($disable_parallax) ? $disable_parallax : FALSE;
$mobile_top_image = isset($mobile_top_image) ? $mobile_top_image : '';
?>
  <div id="page-wrapper" class="outer-wrapper"><div id="page" class="inner-wrapper">

    <header id="site-header" class="site-header">

        <!-- Facebook Pixel Code -->
        <script>
          !function(f,b,e,v,n,t,s)
          {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
          n.callMethod.apply(n,arguments):n.queue.push(arguments)};
          if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
          n.queue=[];t=b.createElement(e);t.async=!0;
          t.src=v;s=b.getElementsByTagName(e)[0];
          s.parentNode.insertBefore(t,s)}(window, document,'script',
          'https://connect.facebook.net/en_US/fbevents.js');
          fbq('init', '130412187582338');
          fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none"
          src="https://www.facebook.com/tr?id=130412187582338&ev=PageView&noscript=1"
        /></noscript>
        <!-- End Facebook Pixel Code -->

      <div class="container">
        <?php if($site_name): ?>
          <a class="btn-mobile" href="#"></a>
        <?php endif; ?>
      <?php if ($logo): ?>
        <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo" class="logo">
          <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
          <img class="mobile" src="<?php print $path . '/images/logo.png'?>" alt="<?php print t('Home'); ?>"/>
        </a>
      <?php endif; ?>
          <div class="top-header">
            <?php if(!empty($social_links) && is_array($social_links)): ?>
              <div class="social-links">
                <ul>
                  <?php foreach($social_links as $name => $link): ?>
                    <?php if(!empty($link)): ?>
                      <li><a class="ss-social-regular ss-<?php print $name ?>" href="<?php print $link;?>" target="_blank"></a></li>
                    <?php endif; ?>
                  <?php endforeach; ?>
                </ul>
              </div>
            <?php endif; ?>
            <div class="navigation">
              <?php print render($page['top_header']); ?>
            </div>
          </div>
          <div class="bottom-header">
            <?php print render($page['header']); ?>
            <div class="navigation mobile">
              <?php print render($page['top_header']); ?>
              <?php if(!empty($donation)): ?>
                <ul>
                  <li>
                    <a href="<?php print $donation ?>"><?php print t(
                        'Donate'
                      ); ?></a>
                  </li>
                </ul>
              <?php endif; ?>
            </div>
            <?php if(!empty($social_links) && is_array($social_links)): ?>
              <div class="social-links mobile">
                <ul>
                  <?php foreach($social_links as $name =>  $link): ?>
                    <?php if(!empty($link)): ?>
                      <li><a class="ss-social-regular ss-<?php print $name ?>" href="<?php print $link;?>" target="_blank"></a></li>
                    <?php endif; ?>
                  <?php endforeach; ?>
                </ul>
              </div>
            <?php endif; ?>
          </div>
        <?php if(!empty($donation)): ?>
          <a class="link" href="<?php print $donation?>"><?php print t('Donate'); ?></a>
        <?php endif; ?>
        <div class="btn-tickets"><a href="<?php print $tickets?>"><span class="ss-ticket"><?php print t('Admissions'); ?></span></a></div>
      </div>
    </header> <!-- /.section, /#header -->
    <?php print render($page['after_header']); ?>
    <?php if ($tabs): ?><div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
      <?php if(!empty($title) || !empty($top_image)): ?>

        <section class="section section-top <?php print (!empty($top_image)) ? 'with-image' : 'without-image'; ?> <?php print (!$disable_parallax) ? 'with-parallax' : ''; ?>">

          <?php if (!empty($top_image)): ?>
            <div class="bg">
              <img src="<?php print $top_image; ?>" alt=""/>
            </div>
          <?php endif; ?>
          <?php if (!empty($mobile_top_image)): ?>
            <div class="bg-mobile">
              <?php print render ($mobile_top_image); ?>
            </div>
          <?php endif; ?>

          <?php print render($title_prefix); ?>
          <?php if ($title): ?>
            
            <div class="container text<?php print (!empty($logo_image) ? ' with-logo' : '');?>">
              
              <?php if (!empty($logo_image)): ?>                
                <div class="logo">               
                  <?php print render ($logo_image)?>
                </div>
              <?php endif;?>

              <?php if (!$hide_title): ?>
                <?php print render($above_title_text);?>
                  <h1 class="title" id="page-title"><?php print $title; ?></h1>
                <?php print render($below_title_text);?>
              <?php endif; ?>
            </div>
          <?php endif; ?>

          <?php print render($title_suffix); ?>

        </section>
      <?php endif; ?>
    <?php print $messages; ?>
    <div id="main-wrapper" class="<?php print isset($content_class) ? $content_class : ''; ?>">
      <div id="main" class="<?php print isset($container_class) ? $container_class : ''; ?>">
          <div id="content" class="column"><div class="section">
            <a id="main-content"></a>

            <?php print render($page['help']); ?>
            <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
              <?php print render($page['content_top']); ?>
            <?php print render($page['content']); ?>
            <?php print $feed_icons; ?>
          </div></div> <!-- /.section, /#content -->

      </div> <!-- /#main -->
      <?php print render($page['content_bottom']); ?>
    </div> <!-- /#main -->

      <footer id="site-footer" class="site-footer">
        <div class="container">
          <div class="top-footer">
            <?php print render($page['top_footer']); ?>
          </div>
          <div class="bottom-footer">
            <div class="logo">
              <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo" href="<?php print $front_page; ?>">
                <img src="<?php print $path;?>/images/logo.png" alt="">
              </a>
            </div>
            <div class="navigation">
            <?php print render($page['footer']); ?>
            </div>
            <?php if(!empty($social_links) && is_array($social_links)): ?>
              <div class="social-links">
                <ul>
                  <?php foreach ($social_links as $name => $link): ?>
                    <?php if (!empty($link)): ?>
                      <li><a class="ss-social-regular ss-<?php print $name ?>"
                             href="<?php print $link; ?>" target="_blank"></a>
                      </li>
                    <?php endif; ?>
                  <?php endforeach; ?>
                </ul>
              </div>
            <?php endif; ?>
            <p class="copy"><?php print($location);?>  •&nbsp;<?php print($phone);?></p>
          </div>
        </div>
      </footer>

    <div id="footer"><div class="section">

    </div></div> <!-- /.section, /#footer -->

  </div></div> <!-- /#page, /#page-wrapper -->
