<?php
    $sendFeedbacks = R::findAll('reviews', 'promo_id = ? AND reviewer_id = ?', [$_GET['campaign'], get_user()->id]);

    $artistid  = $_POST['artistid'];
    $choose    = $_POST['choose'];
    $support   = $_POST['support'];
    $rating    = $_POST['rating'];
    $feedback  = $_POST['message'];
    $playbtns  = $_POST['listenplayer'];
    $dwnldmp3  = $_POST['downloadtrack'];
    $dwnldzip  = $_POST['downloadzip'];

    if ( isset($_POST['submit']) ) {
        $review = R::dispense('reviews');

        $review->promo_id               = $_GET['campaign'];
        $review->reviewer_id            = $artistid;
        $review->reviewer_track_rate    = $rating;
        $review->reviewer_track_support = $support;
        $review->reviewer_track_choosed = $choose;
        $review->reviewer_track_comment = $feedback;
        $review->reviewer_ip            = $_SERVER['REMOTE_ADDR'];
        $review->reviewer_time          = date('M-d-Y / H:i:s');
        if ($playbtns) {
            $review->promo_track_listened = $playbtns;
        } else {
            $review->promo_track_listened = 0;
        }
        if ($dwnldmp3) {
            $review->promo_download_track = $dwnldmp3;
        } else {
            $review->promo_download_track = 0;
        }
        if ($dwnldzip) {
            $review->promo_download_zip = $dwnldzip;
        } else {
            $review->promo_download_zip = 0;
        }

        R::store($review);
        header('Location: /promo/index.php?campaign=' .  $_GET['campaign'] . '&unique=' . hash('sha256', $_GET['campaign']) . '&result=success');
        exit;
    }