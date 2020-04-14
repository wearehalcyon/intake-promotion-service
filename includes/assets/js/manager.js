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
    $("#upload_new_cover").dropzone({
        url: '/includes/uploader-new-cover.php',
        maxFiles: 1,
        acceptedFiles: '.jpg, .png',
        thumbnail: function(file, dataUrl) {
            $('img[data-dz-thumbnail]').attr('src', dataUrl);
            $('.coverPreview').html('<img src="' + dataUrl + '" />');
            $('input[name="cover"]').attr('value', file.name);
        },
        resizeWidth: 500,
        resizeHeight: 500
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
        selector:'textarea',
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
    $('.addNewTrackRow').click(function(){
        var cloneID = parseInt($('.atfRow[data-clone-id]').attr('data-clone-id')) + rowNum++;
        var namePrefix = 'track[' + (++trackIndex)  + ']';
        $('.atfRow[data-item-id="track-origin"]')
            .clone()
            .attr('data-item-id', 'track-cloned')
            .attr('name', 'trackname-' + cloneID)
            .attr('data-clone-id', cloneID)
            .appendTo('.multitrackTracklist')
            .find('input').attr('data-input-id', cloneID);
        $('input[data-input-id="' + cloneID + '"].trackname').attr('name', (namePrefix) + '[artist]');
        $('input[data-input-id="' + cloneID + '"].tracktitle').attr('name', (namePrefix) + '[title]');
        $('input[data-input-id="' + cloneID + '"].trackdescription').attr('name', (namePrefix) + '[description]');
        $('input[data-input-id="' + cloneID + '"].tracksource').attr('name', (namePrefix) + '[source]');
    });

})(jQuery);
