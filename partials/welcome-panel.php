<?php
$options = get_site_option('_igv_site_options');
?>

<div id="welcome-panel" class="grid-row align-items-center align-content-center padding-top-mid padding-bottom-mid">
  <?php if (!empty($options['welcome_text'])) { ?>
  <div id="welcome-content" class="grid-item item-s-12 item-m-8 offset-m-2 font-mono">
    <?php echo apply_filters('the_content', $options['welcome_text']); ?>
  </div>
  <?php } ?>
  <div class="grid-item item-s-12 item-m-8 offset-m-2 margin-bottom-small">
    <p>Our website uses cookies<br><a href="<?php echo home_url('privacy-policy'); ?>" class="font-size-small">Read our privacy policy.</a></p>
  </div>
  <div class="grid-item item-s-12 item-m-8 offset-m-2 text-align-center font-size-small font-uppercase">
    <div class="small-button close-welcome"><span>I Agree</span></div>
  </div>
</div>
