<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="pageTitle"><?php echo get_translate('Media Library', 'Медиа Библиотека'); ?></h1>
        </div>
        <div class="col-md-12 col-card">
            <div class="newsSection card">
                <div class="cardContent">
                    <ul class="mlList">
                        <?php get_required_file('/includes/vendor/', 'media-library-explorer.php'); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
