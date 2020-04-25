<div class="sidebarNav">
    <div class="engineLogo">
        <img src="<?php echo get_assets('intakePromotionLogoWhite', 'images', 'png'); ?>" alt="Intake Promotion Service">
    </div>
    <div class="navList">
        <h4><?php echo get_translate('Navigation', 'Навигация'); ?></h4>
        <ul class="navMenu">
            <li class="menuItem <?php if ( !$get['page'] == true && !$get['type'] == true ) { echo 'active'; } ?>">
                <a href="<?php echo base_url('manager/index.php'); ?>"><i class="fas fa-tachometer-alt"></i><?php echo get_translate('Dashboard', 'Главная'); ?></a>
            </li>
            <li class="menuItem <?php if ( $get['page'] == 'promos' || $get['type'] == 'campaign' ) { echo 'active'; } ?>">
                <a href="<?php echo base_url('manager/index.php?page=promos'); ?>"><i class="fas fa-headphones-alt"></i><?php echo get_translate('Promos', 'Промо'); ?></a>
            </li>
            <li class="menuItem <?php if ( $get['page'] == 'artists' ) { echo 'active'; } ?>">
                <a href="<?php echo base_url('manager/index.php?page=artists'); ?>"><i class="fas fa-user"></i><?php echo get_translate('Artists', 'Артисты'); ?></a>
            </li>
            <li class="menuItem <?php if ( $get['page'] == 'statistics' ) { echo 'active'; } ?>">
                <a href="<?php echo base_url('manager/index.php?page=statistics'); ?>"><i class="fas fa-chart-pie"></i><?php echo get_translate('Statistics', 'Статистика'); ?></a>
            </li>
            <li class="menuItem <?php if ( $get['page'] == 'media-library' ) { echo 'active'; } ?>">
                <a href="<?php echo base_url('manager/index.php?page=media-library'); ?>"><i class="fas fa-folder"></i><?php echo get_translate('Media Library', 'Медиа Библиотека'); ?></a>
            </li>
        </ul>
    </div>
    <div class="navList">
        <h4><?php echo get_translate('Tools', 'Инструменты'); ?></h4>
        <ul class="navMenu">
            <li class="menuItem <?php if ( $get['page'] == 'settings' ) { echo 'active'; } ?>">
                <a href="<?php echo base_url('manager/index.php?page=settings'); ?>"><i class="fas fa-tools"></i><?php echo get_translate('Engine Settings', 'Настройки Приложения'); ?></a>
            </li>
            <li class="menuItem <?php if ( $get['page'] == 'account-settings' ) { echo 'active'; } ?>">
                <a href="<?php echo base_url('manager/index.php?page=account-settings'); ?>"><i class="fas fa-user-cog"></i><?php echo get_translate('Profile Settings', 'Настройки Профиля'); ?></a>
            </li>
            <li class="menuItem <?php if ( $get['page'] == 'activation' ) { echo 'active'; } ?>">
                <a href="<?php echo base_url('manager/index.php?page=activation'); ?>"><i class="fas fa-key"></i><?php echo get_translate('Activation', 'Активация'); ?></a>
            </li>
        </ul>
    </div>
    <div class="navList">
        <h4><?php echo get_translate('Information', 'Информация'); ?></h4>
        <ul class="navMenu">
            <li class="menuItem <?php if ( $get['page'] == 'help' ) { echo 'active'; } ?>">
                <a href="<?php echo base_url('manager/index.php?page=help'); ?>"><i class="fas fa-fire-alt"></i><?php echo get_translate('Help', 'Помощь'); ?></a>
            </li>
            <li class="menuItem <?php if ( $get['page'] == 'faq' ) { echo 'active'; } ?>">
                <a href="<?php echo base_url('manager/index.php?page=faq'); ?>"><i class="fas fa-question-circle"></i><?php echo get_translate('FAQ', 'FAQ'); ?></a>
            </li>
            <li class="menuItem <?php if ( $get['page'] == 'about' ) { echo 'active'; } ?>">
                <a href="<?php echo base_url('manager/index.php?page=about'); ?>"><i class="fas fa-info-circle"></i><?php echo get_translate('About IPE', 'О Приложении'); ?></a>
            </li>
        </ul>
    </div>
</div>
