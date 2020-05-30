<?php
    require('kernel.php');

    $data = $_POST;
    if ( isset( $data['login'] ) ) {
        $errors = array();
        $artist = R::findOne( 'artists', 'artist_username = ?', array( $data['username'] ) );

        //var_dump($artist);
        if ( $artist ) {
            if ( password_verify( $data['userpass'], $artist->artist_password ) ) {
                //echo '<div style="color:green;">Logged succesfully!</div>';
                $_SESSION['logged_user'] = $artist;
                $artist = R::findOne( 'artists', 'artist_username = ?', array( $data['username'] ) );
                $userID = $artist->id;
                $userIP = $_SERVER['REMOTE_ADDR'];
                $artist->artist_last_login = date('M-d-Y / H:i:s');
                $artist->artist_ip = $userIP;
                R::store($artist);
            } else {
                $errors[] = 'Password incorrect!';
            }
        } else {
            $errors[] = 'Artist with this Username not found!';
        }
    }

    $userRole = $_SESSION['logged_user']->artist_role;
    if ( $userRole == 'admin' ) {
        header('location: /manager/');
        exit;
    } elseif ( $userRole == 'artist' ) {
        header('location: /');
        exit;
    }
?>
