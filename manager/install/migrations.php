<?php
// Create Options Table
$option = R::dispense('options');
if ($option && R::count('options') < 1) {
    $option->site_name = 'Intake Digital';
    $option->site_description = 'Standalone Promotion Engine';
    $option->serial_number = NULL;
    $option->api_key = NULL;
	$option->site_email = 'admin@admin.com';
	$option->label_url = NULL;
	$option->site_logo_url = 'intakePromotionLogoBlack.png';
	$option->label_banner = 'labelBanner.jpg';
    $option->site_banner = NULL;
    $option->debuger_enabler = '1';
    $option->pjax_enabler = '1';
    $option->app_language = 'en';
    $option->app_reg_access = '0';
    $option->app_social = '{"facebook": "https://facebook.com/", "instagram": "https://instagram.com/", "twitter": "https://twitter.com/"}';
    $option->mailer_settings = '{"server":"smtp.example.com", "port":"25", "username":"example@example.com", "password":"password", "sendfrom":"admin@example.com"}';
    $option->app_ui_mode = '0';
    R::store( $option );
}

// Create Artists Table
$artist = R::dispense('artists');
if ($artist && R::count('artists') < 1) {
    $artist->artist_username = 'admin';
    $artist->artist_first_name = NULL;
    $artist->artist_last_name = NULL;
    $artist->artist_alias = 'Admin';
    $artist->artist_email = 'administrator@site.com';
    $artist->artist_password = password_hash('admin', PASSWORD_DEFAULT);
    $artist->artist_creation_date = date('m-d-Y');
    $artist->artist_role = 'admin';
    $artist->artist_last_login = date('M-d-Y / H:i:s');
    $artist->artist_ip = NULL;
    $artist->artist_secret_key = (md5('Administrator') . md5(time()));
    $artist->artist_group = 'list_dev';
    R::store( $artist );
}

// Create Promos
$promo = R::dispense('promos');
if ($promo && R::count('promos') < 1) {
    $promo->promo_title = 'Intake - Hello World (Inc. Worldwide Artists)';
    $promo->promo_artist_name = 'Intake';
    $promo->promo_track_name = 'Hello World';
    $promo->promo_track_desc = 'Original Mix';
    $promo->promo_track_preview = '{"1":{"artist":"Intake","title":"Hello World","description":"Original Mix","source":"Intake - Hello World (Original Mix).mp3"}}';
    $promo->promo_track_wav = 'eric-prydz-opus-jonnas-roy-remix.wav';
    $promo->promo_track_zip = 'eric-prydz-opus-jonnas-roy-remix.zip';
    $promo->promo_description = '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>';
    $promo->promo_artist_social = '{"facebook":"https://facebook.com/","twitter":"https://twitter.com/","instagram":"https://instagram.com/","vk":"https://vk.com/"}';
    $promo->promo_creation_date = date('F d Y');
    $promo->promo_release_date = 'Apr 28 2020';
    $promo->promo_cover = 'intake-hello-world-cover.jpg';
    $promo->promo_status = 'active';
    $promo->promo_mail_theme = 'light';
    $promo->promo_public_theme = 'light';
    R::store( $promo );
}

// Create Reviews
$review = R::dispense('reviews');
if ($review && R::count('reviews') < 1) {
    $review->promo_id = '1';
    $review->reviewer_id = '1';
    $review->reviewer_track_rate = '10';
    $review->reviewer_track_support = 'Yes';
    $review->reviewer_track_choosed = 'Intake - Hello World (Original Mix)';
    $review->reviewer_track_comment = 'Wow! This is amazing. Will support this on my radioshow!';
    $review->reviewer_ip = '127.0.0.1';
    $review->reviewer_time = date('M-d-Y / H:i:s');
    $review->reviewer_logged_in = 0;
    $review->promo_track_listened = 0;
    $review->promo_download_zip = 0;
    $review->promo_download_track = 0;
    R::store( $review );
}