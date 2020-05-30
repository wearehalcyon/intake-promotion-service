'use_strict';

(function ($) {

    $('a.userIcon').click(function(){
        $(this).toggleClass('active');
        $('.userMetaSubNav').toggleClass('active');
    });

    // Open Debuger
    $('button.openDebug').click(function(){
        $(this).toggleClass('active');
        $('.debugPan').toggleClass('active');
    });

    // Nice select
    $('.select').niceSelect();

    // Photo Changer
    $('.changePhotoButton button.changePhoto, button.changeLabelLogo').click(function(){
        $(this).toggleClass('active');
        $('.PhotoUploaderPopup').toggleClass('active');
    });
    $('button.changeLabelbanner').click(function(){
        $(this).toggleClass('active');
        $('.PhotoUploaderBannerPopup').toggleClass('active');
    });
    $("#upload_photo").dropzone({
        url: '/includes/uploader-account.php',
        maxFiles: 1,
        acceptedFiles: '.jpg, .png',
        thumbnail: function(file, dataUrl) {
            $('.userPhoto img, img[data-dz-thumbnail]').attr('src', dataUrl);
            setTimeout(function() {
                $('.PhotoUploaderPopup').removeClass('active');
                window.location.replace('/manager/index.php?page=account-settings');
            }, 2000);
        },
        resizeMethod: 'crop'
    });
    $("#upload_photo_manager").dropzone({
        url: '/includes/uploader-manager.php',
        maxFiles: 1,
        acceptedFiles: '.jpg, .png',
        thumbnail: function(file, dataUrl) {
            $('.userPhoto img, img[data-dz-thumbnail]').attr('src', dataUrl);
            setTimeout(function() {
                $('.PhotoUploaderPopup').removeClass('active');
                window.location.replace('/manager/index.php?page=settings');
            }, 2000);
        },
        resizeMethod: 'crop'
    });
    $("#upload_photo_banner").dropzone({
        url: '/includes/uploader-banner.php',
        maxFiles: 1,
        acceptedFiles: '.jpg, .png',
        thumbnail: function(file, dataUrl) {
            $('.userPhoto img, img[data-dz-thumbnail]').attr('src', dataUrl);
            setTimeout(function() {
                $('.PhotoUploaderPopup').removeClass('active');
                window.location.replace('/manager/index.php?page=settings');
            }, 2000);
        },
        resizeMethod: 'crop'
    });
    $("#upload_new_cover").dropzone({
        url: '/includes/uploader-new-cover.php',
        maxFiles: 1,
        acceptedFiles: '.jpg, .png',
        thumbnail: function(file, dataUrl) {
            $('img[data-dz-thumbnail]').attr('src', dataUrl);
            $('.coverPreview').html('<img src="' + dataUrl + '" />');
            $('input[name="cover"]').attr('value', file.name);
        },
        success: function(){
            $('.campaignNewContent #dropzone.photoChanger').fadeOut();
        },
        resizeWidth: 500,
        resizeHeight: 500,
        resizeMethod: 'crop'
    });

    // Fancybox 3
    $('[data-fancybox]').fancybox({
        // Options will go here
    });

    // Refresh CPU
    setInterval(function(){
        $('.cpuNum').load('/includes/vendor/debuger-cpu.php').fadeIn("slow");
    }, 500);

    // Changing Account Details
    $('button.changeDetails').click(function(){
        $(this).toggleClass('active');
        $('.changingAccDetails').toggleClass('active');
    });

    // Init TinyMCE
    tinymce.init({
        selector:'.newCampaignCard textarea',
        height: 300
    });

    // Flat Datepicker
    flatpickr('#flatpickr',{
        dateFormat: 'F d Y'
    });

    // Delete Row
    $('.deleteCampaignQuckly form').submit(function(){
        if(confirm('Do you really want to delete this Campaign?')) {
            return true;
        }

        return false;
    });

    // Tracklist Repeater
    var rowNum = 1;
    var trackIndex = $('addNewTrackRow input').length + 1;
    var dzID = $('.addNewTrackRow input').length + 1;

    $('#upload_track_1').dropzone({
        url: '/includes/uploader-track.php',
        maxFiles: 1,
        acceptedFiles: '.mp3',
        thumbnail: function(file, dataUrl) {
            $('.dz-image img').attr('src', '/includes/assets/images/mp3.png');
        },
        success: function(file){
            $('input[data-input-id="1"].tracksource').attr('value', file.name);
            $('#upload_track_1 .dz-image img').attr('src', '/includes/assets/images/mp3.png');
        },
    });

    $('.addNewTrackRow').click(function(){
        var cloneID = parseInt($('.atfRow[data-clone-id]').attr('data-clone-id')) + rowNum++;
        var namePrefix = 'track[' + (++trackIndex)  + ']';
        $('.atfRow[data-item-id="track-origin"]')
            .clone()
            .attr('data-item-id', 'track-cloned')
            .attr('name', 'trackname-' + cloneID)
            .attr('data-clone-id', cloneID)
            .appendTo('.multitrackTracklist')
            .find('input, .upload_track').attr('data-input-id', cloneID);
        $('input[data-input-id="' + cloneID + '"].trackname').attr('name', (namePrefix) + '[artist]');
        $('input[data-input-id="' + cloneID + '"].tracktitle').attr('name', (namePrefix) + '[title]');
        $('input[data-input-id="' + cloneID + '"].trackdescription').attr('name', (namePrefix) + '[description]');
        $('input[data-input-id="' + cloneID + '"].tracksource').attr('name', (namePrefix) + '[source]');
        //$('input[data-input-id="' + cloneID + '"].trackupload').attr('name', (namePrefix) + '[upload]');
        //$('input[data-input-id="' + cloneID + '"].getuploader').attr('data-uploader-id', cloneID);

        $('input[data-input-id="' + cloneID + '"].trackname').attr('value', '');
        $('input[data-input-id="' + cloneID + '"].tracktitle').attr('value', '');
        $('input[data-input-id="' + cloneID + '"].trackdescription').attr('value', '');
        $('input[data-input-id="' + cloneID + '"].tracksource').attr('value', '');
        $('.upload_track[data-input-id="' + cloneID + '"] .dz-message').css('display', 'block');
        $('.upload_track[data-input-id="' + cloneID + '"] .dz-preview').css('display', 'none');

        $('.upload_track[data-input-id="' + cloneID + '"]').attr('id', 'upload_track_' + cloneID).dropzone({
            url: '/includes/uploader-track.php',
            maxFiles: 1,
            acceptedFiles: '.mp3',
            thumbnail: function(file, dataUrl) {
                $('.dz-image img').attr('src', '/includes/assets/images/mp3.png');
            },
            success: function(file){
                $('input[data-input-id="' + cloneID + '"].tracksource').attr('value', file.name);
                $('.dz-image img').attr('src', '/includes/assets/images/mp3.png');
                $('.upload_track[data-input-id="' + cloneID + '"] .dz-message').css('display', 'none');
                $(this).remove();
            },
        });
    });

    // Terminal
    $('.terminal').draggable();
    document.onkeydown = function(e) {
        var keycode = 192;
        if (e.which == keycode) {
            $('.terminal').toggleClass('active');
        }
    };
    $('span.close_terminal').click(function(){
        $('.terminal').removeClass('active');
    });

    var get_terminal_cmd = $('.terminalCMDs p textarea').val();
    if ( get_terminal_cmd == 'exit' ){
        $('.terminal').removeClass('active');
    }

    /**
     * Mobile menu button
     */
    $('.mobileNavButton button').click(function(){
        $(this).toggleClass('active');
        $('.sidebarNav').toggleClass('active');
    });

    /**
     * Artists List Filter
     */
    $('select.artists_filter').on('change', function(){
        //alert('Changed to' + $(this).val());
        if ( $(this).val() == 'list_all' ) {
            window.location.href = '/manager/index.php?page=artists';
        } else {
            window.location.href = '/manager/index.php?page=artists&list=' + $(this).val();
        }
    });

})(jQuery);
