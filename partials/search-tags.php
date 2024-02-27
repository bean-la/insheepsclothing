<?php
$tags = get_tags();
?>
<div class="grid-item item-s-12 grid-row">
  <div id="search-tags-holder">
    <div class="grid-item item-s-12">
      <div class="search-tags grid-column text-align-center">
        <?php foreach($tags as $tag) {?>
          <div class="search-tag" data-tag="<?= $tag->slug ?>" data-tagname="<?= $tag->name ?>">
            <span><?= $tag->name; ?></span>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
