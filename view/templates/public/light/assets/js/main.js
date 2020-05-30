'use_strict';

(function ($) {
    // Select
    $('select').niceSelect();

    // Checkra
    $('.checkra').checkradios();

    // Player
    $('ul.player li:first-child').addClass('active');
    $('ul.trackItems li:first-child').addClass('active');

    var wavesurfer = [];

    $('ul.player li').each(function(i){
        $(this).find('.playBtn button.btn-play').attr('id', 'track-' + i);
    });

    $('ul.player li #wavesurfer-container').each(function(i){
        var trackUrl = $(this).attr('data-src');

        $(this).attr('id', 'wavesurfer-container-' + i);

        var options = {
            container: '#wavesurfer-container-' + i,
            waveColor: '#8b939c',
            progressColor: '#00b39a',
            backend: 'MediaElement',
            mediaType:'audio',
            backgroundColor: 'transparent',
            barGap: 2.5,
            barHeight: 1,
            barMinHeight: 1,
            barRadius: 1,
            barWidth: 1.2,
            height: 60,
            partialRender: false,
            pixelRatio: 1,
            responsive: true,
            splitChannels: false,
            normalize: true,
            cursorColor: '#00b39a',
        };

        wavesurfer[i] = WaveSurfer.create(options);

        wavesurfer[i].load(trackUrl);
        var buttons = {
            play: document.getElementById('track-' + i),
        };

        wavesurfer[i].on('waveform-ready', function () {
            buttons.play.addEventListener("click", function(){
                wavesurfer[i].playPause();
            }, false);
            $('#wavesurfer-container-' + i + ' .loadingTrack').fadeOut(500);
        });

        wavesurfer[i].on('loading', function (percents) {
            document.getElementById('progress-' + i).value = percents;
            $('.progress_pecents-' + i).text(percents + '%');
        });

        if ($('ul.player li').hasClass('active') != true) {
            wavesurfer[i].pause();
        }

        wavesurfer[i].on('play', function () {
            $('ul.player li.active .playBtn button#track-' + i).addClass('played');
            $('ul.player li.active .playBtn button.played i').removeClass('fa-play').addClass('fa-pause');
            $('ul.trackItems li').addClass('playing');
        });

        wavesurfer[i].on('pause', function () {
            $('ul.player li.active .playBtn button#track-' + i).removeClass('played');
            $('ul.player li.active .playBtn button i').removeClass('fa-pause').addClass('fa-play');
            $('ul.trackItems li').removeClass('playing');
        });

        wavesurfer[i].on('finish', function () {
            $('ul.player li.active .playBtn button i').removeClass('fa-pause').addClass('fa-play');
        });

    });

    $('.trackItems li').each(function(iq){
        $(this).find('a').on('click', function(){
            for (var i = 0, wsInstance; wsInstance = wavesurfer[i]; i++) {
                wsInstance.pause();
                wsInstance.on('pause', function () {
                    $('ul.player li.active .playBtn button i').removeClass('fa-pause').addClass('fa-play');
                });
            }
            $('ul.player li').removeClass('active');
            $('ul.player li[data-player-id="' + iq + '"]').addClass('active');
            $('ul.trackItems li').removeClass('active');
        });
        $(this).on('click', function(){
            $(this).addClass('active');
        });
    });

    // Listen player
    $('.playBtn button').on('click', function(){
        $('input[name="listenplayer"]').attr('value', 1);
    });

    // Download Track
    $('a.downloadTrack').on('click', function(){
        $('input[name="downloadtrack"]').attr('value', 1);
    });

    // Download ZIP
    $('a.downloadArchive').on('click', function(){
        $('input[name="downloadzip"]').attr('value', 1);
    });

})(jQuery);