<?php
$featured_projects = get_post_meta($post->ID, '_igv_partner_projects', true);
if (!empty($featured_projects)) {
?>

<section class="padding-top-basic padding-bottom-basic border-box border-sides-brown background-almond">

  <div class="container">
    <div class="grid-row">
      <div class="grid-item margin-bottom-basic">
        <h2 class="font-size-mid font-uppercase">Featured Projects</h2>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="grid-row">
      <?php foreach ($featured_projects as $project) { ?>
        <div class="grid-item item-s-12 item-m-6 item-l-4 margin-bottom-basic">
          <a href="<?php echo $project['url']; ?>">
            <div><img src="<?php echo $project['image']; ?>" /></div>
            <span class="font-size-mid font-cond"><?php echo $project['title']; ?></span>
          </a>
        </div>
      <?php } ?>
    </div>
  </div>

</section>

<?php
}
?>
