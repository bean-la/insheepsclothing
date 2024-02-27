<?php
$permalink = get_permalink();
$title = get_the_title();
$facebook_post = urlencode( $permalink );
$tweet = rawurlencode('From In Sheep\'s Clothing HiFi: ' . $title . ' ' . $permalink);
$email_subject = rawurlencode('From In Sheep\'s Clothing HiFi');
$email_body = rawurlencode('From In Sheep\'s Clothing HiFi: ' . $title . ' ' . $permalink);
?>

<div class="grid-row align-items-center">
  <div class="grid-item item-s-2">
    <span>Share:</span>
  </div>
  <ul class="grid-row align-items-center">
    <li class="grid-item">
      <a class="social-icon" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $facebook_post; ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/dist/img/social-facebook.png" /></a>
    </li>
    <li class="grid-item">
      <a class="social-icon" href="https://twitter.com/intent/tweet?text=<?php echo $tweet; ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/dist/img/social-twitter.png" /></a>
    </li>
    <li class="grid-item">
      <a class="social-icon" href="mailto:?&subject=<?php echo $email_subject; ?>&body=<?php echo $email_body; ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/dist/img/social-email.png" /></a>
    </li>
    <li class="grid-item grid-row align-items-center">
      <span class="social-icon copy-link u-pointer"><img src="<?php bloginfo('stylesheet_directory'); ?>/dist/img/social-copy.png" /></span><span class="padding-left-micro copy-link-message">&nbsp;</span>
    </li>
  </ul>
</div>
