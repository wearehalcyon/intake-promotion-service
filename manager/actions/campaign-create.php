<?php
$last_record = R::findLast('promos');
$data = $_POST;
if (isset($data['createCanpaign'])) {
    $create = R::dispense('promos');
        if ( !empty( $data['settitle'] ) ) {
            $create->promo_title = $data['settitle'];
        } else {
            $create->promo_title = get_translate('Unspecified Campaign Name', 'Не Установленное Имя Кампании');
        }
        $create->promo_artist_name = $data['relartistname'];
        $create->promo_track_name = $data['reltrackname'];
        $create->promo_track_desc = $data['reltrackdesc'];
        $create->promo_description = $data['text'];
        $create->promo_description = $data['text'];
        $create->promo_creation_date = date('F d Y / H:i:s');
        if ( !empty( $data['releasedate'] ) ) {
            $create->promo_release_date = $data['releasedate'];
        } else {
            $create->promo_release_date = get_translate('Not Set', 'Не Выбрано');
        }
        $create->promo_status = 'active';
        $create->promo_cover = $data['cover'];
        $artistScoial = [
            'facebook' => $data['facebook'],
            'twitter' => $data['twitter'],
            'instagram' => $data['instagram'],
            'vk' => $data['vk'],
        ];
        $create->promo_artist_social = json_encode($artistScoial, JSON_UNESCAPED_SLASHES);
        $create->promo_mail_theme = $data['mail_theme'];
        $create->promo_public_theme = $data['public_theme'];

        $tracknameSrc = json_encode($_POST['track']);
        $create->promo_track_preview = str_replace(['[', ']'], ['{', '}'], $tracknameSrc);
    R::store($create);
    echo '<meta http-equiv="refresh" content="0; URL=/manager/create.php?type=campaign&result=success">';
}
?>
<div class="container-fluid">
    <?php if ($_GET['result'] == 'success') : ?>
        <div class="row">
            <div class="col-md-12">
                <p class="campaignCreated">
                    <?php echo get_translate('Done! Campaign сreated.', 'Готово! Кампания создана.'); ?>
                    <a href="/manager/edit.php?type=campaign&campaign_id=<?php echo $last_record->id; ?>&action=edit"><?php echo get_translate('Edit', 'Изменить'); ?></a> <?php echo get_translate('or', 'или'); ?> <a href="<?php echo base_url('promo/index.php?campaign=' . $promo['id'] . '&unique=' . hash('sha256', $last_record->id)); ?>" target="_blank"><?php echo get_translate('View', 'Посмотреть'); ?></a>
                </p>
            </div>
        </div>
    <?php endif; ?>
    <form action="" method="post">
        <div class="row">
            <div class="col-md-12">
                <div class="campaignSetName">
                    <input type="text" name="settitle" placeholder="<?php echo get_translate('Campaign Title', 'Название Кампании'); ?>">
                </div>
            </div>
            <div class="col-md-3 col-card">
                <div class="newCampaignCard card">
                    <h4><?php echo get_translate('Cover', 'Обложка'); ?></h4>
                    <div class="campaignNewContent">
                        <div class="coverPreview"></div>
                        <input type="text" name="cover" value="" hidden>
                        <div id="dropzone" class="photoChanger">
                            <div id="upload_new_cover" class="upload_photo">
                                <div class="dz-message">
                                    <?php echo get_translate('Upload Image Here<br>(Only JPG/PNG)', 'Загружайте изображения сюда<br>(Только JPG/PNG)'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="newCampaignCard card">
                    <h4><?php echo get_translate('Release Meta', 'Мета Информация Релиза'); ?></h4>
                    <div class="campaignNewContent">
                        <p class="formControl">
                            <label>
                                <strong><?php echo get_translate('Release Artist Name', 'Имя Артиста'); ?></strong>
                                <input type="text" name="relartistname" placeholder="John Doe">
                            </label>
                        </p>
                        <p class="formControl">
                            <label>
                                <strong><?php echo get_translate('Release Track Title', 'Название Трека'); ?></strong>
                                <input type="text" name="reltrackname" placeholder="My World">
                            </label>
                        </p>
                        <p class="formControl">
                            <label>
                                <strong><?php echo get_translate('Release Description', 'Описание Релиза'); ?></strong>
                                <input type="text" name="reltrackdesc" placeholder="Inc. Remixer Edit">
                            </label>
                        </p>
                    </div>
                </div>
                <div class="newCampaignCard card">
                    <h4><?php echo get_translate('Artist Social', 'Социальные Сети Артиста'); ?></h4>
                    <div class="campaignNewContent">
                        <p class="formControl">
                            <label>
                                <strong>Facebook</strong>
                                <input type="text" name="facebook" placeholder="https://facebook.com/">
                            </label>
                        </p>
                        <p class="formControl">
                            <label>
                                <strong>Twitter</strong>
                                <input type="text" name="twitter" placeholder="https://twitter.com/">
                            </label>
                        </p>
                        <p class="formControl">
                            <label>
                                <strong>Instagram</strong>
                                <input type="text" name="instagram" placeholder="https://instagram.com/">
                            </label>
                        </p>
                        <p class="formControl">
                            <label>
                                <strong>VK</strong>
                                <input type="text" name="vk" placeholder="https://vk.com/">
                            </label>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-card">
                <div class="newCampaignCard card">
                    <h4><?php echo get_translate('Campaign Description', 'Описание Кампании'); ?></h4>
                    <div class="campaignNewContent">
                        <p class="formControl">
                            <textarea rows="10" cols="55" name="text"></textarea>
                        </p>
                    </div>
                </div>
                <div class="newCampaignCard card">
                    <h4><?php echo get_translate('Media', 'Медиа'); ?></h4>
                    <div class="campaignNewContent">
                        <div class="container-fluid addTrackfile">
                            <ol class="multitrackTracklist">
                                <li class="row atfRow" data-item-id="track-origin" data-clone-id="1">
                                    <div class="col-md-4">
                                        <p class="formControl">
                                            <input data-input-id="1" data-type="atrist" class="trackname" type="text" name="track[1][artist]" placeholder="<?php echo get_translate('John Doe', 'John Doe'); ?>">
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="formControl">
                                            <input data-input-id="1" data-type="title" class="tracktitle" type="text" name="track[1][title]" placeholder="<?php echo get_translate('My World', 'My World'); ?>">
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="formControl">
                                            <input data-input-id="1" data-type="description" class="trackdescription" type="text" name="track[1][description]" placeholder="<?php echo get_translate('Original Mix', 'Original Mix'); ?>">
                                        </p>
                                    </div>
                                    <div class="col-md-12">
                                        <p class="formControl">
                                            <input data-input-id="1" data-type="source" class="tracksource" type="text" name="track[1][source]" value="">
                                        </p>
                                    </div>
                                    <div class="col-md-12">
                                        <div id="gu-1" class="graphicUploader">
                                            <div id="dropzone_1" class="photoChanger">
                                                <div id="upload_track_1" class="upload_track upload_photo">
                                                    <div class="dz-message">
                                                        <?php echo get_translate('Upload Track Here<br>(Only MP3)', 'Загружайте трек сюда<br>(Только MP3)'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ol>
                        </div>
                        <div class="atfButton">
                            <button type="button" class="button addNewTrackRow">
                                <?php echo get_translate('Add One More Track', 'Добавить Еще Один Трек'); ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-card">
                <div class="newCampaignCard card">
                    <h4><?php echo get_translate('Publishing', 'Публикация'); ?></h4>
                    <div class="campaignNewContent">
                        <p class="formControl">
                            <label>
                                <strong><?php echo get_translate('Creation Date', 'Дата Создания'); ?>: <?php echo date('F d Y'); ?></strong>
                            </label>
                        </p>
                        <p class="formControl">
                            <label>
                                <strong><?php echo get_translate('Choose Release Date', 'Выберите Дату Релиза'); ?></strong>
                                <input id="flatpickr" type="date" name="releasedate" value="Choose Date">
                            </label>
                        </p>
                        <p class="formControl">
                            <strong class="forSelect"><?php echo get_translate('Mail Sender Theme', 'Тема Для Почтовой Рассылки'); ?></strong>
                            <select class="select" name="mail_theme">
                                <?php
                                    $tplMailFolders = scandir('../view/templates/mail/');
                                    foreach ($tplMailFolders as $tplMailFolder) {
                                        if (!is_file($tplMailFolder) && $tplMailFolder != '.' && $tplMailFolder != '..') {
                                            //echo preg_replace('/\.[^.]+$/', '', $tplFolder);
                                            ?>
                                            <option value="<?php echo $tplMailFolder; ?>" <?php if ($create->promo_mail_theme == $tplMailFolder) echo 'selected'; ?>><?php echo ucfirst($tplMailFolder); ?></option>';
                                            <?php
                                        }
                                    }
                                ?>
                            </select>
                        </p>
                        <p class="formControl">
                            <strong class="forSelect"><?php echo get_translate('Public Theme', 'Публичная Тема'); ?></strong>
                            <select class="select" name="public_theme">
	                            <?php
                                    $tplFolders = scandir('../view/templates/public/');
		                            foreach ($tplFolders as $tplFolder) {
			                            if (!is_file($tplFolder) && $tplFolder != '.' && $tplFolder != '..') {
				                            //echo preg_replace('/\.[^.]+$/', '', $tplFolder);
				                            ?>
                                            <option value="<?php echo $tplFolder; ?>" <?php if ($create->promo_public_theme == $tplFolder) echo 'selected'; ?>><?php echo ucfirst($tplFolder); ?></option>';
				                            <?php
			                            }
		                            }
	                            ?>
                            </select>
                        </p>
                        <p class="formControl">
                            <button type="submit" name="createCanpaign" class="button"><?php echo get_translate('Create', 'Создать'); ?></button>
                        </p>
                    </div>
                </div>
                <div class="newCampaignCard card">
                    <h4><?php echo get_translate('Dwonloads', 'Загрузки'); ?></h4>
                    <div class="campaignNewContent">
                        <p class="formControl">
                            <label>
                                <strong><?php echo get_translate('Full Release Archive', 'Архив полного релиза'); ?></strong>
                            </label>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>