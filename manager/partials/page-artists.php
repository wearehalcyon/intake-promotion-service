<?php
    $artistsCount = R::count('artists');

    $artists = R::getAll('SELECT * FROM `artists`');
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="pageTitle"><?php echo get_translate('Artists', 'Артисты'); ?></h1>
        </div>
        <div class="col-md-12 col-card">
            <div class="newsSection card">
                <h4><?php echo get_translate('All Artists List', 'Весь Список Артистов'); ?></h4>
                <p class="subTitle"><?php echo get_translate('Active Artists', 'Активные Артисты'); ?> - (<?php echo $artistsCount; ?>)</p>
                <div class="queryTable table">
                    <table class="table users-artists-table">
                        <thead>
                            <tr>
                                <th scope="col"><?php echo get_translate('#ID', '#ID'); ?></th>
                                <th scope="col"><?php echo get_translate('Photo', 'Фото'); ?></th>
                                <th scope="col"><?php echo get_translate('Artist', 'Артист'); ?></th>
                                <th scope="col"><?php echo get_translate('Email', 'Email'); ?></th>
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
                                        if ( $artist['artist_photo'] ) {
                                            $userPhoto = '<img class="uit-photo" src="' . base_url('view/uploads/manager/users-photos/' . $artist['artist_photo']) . '" alt="' . $artist['artist_alias'] . '">';
                                        } else {
                                            $userPhoto = '<i class="fas fa-user-circle no-user-photo"></i>';
                                        }
                                    ?>
                                    <td><?php echo $userPhoto; ?></td>
                                    <td><?php echo $artist['artist_alias']; ?></td>
                                    <td><?php echo $artist['artist_email']; ?></td>
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
