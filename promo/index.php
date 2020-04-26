<?php
	require('../includes/kernel.php');

	$themeFolder = R::findOne('promos', 'id = ?', [get_page()->id]);

	/**
	 * Front Checking
	 */
	if ( $_GET ) {
		if (file_exists('../view/templates/public/' . $themeFolder->promo_public_theme . '/index.php')) {
			require('../view/templates/public/' . $themeFolder->promo_public_theme . '/index.php');
			//var_dump($themeFolder);
		} else {
			echo 'Theme ERROR';
		}
	} else {
		header('Location: /');
		exit;
	}