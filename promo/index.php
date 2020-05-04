<?php
	require('../includes/kernel.php');

	$themeFolder = R::findOne('promos', 'id = ?', [get_page()->id]);

    /**
     * Autologin
     */
    if ( $_GET['usrk'] ) {
        $artist = R::findOne( 'artists', 'artist_secret_key = ?', array( $_GET['usrk'] ) );
        $lastLogin = date('M-d-Y / H:i:s');
        $userID = $artist->id;
        $userIP = $_SERVER['REMOTE_ADDR'];
        $artist->artist_last_login = $lastLogin;
        $artist->artist_ip = $userIP;
        $reviews = R::findOne('reviews', 'reviewer_id = ?', [$userID]);
        $reviews->reviewer_logged_in = $reviews->reviewer_logged_in + 1;
        R::store($artist);
        R::store($reviews);


        if ( $_GET['usrk'] == $artist->artist_secret_key ) {
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