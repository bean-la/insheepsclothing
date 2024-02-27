<?php
$player_options = get_site_option('_igv_player_options');
$playlist = $player_options['player_playlist'];

if (!empty($playlist)) {

get_template_part('partials/playlist');
?>

<div id="player" class="padding-bottom-tiny padding-top-tiny">
  <div class="container">
    <div id="player-main-row" class="grid-row justify-between align-items-center">

      <div class="player-track-details flex-nowrap grid-row justify-between align-items-center grid-item item-s-12 item-l-auto flex-grow no-gutter">

        <div class="grid-item">
          <div class="player-thumb-holder">
            <img class="player-thumb"/>
          </div>
        </div>

        <div class="player-name-title-holder flex-grow grid-item font-size-small">
          <div class="player-name-holder desktop-only">
            <span class="font-bold">ISCHiFi</span></span> ((ROOM RECORDING))</span>
          </div>
          <span class="player-track-title font-mono">&hellip;</span>
        </div>

        <div class="grid-item font-size-small font-mono desktop-only player-desktop-time">
          <span class="player-current-time">0:00</span><span> / </span><span class="player-duration">0:00</span>
        </div>

        <div class="grid-item not-desktop">
          <a class="player-track-info player-control grid-row align-items-center disabled">
            <div class="player-control-icon">
              <?php get_template_part('assets/info.svg'); ?>
            </div>
          </a>
        </div>

        <div class="grid-item not-desktop">
          <button class="playlist-toggle player-control grid-row align-items-center">
            <div class="player-control-icon">
              <?php get_template_part('assets/player-playlist.svg'); ?>
            </div>
          </button>
        </div>

      </div>

      <!-- I'm a little teapot -->

      <div class="grid-row justify-between align-items-center grid-item item-s-12 item-l-auto no-gutter flex-nowrap">

        <div class="grid-item font-size-small font-mono not-desktop">
          <span class="player-current-time">0:00</span>
        </div>

        <div class="grid-item">
          <button class="player-skip player-control" data-skip="prev">
            <div class="player-control-icon">
              <?php get_template_part('assets/player-prev.svg'); ?>
            </div>
          </button>
        </div>

        <div class="grid-item not-desktop">
          <button class="player-play-pause player-control" disabled>
            <div class="player-control-icon">
              <?php get_template_part('assets/player-play-mobile.svg'); ?>
            </div>
            <div class="player-control-icon hide">
              <?php get_template_part('assets/player-pause-mobile.svg'); ?>
            </div>
          </button>
        </div>

        <div class="grid-item desktop-only">
          <button class="player-play-pause player-control" disabled>
            <div class="player-control-icon">
              <?php get_template_part('assets/player-play.svg'); ?>
            </div>
            <div class="player-control-icon hide">
              <?php get_template_part('assets/player-pause.svg'); ?>
            </div>
          </button>
        </div>

        <div class="grid-item">
          <button class="player-skip player-control" data-skip="next">
            <div class="player-control-icon">
              <?php get_template_part('assets/player-next.svg'); ?>
            </div>
          </button>
        </div>

        <div class="grid-item desktop-only">
          <a class="player-track-info player-control grid-row align-items-center disabled">
            <div class="player-control-icon">
              <?php get_template_part('assets/info.svg'); ?>
            </div>
          </a>
        </div>

        <div class="grid-item desktop-only">
          <button class="playlist-toggle player-control grid-row align-items-center">
            <div class="player-control-icon">
              <?php get_template_part('assets/player-playlist.svg'); ?>
            </div>
          </button>
        </div>

        <div class="grid-item font-size-small font-mono  not-desktop">
          <span class="player-duration">0:00</span>
        </div>

      </div>

    </div>
  </div>
</div>

<?php
}
?>
