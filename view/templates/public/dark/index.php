<!doctype html>
<html lang="en">
<head>
    <?php get_tpl_header(); ?>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>
	<div class="wrapper">
        <?php
            // Header
	        include('partials/top.php');
	        // Content
	        include('partials/content.php');
	        // Footer
	        include('partials/bottom.php');
        ?>
    </div>
	<?php get_tpl_footer(); ?>
    <script src="<?php echo base_url('view/templates/public/dark/assets/js/wavesurfer.js'); ?>"></script>
    <script src="<?php echo base_url('view/templates/public/dark/assets/js/test.js'); ?>"></script>
</body>
</html>