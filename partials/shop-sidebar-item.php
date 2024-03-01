<div class="<?php if ($_GET['list'] === $args['slug']) echo 'font-bold'; ?> sidebar-item">
    <a href="<?php echo str_replace(home_url(), '', get_post_type_archive_link( 'product' )) ?>?list=<?php echo $args['slug']?>"><?php echo $args['title']; ?></a>
</div>
