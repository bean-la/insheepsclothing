<?php
$options = get_site_option('_igv_site_options');
if (!empty($options['socialmedia_instagram'])) { ?>
  <div class="grid-item">
    <a href="https://instagram.com/<?php echo $options['socialmedia_instagram']; ?>" class="social-icon">
      <img src="<?php bloginfo('stylesheet_directory'); ?>/dist/img/social-instagram.png" />
    </a>
  </div>
<?php } if (!empty($options['socialmedia_facebook_url'])) { ?>
  <div class="grid-item">
    <a href="<?php echo $options['socialmedia_facebook_url']; ?>" class="social-icon">
      <img src="<?php bloginfo('stylesheet_directory'); ?>/dist/img/social-facebook.png" />
    </a>
  </div>
<?php } if (!empty($options['socialmedia_twitter'])) { ?>
  <div class="grid-item">
    <a href="https://twitter.com/<?php echo $options['socialmedia_twitter']; ?>" class="social-icon">
      <img src="<?php bloginfo('stylesheet_directory'); ?>/dist/img/social-twitter.png" />
    </a>
  </div>
<?php } ?>
