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
        <div class="grid-item item-s-auto flex-grow"><span class="font-sans font-bold">SHOP</span> <span class="font-mono"><?php echo $total_results ?> results</span></div>
        <div class="grid-item product-sort">
          <span class="font-mono">Sort by &darr;</span>
          <div class="product-sort-dropdown font-mono">
            <a href="<?php echo site_url() . add_query_arg( 'sort', 'featured' ); ?>"><div class="sort-item<?php if (get_query_var( 'sort', 1 ) === 'featured') echo ' item-selected'; ?>">Featured</div></a>
            <a href="<?php echo site_url() . add_query_arg( 'sort', 'newest' ); ?>"><div class="sort-item<?php if (get_query_var( 'sort', 1 ) === 'newest' || !get_query_var( 'sort' ) ) echo ' item-selected'; ?>">Newest</div></a>
            <a href="<?php echo site_url() . add_query_arg( 'sort', 'oldest' ); ?>"><div class="sort-item<?php if (get_query_var( 'sort', 1 ) === 'oldest') echo ' item-selected'; ?>">Oldest</div></a>
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
                  Genre
                </div>
                <div class="grid-item no-gutter accordion-icon plus">
                  
                </div>
              </div>
            </a>
            <div data-filter="genre" class="filter margin-top-micro closed">
              <form>
                <div class="padding-bottom-micro">
                  <input id="ambientCheckbox" type="checkbox" name="ambient" value="Ambient" />
                  <label for="ambientCheckbox">Ambient</label>
                </div>
                <div class="padding-bottom-micro">
                  <input id="electronicCheckbox" type="checkbox" name="electronic" value="Electronic" />
                  <label for="electronicCheckbox">Electronic</label>
                </div>
                <div class="padding-bottom-micro">
                  <input id="danceCheckbox" type="checkbox" name="dance" value="Dance" />
                  <label for="danceCheckbox">Dance</label>
                </div>
                <div class="padding-bottom-micro">
                  <input id="jazzCheckbox" type="checkbox" name="jazz" value="Jazz" />
                  <label for="jazzCheckbox">Jazz</label>
                </div>
                <div class="padding-bottom-micro">
                  <input id="dubReggaeCheckbox" type="checkbox" name="dub-reggae" value="Dub / Reggae" />
                  <label for="dubReggaeCheckbox">Dub / Reggae</label>
                </div>
                <div class="padding-bottom-micro">
                  <input id="rockFolkCheckbox" type="checkbox" name="rock-folk" value="Rock / Folk" />
                  <label for="rockFolkCheckbox">Rock / Folk</label>
                </div>
                <div class="padding-bottom-micro">
                  <input id="soulCheckbox" type="checkbox" name="soul" value="Soul" />
                  <label for="soulCheckbox">Soul</label>
                </div>
                <div class="padding-bottom-micro">
                  <input id="japanCheckbox" type="checkbox" name="japan" value="Japan" />
                  <label for="japanCheckbox">Japan</label>
                </div>
                <div class="padding-bottom-micro">
                  <input id="africaCheckbox" type="checkbox" name="africa" value="Africa" />
                  <label for="africaCheckbox">Africa</label>
                </div>
                <div class="padding-bottom-micro">
                  <input id="southAmericaCheckbox" type="checkbox" name="south-america" value="South America" />
                  <label for="southAmericaCheckbox">South America</label>
                </div>
                <div class="padding-bottom-micro">
                  <input id="globalMiscCheckbox" type="checkbox" name="global-misc" value="Global Misc." />
                  <label for="globalMiscCheckbox">Global Misc.</label>
                </div>
              </form>
            </div>
            <a href="#" onClick="return false;" class="sidebar-toggle">
              <div class="font-uppercase sidebar-item-accordion grid-row" data-trigger="format">
                <div class="grid-item no-gutter flex-grow">
                  Format
                </div>
                <div class="grid-item no-gutter accordion-icon plus">
                  
                </div>
              </div>
            </a>
            <div data-filter="format" class="filter margin-top-micro closed">
              <form>
                <div class="padding-bottom-micro">
                  <input id="vinylNewCheckbox" type="checkbox" name="vinyl-new" value="Vinyl New" />
                  <label for="vinylNewCheckbox">Vinyl New</label>
                </div>
                <div class="padding-bottom-micro">
                  <input id="vinylUsedCheckbox" type="checkbox" name="vinyl-used" value="Vinyl Used" />
                  <label for="vinylUsedCheckbox">Vinyl Used</label>
                </div>
                <div class="padding-bottom-micro">
                  <input id="cassetteCheckbox" type="checkbox" name="cassette" value="Cassette" />
                  <label for="cassetteCheckbox">Cassette</label>
                </div>
                <div class="padding-bottom-micro">
                  <input id="merchandiseCheckbox" type="checkbox" name="merchandise" value="Merchandise" />
                  <label for="merchandiseCheckbox">Merchandise</label>
                </div>
                <div class="padding-bottom-micro">
                  <input id="booksTapeCheckbox" type="checkbox" name="books-tape" value="Books & Tape" />
                  <label for="booksTapeCheckbox">Books & Tape</label>
                </div>
              </form>
            </div>
            <div class="<?php if (!$_GET['list']) echo 'font-bold'; ?> sidebar-item">
              <a href="<?php echo get_site_url(); ?>/store">Shop All</a>
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
        <div class="grid-item item-s-10 flex-grow shop-grid">
          <div id="posts" class="grid-row" data-maxpages="<?php echo $max_pages; ?>">
          <?php
          if (have_posts()) {
            while (have_posts()) {
              the_post();
              get_template_part('partials/product-item');
            }
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
              echo '<a href="' . site_url() . add_query_arg( 'paged', ($current_page - 1) ) . '">' . file_get_contents(get_stylesheet_directory() . '/assets/arrow-left.svg.php') . '</a>';
            }

            // Page links
            for ($i = 1; $i <= $max_pages; $i++) {
              if ($i == $current_page) {
                  echo '<span class="font-bold page-item current">' . $i . '</span>';
              } else {
                  echo '<a class="page-item" href="' . site_url() . add_query_arg( 'paged', $i ) . '">' . $i . '</a>';
              }
            }

            // Next page link
            if ($current_page < $max_pages) {
              echo '<a class="next" href="'  . site_url() . add_query_arg( 'paged', ($current_page + 1) ) . '">' . file_get_contents(get_stylesheet_directory() . '/assets/arrow-right.svg.php') . '</a>';
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
