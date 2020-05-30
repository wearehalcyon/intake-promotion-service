<?php
    // Constants
    define('DOC_ROOT', $_SERVER['DOCUMENT_ROOT']);
    
    // Mem usage
	$mem_start = memory_get_usage();

    /**
     * Enable SwiftMailer
     */
    require_once DOC_ROOT . '/lib/swiftmailer/autoload.php';

    /**
     * Connect To Server
     */
    ob_start();
    readfile('https://api.intakedigital.com/clients/id/activation.json');
        $get_server = ob_get_contents();
    ob_clean();
    $server_key = json_decode($get_server);

	/**
	 * Get Version
	 */
	function get_version($version = null){
        ob_start();
        readfile('https://api.intakedigital.com/clients/id/checkver.json');
            $content = ob_get_contents();
        ob_clean();
        $ver = json_decode($content);
        $thisver = '1.0.9';
        if ($version == 'current') {
            return $thisver;
        }
        if ($version == 'update') {
            return $ver->{'version'};
        }
        if ($version == null) {
            if ($ver->{'version'} != $thisver && $ver->{'version'} > $thisver) {
                return get_translate($thisver . '. Available update: ' . $ver->{'version'});
            } else {
                return $thisver;
            }
        }
	}

	/**
	 * Get File
	 * The same is require but with ABTH PATH
	 */
	function get_required_file($path = null, $file = null){
		$base = DOC_ROOT;
		require($base . $path . $file);
	}

	/**
	 * Main Kernel file
	 * Version: 1.0.0
	 */
	get_required_file('', '/config.php');
    
    /**
     * Start session
     */
    session_start();


	/**
	 * API Connection
	 */
	function api_connect(){
		ob_start();
		readfile('https://api.intakedigital.com/clients/id/activation.json');
		$content = ob_get_contents();
		ob_clean();
		return $content;
	}
	$json = api_connect();
	$api = json_decode($json);

    if (isset($_POST['submit_license'])) {
        $update = R::findOne('options', 'id=?', [1]);
        $update->api_key = $_POST['apikey'];
        $update->serial_number = $_POST['serialnum'];
        R::store($update);
        echo '<meta http-equiv="refresh" content="0; URL=/manager/index.php?page=activation">';
    }

    if ($api->{'api_key'} == get_option('api_key') && $api->{'serial_number'} == get_option('serial_number')) {
        $apikey_message = get_translate('Activated', 'Активировано');
        $apil_class = ' registered';
        $activation = true;
    } else {
        $apikey_message = get_translate('Unactivated', 'Не Активировано');
        $apil_class = get_translate(' unregistered', ' unregistered unregistered_ru');
        $activation = false;
    }

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
		if (get_option('debuger_enabler') && $activation) {
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
		echo '<meta charset="utf-8">';
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

	/**
     * Get Artist By ID
     */
	function get_artist_by($id = null, $value = null){
	    $artist = R::findOne('artists', 'id = ?', [$id]);
	    return $artist['artist_' . $value];
    }

	/**
	 * Stats Card
	 */
	 function get_stats_card(){
		 $campaignID = $_GET['campaign'];
	     $campaign = R::findOne('promos', 'id = ?', [$campaignID]);
	     $views = R::count('reviews', 'promo_id = ? && reviewer_logged_in != ?', [$campaignID, 0]);
	     $artistlist = R::count('artists');
	     $total_views = R::findAll('reviews', 'promo_id = ? && reviewer_logged_in != ?', [$campaignID, 0]);
	     $total_sum = 0;
	     foreach($total_views as $total_view) {
	         $total_sum += $total_view->reviewer_logged_in;
	     }
		 // Stats Card
	     ob_start();
	         require_once('../manager/actions/campaign-statistics-card.php');
	         $stats_card = ob_get_contents();
	     ob_end_clean();
		 return $stats_card;
	 }

	 /**
 	 * Stats Card Download
 	 */
 	 function get_stats_card_download(){
 		 $campaignID = $_GET['campaign'];
 	     $campaign = R::findOne('promos', 'id = ?', [$campaignID]);
 	     $views = R::count('reviews', 'promo_id = ? && reviewer_logged_in != ?', [$campaignID, 0]);
 	     $artistlist = R::count('artists');
 	     $total_views = R::findAll('reviews', 'promo_id = ? && reviewer_logged_in != ?', [$campaignID, 0]);
 	     $total_sum = 0;
 	     foreach($total_views as $total_view) {
 	         $total_sum += $total_view->reviewer_logged_in;
 	     }
 		 // Stats Card
 	     ob_start();
 	         require_once('../manager/actions/campaign-statistics-card-table.php');
 	         $stats_card = ob_get_contents();
 	     ob_end_clean();
 		 return $stats_card;
 	 }

 	 /**
      * Help Form
      */
     $stmpSettings = get_option('mailer_settings');
     $stmpSetting = json_decode($stmpSettings);

     $transport = (new Swift_SmtpTransport($stmpSetting->{'server'}, $stmpSetting->{'port'}))
        ->setUsername($stmpSetting->{'username'})
        ->setPassword($stmpSetting->{'password'})
     ;

     // Create the Mailer using your created Transport
     $help_mailer = new Swift_Mailer($transport);

     $clientEmail = $_POST['help_client_email'];
     $clientAPI = $_POST['help_client_api_key'];
     $clientSerial = $_POST['help_client_serial'];
     $clientTicket = str_replace('Ticket Number: #', '', $_POST['help_client_ticket_number']);
     $clientSubject = $_POST['help_client_subject'];
     $clientMessage = $_POST['help_client_message'];
     $help_message_body = "
        <strong>Client Email:</strong> $clientEmail
        <br>
        <strong>Client API Key:</strong> $clientAPI
        <br>
        <strong>Client Serial Number:</strong> $clientSerial
        <br>
        <strong>Client Ticket Number:</strong> $clientTicket
        <br>
        <i>$clientMessage</i>
     ";

     // Create a message
     $help_message = (new Swift_Message('INTAKE Support Request: ' . $_POST['help_client_subject']))
        ->setFrom([$stmpSetting->{'sendfrom'} => get_option('site_name')])
        ->setTo($server_key->{'intake_email'})
        ->setBody($help_message_body, 'text/html')
     ;

 	 if (
         isset($_POST['help_client_email']) &&
         isset($_POST['help_client_api_key']) &&
         isset($_POST['help_client_serial']) &&
         isset($_POST['help_client_ticket_number']) &&
         isset($_POST['help_client_subject']) &&
         isset($_POST['help_client_message']) &&
         isset($_POST['help_client_submit'])
     ) {
 	     $result = $help_mailer->send($help_message);
         header('Location: /manager/index.php?page=help&result=success&ticket=' . str_replace('Ticket Number: #', '', $clientTicket));
         exit;
     }
 	 
 	 /**
      * Send Campaign
      */
 	 function get_send_campaign(){
         global $activation;
         if ($activation) :
     ?>
         <div class="testSend">
             <form action="" method="post">
                 <p class="formControl">
                     <input type="email" name="test_email" value="<?php echo get_option('site_email'); ?>" />
                 </p>
                 <button type="submit" class="button" name="test_send">
                     <?php echo get_translate('Test Sending', 'Тестовая отправка'); ?>
                 </button>
             </form>
             <hr>
             <p class="formControl">
                 <a href="<?php echo base_url('manager/edit.php?type=campaign&campaign_id=' . $_GET['campaign_id'] . '&action=edit&preparation=send_campaign'); ?>" class="button">
                     <?php echo get_translate('Proceed To Send', 'Перейти к отправке'); ?>
                 </a>
             </p>
         </div>
     <?php else : ?>
         <div class="testSend">
             <p class="formControl">
                 <?php echo get_translate('You cannot send promotional campaigns until you activate your copy of the application. To solve the problem, go to the product activation section.', 'Вы не можете отправлять промокампании, пока не активируете свою копию приложения. Для решения проблемы - перейдите в раздел активации продукта.'); ?>
             </p>
         </div>
     <?php
        endif;
 	 }
    
    /**
     * Dashboard NAV
     */
    function get_dashboard_nav(){
        global $activation;
        ?>
        <div class="sidebarNav">
            <div class="engineLogo">
                <img src="<?php echo get_assets('intakePromotionLogoWhite', 'images', 'png'); ?>" alt="Intake Promotion Service">
            </div>
            <div class="navList">
                <h4><?php echo get_translate('Navigation', 'Навигация'); ?></h4>
                <ul class="navMenu">
                    <li class="menuItem <?php if ( !$_GET['page'] == true && !$_GET['type'] == true ) { echo 'active'; } ?>">
                        <a href="<?php echo base_url('manager/index.php'); ?>"><i class="fas fa-tachometer-alt"></i><?php echo get_translate('Dashboard', 'Главная'); ?></a>
                    </li>
                    <?php if ($activation) { ?>
                        <li class="menuItem <?php if ( $_GET['page'] == 'promos' || $_GET['type'] == 'campaign' ) { echo 'active'; } ?>">
                            <a href="<?php echo base_url('manager/index.php?page=promos'); ?>"><i class="fas fa-headphones-alt"></i><?php echo get_translate('Promos', 'Промо'); ?></a>
                        </li>
                        <li class="menuItem <?php if ( $_GET['page'] == 'artists' ) { echo 'active'; } ?>">
                            <a href="<?php echo base_url('manager/index.php?page=artists'); ?>"><i class="fas fa-user"></i><?php echo get_translate('Artists', 'Артисты'); ?></a>
                        </li>
                        <li class="menuItem <?php if ( $_GET['page'] == 'statistics' ) { echo 'active'; } ?>">
                            <a href="<?php echo base_url('manager/index.php?page=statistics'); ?>"><i class="fas fa-chart-pie"></i><?php echo get_translate('Statistics', 'Статистика'); ?></a>
                        </li>
                        <li class="menuItem <?php if ( $_GET['page'] == 'media-library' ) { echo 'active'; } ?>">
                            <a href="<?php echo base_url('manager/index.php?page=media-library'); ?>"><i class="fas fa-folder"></i><?php echo get_translate('Media Library', 'Медиа Библиотека'); ?></a>
                        </li>
                    <?php } else { ?>
                        <li class="menuItem unactive" style="opacity: .4;">
                            <a><i class="fas fa-headphones-alt"></i><?php echo get_translate('Promos', 'Промо'); ?></a>
                        </li>
                        <li class="menuItem unactive" style="opacity: .4;">
                            <a><i class="fas fa-user"></i><?php echo get_translate('Artists', 'Артисты'); ?></a>
                        </li>
                        <li class="menuItem unactive" style="opacity: .4;">
                            <a><i class="fas fa-chart-pie"></i><?php echo get_translate('Statistics', 'Статистика'); ?></a>
                        </li>
                        <li class="menuItem unactive" style="opacity: .4;">
                            <a><i class="fas fa-folder"></i><?php echo get_translate('Media Library', 'Медиа Библиотека'); ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="navList">
                <h4><?php echo get_translate('Tools', 'Инструменты'); ?></h4>
                <ul class="navMenu">
                    <li class="menuItem <?php if ( $_GET['page'] == 'settings' ) { echo 'active'; } ?>">
                        <a href="<?php echo base_url('manager/index.php?page=settings'); ?>"><i class="fas fa-tools"></i><?php echo get_translate('Engine Settings', 'Настройки Приложения'); ?></a>
                    </li>
                    <li class="menuItem <?php if ( $_GET['page'] == 'account-settings' ) { echo 'active'; } ?>">
                        <a href="<?php echo base_url('manager/index.php?page=account-settings'); ?>"><i class="fas fa-user-cog"></i><?php echo get_translate('Profile Settings', 'Настройки Профиля'); ?></a>
                    </li>
                    <li class="menuItem <?php if ( $_GET['page'] == 'activation' ) { echo 'active'; } ?>">
                        <a href="<?php echo base_url('manager/index.php?page=activation'); ?>"><i class="fas fa-key"></i><?php echo get_translate('Activation', 'Активация'); ?></a>
                    </li>
                </ul>
            </div>
            <div class="navList">
                <h4><?php echo get_translate('Information', 'Информация'); ?></h4>
                <ul class="navMenu">
                    <li class="menuItem <?php if ( $_GET['page'] == 'help' ) { echo 'active'; } ?>">
                        <a href="<?php echo base_url('manager/index.php?page=help'); ?>"><i class="fas fa-fire-alt"></i><?php echo get_translate('Help', 'Помощь'); ?></a>
                    </li>
                    <li class="menuItem <?php if ( $_GET['page'] == 'faq' ) { echo 'active'; } ?>">
                        <a href="<?php echo base_url('manager/index.php?page=faq'); ?>"><i class="fas fa-question-circle"></i><?php echo get_translate('FAQ', 'FAQ'); ?></a>
                    </li>
                    <li class="menuItem <?php if ( $_GET['page'] == 'about' ) { echo 'active'; } ?>">
                        <a href="<?php echo base_url('manager/index.php?page=about'); ?>"><i class="fas fa-info-circle"></i><?php echo get_translate('About IPE', 'О Приложении'); ?></a>
                    </li>
                </ul>
            </div>
        </div>
        <?php
    }