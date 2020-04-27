<?php
    $promoCount = R::count('promos', 'promo_status != ?', ['unactive']);

    if ($promoCount > 0) {
        $count = '<span class="campaignsCount">' . $promoCount . '</span>';
    }
?>
<section class="content">
	<div class="container">
		<div class="row">
            <div class="col-md-12">
                <div class="userWelcome">
                    <h4>Welcome, <span><?php echo $_SESSION['logged_user']->artist_alias; ?></span></h4>
                    <h2>Your main event center</h2>
                </div>
            </div>
			<div class="col-md-3">
                <h4>Navigation</h4>
                <ul class="homepageNav">
	                <?php
		                /*if ( !$_GET || $_GET['section'] == 'dashboard' ) {
			                echo '<li class="navItem active"><a href="index.php?section=dashboard">Dashboard</a></li>';
		                } else {
			                echo '<li class="navItem"><a href="index.php?section=dashboard">Dashboard</a></li>';
		                }*/
		                if ( !$_GET || $_GET['section'] == 'campaigns' ) {
			                echo '<li class="navItem active"><a href="index.php?section=campaigns">Promotion Campaigns' . $count . '</a></li>';
		                } else {
			                echo '<li class="navItem"><a href="index.php?section=campaigns">Promotion Campaigns' . $count . '</a></li>';
		                }
		                if ( $_GET['section'] == 'account_details' ) {
			                echo '<li class="navItem active"><a href="index.php?section=account_details">Account Details</a></li>';
		                } else {
			                echo '<li class="navItem"><a href="index.php?section=account_details">Account Details</a></li>';
		                }
		                if ( $_GET['section'] == 'help' ) {
			                echo '<li class="navItem active"><a href="index.php?section=help">Help</a></li>';
		                } else {
			                echo '<li class="navItem"><a href="index.php?section=help">Help</a></li>';
		                }
		                if ( $_GET['section'] == 'logout' ) {
			                echo '<li class="navItem active"><a href="index.php?section=logout">Logout</a></li>';
		                } else {
			                echo '<li class="navItem"><a href="index.php?section=logout">Logout</a></li>';
		                }
	                ?>
                </ul>
            </div>
            <div class="col-md-9">
                <?php
	                /*if ( !$_GET || $_GET['section'] == 'dashboard' ) {
		                require('partials/pt-dashboard.php');
	                }*/
	                if ( !$_GET || $_GET['section'] == 'campaigns' ) {
		                require('partials/pt-campaigns.php');
	                }
	                if ( $_GET['section'] == 'account_details' ) {
		                require('partials/pt-account-details.php');
	                }
	                if ( $_GET['section'] == 'help' ) {
		                require('partials/pt-help.php');
	                }
	                if ( $_GET['section'] == 'logout' ) {
		                require('partials/pt-logout.php');
	                }
                ?>
            </div>
		</div>
	</div>
</section>