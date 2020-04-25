<header class="top">
	<div class="container">
		<div class="flex-row">
			<div class="col-md-4">
				<div class="logo">
					<?php if ( get_option('site_email') ) : ?>
                        <a href="<?php echo get_option('label_url'); ?>" target="_blank">
                            <img src="<?php echo get_site_logo_url(); ?>" alt="<?php echo get_option('site_name'); ?>">
                        </a>
					<?php else : ?>
                        <img src="<?php echo get_site_logo_url(); ?>" alt="<?php echo get_option('site_name'); ?>">
                    <?php endif; ?>
				</div>
			</div>
			<div class="col-md-4"></div>
			<div class="col-md-4">
                <?php if ( get_option('site_email') ) : ?>
                    <div class="contactButton">
                        <a href="mailto:<?php echo get_option('site_email'); ?>">Contact</a>
                    </div>
                <?php endif; ?>
			</div>
		</div>
	</div>
</header>
<section class="welcome">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="welcomeHuman">
                    Welcome, <span><?php echo get_user()->artist_alias; ?></span>
                </div>
            </div>
        </div>
    </div>
</section>