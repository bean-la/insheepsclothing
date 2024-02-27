<section id="search-form-holder">
  <div class="grid-row">
    <form id="search-form" method="get" class="flex-grow padding-bottom-small" action="<?php echo home_url('/'); ?>">
      <label for="s" class="grid-row text-align-center">
        <div class="grid-item search-label-item">
          <span class="font-uppercase font-size-tiny">Search</span>
        </div>
        <div class="flex-grow grid-row grid-item">
          <input id="search-field" type="text" class="font-size-small flex-grow search-field text-align-center font-sans" name="s" placeholder="<?php echo is_search() ? get_search_query() : ''; ?>">
        </div>
      </label>
      <!--button type="submit" id="search-submit" class="margin-top-tiny button">Submit</button-->
    </form>
    <div class="filter-wrapper grid-row item-s-12 item-l-4 padding-bottom-small">
      <div class="grid-item search-label-item">
        <span class="font-uppercase font-size-tiny">Sort By</span>
      </div>
      <div class="grid-item flex-grow">
        <?php
          $select_args = array(
            'initial_value' => function() {
              echo 'Newest';
            },
            'filter_options' => function() {
              echo '<a class="filter-option search-sort-option active" data-context="search" data-filter="sort" data-query="?orderby=date&order=DESC">Newest</a>';
              echo '<a class="filter-option search-sort-option" data-context="search" data-filter="sort" data-query="?orderby=date&order=ASC">Oldest</a>';
              echo '<a class="filter-option search-sort-option" data-context="search" data-filter="sort" data-query="?orderby=title&order=ASC">A–Z</a>';
              echo '<a class="filter-option search-sort-option" data-context="search" data-filter="sort" data-query="?orderby=title&order=DESC">Z–A</a>';
            }
          );

          custom_filter($select_args);
        ?>
      </div>
    </div>
  </div>
</section>
