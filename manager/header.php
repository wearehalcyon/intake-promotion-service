<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="theme-color" content="#cfa167">
        <meta charset="utf-8">
        <title><?php echo get_translate('Manager Dashboard', 'Панель Управления'); ?> | <?php echo get_dashboard_page() . get_option('site_name'); ?></title>
        <link rel="stylesheet" href="<?php echo get_assets('bootstrap', 'style'); ?>">
        <link rel="stylesheet" href="<?php echo get_assets('ui.min', 'style'); ?>">
        <link rel="stylesheet" href="<?php echo get_assets('font-awesome', 'style'); ?>">
        <link rel="stylesheet" href="<?php echo get_assets('nice-select', 'style'); ?>">
        <link rel="stylesheet" href="<?php echo get_assets('pretty-checkbox', 'style'); ?>">
        <link rel="stylesheet" href="<?php echo get_assets('dropzone', 'style'); ?>">
        <link rel="stylesheet" href="<?php echo get_assets('fancybox.min', 'style'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('lib/flat-datepicker/datepicker.css'); ?>">
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100;0,200;0,300;0,400;0,423;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,423;1,500;1,600;1,700&family=Nunito+Sans:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        <?php if (get_option('app_ui_mode')) : ?>
            <link rel="stylesheet" href="<?php echo get_assets('manager-dark', 'style'); ?>">
        <?php else : ?>
            <link rel="stylesheet" href="<?php echo get_assets('manager', 'style'); ?>">
        <?php endif; ?>
    </head>
    <body class="dashboard <?php echo $bodyClass; ?>">
        <div class="wrapper">
            <?php require('sidebar.php'); ?>
            <div class="content">
                <div class="contentTop">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="labelLogo">
                                    <img src="<?php echo base_url('view/uploads/label/' . get_option('site_logo_url')); ?>" alt="Armada Music">
                                    <a class="settingsIconLink" href="<?php echo base_url('manager/index.php?page=settings'); ?>"><i class="fas fa-cog"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <div class="userMeta">
                                    <a href="javascript:;" class="userIcon">
                                        <?php echo get_user_value('artist_alias'); ?>
                                        <?php
                                            $smallAvatar = base_url('view/uploads/manager/users-photos/' . get_user_value('artist_photo'));
                                            if (get_user_value('artist_photo')) {
                                                echo '<img class="smallAvatar" src="' . $smallAvatar . '" alt="' . get_user_value('artist_alias') . '">';
                                            } else {
                                                echo '<i class="fas fa-user-circle"></i>';
                                            }
                                        ?>
                                    </a>
                                    <div class="userMetaSubNav">
                                        <ul>
                                            <li>
                                                <a href="<?php echo base_url('manager/index.php?page=account-settings'); ?>"><?php echo get_translate('Settings', 'Настройки'); ?></a>
                                            </li>
                                            <li>
                                                <a href="<?php echo base_url('logout.php'); ?>"><?php echo get_translate('Logout', 'Выйти'); ?></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dashboardBreadcrumbs">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <ul>
                                    <?php if ( $_GET ) : ?>
                                        <li>
                                            <a href="<?php echo base_url('manager/'); ?>">
                                                <i class="fas fa-home"></i> <?php echo get_translate('Home', 'Главная'); ?>
                                            </a>
                                        </li>
                                        <li>
                                            <span>/</span>
                                        </li>
                                        <li>
                                            <span><?php echo str_replace([' | '], '', get_dashboard_page()); ?></span>
                                        </li>
                                    <?php else : ?>
                                        <li>
                                            <span><i class="fas fa-home"></i> <?php echo get_translate('Home', 'Главная'); ?></span>
                                        </li>
                                    <?php endif; ?>
	                                <?php if ( $_GET['action'] == 'create' ) : ?>
                                        <li>
                                            <a href="<?php echo base_url('manager/index.php?page=promos'); ?>">
				                                <?php echo get_translate('Promos', 'Промо Кампании'); ?>
                                            </a>
                                        </li>
                                        <li>
                                            <span>/</span>
                                        </li>
                                        <li>
                                            <span><?php echo get_translate('Create New Campaign', 'Создание Новой Кампании'); ?></span>
                                        </li>
	                                <?php endif; ?>
                                    <?php if ( $_GET['action'] == 'edit' && !$_GET['preparation'] ) : ?>
                                        <li>
                                            <a href="<?php echo base_url('manager/index.php?page=promos'); ?>">
                                                <?php echo get_translate('Promos', 'Промо Кампании'); ?>
                                            </a>
                                        </li>
                                        <li>
                                            <span>/</span>
                                        </li>
                                        <li>
                                            <span><?php echo get_translate('Edit Campaign', 'Изменить Кампанию'); ?></span>
                                        </li>
                                    <?php endif; ?>
                                    <?php if ( $_GET['preparation'] ) : ?>
                                        <li>
                                            <a href="<?php echo base_url('manager/index.php?page=promos'); ?>">
                                                <?php echo get_translate('Promos', 'Промо Кампании'); ?>
                                            </a>
                                        </li>
                                        <li>
                                            <span>/</span>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('manager/edit.php?type=campaign&campaign_id=' . $_GET['campaign_id'] . '&action=edit'); ?>" style="margin-left: 3px;">
                                                <?php echo get_translate('Edit Campaign', 'Изменить Кампанию'); ?>
                                            </a>
                                        </li>
                                        <?php if ($_GET['preparation'] != 'send_campaign') : ?>
                                            <li>
                                                <span>/</span>
                                            </li>
                                            <li>
                                                <span><?php echo get_translate('Send Campaign', 'Разослать Кампанию'); ?></span>
                                            </li>
                                        <?php else : ?>
                                            <li>
                                                <span>/</span>
                                            </li>
                                            <li>
                                                <a href="<?php echo base_url('manager/edit.php?type=campaign&campaign_id=' . $_GET['campaign_id'] . '&action=edit&preparation=send'); ?>" style="margin-left: 3px;">
                                                    <?php echo get_translate('Send Campaign', 'Разослать Кампанию'); ?>
                                                </a>
                                            </li>
                                            <li>
                                                <span>/</span>
                                            </li>
                                            <li>
                                                <span><?php echo get_translate('Submission', 'Отправка'); ?></span>
                                            </li>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mainContentSection">
