<?php
	require('kernel.php');

	$ds = DIRECTORY_SEPARATOR;

	$storeFolder = 'uploads';
	$uploads_dir = $_SERVER['DOCUMENT_ROOT'] . '/view/uploads/label/';

	$temp = explode(".", $_FILES["file"]["name"]);
//$filename = 'label-logo' . '.' . end($temp);
	$filename = str_replace(' ', '-', $_FILES["file"]["name"]);

	if (!empty($_FILES)) {

		$tempFile = $_FILES['file']['tmp_name'];

		$targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;

		$targetFile =  $uploads_dir . $filename;

		move_uploaded_file($tempFile,$targetFile);

		$option = R::findOne('options', 'id=?', [1]);

		$option->label_banner = $filename;
		R::store($option);
		R::freeze(true);
	}

	$res = ['answer' => 'OK'];
	exit(json_encode($res));
