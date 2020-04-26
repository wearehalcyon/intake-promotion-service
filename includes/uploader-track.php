<?php
require('kernel.php');

$ds = DIRECTORY_SEPARATOR;

//$storeFolder = 'uploads';
$uploads_dir = $_SERVER['DOCUMENT_ROOT'] . '/view/uploads/promos/preview/';

$temp = explode(".", $_FILES["file"]["name"]);
//$filename = 'label-logo' . '.' . end($temp);
$filename = str_replace(' ', '-', $_FILES["file"]["name"]);

if (!empty($_FILES)) {

    $tempFile = $_FILES['file']['tmp_name'];

    //$targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;

    $targetFile =  $uploads_dir . $filename;

    move_uploaded_file($tempFile,$targetFile);
}

$res = ['answer' => 'OK'];
exit(json_encode($res));
