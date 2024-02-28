/* jshint esversion: 6, browser: true, devel: true, indent: 2, curly: true, eqeqeq: true, futurehostile: true, latedef: true, undef: true, unused: true */
/* global $, document, WP, URLSearchParams */

// Import dependencies
import lazySizes from 'lazysizes';
import Swiper from 'swiper';
import { init, track } from 'fbq';
import Player from './player';
import Mailchimp from './mailchimp';
import GWS from './shopify';

// Import style
import '../styl/site.styl';

class Site {
  constructor() {
    this.landscapeThreshold = 1024;
    this.swiperInstance = false;
    this.currentArchivePage = 1;

    this.handleSearchToggle = this.handleSearchToggle.bind(this);
    this.handleSearchSubmit = this.handleSearchSubmit.bind(this);
    this.handleSearchTag = this.handleSearchTag.bind(this);
    this.onScrollInterval = this.onScrollInterval.bind(this);
    this.onScroll = this.onScroll.bind(this);

    $(window).resize(this.onResize.bind(this));

    $(document).ready(this.onReady.bind(this));

  }

  onResize() {
    this.windowWidth = $(window).width();
    this.navbarHeight = $('#header').outerHeight();
    this.windowHeight = $(window).height();
    this.documentHeight = $(document).height();
  }

  onReady() {
    this.gws = new GWS();
    this.audioPlayer = new Player();

    this.$mainContainer = $('#main-container');

    this.windowWidth = $(window).width();
    this.navbarHeight = $('#header').outerHeight();
    this.windowHeight = $(window).height();
    this.documentHeight = $(document).height();

    this.didScroll = false;
    this.lastScrollTop = 0;
    this.delta = 5;

    const pixel = '1351098861910831';
    init(pixel);
    track('PageView');

    lazySizes.init();

    this.bindLinks();
    this.bindStreamButtons();
    this.bindFilterToggle();
    this.bindBack();
    this.setupSwiper();
    this.bindStickyHeader();
    this.bindSearchEvents();
    this.setFooterHeight();
    this.bindMobileNav();
    //this.initWelcomePanel();
    this.bindProductScroll();
    this.bindLinkCopy();
    this.bindShopFilter();

    //this.count();
    //this.thetime = 1;
  }

  count() {
    const _this = this;
    setInterval(function() {
      _this.thetime++;
      $('#counter').html(_this.thetime);
    }, 1000);
  }

  setFooterHeight() {
    const headerHeight = $('#header').outerHeight();
    const contentHeight = $('#main-content').outerHeight();
    const windowHeight = $(window).outerHeight();

    $('#footer').css('min-height', (windowHeight - (headerHeight + contentHeight)) + 'px');
  }

  initWelcomePanel() {
    const welcomeOption = localStorage.getItem('cookies-accepted');

    if (!welcomeOption) {
      $('body').addClass('welcome-open');
    }

    $('.close-welcome').on('click', function() {
      $('body').removeClass('welcome-open');
      localStorage.setItem('cookies-accepted', 'true');
    });
  }

  initShop() {
    this.gws.getShopElements();
    this.gws.initProducts();
    this.gws.initCartSection();
    this.gws.initCheckout();
  }

  bindStickyHeader() {
    $(window).scroll(this.onScroll);

    setInterval(this.onScrollInterval, 250);
  }

  onScroll() {
    this.didScroll = true;
  }

  onScrollInterval() {
    if (this.didScroll) {
      this.hasScrolled();
      this.didScroll = false;
    }
  }

  hasScrolled() {
    var scrollTop = $(window).scrollTop();

    // Make sure they scroll more than delta
    if(Math.abs(this.lastScrollTop - scrollTop) <= this.delta) {
      return;
    }



    // If they scrolled down and are past the navbar, add class .nav-up.
    // This is necessary so you never see what is "behind" the navbar.
    if (scrollTop > this.lastScrollTop && scrollTop > this.navbarHeight){
      // Scroll Down
      //$('body').removeClass('search-open');
      $('#header').removeClass('nav-down show-background').addClass('nav-up');
    } else {
      // Scroll Up
      if(scrollTop + this.windowHeight < this.documentHeight) {
        if (scrollTop > this.navbarHeight) {
          $('#header').removeClass('nav-up').addClass('nav-down show-background');
        } else {
          $('#header').removeClass('nav-up show-background').addClass('nav-down');
        }
      }
    }

    this.lastScrollTop = scrollTop;
  }

  bindMobileNav() {
    $('.toggle-nav').on('click', function() {
      $('body').toggleClass('mobile-nav-open');
    });
  }

  bindOverlayGallery() {
    $('.toggle-gallery').off().on('click', function() {
      $('body').toggleClass('gallery-open');
    });
  }

  bindLinks(selector = 'a') {
    const _this = this;

    $(selector).off().on('click', function(e) {
      const target = e.currentTarget;
      const href = $(this).attr('href');

      $(this).blur();

      if ($(target).hasClass('search-toggle')) {
        _this.handleSearchToggle(e);
        return false;
      } else if ($(target).hasClass('filter-option')) {
        return;
      } else {
        if (!href.startsWith(WP.siteUrl)) {
          return;
        }

        if ($(target).closest('.swiper-slide').length) {
          const $swiperContainer = $(target).closest('.swiper-container');
          const $slide = $(target).closest('.swiper-slide');
          /*if ($swiperContainer.attr('id') !== 'post-selection-swiper' && !$slide.hasClass('swiper-slide-active')) {
            return false;
          }*/
        }

        if ($(target).closest('.search-result').length) {
          $('body').removeClass('search-open');
        }

        const context = $(target).attr('data-context') !== undefined ? $(target).attr('data-context') : 'content';
        _this.handleRequest(href, context);

        return false;
      }
    });
  }

  bindSearchEvents() {
    this.$searchPanel = $('#search-panel');
    this.$searchForm = $('#search-form');
    this.$searchField = $('#search-field');
    this.$searchResults = $('#search-results');
    this.$searchLoadMore = $('#search-load-more');

    this.$searchForm.on('submit', this.handleSearchSubmit);
    $('#search-toggle-overlay').on('click', this.handleSearchToggle);
    this.$searchField.on('click', this.handleSearchInput);
    $('.search-tag').on('click.searchTag', this.handleSearchTag);
  }

  handleSearchInput() {
    $(this).select();
  }

  handleSearchToggle() {
    if ($('body').hasClass('search-open')) {
      this.$searchField.blur();
      $('body').removeClass('search-open');
      this.$mainContainer.css('top', 'auto');
      $(window).scrollTop(this.windowScrollTop);
    } else {
      this.windowScrollTop = $(window).scrollTop();
      this.$searchPanel.scrollTop(0);
      $('body').addClass('search-open');
      this.$mainContainer.css('top', this.windowScrollTop * -1);
      this.$searchField.focus();
    }
  }

  handleSearchSubmit(e, searchTag = false) {
    const _this = this;

    this.searchQuery = this.$searchField.val();

    if (!this.searchQuery.length && !searchTag) {
      return false;
    }

    this.searchUrl = new URL(WP.siteUrl);

    this.searchPage = 1;

    const searchSortQuery = $('.search-sort-option.active').attr('data-query');
    const sortParams = new URLSearchParams(searchSortQuery);

    if (searchTag) {
      this.searchQuery = searchTag;
      this.searchUrl = new URL(WP.siteUrl + '/tag/' + this.searchQuery);
    } else {
      this.searchUrl.searchParams.set('s', this.searchQuery);
    }

    sortParams.forEach(function(value, key) {
      _this.searchUrl.searchParams.set(key, value);
    });

    this.$searchLoadMore.addClass('hide');
    this.$searchResults.html('');

    this.currentSearchPage = 1;

    this.getSearchResults();

    return false;
  }

  getSearchResults() {
    const _this = this;
    const initialScrollTop = this.$searchPanel.scrollTop();

    $.ajax({
      url: this.searchUrl.href,
      success: function(data){
        const $newResults = $(data).find('#search-results');
        const maxPages = $newResults.data('maxpages');
        const results = $newResults.html();

        if (maxPages === 0) {
          _this.$searchResults.html('<div class="grid-item item-s-12 text-align-center"><span>Sorry, this search returned no results</span></div>');
          return;
        }

        _this.$searchResults.append(results);

        _this.$searchPanel.scrollTop(initialScrollTop);

        _this.bindLinks('#search-results a');

        if (_this.currentSearchPage === maxPages) {
          // hide load more button
          _this.$searchLoadMore.addClass('hide');
        } else {
          // iterate load more page url and show load more button
          _this.currentSearchPage++;
          _this.searchUrl.searchParams.set('paged', _this.currentSearchPage);
          _this.$searchLoadMore.attr('href', _this.searchUrl.href).removeClass('hide');
        }
      }
    });
  }

  handleSearchTag(e) {
    this.$searchField.val($(e.currentTarget).attr('data-tagname'));
    this.handleSearchSubmit(null, $(e.currentTarget).attr('data-tag'));
  }

  bindFilterToggle() {
    const _this = this;

    if ($('.filter').length) {
      $('.filter-trigger').off('click.toggleFilter').on('click.toggleFilter', function() {
        const $filter = $(this).closest('.filter');

        if ($filter.hasClass('show')) {
          $filter.removeClass('show');

          _this.unbindClickOutsideFilter();
        } else {
          $filter.siblings('.show').removeClass('show');

          $filter.addClass('show');

          _this.bindClickOutsideFilter();
        }

        return false;
      });

      $('.filter-option').off('click.updateFilter').on('click.updateFilter', function() {
        const filterText = $(this).text();
        const $filter = $(this).closest('.filter');
        const href = $(this).attr('href');

        $(this).siblings('.active').removeClass('active');
        $(this).addClass('active');

        $filter.find('.filter-value').text(filterText);
        $filter.removeClass('show');

        _this.unbindClickOutsideFilter();

        if ($filter.hasClass('collection-filter')) {
          _this.handleRequest(href, 'filter');
        } else {
          _this.handleSearchSubmit(null, false);
        }

        return false;
      });
    }
  }

  bindClickOutsideFilter() {
    $(document).off('click.outsideFilter').on('click.outsideFilter', function(e) {
      const $filter = $('.filter');
      if (!$filter.is(e.target) && $filter.has(e.target).length === 0) {
        $filter.removeClass('show');
      }
    });
  }

  unbindClickOutsideFilter() {
    $(document).off('click.outsideFilter');
  }

  pushState(data, url, context, filter) {
    const title = $(data).filter('title').text();
    this.updateMetaData(data, title, url);

    history.pushState({
      context,
      filter
    }, title, url);
  }

  updateMetaData(data, title) {
    const $meta = $(data).filter('meta');

    document.title = title;

    $.each($meta, function(index, el) {
      const prop = $(el).attr('property');
      const content = $(el).attr('content');
      if (prop) {
        if (prop.startsWith('og:')) {
          $('meta[property="' + prop + '"]').attr('content', content);
        }
      }
    });
  }

  bindBack() {
    const _this = this;
    $(window).on('popstate', function() {
      const context = history.state ? history.state.context : 'content';
      _this.handleRequest(window.location.href, context, true);
    });
  }

  handleRequest(href, context = 'content', isPop = false) {
    if (isPop) {
      this.replaceContent(href, context, isPop);
    } else {
      switch (context) {
        case 'filter':
          this.filterResults(href);
          break;
        case 'load-more':
          this.loadMore(href);
          break;
        case 'search-load-more':
          this.getSearchResults();
          break;
        default:
          this.replaceContent(href, context);
          break;
      }
    }
  }

  filterResults(href) {
    const _this = this;
    const $posts = $('#posts');
    const url = new URL(window.location.href);

    const $loadMore = $('#load-more');

    const newUrl = new URL(href);
    newUrl.searchParams.forEach(function(value, key) {
      url.searchParams.set(key, value);
    });

    $('body').addClass('filtering');

    $.ajax({
      url,
      success: function(data){
        const $newPosts = $(data).find('#posts');
        const posts = $newPosts.html();
        const maxPages = parseInt($newPosts.attr('data-maxpages'));

        $posts.html(posts);

        _this.bindLinks();
        _this.bindFilterToggle();
        _this.setupSwiper();

        _this.initShop();

        _this.pushState(data, url, 'filter', url.searchParams.toString());

        _this.currentArchivePage = 1;

        if (maxPages === 1) {
          // hide load more button
          $loadMore.addClass('hide');
        } else {
          // iterate load more page url
          url.searchParams.set('paged', 2);
          $loadMore.attr('href', url.href);
          $loadMore.removeClass('hide');
        }

        $('body').removeClass('filtering');
      }
    });
  }

  loadMore(href, postsSelector = '#posts') {
    const _this = this;
    const url = new URL(href);
    const $posts = $(postsSelector);
    const $loadMore = $('#load-more');
    const maxPages = parseInt($posts.attr('data-maxpages'));
    const nextPage = parseInt(url.searchParams.get('paged'));
    const initialScrollTop = $(window).scrollTop();

    $('body').addClass('loading-more');

    $.ajax({
      url,
      success: function(data){
        const newPosts = $(data).find(postsSelector)[0].innerHTML;

        $posts.append(newPosts);

        $(window).scrollTop(initialScrollTop);

        _this.bindLinks();
        _this.bindFilterToggle();
        _this.setupSwiper();

        _this.initShop();

        _this.currentArchivePage = nextPage;

        if (_this.currentArchivePage === maxPages) {
          // hide load more button
          $loadMore.addClass('hide');
        } else {
          // iterate load more page url
          url.searchParams.set('paged', _this.currentArchivePage + 1);
          $loadMore.attr('href', url.href);
        }

        $('body').removeClass('loading-more');
      }
    });
  }

  replaceContent(href, context, isPop) {
    const _this = this;

    $('body').addClass('loading').removeClass('welcome-open mobile-nav-open gallery-open search-open playlist-open');

    const destinationUrl = new URL(href);

    if (
      destinationUrl.pathname.indexOf('/store') > -1 ||
      destinationUrl.pathname.indexOf('/product') > -1 ||
      destinationUrl.pathname.substr(destinationUrl.pathname.length - 5) === '/cart'
    ) {
      $('body').addClass('background-pistachio');
    } else {
      $('body').removeClass('background-pistachio');
    }

    this.destroyOverlaySwiper();

    $.ajax({
      url: href,
      success: function(data){
        const content = $(data).find('#main-content').html();

        $(window).scrollTop(0);

        if (_this.swiperInstance) {
          _this.swiperInstance.destroy();
          _this.swiperInstance = false;
        }

        $('#main-content').html(content);

        _this.bindLinks();
        _this.bindFilterToggle();
        _this.setupSwiper();
        _this.bindProductScroll();

        _this.initShop();

        _this.bindStreamButtons();
        _this.replaceOverlayGallery(data);
        _this.bindShopFilter();

        if (!isPop) {
          _this.pushState(data, href, context);
        }

        $('body').removeClass('loading');

        track('PageView');
      }
    });
  }

  replaceOverlayGallery(data) {
    const $overlaySlides = $(data).find('.overlay-gallery-slide');

    if ($overlaySlides.length) {
      $('#overlay-gallery-swiper-wrapper').html($overlaySlides);
      this.setupOverlaySwiper();
    }
  }

  bindStreamButtons() {
    $('.album-stream').on('click', this.audioPlayer.handleSkip);
    $('.streaming-service').on('click', this.audioPlayer.handlePause);
  }

  setupSwiper() {
    this.setupAlbumsSwiper();
    this.setupOverlaySwiper();
    this.setupSelectionSwiper();
    this.setupCategorySwiper();
  }

  setupAlbumsSwiper() {
    const _this = this;

    if ($('#featured-albums-swiper').length) {
      const args = {
        slidesPerView: 'auto',
        loop: true,
        loopedSlides: 10,
        centeredSlides: true,
        mousewheel: {
          forceToAxis: true,
          invert: true
        },
        navigation: {
          nextEl: '.next-slide',
          prevEl: '.prev-slide'
        },
        on: {
          init: function() {
            $('#featured-albums-swiper').removeClass('hide');

            var $mouseX = 0, $mouseY = 0;
            var $xp = 0, $yp =0;
            var damp = 3;

            $(document).mousemove(function(e){
              $mouseX = e.pageX;
              $mouseY = e.pageY;
            });

            var $loop = setInterval(function(){
              // change 12 to alter damping higher is slower
              $xp += (($mouseX - $xp)/damp);
              $yp += (($mouseY - $yp)/damp);
              $("#featured-albums-swiper-pagination svg").css({left:$xp +'px', top:$yp +'px'});
            }, 30);

            _this.bindLinks('.swiper-slide a');
          },
          loopFix: function() {
            _this.bindLinks('.swiper-slide a');
          },
          slideChangeTransitionStart: function() {
            $('#featured-albums-swiper').addClass('slide-transition');
          },
          slideChangeTransitionEnd: function() {
            $('#featured-albums-swiper').removeClass('slide-transition');
          },
        }
      };

      this.albumSwiper = new Swiper ('#featured-albums-swiper', args);
    }
  }

  setupOverlaySwiper() {
    const _this = this;

    this.bindOverlayGallery();

    if ($('.overlay-gallery-slide').length && this.windowWidth >= this.landscapeThreshold) {
      const args = {
        slidesPerView: 'auto',
        loop: true,
        loopedSlides: 10,
        centeredSlides: true,
        mousewheel: {
          forceToAxis: true,
          invert: true
        },
        navigation: {
          nextEl: '.next-slide',
          prevEl: '.prev-slide'
        },
        on: {
          resize: function() {
            if (_this.windowWidth < _this.landscapeThreshold && this.overlaySwiper) {
              this.overlaySwiper.destroy(true);
            }
          }
        }
      };

      this.overlaySwiper = new Swiper ('#overlay-gallery-swiper', args);
    }
  }

  destroyOverlaySwiper() {
    if (this.overlaySwiper) {
      this.overlaySwiper.destroy(true,true);
      $('#overlay-gallery-swiper-wrapper').html('');
      this.overlaySwiper = false;
    }
  }

  setupSelectionSwiper() {
    const _this = this;

    if ($('#post-selection-swiper').length) {
      const args = {
        slidesPerView: 'auto',
        loop: false,
        centeredSlides: false,
        mousewheel: {
          forceToAxis: true,
          invert: true
        },
        navigation: {
          nextEl: '.next-slide',
          prevEl: '.prev-slide'
        },
        slideToClickedSlide: false,
        on: {
          init: function() {
            $('#post-selection-swiper').removeClass('hide');
            _this.bindLinks('.swiper-slide a');
          },
          loopFix: function() {
            _this.bindLinks('.swiper-slide a');
          },
        }
      };

      this.selectionSwiper = new Swiper ('#post-selection-swiper', args);
    }
  }

  setupCategorySwiper() {
    const _this = this;

    if ($('.post-category-swiper').length && this.windowWidth >= 650) {
      const args = {
        slidesPerView: 'auto',
        loop: false,
        centeredSlides: false,
        freeMode: true,
        simulateTouch: true,
        mousewheel: {
          sensitivity: 1,
          forceToAxis: true,
          invert: true,
        },
        scrollbar: {
          el: '.swiper-scrollbar',
          draggable: true,
          hide: false,
          snapOnRelease: false,
          dragSize: 200,
        },
        slideToClickedSlide: false,
        on: {
          init: function() {
            $('.post-category-swiper').removeClass('hide');
            _this.bindLinks('.swiper-slide a');
          },
          loopFix: function() {
            _this.bindLinks('.swiper-slide a');
          },
        }
      };

      this.selectionSwiper = new Swiper ('.post-category-swiper', args);
    } else {
      $('.post-category-swiper').removeClass('hide');
    }
  }

  bindProductScroll() {
    $(window).off('scroll.product-image');
    if ($('#product-image-holder').length) {
      const $contentHolder = $('#product-content-holder');
      const $imageHolder = $('#product-image-holder');
      const $coverHolder = $('.product-cover-holder');

      $(window).on('scroll.product-image', function() {
        const contentHeight = $contentHolder.outerHeight(true);
        const imageHeight = $imageHolder.outerHeight(true);
        const coverTop = $coverHolder.offset().top;
        const scrollTop = $(this).scrollTop();

        if (scrollTop + imageHeight >= contentHeight) {
          $imageHolder.addClass('bottom');
        } else {
          $imageHolder.removeClass('bottom');
        }

        /*if (scrollTop + imageHeight >= contentHeight) {
          $imageHolder.addClass('bottom').removeClass('fixed');
        } else if (scrollTop + 30 < coverTop) {
          $imageHolder.addClass('top').removeClass('bottom');
        } else {
          $imageHolder.removeClass('top bottom');
        }*/
      });
    }
  }

  bindLinkCopy() {
    if ($('.copy-link').length) {
      var $temp = $("<input>");
      var $url = $(location).attr('href');
      var timeout;

      $('.copy-link').on('click', function() {
        $("body").append($temp);
        $temp.val($url).select();
        document.execCommand("copy");
        $temp.remove();
        $('.copy-link-message').text("Link copied!");
        timeout = setTimeout(function() {
          $('.copy-link-message').text('');
        }, 5000);
      });
    }
  }

  fixWidows() {
    // utility class mainly for use on headines to avoid widows [single words on a new line]
    $('.js-fix-widows').each(function(){
      var string = $(this).html();
      string = string.replace(/ ([^ ]*)$/,'&nbsp;$1');
      $(this).html(string);
    });
  }

  bindShopFilter(e) {
    var queryString = window.location.search;
    var newItem = $(this).attr('name');

    var searchParams = new URLSearchParams(queryString);

    // Check query params in the URL and check the checkboxes accordingly
    
    // Genre
    var existingParams = searchParams.get('genre') ? searchParams.get('genre').split(',') : [];
    if (existingParams) {
      existingParams.forEach(function(e) {
        $('input[name="' + e + '"]').closest('.filter').removeClass('closed');
        $('div[data-trigger="genre"]').find('.plus').removeClass('plus');
        $('input[name="' + e + '"]').prop("checked", true);
      })
      if (existingParams.length > 0) {
        $('div[data-trigger="genre"] .selected-amount-wrapper').toggleClass('hidden');
        $('div[data-trigger="genre"] .selected-amount').text(existingParams.length);
      }
    }

    // Genre
    var existingParams = searchParams.get('format') ? searchParams.get('format').split(',') : [];
    if (existingParams) {
      existingParams.forEach(function(e) {
        $('input[name="' + e + '"]').closest('.filter').removeClass('closed');
        $('div[data-trigger="format"]').find('.plus').removeClass('plus');
        $('input[name="' + e + '"]').prop("checked", true);
      })
      if (existingParams.length > 0) {
        $('div[data-trigger="format"] .selected-amount-wrapper').toggleClass('hidden');
        $('div[data-trigger="format"] .selected-amount').text(existingParams.length);
      }
    }

    $('.sidebar-item-accordion').click(function(e) {
      var selector = "div[data-filter='" + $(this).data('trigger') + "']";
      $(this).find('.accordion-icon').toggleClass('plus');
      $(this).parent().parent().find(selector).toggleClass('closed');
    })

    $('.filter :checkbox').change(function() {
      var queryString = window.location.search;
      var newItem = $(this).attr('name');
      var filterType = $(this).closest('.filter').attr('data-filter');

      var searchParams = new URLSearchParams(queryString);
      var existingParams = searchParams.get(filterType) ? searchParams.get(filterType).split(',') : [];
      if ($(this).is(':checked')) {
        if (existingParams.indexOf(newItem) === -1) {
          existingParams.push(newItem)
        }
      } else {
        var index = existingParams.indexOf(newItem);
        if (index !== -1) {
          existingParams.splice(index, 1);
        }
      }
      existingParams.join(',');
      searchParams.set(filterType, existingParams);
      searchParams.set('paged', 1);

      window.location.href = "?" + searchParams;
    })
  }
}

new Site();
new Mailchimp();
