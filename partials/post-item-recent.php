<article <?php post_class('grid-item no-gutter item-s-12 item-m-4 grid-row align-content-start margin-bottom-basic'); ?> id="post-<?php the_ID(); ?>">
  <div class="grid-item item-s-12 margin-bottom-tiny">
    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('post-item'); ?></a>
  </div>
  <div class="grid-item item-s-12">
    <span class="font-uppercase font-size-small"><?php
      $category = get_the_category($post->ID);
      echo $category[0]->slug === 'uncategorized' ? 'Feature' : $category[0]->name;
    ?></span>
    <h2 class="font-size-large font-cond margin-bottom-tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
  </div>
  <div class="item-s-12 grid-row">
    <div class="grid-item item-s-12">
      <?php guest_authors($post->ID); ?>
    </div>
  </div>
</article>
