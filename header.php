<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php wp_title('|',true,'right'); bloginfo('name'); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

<?php
get_template_part('partials/globie');
get_template_part('partials/seo');
?>

  <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />

  <link rel="icon" type="image/png" sizes="32x32" href="<?php bloginfo('stylesheet_directory'); ?>/dist/img/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php bloginfo('stylesheet_directory'); ?>/dist/img/favicon-16x16.png">


  <link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo('stylesheet_directory'); ?>/dist/img/apple-touch-icon.png">

  <link rel="shortcut" href="<?php bloginfo('stylesheet_directory'); ?>/dist/img/favicon.ico">

  <link rel="manifest" href="<?php bloginfo('stylesheet_directory'); ?>/site.webmanifest">

  <link rel="preload" href="<?php bloginfo('stylesheet_directory'); ?>/dist/static/fonts/ROM-Medium.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="<?php bloginfo('stylesheet_directory'); ?>/dist/static/fonts/ROMCondensed-Medium.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="<?php bloginfo('stylesheet_directory'); ?>/dist/static/fonts/ROM-Light.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="<?php bloginfo('stylesheet_directory'); ?>/dist/static/fonts/ROMMono-Regular.woff2" as="font" type="font/woff2" crossorigin>

<?php if (is_singular() && pings_open(get_queried_object())) { ?>
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<?php } ?>

  <?php wp_head(); ?>
</head>
<?php
$classes = '';
$isStorePage = is_page('cart') || is_singular('product') || is_post_type_archive('product');
$classes .= $isStorePage ? 'background-pistachio' : '';
?>
<body <?php body_class($classes); ?>>
<!--[if lt IE 9]><p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p><![endif]-->

<section id="main-container">
  <header id="header" class="nav-down">
    <div class="container">
      <div class="grid-row padding-top-micro padding-bottom-micro align-items-center">
        <div class="grid-item grid-row flex-grow align-items-center">
          <a href="<?php echo home_url(); ?>">
            <?php get_template_part('assets/logo-isc.svg'); ?>
          </a>
        </div>
        <nav id="main-nav">
          <ul class="grid-row font-cond">
            <li class="grid-item">
              <a href="<?php echo home_url('collection'); ?>" class="toggle-nav">Collection</a>
            </li>
            <?php if (get_show_events()) { ?>
            <li class="grid-item">
              <a href="<?php echo home_url('events'); ?>" class="toggle-nav">Events</a>
            </li>
            <?php } ?>
            <li class="grid-item">
              <a href="<?php echo home_url('features'); ?>" class="toggle-nav">Features</a>
            </li>
            <li class="grid-item">
              <a href="<?php echo get_term_link('playlist', 'category'); ?>" class="toggle-nav">Playlists</a>
            </li>
            <li class="grid-item">
              <a href="<?php echo get_term_link('community', 'category'); ?>" class="toggle-nav">Community</a>
            </li>
            <li class="grid-item">
              <a href="<?php echo home_url('store'); ?>" class="toggle-nav">Store</a>
            </li>
            <li class="grid-item">
              <a class="search-toggle" href="#" class="toggle-nav">Search</a>
            </li>
            <li class="grid-item">
              <a href="<?php echo home_url('cart'); ?>"><?php get_template_part('assets/shopping-bag.svg'); ?></a>
              <span>(<span class="gws-cart-counter">0</span>)</span>
            </li>
          </ul>
        </nav>
        <div class="grid-item not-desktop">
          <div class="cart-item">
            <a href="<?php echo home_url('cart'); ?>"><?php get_template_part('assets/shopping-bag.svg'); ?></a>
            <span>(<span class="gws-cart-counter">0</span>)</span>
          </div>
        </div>
        <div id="mobile-nav-toggle" class="grid-item toggle-nav not-desktop">
          <div id="nav-toggle-open"><?php get_template_part('assets/nav-open.svg'); ?></div>
          <div id="nav-toggle-closed"><?php get_template_part('assets/nav-closed.svg'); ?></div>
        </div>
      </div>
    </div>
  </header>

  <?php //get_template_part('partials/welcome-panel'); ?>
