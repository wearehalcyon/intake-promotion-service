<?php
	$configExist = file_exists('config.php');
	if ( $configExist ) {
		/*
		 * Include config file
		 */
		require('config.php');
	}

	/*
	 * Check connection
	 */
	if ($configExist && R::testConnection()) {
		echo 'OK';
	} else {
		header('location: /manager/install/index.php');
		exit;

	}
