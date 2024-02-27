<?php
get_header();
?>

<main id="main-content">
<?php
global $featured_posts;
$featured_posts = array();

get_template_part('partials/home-featured-albums');
get_template_part('partials/home-featured-posts');
get_template_part('partials/home-recent-albums');
get_template_part('partials/home-recent-playlists');
get_template_part('partials/home-recent-products');
?>
</main>

<?php
get_footer();
?>
