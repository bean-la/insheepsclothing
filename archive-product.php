<?php
get_header();
global $wp_query;
$max_pages = $wp_query->max_num_pages;
$total_results = $wp_query->found_posts;
$list = get_query_var('list') ? get_query_var('list') : false;
$sort = get_query_var('sort') ? get_query_var('sort') : false;
$current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
$promo_message = gws_get_option('_gws_shop_promo_message');
?>
<main id="main-content">
<div class="mobile-padding-top">
  <section class="padding-top-basic padding-bottom-basic">
    <div class="shop-header margin-bottom-tiny margin-top-small">
      <div class="container grid-row">
        <div class="grid-item item-s-auto flex-grow"><span class="font-sans font-larger not-mobile">STORE</span> <span class="font-mono font-smaller"><?php echo $total_results ?> results</span></div>
        <div class="grid-item product-sort">
          <span class="font-mono">Sort by &darr;</span>
          <div class="product-sort-dropdown font-mono">
            <a href="<?php echo add_query_arg( 'sort', 'featured', get_post_type_archive_link( 'product' ) ); ?>&genre=<?php echo $_GET['genre'] ?>&format=<?php echo $_GET['format'] ?>"><div class="sort-item<?php if (get_query_var( 'sort', 1 ) === 'featured') echo ' item-selected'; ?>">Featured</div></a>
            <a href="<?php echo add_query_arg( 'sort', 'newest', get_post_type_archive_link( 'product' ) ); ?>&genre=<?php echo $_GET['genre'] ?>&format=<?php echo $_GET['format'] ?>"><div class="sort-item<?php if (get_query_var( 'sort', 1 ) === 'newest' || !get_query_var( 'sort' ) ) echo ' item-selected'; ?>">Newest</div></a>
            <a href="<?php echo add_query_arg( 'sort', 'oldest', get_post_type_archive_link( 'product' ) ); ?>&genre=<?php echo $_GET['genre'] ?>&format=<?php echo $_GET['format'] ?>"><div class="sort-item<?php if (get_query_var( 'sort', 1 ) === 'oldest') echo ' item-selected'; ?>">Oldest</div></a>
          </div>
        </div>
    </div>
    </div>
    <div class="container">
      <div class="grid-row margin-bottom-basic align-items-flex-start">
        <div class="grid-item item-s-2 flex-grow shop-sidebar font-mono">
          <div class="filter-category background-pistachio">
            <a href="#" onClick="return false;" class="sidebar-toggle">  
              <div class="font-uppercase sidebar-item-accordion grid-row" data-trigger="genre">
                <div class="grid-item no-gutter flex-grow">
                  Genre <span class="selected-amount-wrapper font-bold hidden">(<span class="selected-amount">0</span>)</span>
                </div>
                <div class="grid-item no-gutter accordion-icon plus">
                  
                </div>
              </div>
            </a>
            <div data-filter="genre" class="filter margin-top-micro closed">
              <form>
                <?php 
                  if (get_store_genre_filters()) { 
                    foreach (get_store_genre_filters() as $genre) {
                      $genre_details = get_term_by('slug', $genre, 'style');
                      $genre_name_camel_case = lcfirst(str_replace('-', '', ucwords($genre_details->name, '-')));
                    
                ?>
                  <div class="padding-bottom-micro">
                    <input id="<?php echo $genre_name_camel_case ?>" type="checkbox" name="<?php echo $genre ?>" value="<?php echo $genre_details->name ?>" />
                    <label for="<?php echo $genre_name_camel_case ?>"><?php echo $genre_details->name ?></label>
                  </div>
                <?php 
                    }
                  } 
                ?>
              </form>
            </div>
            <a href="#" onClick="return false;" class="sidebar-toggle">
              <div class="font-uppercase sidebar-item-accordion grid-row" data-trigger="format">
                <div class="grid-item no-gutter flex-grow">
                  Format <span class="selected-amount-wrapper font-bold hidden">(<span class="selected-amount">0</span>)</span>
                </div>
                <div class="grid-item no-gutter accordion-icon plus">
                  
                </div>
              </div>
            </a>
            <div data-filter="format" class="filter margin-top-micro closed">
              <form>
                <?php 
                  if (get_store_format_filters()) { 
                    foreach (get_store_format_filters() as $format) {
                      $format_details = get_term_by('slug', $format, 'format');
                      $format_name_camel_case = lcfirst(str_replace('-', '', ucwords($format_details->name, '-')));
                    
                ?>
                  <div class="padding-bottom-micro">
                    <input id="<?php echo $format_name_camel_case ?>" type="checkbox" name="<?php echo $format ?>" value="<?php echo $format_details->name ?>" />
                    <label for="<?php echo $format_name_camel_case ?>"><?php echo $format_details->name ?></label>
                  </div>
                <?php 
                    }
                  } 
                ?>
              </form>
            </div>
            <div class="<?php if (!$_GET['list']) echo 'font-bold'; ?> sidebar-item">
              <a href="<?php echo get_post_type_archive_link( 'product' ) ?>">Shop All</a>
            </div>

            <?php
            $product_lists = get_posts([
              'post_type' => 'product_list',
              'post_status' => 'publish',
              'numberposts' => -1
              // 'order'    => 'ASC'
            ]);

            foreach ( $product_lists as $list ) {
              get_template_part('partials/shop-sidebar-item', null, array('title' => $list->post_title, 'slug' => $list->post_name));
            }
            ?>
          </div>
          <?php 
        if (get_show_join_record_club_btn()) {
          ?>
          <a href="https://club.insheepsclothinghifi.com" target="_blank">
            <div class="record-club-btn">
              JOIN THE RECORD CLUB
            </div>
          </a>
          <?php
        }
          ?>
        </div>
        <div class="grid-item no-gutter item-s-10 flex-grow shop-grid">
          <div id="posts" class="grid-row" data-maxpages="<?php echo $max_pages; ?>">
          <?php
          if (have_posts()) {
            while (have_posts()) {
              the_post();
              get_template_part('partials/product-item');
            }
          } else {
            echo "<div class='margin-left-tiny'>No results.</div>";
          }
          ?>
          </div>
        </div>
      </div>
      <div class="grid-row justify-center shop-pagination">
        <div class="grid-item">
          <?php
          // Previous page link
            if ($current_page > 1) {
              echo '<a href="' . add_query_arg( 'paged', ($current_page - 1), get_post_type_archive_link( 'product' ) ) . '&sort=' . $_GET['sort'] . '&genre=' . $_GET['genre'] . '&format=' . $_GET['format'] . '">' . file_get_contents(get_stylesheet_directory() . '/assets/arrow-left.svg.php') . '</a>';
              echo '<a class="page-item" href="' . add_query_arg( 'paged', ($current_page - 1), get_post_type_archive_link( 'product' ) ) . '&sort=' . $_GET['sort'] . '&genre=' . $_GET['genre'] . '&format=' . $_GET['format'] . '">' . ($current_page - 1) . '</a>';
            }

            // Page links
            for ($i = 1; $i <= $max_pages; $i++) {
              if ($i == $current_page) {
                  echo '<span class="font-bold page-item current">' . $i . '</span>';
              }
            }

            // Next page link
            if ($current_page < $max_pages) {
              echo '<a class="page-item" href="' . add_query_arg( 'paged', ($current_page + 1), get_post_type_archive_link( 'product' ) ) . '&sort=' . $_GET['sort'] . '&genre=' . $_GET['genre'] . '&format=' . $_GET['format'] . '">' . ($current_page + 1) . '</a>';

              if ($current_page == 1) {
                echo '<a class="page-item" href="' . add_query_arg( 'paged', ($current_page + 2), get_post_type_archive_link( 'product' ) ) . '&sort=' . $_GET['sort'] . '&genre=' . $_GET['genre'] . '&format=' . $_GET['format'] . '">' . ($current_page + 2) . '</a>';
              }
              echo '<a class="next" href="'  . add_query_arg( 'paged', ($current_page + 1), get_post_type_archive_link( 'product' ) ) . '&sort=' . $_GET['sort'] . '&genre=' . $_GET['genre'] . '&format=' . $_GET['format'] . '">' . file_get_contents(get_stylesheet_directory() . '/assets/arrow-right.svg.php') . '</a>';
            }
          ?>
        </div>
      </div>
    </div>
  </section>
</div>
</main>
<?php
get_footer();
?>
