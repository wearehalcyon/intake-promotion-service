<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?php echo get_option('site_name'); ?> | <?php echo get_user()->artist_alias; ?> Campaigns Library</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo get_assets('bootstrap', 'style'); ?>">
	<link rel="stylesheet" href="<?php echo get_assets('nice-select', 'style'); ?>">
	<link rel="stylesheet" href="<?php echo get_assets('font-awesome', 'style'); ?>">
	<link rel="stylesheet" href="<?php echo get_assets('front', 'style'); ?>">
</head>
<body class="homepage">
<div class="f_wrapper">
	<header class="frontHeader">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="logo">
						<img src="<?php echo get_site_logo_url(); ?>" alt="">
					</div>
				</div>
				<div class="col-md-4 hidden-xs"></div>
				<div class="col-md-4 contactLabel">
					<a href="mailto:<?php echo get_option('site_email'); ?>">Contact</a>
				</div>
			</div>
		</div>
	</header>