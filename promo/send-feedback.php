<?php
    $sendFeedbacks = R::findAll('reviews', 'promo_id = ? AND reviewer_id = ?', [$_GET['campaign'], get_user()->id]);

    $artistid  = $_POST['artistid'];
    $choose    = $_POST['choose'];
    $support   = $_POST['support'];
    $rating    = $_POST['rating'];
    $feedback  = $_POST['message'];

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

        R::store($review);
        header('Location: /promo/index.php?campaign=' .  $_GET['campaign'] . '&unique=' . hash('sha256', $_GET['campaign']) . '&result=success');
        exit;
    }