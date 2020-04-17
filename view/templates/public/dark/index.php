<!doctype html>
<html lang="en">
<head>
    <?php get_tpl_header(); ?>
</head>
<body>
	<div class="wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-4">
					<div class="logo">
                        <img src="<?php echo get_site_logo_url(); ?>" alt="">
                    </div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1><?php echo get_promo('title'); ?></h1>
				</div>
			</div>
		</div>
	</div>
	<?php get_tpl_footer(); ?>
</body>
</html>