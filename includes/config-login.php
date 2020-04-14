<?php
    require('kernel.php');

    $data = $_POST;
    if ( isset( $data['login'] ) ) {
        $errors = array();
        $artist = R::findOne( 'artists', 'artist_username = ?', array( $data['username'] ) );
        $lastLogin = date('M-d-Y / H:i:s');
        $userID = $artist->id;
        $userIP = get_client_ip_env();
        $artist->artist_last_login = $lastLogin;
        $artist->artist_ip = $userIP;
        //R::exec( "update artists set artist_ip=? where id=?", [$userIP, $userID] );
        R::store($artist);

        //var_dump($artist);
        if ( $artist ) {
            if ( password_verify( $data['userpass'], $artist->artist_password ) ) {
                //echo '<div style="color:green;">Logged succesfully!</div>';
                $_SESSION['logged_user'] = $artist;
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
        header('location: /artist/');
        exit;
    }
?>
