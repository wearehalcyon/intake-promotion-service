<?php
    $base = $_SERVER['DOCUMENT_ROOT'];
    $configExist = file_exists($base . '/config.php');

    if (!$configExist) {
        header('location: /manager/install/setup.php');
        exit;
    }

    require($base . '/includes/kernel.php');


    if ( R::testConnection() && R::inspect() && $configExist ) {
        $user = $_SESSION['logged_user'];
        $uid = $user->id;
        $role = $user->artist_role;
        $username = $user->artist_username;

        $username = R::findOne('artists', 'id = ?', [$uid]);

        if (!$user || $role != 'admin') {
            header( 'location: /login.php' );
            exit;
        }

        if ($role == 'admin') {
            $bodyClass = 'user_is_admin admin admin-name-' . $username->artist_username . ' ' . $username->artist_username . '-user in-session';
        } else {
            $bodyClass = 'user_is_artist artist artist-name-' . $username->artist_username . ' ' . $username->artist_username . '-user in-session';
        }

        $get = $_GET;

        require('header.php');
        // Home
        if ( !$get ) {
            require('partials/page-home.php');
        }
        // Promo Campaigns
        if ( $get['page'] == 'promos' ) {
            require('partials/page-promos.php');
        }
        // Artists
        if ( $get['page'] == 'artists' ) {
            require('partials/page-artists.php');
        }
        // Media Library
        if ( $get['page'] == 'media-library' ) {
            require('partials/page-media-library.php');
        }
        // Activation
        if ( $get['page'] == 'account-settings' ) {
            require('partials/page-account-settings.php');
        }
        // Settings
        if ( $get['page'] == 'settings' ) {
            require('partials/page-settings.php');
        }
        // Activation
        if ( $get['page'] == 'activation' ) {
            require('partials/page-activation.php');
        }
        // About App
        if ( $get['page'] == 'about' ) {
            require('partials/page-about.php');
        }
        require('footer.php');
    } else {
        header('location: /manager/install/setup.php');
        exit;
    }
?>
