<?php
// Mem usage
	$mem_start = memory_get_usage();

	/**
	 * Get Version
	 */
	function get_version(){
		return '1.0.1';
	}

	/**
	 * Get File
	 * The same is require but with ABTH PATH
	 */
	function get_required_file($path = null, $file = null){
		$base = $_SERVER['DOCUMENT_ROOT'];
		require($base . $path . $file);
	}

	/**
	 * Main Kernel file
	 * Version: 1.0.0
	 */
	get_required_file('', '/config.php');


	/**
	 * API Connection
	 */
	function api_connect(){
		ob_start();
		readfile('https://api.artroman.net/clients/demo/localhost.json');
		$content = ob_get_contents();
		ob_clean();
		return $content;
	}
	$json = api_connect();
	$api = json_decode($json);

	/**
	 * Site General Options
	 */
	function get_option($value = null){
		$activations = R::getAll('SELECT * FROM `options`');
		foreach ($activations as $activation) {
			$option = $activation[$value];
		}
		return $option;
	}

	/**
	 * Dashboard Page Title
	 */
	function get_dashboard_page(){
		if ( $_GET['page'] == 'promos' ) {
			return get_translate('Promos | ', 'Промо | ');
		}
		if ( $_GET['page'] == 'artists' ) {
			return get_translate('Artists | ', 'Артисты | ');
		}
		if ( $_GET['page'] == 'statistics' ) {
			return get_translate('Statistics | ', 'Статистика | ');
		}
		if ( $_GET['page'] == 'media-library' ) {
			return get_translate('Media Library | ', 'Медиа Библиотека | ');
		}
		if ( $_GET['page'] == 'settings' ) {
			return get_translate('General Settings | ', 'Главные Настройки | ');
		}
		if ( $_GET['page'] == 'account-settings' ) {
			return get_translate('Profile Settings | ', 'Настройки Профиля | ');
		}
		if ( $_GET['page'] == 'activation' ) {
			return get_translate('App Activation | ', 'Активация Приложения | ');
		}
		if ( $_GET['page'] == 'help' ) {
			return get_translate('Help | ', 'Помощь | ');
		}
		if ( $_GET['page'] == 'faq' ) {
			return get_translate('FAQ | ', 'FAQ | ');
		}
		if ( $_GET['page'] == 'about' ) {
			return get_translate('About App | ', 'О Приложении | ');
		}
	}

	/**
	 * Home base URL
	 */
	if (!function_exists('base_url')) {
		function base_url( $end = null ){
			$protocol = empty($_SERVER['HTTPS']) ? 'http' : 'https';
			return $protocol . '://' . $_SERVER['HTTP_HOST'] . '/' . $end;
		}
	}

	/**
	 * Assets
	 */
	function get_assets($value = null, $type = null, $ext = null){
		// Default extension
		if ( $type == 'style' ) {
			$type = 'css';
		} elseif ( $type == 'script' ) {
			$type = 'js';
		}

		// Custom extension
		if ( $ext ) {
			$ext = $ext;
		} else {
			$ext = $type;
		}

		// Get source
		$asset = base_url() . 'includes/assets/' . $type . '/' . $value . '.' . $ext;
		return $asset;
	}

	/**
	 * Manager Uploads URL
	 */
	function get_manager_uploads_url($url = null){
		return base_url('manager/uploads/' . $url);
	}

	/**
	 * Debug bar
	 */
	function debug_bar(){
		if (get_option('debuger_enabler')) {
			get_required_file('/includes/vendor/', 'debuger.php');
		}
	}

	/**
	 * String translate
	 */
	function get_translate($en = null, $ru = null){
		if (get_option('app_language') == 'en') {
			return $en;
		} else {
			return $ru;
		}
	}

	/**
	 * Get Client IP Address
	 */
	function get_client_ip_env(){
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
			$ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';

		return $ipaddress;
	}

	/**
	 * Get Server IP Address
	 */
	function get_client_ip_server(){
		$ipaddress = '';
		if ($_SERVER['HTTP_CLIENT_IP'])
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if($_SERVER['HTTP_X_FORWARDED_FOR'])
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if($_SERVER['HTTP_X_FORWARDED'])
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if($_SERVER['HTTP_FORWARDED_FOR'])
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if($_SERVER['HTTP_FORWARDED'])
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if($_SERVER['REMOTE_ADDR'])
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = 'UNKNOWN';

		return $ipaddress;
	}

	/**
	 * Get User Value
	 */
	function get_user_value($value = null){
		$user = json_decode($_SESSION['logged_user']);
		$results = R::findOne('artists', 'id = ?', [$user->{'id'}]);
		return  $results[$value];
	}

	/**
	 * Get Tenplate Header
	 */
	function get_tpl_header(){
		$campaignID = $_GET['campaign'];
		$promo = R::findOne('promos', 'id = ?', [$campaignID]);
		$themeFolder = $promo['promo_public_theme'];
		$pageTitle = $promo['promo_title'];
		echo '<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">';
		echo '<meta http-equiv="X-UA-Compatible" content="ie=edge">';
		echo '<meta name="theme-color" content="#cfa167">';
		echo ' <meta charset="utf-8">';
		echo '<title>' . get_option('site_name') . ' | ' . $pageTitle . ' Promo Pool</title>';
		echo '<link rel="stylesheet" href="' . get_assets('bootstrap', 'style') . '">';
		echo '<link rel="stylesheet" href="' . get_assets('nice-select', 'style') . '">';
		echo '<link rel="stylesheet" href="' . get_assets('font-awesome', 'style') . '">';
		echo '<link rel="stylesheet" href="' . base_url('view/templates/public/' . $themeFolder . '/assets/css/checkra.css') . '">';
		echo '<link rel="stylesheet" href="' . base_url('view/templates/public/' . $themeFolder . '/style.css') . '">';
	}

	/**
	 * Get Tenplate Footer
	 */
	function get_tpl_footer(){
		$campaignID = $_GET['campaign'];
		$promo = R::findOne('promos', 'id = ?', [$campaignID]);
		$themeFolder = $promo['promo_public_theme'];
		echo '<script src="' . get_assets('jquery/3.4.1/jquery.min', 'script') . '"></script>';
		echo '<script src="' . get_assets('nice-select', 'script') . '"></script>';
		echo '<script src="' . base_url('view/templates/public/' . $themeFolder . '/assets/js/wavesurfer.js') . '"></script>';
		echo '<script src="' . base_url('view/templates/public/' . $themeFolder . '/assets/js/checkra.js') . '"></script>';
		echo '<script src="' . base_url('view/templates/public/' . $themeFolder . '/assets/js/main.js') . '"></script>';
	}

	/**
	 * Get Promo Value
	 */
	function get_promo($value = null){
		$campaignID = $_GET['campaign'];
		$promo = R::findOne('promos', 'id = ?', [$campaignID]);
		return $promo['promo_' . $value];
	}

	/**
	 * Get Page Value
	 */
	function get_page($value = null){
		$campaignID = $_GET['campaign'];
		$promo = R::findOne('promos', 'id = ?', [$campaignID]);
		return $promo;
	}

	/**
	 * Get Site Logo Url
	 */
	function get_site_logo_url(){
		return base_url('view/uploads/label/' . get_option('site_logo_url'));
	}

	/**
	 * Get User
	 */
	function get_user($value = null){
		$user = $_SESSION['logged_user'];
		return $user;
	}