    'use_strict';

    (function ($) {

        $('ul.player li:first-child').addClass('active');

        var wavesurfer = [];

        $('ul.player li').each(function(i){
            $(this).find('.playBtn button.btn-play').attr('id', 'track-' + i);
            /*$(this).find('.playBtn button.btn-play').on('click', function(){
                $(this).toggleClass('played');
            });*/
        });

        $('ul.player li #wavesurfer-container').each(function(i){
            var trackUrl = $(this).attr('data-src');

            $(this).attr('id', 'wavesurfer-container-' + i);

            var options = {
                container: '#wavesurfer-container-' + i,
                waveColor: '#8b939c',
                progressColor: '#00b39a',
                backend: 'MediaElement',
                backgroundColor: 'transparent',
                barGap: 2.5,
                barHeight: 1,
                barMinHeight: 1,
                barRadius: 1,
                barWidth: 1.2,
                height: 60
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
                $('#wavesurfer-container-' + i + ' .loadingTrack').fadeOut(1000);
            });

            if ($('ul.player li').hasClass('active') != true) {
                wavesurfer[i].pause();
            }

            wavesurfer[i].on('play', function () {
                $('ul.player li.active .playBtn button#track-' + i).addClass('played');
                $('ul.player li.active .playBtn button.played i').removeClass('fa-play').addClass('fa-pause');
            });

            wavesurfer[i].on('pause', function () {
                $('ul.player li.active .playBtn button#track-' + i).removeClass('played');
                $('ul.player li.active .playBtn button i').removeClass('fa-pause').addClass('fa-play');
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
            });
        });



    })(jQuery);
