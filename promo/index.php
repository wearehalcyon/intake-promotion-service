<?php
	require('../includes/kernel.php');

	$themeFolder = R::findOne('promos', 'id = ?', [get_page()->id]);

    /**
     * Autologin
     */
    if ( $_GET['usrk'] ) {
        $artist = R::findOne( 'artists', 'artist_secret_key = ?', [ $_GET['usrk'] ] );
        $lastLogin = date('M-d-Y / H:i:s');
        $userID = $artist->id;
        $userIP = $_SERVER['REMOTE_ADDR'];
        $artist->artist_last_login = $lastLogin;
        $artist->artist_ip = $userIP;
        R::store($artist);


        if ( $_GET['usrk'] == $artist->artist_secret_key ) {
            $reviews = R::findOne('reviews', 'reviewer_id = ?', [$userID]);
            if ($reviews) {
                $reviews->reviewer_logged_in = $reviews->reviewer_logged_in + 1;
                R::store($reviews);
            } else {
                $first_reviews = R::dispense('reviews');
                $first_reviews->promo_id = get_page()->id;
                $first_reviews->reviewer_id = $userID;
                $lastLogin = date('M-d-Y / H:i:s');
                $userIP = $_SERVER['REMOTE_ADDR'];
                $first_reviews->reviewer_time = $lastLogin;
                $first_reviews->reviewer_ip = $userIP;
                $first_reviews->reviewer_logged_in = $reviews->reviewer_logged_in + 1;
                R::store($first_reviews);
            }
            
            $_SESSION['logged_user'] = $artist;
            header('Location: /promo/index.php?campaign=' . $_GET['campaign'] . '&unique=' . $_GET['unique']);
            exit;
        }
    }

	/**
	 * Front Checking
	 */
	if ( $_GET ) {
		if ($_SESSION['logged_user'] && get_promo('status') == 'active') {
			if (file_exists('../view/templates/public/' . $themeFolder->promo_public_theme . '/index.php')) {
				require('../view/templates/public/' . $themeFolder->promo_public_theme . '/index.php');
				//var_dump($themeFolder);
			} else {
				echo 'Theme ERROR';
			}
		} else {
			require('unavailable.php');
		}
	} else {
		header('Location: /');
		exit;
	}