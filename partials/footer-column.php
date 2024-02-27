<?php
$options = get_site_option('_igv_site_options');
?>
<div class="mobile-only">
  <div class="grid-column">
    <?php if (!empty($options['mailchimp_action'])) { ?>
      <div class="grid-item">
        <?php get_template_part('partials/mailchimp'); ?>
      </div>
    <?php } ?>
  </div>
</div>
