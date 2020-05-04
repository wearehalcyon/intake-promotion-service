'use_strict';

(function ($) {

    // Create New Tracklist
    $('.editableCreateNewTracklist button').click(function(){
        $(this).addClass('active');
        $('.ditableTracklist, .editableAddTrackButton').fadeIn();
    });
    $('button.hideTracklistCreator').click(function(){
        $('.ditableTracklist, .editableAddTrackButton').fadeOut();
        $('.editableCreateNewTracklist button').removeClass('active');
    });

    // Play Preview
    $(document).ready(function(){
        var wavesurfer = WaveSurfer.create({
            container: '#wavesurfer',
            waveColor: '#373f48',
            progressColor: '#3dd0b5',
            backgroundColor: 'transparent',
            backend: 'WebAudio',
            barHeight: 1.5,
            barWidth: 1,
            height: 50,
            barGap: 2
        });
        $('button.playTrack').click(function(){
            $('button.playTrack').removeClass('played');
            $('#wavesurfer').addClass('active');
            var prevSrc = $(this).attr('data-preview-src');
            $(this).toggleClass('played');
            wavesurfer.on('ready', function () {
                wavesurfer.play();
            });
            wavesurfer.load(prevSrc);
        });
    });

})(jQuery);
