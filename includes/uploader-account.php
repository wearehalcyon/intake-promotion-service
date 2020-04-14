<?php
require('kernel.php');

$ds = DIRECTORY_SEPARATOR;

$storeFolder = 'uploads';
$uploads_dir = $_SERVER['DOCUMENT_ROOT'] . '/view/uploads/manager/users-photos/';

$img_role = get_user_value('artist_role');
$img_username = get_user_value('artist_username');
$img_id = get_user_value('id');

$temp = explode(".", $_FILES["file"]["name"]);
$filename = $img_role . '-' . $img_username . '-id-' . $img_id . '.' . end($temp);

if (!empty($_FILES)) {

    $tempFile = $_FILES['file']['tmp_name'];

    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;

    $targetFile =  $uploads_dir . $filename;

    move_uploaded_file($tempFile,$targetFile);

    $artist = R::findOne('artists', 'id=?', [get_user_value('id')]);

    $artist->artist_photo = $filename;
    R::store($artist);
    R::freeze(true);
}

$res = ['answer' => 'OK'];
exit(json_encode($res));
