<div class="<?php if ($_GET['list'] === $args['slug']) echo 'font-bold'; ?> sidebar-item">
    <a href="<?php echo get_post_type_archive_link( 'product' ) ?>?list=<?php echo $args['slug']?>&genre=<?php echo $_GET['genre'] ?>&format=<?php echo $_GET['format'] ?>"><?php echo $args['title']; ?></a>
</div>
