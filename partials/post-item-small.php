<article <?php post_class('grid-item item-s-12 item-m-4 margin-bottom-basic'); ?> id="post-<?php the_ID(); ?>">
  <div class="margin-bottom-tiny">
    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('post-item-small'); ?></a>
  </div>
  <div>
    <h2 class="font-size-large font-cond margin-bottom-tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
  </div>
  <div class="grid-row">
    <div class="item-s-6">
      <?php guest_authors($post->ID); ?>
    </div>
  </div>
</article>
