<div class="grid-row">
  <div class="grid-item no-gutter item-s-12 item-m-7 item-l-6 offset-l-2 grid-row margin-bottom-basic">
    <div class="grid-item item-s-3 item-m-auto">
      <span class="font-uppercase font-size-tiny">Style</span>
    </div>
    <div class="grid-item flex-grow">
      <?php
        $select_args = array(
          'filter_class' => 'collection-filter',
          'initial_value' => function() {
            $q_style = get_query_var('style');
            $active_style = get_term_by('slug', $q_style, 'style');
            echo $active_style ? $active_style->name : 'All';
          },
          'filter_options' => function() {
            $styles = get_terms('style', array(
                'hide_empty' => true,
            ));
            $q_style = get_query_var('style');

            echo '<a href="' . get_post_type_archive_link('album') . '?style=" class="filter-option ' . (!$q_style ? 'active' : '') . '" data-context="filter" data-filter="style">All</a>';

            foreach($styles as $key => $value) {
              echo '<a href="' . get_post_type_archive_link('album') . '?style=' . $value->slug . '" class="filter-option ' . ($q_style === $value->slug ? 'active' : '') . '" data-context="filter" data-filter="style">';
              echo $value->name;
              echo '</a>';
            }
          }
        );

        custom_filter($select_args);
      ?>
    </div>
  </div>
  <div class="grid-item no-gutter item-s-12 item-m-5 item-l-3 offset-l-1 grid-row margin-bottom-basic">
    <div class="grid-item item-s-3 item-m-auto">
      <span class="font-uppercase font-size-tiny">Sort By</span>
    </div>
    <div class="grid-item flex-grow">
      <?php
        $select_args = array(
          'filter_class' => 'collection-filter',
          'initial_value' => function() {
            $sort = get_query_var('sort');

            switch ($sort) {
              case 'added_newest':
                echo 'Added Newest';
                break;
              case 'added_oldest':
                echo 'Added Oldest';
                break;
              case 'artist_a_z':
                echo 'Artist A-Z';
                break;
              case 'artist_z_a':
                echo 'Artist Z-A';
                break;
              case 'release_newest':
                echo 'Release Date - Newest';
                break;
              case 'release_oldest':
                echo 'Release Date - Oldest';
                break;
              default:
                echo 'Added Newest';
            }
          },
          'filter_options' => function() {
            $sort = get_query_var('sort');
            $album_archive_url = get_post_type_archive_link('album');

            echo '<a href="' .
            $album_archive_url .
            '?sort=added_newest" class="filter-option ' .
            (!$sort || $sort === 'added_newest' ? 'active' : '') .
            '" data-context="filter" data-filter="sort">Added Newest</a>';

            echo '<a href="' .
            $album_archive_url .
            '?sort=added_oldest" class="filter-option ' .
            ($sort === 'added_oldest' ? 'active' : '') .
            '" data-context="filter" data-filter="sort">Added Oldest</a>';

            echo '<a href="' .
            $album_archive_url .
            '?sort=artist_a_z" class="filter-option ' .
            ($sort === 'artist_a_z' ? 'active' : '') .
            '" data-context="filter" data-filter="sort">Artist A–Z</a>';

            echo '<a href="' .
            $album_archive_url .
            '?sort=artist_z_a" class="filter-option ' .
            ($sort === 'artist_z_a' ? 'active' : '') .
            '" data-context="filter" data-filter="sort">Artist Z-A</a>';

            echo '<a href="' .
            $album_archive_url .
            '?sort=release_newest" class="filter-option ' .
            ($sort === 'release_newest' ? 'active' : '') .
            '" data-context="filter" data-filter="sort">Release Date - Newest</a>';

            echo '<a href="' .
            $album_archive_url .
            '?sort=release_oldest" class="filter-option ' .
            ($sort === 'release_oldest' ? 'active' : '') .
            '" data-context="filter" data-filter="sort">Release Date - Oldest</a>';
          }
        );

        custom_filter($select_args);
      ?>
    </div>
  </div>
</div>
