<?php
$options = get_site_option('_igv_site_options');
?>
<div id="footer-row-a" class="grid-row">

  <div class="not-mobile grid-item">
    <div class="margin-bottom-tiny"><span class="font-bold font-size-mid">ISCHiFi</span></div>
    <div class="margin-bottom-tiny"><?php get_template_part('assets/logo.svg'); ?></div>
  </div>

  <div id="footer-row-b" class="grid-item no-gutter grid-row align-items-start">

    <div id="footer-row-c" class="grid-item item-s-auto item-m-12 no-gutter grid-row">
      <div class="mobile-only grid-item">
        <div class="margin-bottom-tiny"><span class="font-bold font-size-mid">ISCHiFi</span></div>
        <div class="margin-bottom-tiny"><?php get_template_part('assets/logo.svg'); ?></div>
      </div>
      <div class="grid-item item-s-auto offset-s-1 item-m-12 no-gutter grid-row align-items-center">
      <?php if (!empty($options['mailchimp_action'])) { ?>
        <div class="grid-item item-s-12 item-m-7 item-l-6">
          <?php get_template_part('partials/mailchimp'); ?>
        </div>
      <?php } ?>
        <div id="social-holder" class="grid-item item-s-12 item-m-5 offset-l-1 grid-row no-gutter">
          <?php get_template_part('partials/footer-social'); ?>
        </div>
      </div>
    </div>

    <div id="footer-row-d" class="offset-m-1 grid-item no-gutter grid-row">
    <?php if (!empty($options['contact_address'])) { ?>
      <div class="footer-address-holder grid-item item-s-12">
        <?php echo apply_filters('the_content', $options['contact_address']); ?>
      </div>
    <?php } if (!empty($options['footer_text'])) { ?>
      <div class="grid-item item-s-6 item-m-7 item-l-6">
        <?php echo apply_filters('the_content', $options['footer_text']); ?>
      </div>
    <?php } if (!empty($options['hours'])) { ?>
      <div class="grid-item item-s-6 item-m-5 offset-l-1">
        <?php echo apply_filters('the_content', $options['hours']); ?>
      </div>
    <?php } ?>
    </div>

  </div>

</div>
