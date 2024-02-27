<article <?php post_class('padding-bottom-basic'); ?> id="post-<?php the_ID(); ?>">
  <div class="mobile-only">
    <div class="grid-row">
      <div class="grid-item no-gutter item-s-12 grid-row">
        <div class="grid-item item-s-auto flex-grow offset-l-3">
          <?php guest_authors($post->ID); ?>
        </div>
        <div class="grid-item">
          <time datetime="<?php echo get_the_date('Y-m-d'); ?>" class="font-size-small"><?php echo get_the_date(); ?></time>
        </div>
      </div>
      <div class="grid-item item-s-12">
        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('post-item-first', array('data-no-lazysizes' => 'true')); ?></a>
      </div>
      <div class="grid-item item-s-3">
        <span class="font-uppercase"><?php
          $category = get_the_category($post->ID);
          echo $category[0]->slug === 'uncategorized' ? 'Feature' : $category[0]->name;
        ?></span>
      </div>
      <div class="grid-item item-s-9">
        <h2 class="font-cond font-size-extra"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      </div>
      <div class="grid-item item-s-12 font-mono">
        <?php the_excerpt(); ?>
      </div>
      <div class="grid-item offset-s-9">
        <a href="<?php the_permalink(); ?>"><img class="icon-clickthru" src="<?php bloginfo('stylesheet_directory'); ?>/dist/img/clickthru.png" /></a>
      </div>
    </div>
  </div>
  <div class="not-mobile">
    <div class="grid-row">
      <div class="no-gutter grid-item item-s-6 grid-row align-content-between">
        <div class="grid-item no-gutter item-s-12 grid-row">
          <div class="grid-item item-s-12 margin-bottom-small">
            <h2 class="font-cond font-size-extra"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          </div>
          <div class="grid-item no-gutter item-s-12 grid-row margin-bottom-small">
            <div class="grid-item item-s-auto flex-grow offset-l-3">
              <?php guest_authors($post->ID); ?>
            </div>
            <div class="grid-item">
              <time datetime="<?php echo get_the_date('Y-m-d'); ?>" class="font-size-small"><?php echo get_the_date(); ?></time>
            </div>
          </div>
        </div>
        <div class="grid-item item-s-12 font-mono">
          <?php the_excerpt(); ?>
        </div>
      </div>
      <div class="grid-item item-s-6">
        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('post-item-first', array('data-no-lazysizes' => 'true')); ?></a>
      </div>
    </div>
  </div>
</article>
