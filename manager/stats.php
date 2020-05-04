<?php
$base = $_SERVER['DOCUMENT_ROOT'];

require($base . '/includes/kernel.php');


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
// Type Campaign
if ( $get['action'] == 'view' ) {
    require('actions/campaign-statistic.php');
}
require('footer.php');
?>
<?php
