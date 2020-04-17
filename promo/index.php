<?php
	require('../includes/kernel.php');

	$themeFolder = R::findOne('promos', 'id = ?', [1]);

	/**
	 * Front Checking
	 */
	if (file_exists('../view/templates/public/' . $themeFolder->promo_public_theme . '/index.php')) {
		require('../view/templates/public/' . $themeFolder->promo_public_theme . '/index.php');
	} else {
		echo 'Theme ERROR';
	}