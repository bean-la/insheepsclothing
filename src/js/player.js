/* jshint esversion: 6, browser: true, devel: true, indent: 2, curly: true, eqeqeq: true, futurehostile: true, latedef: true, undef: true, unused: true */
/* global $, document, WP */

class Player {
  constructor() {
    this.mobileThreshold = 601;
    this.playlist = null;
    this.currentTrack = null;
    this.trackIndex = 0;
    this.isPlaying = false;

    // Bind functions
    this.onReady = this.onReady.bind(this);
    this.handlePlayPause = this.handlePlayPause.bind(this);
    this.updateDuration = this.updateDuration.bind(this);
    this.handleSkip = this.handleSkip.bind(this);
    this.setCurrentTime = this.setCurrentTime.bind(this);
    this.updateCurrentTime = this.updateCurrentTime.bind(this);
    this.togglePlaylist = this.togglePlaylist.bind(this);

    $(document).ready(this.onReady);
  }

  onReady() {
    this.$mainContainer = $('#main-container');
    this.$player = $('#player');
    this.$audio = $('#player-audio');
    this.$trackTitle = $('.player-track-title');
    this.$duration = $('.player-duration');
    this.$currentTime = $('.player-current-time');
    this.$playPause = $('.player-play-pause');
    this.$skip = $('.player-skip');
    this.$playlist = $('#playlist');
    this.$playlistToggle = $('.playlist-toggle');
    this.$playerThumb = $('.player-thumb');
    this.$playerTrackInfo = $('.player-track-info');

    this.init();
  }

  shuffle(array) {
    var currentIndex = array.length, temporaryValue, randomIndex;

    // While there remain elements to shuffle...
    while (0 !== currentIndex) {

      // Pick a remaining element...
      randomIndex = Math.floor(Math.random() * currentIndex);
      currentIndex -= 1;

      // And swap it with the current element.
      temporaryValue = array[currentIndex];
      array[currentIndex] = array[randomIndex];
      array[randomIndex] = temporaryValue;
    }

    return array;
  }

  init() {
    if (WP.playerPlaylist && this.$player.length) {
      this.playlist = WP.playerShuffle ? this.shuffle(JSON.parse(WP.playerPlaylist)) : JSON.parse(WP.playerPlaylist);
      console.log(this.playlist)
      this.orderPlaylistElements();
      this.initAudio();
      this.setupSong();
    }
  }

  orderPlaylistElements() {
    var _this = this;
    var playlistItems = document.querySelectorAll('.playlist-item');
    playlistItems.forEach(function(element, index) {
      var playlistIndex = _this.playlist.findIndex(el => el.index === index);
      element.style.order = playlistIndex;
      element.dataset.index = playlistIndex;
    });
  }

  initAudio() {
    this.audio = new Audio();

    this.audio.autoplay = false;
    this.audio.loop = false;
    this.audio.addEventListener('durationchange', this.updateDuration);
    this.audio.addEventListener('ended', this.handleSkip);

    this.bindControls();
  }

  updateDuration(event) {
    const duration = this.durationToMinutesAndSeconds(event.path[0].duration);
    this.$duration.text(duration);
  }

  setupSong() {
    this.currentTrack = this.playlist[this.trackIndex];
    this.audio.src = this.currentTrack.mediaUrl;

    this.enablePlayPause();
    this.setTrackTitle();
    this.setTrackThumb();
    this.updateInfoLink();

    if (this.isPlaying) {
      this.handlePlayPause();
    }
  }

  bindControls() {
    const _this = this;
    this.$playPause.on('click', function() {
      $(this).blur();
      _this.isPlaying = !_this.isPlaying;
      _this.handlePlayPause();
    });
    this.$skip.unbind('click').on('click', function (e) {
      $(this).blur();
      _this.handleSkip(e)
    });
    this.$playlistToggle.on('click', function(e) {
      $(this).blur();
      _this.togglePlaylist(e);
    });
    this.$playerTrackInfo.on('click.togglePlaylist', function() {
      $(this).blur();
      if ($('body').hasClass('playlist-open')) {
        $('body').removeClass('playlist-open');
        this.$mainContainer.css('top', 'auto');
        $(window).scrollTop(this.windowScrollTop);
      }
    });
  }

  enablePlayPause() {
    this.$playPause.prop('disabled', false);
  }

  disablePlayPause() {
    this.$playPause.prop('disabled', true);
  }

  handlePlayPause() {
    this.$playPause.children('.player-control-icon').toggleClass('hide');

    if (this.audio.paused) {
      this.playPlayer();
    } else {
      this.pausePlayer();
    }
  }

  playPlayer() {
    this.audio.play();
    this.setCurrentTime();
  }

  pausePlayer() {
    this.audio.pause();
    clearInterval(this.timeUpdater);
  }

  handleSkip(e) {
    this.clearSong();

    if (e === undefined) {
      // track finished
      this.trackIndex = this.trackIndex === this.playlist.length - 1 ? 0 : this.trackIndex + 1;
    } else if ($(e.currentTarget).hasClass('album-stream')) {
      // stream ISC HiFi
      this.insertAlbumTrack(e.currentTarget);
    } else if ($(e.currentTarget).hasClass('playlist-item')) {
      // playlist click
      this.trackIndex = parseInt($(e.currentTarget).attr('data-index'));
    } else {
      if ($(e.currentTarget).attr('data-skip') === 'prev') {
        // skip prev
        this.trackIndex = this.trackIndex === 0 ? this.playlist.length - 1 : this.trackIndex - 1;
      } else {
        // skip next / default
        this.trackIndex = this.trackIndex === this.playlist.length - 1 ? 0 : this.trackIndex + 1;
      }
    }

    this.setupSong();
  }

  clearSong() {
    this.disablePlayPause();
    if (this.isPlaying) {
      // pause the player
      // without changing isPlaying state
      // this is important to resume playing
      // after new player is created
      this.handlePlayPause();
    }
    this.$trackTitle.html('&hellip;');
    this.$playerThumb.removeClass('show');
    this.$duration.text('0:00');
    this.$currentTime.text('0:00');
  }

  insertAlbumTrack(target) {
    const trackData = $(target).data();
    const $playlistTrack = $('.playlist-item[data-id="' + trackData.id + '"]');

    if ($playlistTrack.length) {
      // track is in playlist

      this.trackIndex = $playlistTrack.attr('data-index');

    } else {
      // create track in playlist

      const albumTrack = {
        title: trackData.title,
        thumbUrl: trackData.thumb,
        mediaUrl: trackData.media,
        relatedAlbumUrl: trackData.url
      };

      const $currentPlaylistItem = $('.playlist-item').eq(this.trackIndex);
      let $newPlaylistItem = $currentPlaylistItem.clone(true, true);

      this.trackIndex++;

      $newPlaylistItem
        .attr('data-id', trackData.id)
        .attr('data-index', this.trackIndex)
        .find('.playlist-item-title')
        .text(albumTrack.title);

      if (albumTrack.thumbUrl) {
        $newPlaylistItem.find('.playlist-item-thumb')
          .attr('src', albumTrack.thumbUrl)
          .removeClass('u-visuallyhidden');
      }
      
      $newPlaylistItem.insertAfter($currentPlaylistItem);

      this.playlist.splice(this.trackIndex, 0, albumTrack);
    }
  }

  togglePlaylist() {
    if ($('body').hasClass('playlist-open')) {
      $('body').removeClass('playlist-open');
      this.$mainContainer.css('top', 'auto');
      $(window).scrollTop(this.windowScrollTop);
    } else {
      this.windowScrollTop = $(window).scrollTop();
      this.$playlist.scrollTop(0);
      $('body').addClass('playlist-open');
      this.$mainContainer.css('top', this.windowScrollTop * -1);
    }
  }

  setTrackThumb() {
    if (this.playlist[this.trackIndex].thumbUrl) {
      // track has thumb
      this.$playerThumb.removeAttr('src')
        .attr('src', this.playlist[this.trackIndex].thumbUrl)
        .addClass('show');
    } else {
      // track doesn't have thumb
      this.$playerThumb.removeAttr('src')
        .removeClass('show');
    }
  }

  setTrackTitle() {
    this.$trackTitle.text(this.playlist[this.trackIndex].title);
  }

  updateInfoLink() {
    if (this.playlist[this.trackIndex].relatedAlbumUrl) {
      this.$playerTrackInfo.attr('href', this.playlist[this.trackIndex].relatedAlbumUrl)
        .removeClass('disabled');
    } else {
      this.$playerTrackInfo.removeAttr('href')
        .addClass('disabled');
    }
  }

  setCurrentTime() {
    this.timeUpdater = setInterval(this.updateCurrentTime, 500);
  }

  updateCurrentTime() {
    const currentTime = this.durationToMinutesAndSeconds(this.audio.currentTime);
    this.$currentTime.text(currentTime);
  }

  durationToMinutesAndSeconds(duration) {
    var minutes = Math.floor(duration / 60);
    var seconds = Math.floor(duration % 60);
    return (seconds === 60 ? (minutes + 1) + ":00" : minutes + ":" + (seconds < 10 ? "0" : "") + seconds);
  }
}

export default Player;
