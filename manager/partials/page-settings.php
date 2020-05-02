<?php
    $data = $_POST;
    if (isset($data['submit'])) {
        $update = R::findOne('options', 'id=?', [1]);
        $update->site_name = $_POST['sitename'];
        $update->site_description = $_POST['sitedescription'];
	    $update->site_email = $_POST['siteemail'];
	    $update->label_url = $_POST['labelurl'];
        if (isset($_POST['debuger'])) {
            $update->debuger_enabler = 1;
        } elseif (!isset($_POST['debuger'])) {
            $update->debuger_enabler = 0;
        }
        $update->app_language = $_POST['app_language'];
        if (isset($_POST['app_ui_mode'])) {
            $update->app_ui_mode = 1;
        } elseif (!isset($_POST['app_ui_mode'])) {
            $update->app_ui_mode = 0;
        }
        $appScoial = [
            'facebook' => $_POST['facebook'],
            'twitter' => $_POST['twitter'],
            'instagram' => $_POST['instagram'],
            'vk' => $_POST['vk'],
            'linkedin' => $_POST['linkedin'],
            'youtube' => $_POST['youtube'],
        ];
        $update->app_social = json_encode($appScoial,JSON_UNESCAPED_SLASHES);
        $smtpSettings = [
            'server' => $_POST['smtp_server'],
            'port' => $_POST['smtp_port'],
            'username' => $_POST['smtp_login'],
            'password' => $_POST['smtp_password'],
            'sendfrom' => $_POST['smtp_sendfrom'],
        ];
        $update->mailer_settings = json_encode($smtpSettings,JSON_UNESCAPED_SLASHES);
        R::store($update);
        echo '<meta http-equiv="refresh" content="0; URL=/manager/index.php?page=settings&result=updated">';
    }

    $artists = R::findAll('artists',  'artist_role = ?', ['admin']);
?>
<div class="container-fluid">
    <?php if ($_GET['result'] == 'updated') : ?>
        <div class="row">
            <div class="col-md-12">
                <p class="campaignCreated">
                    <?php echo get_translate('Settings Updated.', 'Настройки Обновлены.'); ?>
                </p>
            </div>
        </div>
    <?php endif; ?>
    <div class="PhotoUploaderPopup">
        <div id="dropzone" class="photoChanger">
            <div id="upload_photo_manager" class="upload_photo">
                <div class="dz-message">
					<?php echo get_translate('Upload Image Here<br>(Only JPG/PNG)', 'Загружайте изображения сюда<br>(Только JPG/PNG)'); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="PhotoUploaderBannerPopup">
        <div id="dropzone" class="photoChanger">
            <div id="upload_photo_banner" class="upload_photo">
                <div class="dz-message">
					<?php echo get_translate('Upload Image Here<br>(Only JPG/PNG)', 'Загружайте изображения сюда<br>(Только JPG/PNG)'); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h1 class="pageTitle"><?php echo get_translate('General Settings', 'Главные Настройки'); ?></h1>
        </div>
        <form id="settings_form" class="settings_form" action="" method="post">
            <div class="col-md-6 col-card">
                <div class="newsSection card">
                    <div class="queryTable table">
                        <table class="table generalSettingsTable">
                            <tbody>
                                <tr>
                                    <td>
                                        <strong><?php echo get_translate('Name', 'Название'); ?></strong>
                                    </td>
                                    <td>
                                        <input class="input" type="text" name="sitename" value="<?php echo get_option('site_name'); ?>" placeholder="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong><?php echo get_translate('Meta Description', 'Meta Описание'); ?></strong>
                                    </td>
                                    <td>
                                        <input class="input" type="text" name="sitedescription" value="<?php echo get_option('site_description'); ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong><?php echo get_translate('Email', 'Email'); ?></strong>
                                    </td>
                                    <td>
                                        <input class="input" type="text" name="siteemail" value="<?php echo get_option('site_email'); ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong><?php echo get_translate('Label Site URL', 'Ссылка На Сайт Лейбла'); ?></strong>
                                    </td>
                                    <td>
                                        <input class="input" type="text" name="labelurl" value="<?php echo get_option('label_url'); ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong><?php echo get_translate('Label Logo', 'Логотип Лейбла'); ?></strong>
                                    </td>
                                    <td>
                                        <button type="button" class="button changeLabelLogo" name="button" href="javascript:;">
                                            <?php echo get_translate('Change', 'Изменить'); ?>
                                        </button>
                                        <span class="labelLogoUrl"><?php echo base_url('view/uploads/label/' . get_option('site_logo_url')); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong><?php echo get_translate('Label Banner', 'Баннер Лейбла'); ?></strong>
                                    </td>
                                    <td>
                                        <button type="button" class="button changeLabelbanner" name="button" href="javascript:;">
                                            <?php echo get_translate('Change', 'Изменить'); ?>
                                        </button>
                                        <span class="labelLogoUrl"><?php echo base_url('view/uploads/label/' . get_option('label_banner')); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong><?php echo get_translate('Administrators', 'Администраторы'); ?></strong>
                                    </td>
                                    <td>
                                        <ul class="appAdminList">
                                            <?php
                                                foreach ($artists as $artist) {
                                                    echo '<li><a href="mailto:' . $artist['artist_email'] . '"><span class="appAdmin">' . $artist['artist_alias'] . '</span></a></li>';
                                                }
                                            ?>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong><?php echo get_translate('Enable Debuger', 'Включить Дебагер'); ?></strong>
                                        <span class="settingDesc"><?php echo get_translate('Monitor the status of the server, its data and application performance using this tool. It should be borne in mind that the activation of the module slightly reduces performance, since data is collected on processor activity, RAM and other server indicators.', 'Следите за состоянием сервера, его данными и производительностью приложения, с помощью этого инструмента. Стоит учитывать, что активация модуля, немного снижает производительность, так как производится сбор данных активности процессора, оперативной памяти и других показателей сервера.'); ?></span>
                                        <!-- <span class="settingDesc"><?php echo get_translate('Please note that with the debugger turned on, the PJax module will not work.', 'Обратите внимание, что при включеном дебагере, не будет работать модуль PJax.'); ?></span> -->
                                    </td>
                                    <td>
                                        <?php
                                            if (get_option('debuger_enabler')) {
                                                echo '<div class="pretty pretty p-switch p-fill">
                                                        <input type="checkbox" name="debuger" checked />
                                                        <div class="state p-success">
                                                            <label></label>
                                                        </div>
                                                    </div>';
                                            } else {
                                                echo '<div class="pretty pretty p-switch p-fill">
                                                        <input type="checkbox" name="debuger" />
                                                        <div class="state p-success">
                                                            <label></label>
                                                        </div>
                                                    </div>';
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <!-- <tr>
                                    <td>
                                        <strong><?php echo get_translate('Enable PJax', 'Включить PJax'); ?></strong>
                                    </td>
                                    <td>
                                        <?php
                                            if (get_option('pjax_enabler')) {
                                                echo '<div class="pretty pretty p-switch p-fill">
                                                        <input type="checkbox" name="pjax" checked />
                                                        <div class="state p-success">
                                                            <label></label>
                                                        </div>
                                                    </div>';
                                            } else {
                                                echo '<div class="pretty pretty p-switch p-fill">
                                                        <input type="checkbox" name="pjax" />
                                                        <div class="state p-success">
                                                            <label></label>
                                                        </div>
                                                    </div>';
                                            }
                                        ?>
                                    </td>
                                </tr> -->
                                <tr>
                                    <td>
                                        <strong><?php echo get_translate('App Language', 'Язык приложения'); ?></strong>
                                    </td>
                                    <td>
                                        <select class="select" name="app_language">
                                            <?php if (get_option('app_language') == 'en') : ?>
                                                <option value="en" selected>English</option>
                                                <option value="ru">Russian</option>
                                            <?php else : ?>
                                                <option value="en">Английский</option>
                                                <option value="ru" selected>Русский</option>
                                            <?php endif; ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong><?php echo get_translate('Enable Dark Mode', 'Включить Темный Режим'); ?></strong>
                                    </td>
                                    <td>
                                        <?php
                                            if (get_option('app_ui_mode')) {
                                                echo '<div class="pretty pretty p-switch p-fill">
                                                        <input type="checkbox" name="app_ui_mode" checked />
                                                        <div class="state p-success">
                                                            <label></label>
                                                        </div>
                                                    </div>';
                                            } else {
                                                echo '<div class="pretty pretty p-switch p-fill">
                                                        <input type="checkbox" name="app_ui_mode" />
                                                        <div class="state p-success">
                                                            <label></label>
                                                        </div>
                                                    </div>';
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                                    $appSocials = get_option('app_social');
                                    $appSocial = json_decode($appSocials);
                                ?>
                                <tr>
                                    <td>
                                        <strong><?php echo get_translate('Facebook', 'Facebook'); ?></strong>
                                    </td>
                                    <td>
                                        <p class="formControl">
                                            <input type="text" name="facebook" value="<?php echo $appSocial->{'facebook'}; ?>">
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong><?php echo get_translate('Twitter', 'Twitter'); ?></strong>
                                    </td>
                                    <td>
                                        <p class="formControl">
                                            <input type="text" name="twitter" value="<?php echo $appSocial->{'twitter'}; ?>">
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong><?php echo get_translate('Instagram', 'Instagram'); ?></strong>
                                    </td>
                                    <td>
                                        <p class="formControl">
                                            <input type="text" name="instagram" value="<?php echo $appSocial->{'instagram'}; ?>">
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong><?php echo get_translate('LinkedIn', 'LinkedIn'); ?></strong>
                                    </td>
                                    <td>
                                        <p class="formControl">
                                            <input type="text" name="linkedin" value="<?php echo $appSocial->{'linkedin'}; ?>">
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong><?php echo get_translate('YouTube', 'YouTube'); ?></strong>
                                    </td>
                                    <td>
                                        <p class="formControl">
                                            <input type="text" name="youtube" value="<?php echo $appSocial->{'youtube'}; ?>">
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong><?php echo get_translate('VK', 'VK'); ?></strong>
                                    </td>
                                    <td>
                                        <p class="formControl">
                                            <input type="text" name="vk" value="<?php echo $appSocial->{'vk'}; ?>">
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="tableSubmit">
                            <button type="submit" class="button" name="submit"><?php echo get_translate('Save', 'Сохранить'); ?></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="newsSection card">
                    <div class="queryTable table">
                        <table class="table generalSettingsTable">
                            <tbody>
                                <tr>
                                    <td>
                                        <h2><?php echo get_translate('SMTP Settings', 'Настройки SMTP'); ?></h2>
                                        <span><?php echo get_translate('Setup your SMTP settings for sending campaigns.', 'Настройте параметры SMTP для отправки кампаний.'); ?></span>
                                    </td>
                                    <td></td>
                                    <?php
                                        $stmpSettings = get_option('mailer_settings');
                                        $stmpSetting = json_decode($stmpSettings);
                                    ?>
                                    <td>
                                        <strong><?php echo get_translate('SMTP Server', 'SMTP Сервер'); ?></strong>
                                    </td>
                                    <td>
                                        <p class="formControl">
                                            <input type="text" name="smtp_server" value="<?php echo $stmpSetting->{'server'}; ?>">
                                        </p>
                                    </td>
                                    <td>
                                        <strong><?php echo get_translate('Port', 'Порт'); ?></strong>
                                    </td>
                                    <td>
                                        <p class="formControl">
                                            <input type="text" name="smtp_port" value="<?php echo $stmpSetting->{'port'}; ?>">
                                        </p>
                                    </td>
                                    <td>
                                        <strong><?php echo get_translate('Login', 'Логин'); ?></strong>
                                    </td>
                                    <td>
                                        <p class="formControl">
                                            <input type="text" name="smtp_login" value="<?php echo $stmpSetting->{'username'}; ?>">
                                        </p>
                                    </td>
                                    <td>
                                        <strong><?php echo get_translate('Password', 'Пароль'); ?></strong>
                                    </td>
                                    <td>
                                        <p class="formControl">
                                            <input type="password" name="smtp_password" value="<?php echo $stmpSetting->{'password'}; ?>">
                                        </p>
                                    </td>
                                    <td>
                                        <strong><?php echo get_translate('Sender Address', 'Адрес Отправителя'); ?></strong>
                                    </td>
                                    <td>
                                        <p class="formControl">
                                            <input type="text" name="smtp_sendfrom" value="<?php echo $stmpSetting->{'sendfrom'}; ?>">
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="tableSubmit">
                            <button type="submit" class="button" name="submit"><?php echo get_translate('Save', 'Сохранить'); ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
