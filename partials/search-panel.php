<div id="search-toggle-overlay"></div>
<div id="search-panel" class="padding-top-mid padding-bottom-mid">
  <?php get_search_form(); ?>
  <section class="margin-top-small">
    <div id="search-results" class="grid-row">
      <?php get_template_part('partials/search-tags'); ?>
    </div>
    <div class="grid-row justify-end">
      <div class="grid-item">
        <a id="search-load-more" class="load-more-button hide" data-context="search-load-more" href="<?php echo $load_more_url; ?>">Load More</a>
      </div>
    </div>
  </section>
</div>
