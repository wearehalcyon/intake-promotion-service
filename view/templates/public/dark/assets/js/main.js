'use_strict';

(function ($) {

    // Player
    $('ul.player li:first-child, ul.player li:first-child .wavesurfer-player, ul.trackItems li:first-child a').addClass('active');
    $('ul.trackItems li:first-child').addClass('active');

    // Activity
    $('ul.trackItems li a').on('click', function(){
        $('ul.trackItems li, ul.trackItems li a').removeClass('active');
        $(this).addClass('active');
        wavesurfer.load(trackSrc);
    });

    // Wavesurfer
    var trackSrc = $('.trackItems li a.active').attr('data-track-url');
    $('ul.player li.active .playBtn').html('<input type="button" id="btn-play" value="Play" disabled="disabled"/><input type="button" id="btn-pause" value="Pause" disabled="disabled"/><input type="button" id="btn-stop" value="Stop" disabled="disabled" />');

    var buttons = {
        play: document.getElementById("btn-play"),
        pause: document.getElementById("btn-pause"),
        stop: document.getElementById("btn-stop")
    };

    var wavesurfer = WaveSurfer.create({
        container: 'ul.player li.active #wavesurfer-container',
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
    });


    // Handle Play button
    buttons.play.addEventListener("click", function(){
        wavesurfer.play();

        // Enable/Disable respectively buttons
        buttons.stop.disabled = false;
        buttons.pause.disabled = false;
        buttons.play.disabled = true;
    }, false);

    // Handle Pause button
    buttons.pause.addEventListener("click", function(){
        wavesurfer.pause();

        // Enable/Disable respectively buttons
        buttons.pause.disabled = true;
        buttons.play.disabled = false;
    }, false);


    // Handle Stop button
    buttons.stop.addEventListener("click", function(){
        wavesurfer.stop();

        // Enable/Disable respectively buttons
        buttons.pause.disabled = true;
        buttons.play.disabled = false;
        buttons.stop.disabled = true;
    }, false);


    // Add a listener to enable the play button once it's ready
    wavesurfer.on('ready', function () {
        buttons.play.disabled = false;
    });

    wavesurfer.on("ready", function(){
        // Do something when the file has been loaded

        // Do whatever you need to do with the player
        wavesurfer.play();
        wavesurfer.pause();
        wavesurfer.stop();
    });


})(jQuery);
