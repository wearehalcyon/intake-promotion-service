<?php
    //$artists = R::getAll('SELECT * FROM `artists` WHERE id = ?', [$user->id]);

    if (get_user_value('artist_photo') == true) {
        $user_photo = base_url('view/uploads/manager/users-photos/' . get_user_value('artist_photo'));
    } else {
        $user_photo = base_url('includes/assets/images/no-user-photo.svg');
    }

    $user_alias = get_user_value('artist_alias');

    // Account Form Action
    if (isset($_POST['updateAccount'])) {

        // Make record
        $updateAccount = R::findOne('artists', 'id = ?', [$_SESSION['logged_user']->id]);
            $updateAccount->artist_username = $_POST['artist_username'];
            $updateAccount->artist_first_name = $_POST['artist_first_name'];
            $updateAccount->artist_last_name = $_POST['artist_last_name'];
            $updateAccount->artist_alias = $_POST['artist_alias'];
            $updateAccount->artist_email = $_POST['artist_email'];
            if ( !empty( $_POST['artist_password'] ) ) {
                $updateAccount->artist_password = password_hash($_POST['artist_password'], PASSWORD_DEFAULT);
            }
        R::store($updateAccount);
        //echo '<meta http-equiv="refresh" content="0; URL=/manager/index.php?page=' . $_GET['page'] . '">';
        header('location: /manager/index.php?page=account-settings&result=updated');
        exit;
    }

?>
<div class="container-fluid">
    <div class="PhotoUploaderPopup">
        <div id="dropzone" class="photoChanger">
            <div id="upload_photo" class="upload_photo">
                <div class="dz-message">
                    <?php echo get_translate('Upload Image Here<br>(Only JPG/PNG)', 'Загружайте изображения сюда<br>(Только JPG/PNG)'); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php echo $updateMessage; ?>
            <?php if ( $_GET['result'] == 'updated' ) { ?>
                <div class="formSubmit success">
                    <p>
                        <?php echo get_translate('Your account details was updated.', 'Данные вашего аккаунта были обновлены.'); ?>
                    </p>
                </div>
            <?php } elseif ( $_GET['result'] == 'error' ) { ?>
                <div class="formSubmit error">
                    <p>
                        <?php echo get_translate('Something went wrong. Try again please.', 'Что-то пошло не так. Попробуйте еще раз, пожалуйста.'); ?>
                    </p>
                </div>
            <?php } ?>
        </div>
        <div class="col-md-12">
            <h1 class="pageTitle"><?php echo get_translate('Account Settings', 'Настройки Аккаунта'); ?></h1>
        </div>
        <div class="col-md-4 col-card">
            <div class="newsSection card">
                <h4><?php echo get_translate('Photo Settings', 'Настройки Фото'); ?></h4>
                <div class="cardContent">
                    <div class="userPhoto">
                        <img src="<?php echo $user_photo; ?>" alt="<?php echo $user_alias; ?> Photo">
                    </div>
                    <div class="changePhotoButton">
                        <button type="button" class="button changePhoto" name="button">
                            <?php echo get_translate('Change', 'Изменить'); ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-card">
            <div class="newsSection card">
                <h4><?php echo get_translate('Account Details', 'Детали Аккаунта'); ?></h4>
                <div class="cardContent">
                    <div class="userDetailsData">
                        <table class="table account-details-table">
                            <tbody>
                                <tr>
                                    <td class="adt-key"><strong><?php echo get_translate('Username', 'Юзернейм'); ?>:</strong></td>
                                    <td><?php echo get_user_value('artist_username'); ?></td>
                                </tr>
                                <tr>
                                    <td class="adt-key"><strong><?php echo get_translate('First Name', 'Имя'); ?>:</strong></td>
                                    <td><?php echo get_user_value('artist_first_name'); ?></td>
                                </tr>
                                <tr>
                                    <td class="adt-key"><strong><?php echo get_translate('Last Name', 'Фамилия'); ?>:</strong></td>
                                    <td><?php echo get_user_value('artist_last_name'); ?></td>
                                </tr>
                                <tr>
                                    <td class="adt-key"><strong><?php echo get_translate('Alias', 'Алиас'); ?>:</strong></td>
                                    <td><?php echo get_user_value('artist_alias'); ?></td>
                                </tr>
                                <tr>
                                    <td class="adt-key"><strong><?php echo get_translate('Email', 'Email'); ?>:</strong></td>
                                    <td><?php echo get_user_value('artist_email'); ?></td>
                                </tr>
                                <tr>
                                    <td class="adt-key"><strong><?php echo get_translate('Secret Key', 'Секретный Ключ'); ?>:</strong></td>
                                    <td><?php echo get_user_value('artist_secret_key'); ?></td>
                                </tr>
                                <tr>
                                    <td class="adt-key"><strong><?php echo get_translate('Role', 'Роль'); ?>:</strong></td>
                                    <td style="font-weight: 700;font-style: italic;color: #b30000;"><?php echo get_user_value('artist_role'); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!--<div class="changePhotoButton">
                        <button type="button" class="button changeDetails" name="button">
                            <?php /*echo get_translate('Change', 'Изменить'); */?>
                        </button>
                    </div>-->
                </div>
            </div>
        </div>
        <div class="col-md-4 col-card">
            <div class="newsSection card changingAccDetails">
                <h4><?php echo get_translate('Changing Account Details', 'Смена Деталей Аккаунта'); ?></h4>
                <div class="cardContent">
                    <form id="updateAccount" action="" method="POST">
                        <p class="formControl">
                            <label>
                                <strong><?php echo get_translate('Username', 'Юзернейм'); ?></strong>
                                <input type="text" name="artist_username" value="<?php echo get_user_value('artist_username'); ?>">
                            </label>
                        </p>
                        <p class="formControl">
                            <label>
                                <strong><?php echo get_translate('First Name', 'Имя'); ?></strong>
                                <input type="text" name="artist_first_name" value="<?php echo get_user_value('artist_first_name'); ?>">
                            </label>
                        </p>
                        <p class="formControl">
                            <label>
                                <strong><?php echo get_translate('Last Name', 'Фамилия'); ?></strong>
                                <input type="text" name="artist_last_name" value="<?php echo get_user_value('artist_last_name'); ?>">
                            </label>
                        </p>
                        <p class="formControl">
                            <label>
                                <strong><?php echo get_translate('Alias', 'Алиас'); ?></strong>
                                <input type="text" name="artist_alias" value="<?php echo get_user_value('artist_alias'); ?>">
                            </label>
                        </p>
                        <p class="formControl">
                            <label>
                                <strong><?php echo get_translate('Email', 'Email'); ?></strong>
                                <input type="email" name="artist_email" value="<?php echo get_user_value('artist_email'); ?>">
                            </label>
                        </p>
                        <h4><?php echo get_translate('Password Changing', 'Смена Пароля'); ?></h4>
                        <hr>
                        <p class="formControl">
                            <label>
                                <strong><?php echo get_translate('New Password', 'Новый пароль'); ?></strong>
                                <input type="password" name="artist_password" value="">
                            </label>
                        </p>
                        <p class="formControl changePhotoButton">
                            <button type="submit" class="button" name="updateAccount"><?php echo get_translate('Update', 'Обновить'); ?></button>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
