<?php
$data = $_POST;
$create = R::findOne('promos', 'id = ?', [$_GET['campaign_id']]);
if (isset($data['createCanpaign'])) {
    $update = R::findOne('promos', 'id = ?', [$_GET['campaign_id']]);
    if ( !empty( $data['settitle'] ) ) {
        $update->promo_title = $data['settitle'];
    } else {
        $update->promo_title = get_translate('Unspecified Campaign Name', 'Не Установленное Имя Кампании');
    }
    $update->promo_artist_name = $data['relartistname'];
    $update->promo_track_name = $data['reltrackname'];
    $update->promo_track_desc = $data['reltrackdesc'];
    $update->promo_description = $data['text'];
    $update->promo_description = $data['text'];
    $update->promo_creation_date = date('F d Y / H:i:s');
    if ( !empty( $data['releasedate'] ) ) {
        $update->promo_release_date = $data['releasedate'];
    } else {
        if ( $create->promo_release_date ) {
            $update->promo_release_date = $create->promo_release_date;
        } else {
            $update->promo_release_date = get_translate('Not Set', 'Не Выбрано');
        }
    }
    $update->promo_status = 'active';
    $update->promo_cover = $data['cover'];
    $artistScoial = [
        'facebook' => $data['facebook'],
        'twitter' => $data['twitter'],
        'instagram' => $data['instagram'],
        'vk' => $data['vk'],
    ];
    $update->promo_artist_social = json_encode($artistScoial, JSON_UNESCAPED_SLASHES);
    $update->promo_mail_theme = $data['mail_theme'];
	$update->promo_public_theme = $data['public_theme'];
	$update->promo_status = $data['status'];

    foreach ($_POST['track'] as $track)  {
        if (!empty($track['artist']) && !empty($track['title']) && !empty($track['description']) && !empty($track['source'])) {
            $tracknameSrc = json_encode($_POST['track']);
            $update->promo_track_preview = str_replace(['[', ']'], ['{', '}'], $tracknameSrc);
        } else {
            $update->promo_track_preview = $create->promo_track_preview;
        }
    }

    R::store($update);
    echo '<meta http-equiv="refresh" content="0; URL=/manager/edit.php?type=campaign&campaign_id=' . $_GET['campaign_id'] . '&result=success">';
}
?>
<div class="container-fluid">
    <?php if ($_GET['result'] == 'success') : ?>
        <div class="row">
            <div class="col-md-12">
                <p class="campaignCreated">
                    <?php echo get_translate('Done! Campaign updated.', 'Готово! Кампания обновлена.'); ?>
                    <a href="/manager/edit.php?type=campaign&campaign_id=<?php echo $last_record->id; ?>"><a href="<?php echo base_url('promo/index.php?campaign=' . $_GET['campaign_id'] . '&unique=' . hash('sha256', $promo['id'])); ?>" target="_blank"><?php echo get_translate('View', 'Посмотреть'); ?></a>
                </p>
            </div>
        </div>
    <?php endif; ?>
    <form action="" method="post">
        <div class="row">
            <div class="col-md-12">
                <div class="campaignSetName">
                    <input type="text" name="settitle" value="<?php echo $create->promo_title; ?>">
                </div>
            </div>
            <div class="col-md-3 col-card">
                <div class="newCampaignCard card">
                    <h4><?php echo get_translate('Cover', 'Обложка'); ?></h4>
                    <div class="campaignNewContent">
                        <div class="coverPreview">
                            <img src="<?php echo base_url('view/uploads/promos/campaign/'.$create->promo_cover) ?>" alt="Cover Preview">
                        </div>
                        <input type="text" name="cover" value="<?php echo $create->promo_cover; ?>" hidden>
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
                                <input type="text" name="relartistname" value="<?php echo $create->promo_artist_name; ?>">
                            </label>
                        </p>
                        <p class="formControl">
                            <label>
                                <strong><?php echo get_translate('Release Track Title', 'Название Трека'); ?></strong>
                                <input type="text" name="reltrackname" value="<?php echo $create->promo_track_name; ?>">
                            </label>
                        </p>
                        <p class="formControl">
                            <label>
                                <strong><?php echo get_translate('Release Description', 'Описание Релиза'); ?></strong>
                                <input type="text" name="reltrackdesc" value="<?php echo $create->promo_track_desc; ?>">
                            </label>
                        </p>
                    </div>
                </div>
                <div class="newCampaignCard card">
                    <h4><?php echo get_translate('Artist Social', 'Социальные Сети Артиста'); ?></h4>
                    <div class="campaignNewContent">
                        <?php
                            $socialUrls = json_decode($create->promo_artist_social);
                            $socialArr = [];
                            foreach ($socialUrls as $socialUrl => $value) {
                                $socialArr[] = $value;
                                $facebook = $socialArr[0];
                                $twitter = $socialArr[1];
                                $instagram = $socialArr[2];
                                $vk = $socialArr[3];
                            }
                        ?>
                        <p class="formControl">
                            <label>
                                <strong>Facebook</strong>
                                <input type="text" name="facebook" value="<?php echo $facebook; ?>">
                            </label>
                        </p>
                        <p class="formControl">
                            <label>
                                <strong>Twitter</strong>
                                <input type="text" name="twitter" value="<?php echo $twitter; ?>">
                            </label>
                        </p>
                        <p class="formControl">
                            <label>
                                <strong>Instagram</strong>
                                <input type="text" name="instagram" value="<?php echo $instagram; ?>">
                            </label>
                        </p>
                        <p class="formControl">
                            <label>
                                <strong>VK</strong>
                                <input type="text" name="vk" value="<?php echo $vk; ?>">
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
                            <textarea rows="10" cols="55" name="text">
                                <?php echo $create->promo_description; ?>
                            </textarea>
                        </p>
                    </div>
                </div>
                <div class="newCampaignCard card">
                    <h4><?php echo get_translate('Media', 'Медиа'); ?></h4>
                    <div class="campaignNewContent">
                        <div class="container-fluid addTrackfile">
                            <ol class="currentTracklist">
                                <strong><?php echo get_translate('Current Tracklist', 'Текущий Треклист'); ?></strong>
                                <?php
                                    $tracksList = json_decode($create->promo_track_preview);
                                    $trackNum = 1;
                                    foreach ($tracksList as $track) {
                                ?>
                                    <li class="trackListItem">
                                        <span class="trackMetadata">
                                            <?php echo $trackNum++ . '. ' . $track->artist . ' - ' . $track->title . ' (' . $track->description . ')'; ?>
                                        </span>
                                        <button type="button" class="playTrack" data-preview-src="<?php echo base_url('view/uploads/promos/preview/' . str_replace(' ', '-', $track->source)) ?>">
                                            <span>
                                                <i class="far fa-play-circle"></i>
                                            </span>
                                        </button>
                                    </li>
                                <?php } ?>
                                <div id="load"></div>
                                <div id="wavesurfer"></div>
                            </ol>
                            <div class="editableCreateNewTracklist">
                                <button type="button" class="button">
                                    <?php echo get_translate('Create New Tracklist', 'Создать Новый Треклист'); ?>
                                </button>
                            </div>
                            <ol class="ditableTracklist multitrackTracklist">
                                <strong class="mtl"><?php echo get_translate('Create New Tracklist', 'Создать Новый Треклист'); ?></strong>
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
                        <div class="editableAddTrackButton atfButton">
                            <button type="button" class="button hideTracklistCreator">
                                <?php echo get_translate('Close Tracklist Creator', 'Закрыть Создатель Треклиста'); ?>
                            </button>
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
                                <?php
                                    if ($_GET['result'] == 'success') {
                                        echo get_translate('Updated At: ', 'Обновлено: ') . $create->promo_creation_date;
                                    } else {
                                        echo get_translate('Last Creation/Update Date: ', 'Дата Создания и Последнего Обновления: ') . $create->promo_creation_date;
                                    }
                                ?>
                            </label>
                        </p>
                        <p class="formControl">
                            <label>
                                <strong><?php echo get_translate('Release Date', 'Дата Релиза'); ?>: <?php echo $create->promo_release_date; ?></strong>
                            </label>
                        </p>
                        <hr>
                        <p class="formControl">
                            <label>
                                <strong><?php echo get_translate('Change Release Date', 'Изменить Дату Релиза'); ?></strong>
                                <input id="flatpickr" type="date" name="releasedate" value="<?php echo $create->promo_release_date; ?>">
                            </label>
                        </p>
                        <p class="formControl">
                            <strong class="forSelect"><?php echo get_translate('Mail Sender Theme', 'Тема Для Почтовой Рассылки'); ?></strong>
                            <select class="select" name="mail_theme">
                                <?php if ($create->promo_mail_theme == 'light') : ?>
                                    <option value="light" selected><?php echo get_translate('Light', 'Светлая'); ?></option>
                                    <option value="dark"><?php echo get_translate('Dark', 'Темная'); ?></option>
                                <?php else : ?>
                                    <option value="light"><?php echo get_translate('Light', 'Светлая'); ?></option>
                                    <option value="dark" selected><?php echo get_translate('Dark', 'Темная'); ?></option>
                                <?php endif; ?>
                            </select>
                        </p>
                        <p class="formControl">
                            <strong class="forSelect"><?php echo get_translate('Public Theme', 'Публичная Тема'); ?></strong>
                            <select class="select" name="public_theme">
	                            <?php
		                            $tplFolders = scandir(dirname(__DIR__) . '../../view/templates/public/');
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
                            <strong class="forSelect"><?php echo get_translate('Status', 'Состояние'); ?></strong>
                            <select class="select" name="status">
			                    <?php if ($create->promo_status == 'active') : ?>
                                    <option value="active" selected><?php echo get_translate('Active', 'Активно'); ?></option>
                                    <option value="unactive"><?php echo get_translate('Unactive', 'Не Активно'); ?></option>
			                    <?php else : ?>
                                    <option value="active"><?php echo get_translate('Active', 'Активно'); ?></option>
                                    <option value="unactive" selected><?php echo get_translate('Unactive', 'Не Активно'); ?></option>
			                    <?php endif; ?>
                            </select>
                        </p>
                        <p class="formControl">
                            <button type="submit" name="createCanpaign" class="button"><?php echo get_translate('Update', 'Обновить'); ?></button>
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