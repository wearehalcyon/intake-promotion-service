<?php
    require('kernel.php');

    $data = $_POST;
    if (isset($data['signup'])) {
        $errors = array();
        // Check fields
        if ( trim($data['username']) == '' ) {
            $errors[] = 'Login field width error';
        }
        if ( trim($data['userfirstname']) == '' ) {
            $errors[] = 'First Name field width error';
        }
        if ( trim($data['userlastname']) == '' ) {
            $errors[] = 'Last Name field width error';
        }
        if ( trim($data['useralias']) == '' ) {
            $errors[] = 'Alias field width error';
        }
        if ( trim($data['useremail']) == '' ) {
            $errors[] = 'Email field width error';
        }
        if ( $data['userpass'] == '') {
            $errors[] = 'Password field width error';
        }
        if ( R::count( 'artists', "artist_username = ?", array( $data['username'] ) ) > 0 ) {
            $errors[] = 'User with this Username was created';
        }
        if ( R::count( 'artists', "artist_alias = ?", array( $data['useralias'] ) ) > 0 ) {
            $errors[] = 'User with this Alias was created';
        }
        if ( R::count( 'artists', "artist_email = ?", array( $data['useremail'] ) ) > 0 ) {
            $errors[] = 'User with this Email was created';
        }

        // Make record in database
        if (empty($errors)) {
            $artist = R::dispense('artists');
            $artist->artist_username      = $data['username'];
            $artist->artist_first_name    = $data['userfirstname'];
            $artist->artist_last_name     = $data['userlastname'];
            $artist->artist_alias         = $data['useralias'];
            $artist->artist_email         = $data['useremail'];
            $artist->artist_password      = password_hash($data['userpass'], PASSWORD_DEFAULT);
            $artist->artist_creation_date = date('m-d-Y');
            $artist->artist_role = 'artist';
            $artist->artist_secret_key    = (md5($data['userpass']) . md5(time()));
            $artistSuccess = R::store( $artist );
            header('location: /signup.php?action=success');
            exit;
        }
    }
?>
