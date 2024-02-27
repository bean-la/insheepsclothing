<article <?php post_class('grid-item no-gutter item-s-12 item-m-6 grid-column margin-bottom-basic'); ?> id="post-<?php the_ID(); ?>">
  <div class="grid-row margin-bottom-tiny">
    <div class="grid-item item-s-auto flex-grow offset-l-3">
      <?php guest_authors($post->ID); ?>
    </div>
    <div class="grid-item">
      <time datetime="<?php echo get_the_date('Y-m-d'); ?>" class="font-size-small"><?php echo get_the_date(); ?></time>
    </div>
  </div>
  <div class="grid-item margin-bottom-tiny">
    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('post-item'); ?></a>
  </div>
  <div class="grid-row margin-bottom-tiny">
    <!--div class="grid-item item-s-3">
      <span class="font-uppercase post-item-type font-size-small"><?php
        $category = get_the_category($post->ID);
        echo $category[0]->slug === 'uncategorized' ? 'Feature' : $category[0]->name;
      ?></span>
    </div-->
    <div class="grid-item item-s-9">
      <h2 class="font-cond font-size-large"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    </div>
  </div>
  <div class="grid-item font-mono font-color-grey">
    <?php the_excerpt(); ?>
  </div>
  <div class="grid-item flex-grow grid-row align-content-end">
    <div class="offset-s-9">
      <a href="<?php the_permalink(); ?>"><img class="icon-clickthru" src="<?php bloginfo('stylesheet_directory'); ?>/dist/img/clickthru.png" /></a>
    </div>
  </div>
</article>
