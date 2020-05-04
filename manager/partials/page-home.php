<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="pageTitle"><?php echo get_translate('Dashboard', 'Панель Управления'); ?></h1>
        </div>
        <div class="col-md-12 col-card">
            <div class="newsSection card">
                <h4><?php echo get_translate('News', 'Новости'); ?></h4>
                <?php if ($api->{'api_key'} == get_option('api_key') && $api->{'serial_number'} == get_option('serial_number')) { ?>
                    <p class="currVerTxt">
                        <?php
                            if ( get_version('update') != get_version('current') && get_version('update') > get_version('current') ) {
                                echo '<a href="https://intakedigital.com/updates/" target="_blank">' . get_translate('Available Updates. Version: ', 'Доступны обновления. Версия: ') . get_version('update') . '</a>';
                            } else {
                                echo get_translate('Current APP version: ', 'Текущая версия приложения: ') . get_version('current');
                            }
                        ?>
                    </p>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
