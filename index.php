<?php
	$configExist = file_exists('config.php');
	if ( $configExist ) {
		/*
		 * Include Kernel
		 */
		require('includes/kernel.php');
	}

	/*
	 * Check connection
	 */
	if ($configExist && R::testConnection()) {
		if ($_SESSION['logged_user']) {
			require('homepage.php');
		} else {
			require('includes/front/unavailable.php');
		}
	} else {
		header('location: /manager/install/index.php');
		exit;
	}
