<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo get_option('site_name'); ?> | Promo Campaign Not Available</title>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo get_assets('front', 'style'); ?>">
</head>
<body>
	<div class="wrapper">
		<div class="unavSection">
			<div class="mainBody">
				<header class="header">
					<img src="<?php echo get_site_logo_url(); ?>" alt="">
				</header>
				<section class="secTitle">
					<h4>PROMO CAMPAIGN NOT AVAILABLE</h4>
				</section>
				<section class="secBody">
					<p>
						You see this page for several reasons:
					</p>
					<ol>
						<li>This promotion campaign has been completed or deleted.</li>
						<li>You may not be logged in (Contact your campaign provider to fix the problem).</li>
						<li>Your browser is outdated and the application does not display correctly.</li>
						<li>Your account has been deleted from the database.</li>
						<li>The internet connection is interrupted.</li>
					</ol>
					<p>
						Please check all of these possible causes, and try again.
					</p>
				</section>
			</div>
			<footer class="footer">
				Powered by <a href="https://intakedigital.com/">INTAKE Promotion Engine</a> | Copyright by INTAKE Digital &copy <?php echo date('Y'); ?> -
				<a href="mailto:info@intakedigital.com">info@intakedigital.com</a>
			</footer>
		</div>
	</div>
</body>
</html>