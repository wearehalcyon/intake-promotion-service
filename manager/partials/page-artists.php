<?php
    $artistsCount = R::count('artists');

    if ( !$_GET['list'] ) {
        $artists = R::getAll('SELECT * FROM `artists` ORDER BY `id` ASC');
    } elseif ( $_GET['list'] ) {
        $artists = R::findAll('artists', 'artist_group = ?', [$_GET['list']]);
    }

	$siteNameExport = mb_strtolower(str_replace(' ', '-', get_option('site_name')));
	$artstsCSV = dirname(__FILE__) . '/../../view/uploads/export/' . $siteNameExport . '-artists.csv';
    if ( isset( $_POST['exportArtists'] ) && isset( $_POST['source-artists-csv'] ) ) {
	    $output = fopen($artstsCSV, 'w');
	    $artists = R::getAll('SELECT artist_alias, artist_email FROM artists');
	    foreach ($artists as $artist) {
		    fputcsv($output, [$artist['artist_alias'], $artist['artist_email']]);
	    }
        header("Location: /manager/index.php?page=artists");
	    exit;
    } elseif ( isset( $_POST['deleteExportArtists'] ) ) {
        unlink($artstsCSV);
	    header("Location: /manager/index.php?page=artists");
	    exit;
    }
 ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="pageTitle">
                <div class="pageTitleLayer">
	                <?php echo get_translate('Artists', 'Артисты'); ?>
                </div>
                <div class="exportArtistsForm">
                    <form id="makeArtistsExport" action="" method="post">
                        <input hidden type="text" name="source-artists-csv" value="<?php echo base_url('view/uploads/export/' . $siteNameExport . '-artists.csv'); ?>">
                        <?php if (file_exists($artstsCSV)) : ?>
                            <a class="button downloadCsv" href="<?php echo base_url('view/uploads/export/' . $siteNameExport . '-artists.csv'); ?>" download>
                                <?php echo get_translate('Download Latest Generated Artists List', 'Скачать Последний Сгенерированый Список Артистов'); ?>
                            </a>
                            <button type="submit" name="deleteExportArtists" class="button">
		                        <?php echo get_translate('Delete Export File', 'Удалить Файл Экспорта'); ?>
                            </button>
                            <span>
                                <?php echo get_translate('Export file already exist.', 'Файл экспорта создан.'); ?>
                            </span>
                        <?php else : ?>
                            <button type="submit" name="exportArtists" class="button">
		                        <?php echo get_translate('Export Artists', 'Экспортировать Артистов'); ?>
                            </button>
                            <span>
                                <?php echo get_translate('Export will create CSV file.', 'Экспорт создаст CSV файл.'); ?>
                            </span>
                        <?php endif; ?>
                    </form>
                </div>
            </h1>
        </div>
        <div class="col-md-12 col-card">
            <div class="newsSection card">
                <h4><?php echo get_translate('All Artists List', 'Весь Список Артистов'); ?></h4>
                <p class="subTitle">
                    <span class="stLeft">
                        <?php echo get_translate('Active Artists', 'Активные Артисты'); ?> - (<?php echo $artistsCount; ?>)
                    </span>
                    <span class="stRight">
                        <span class="filter_title">
                            <?php echo get_translate('Artists Filter', 'Фильтр Артистов'); ?>
                        </span>
                        <select class="select artists_filter" name="artists_filter">
                            <option value="list_all">All Artists</option>
                            <option value="list_dev" <?php if ( $_GET['list'] === 'list_dev' ) { echo 'selected'; }; ?>>Development</option>
                            <option value="list_a" <?php if ( $_GET['list'] === 'list_a' ) { echo 'selected'; }; ?>>List A</option>
                            <option value="list_b" <?php if ( $_GET['list'] === 'list_b' ) { echo 'selected'; }; ?>>List B</option>
                            <option value="list_c" <?php if ( $_GET['list'] === 'list_c' ) { echo 'selected'; }; ?>>List C</option>
                            <option value="list_d" <?php if ( $_GET['list'] === 'list_d' ) { echo 'selected'; }; ?>>List D</option>
                        </select>
                    </span>
                </p>
                <div class="queryTable table">
                    <table class="table users-artists-table">
                        <thead>
                            <tr>
                                <th scope="col"><?php echo get_translate('#ID', '#ID'); ?></th>
                                <th scope="col"><?php echo get_translate('Artist', 'Артист'); ?></th>
                                <th scope="col"><?php echo get_translate('Email', 'Email'); ?></th>
                                <th scope="col"><?php echo get_translate('List', 'Список'); ?></th>
                                <th scope="col"><?php echo get_translate('Submited', 'Зарегистрирован'); ?></th>
                                <th scope="col"><?php echo get_translate('Last Login', 'Последнее Посещение'); ?></th>
                                <th scope="col"><?php echo get_translate('IP', 'IP Адрес'); ?></th>
                                <th scope="col"><?php echo get_translate('Role', 'Роль'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($artists as $artist) : ?>
                                <tr<?php if ( $artist['artist_username'] == $user->artist_username ) { echo ' class="currentUserLoggedIn"'; } ?>>
                                    <th scope="row"><?php echo $artist['id']; ?></th>
                                    <?php
                                        if ( $artist['artist_group'] == 'list_dev' ) {
                                            $userGroup = 'List DEV';
                                        } elseif ( $artist['artist_group'] == 'list_a' ) {
                                            $userGroup = 'List A';
                                        } elseif ( $artist['artist_group'] == 'list_b' ) {
                                            $userGroup = 'List B';
                                        } elseif ( $artist['artist_group'] == 'list_c' ) {
                                            $userGroup = 'List C';
                                        } elseif ( $artist['artist_group'] == 'list_d' ) {
                                            $userGroup = 'List D';
                                        }
                                    ?>
                                    <td><?php echo $artist['artist_alias']; ?></td>
                                    <td><?php echo $artist['artist_email']; ?></td>
                                    <td><?php echo $userGroup; ?></td>
                                    <td><?php echo $artist['artist_creation_date']; ?></td>
                                    <td><?php echo $artist['artist_last_login']; ?></td>
                                    <td><?php echo $artist['artist_ip']; ?></td>
                                    <td<?php if ( $artist['artist_role'] == 'admin' ) { echo ' class="admin"'; } ?>><strong><?php echo ucfirst($artist['artist_role']); ?></strong></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
