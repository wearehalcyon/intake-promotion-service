<?php
$campaignsCountActive = R::count('promos', 'promo_status = ?', ['active']);
$campaignsCountUnactive = R::count('promos', 'promo_status = ?', ['unactive']);

$promos = R::findAll('promos', 'ORDER BY promo_creation_date DESC');

if (isset($_POST['delete_campaign'])){
    $delete = R::findOne('promos', 'id = ?', [$_POST['delete_campaign']]);
    $deleteReviews = R::findAll('reviews', 'promo_id = ?', [$_POST['delete_campaign']]);
    R::trash($delete);
    R::trashAll($deleteReviews);
    R::freeze(true);
    echo '<meta http-equiv="refresh" content="0; URL=/manager/index.php?page=promos">';
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="pageTitle"><?php echo get_translate('Statistics', 'Статистика'); ?></h1>
        </div>
        <div class="col-md-12 col-card">
            <div class="newsSection card">
                <h4><?php echo get_translate('All Campaigns', 'Все Кампании'); ?></h4>
                <p class="subTitle"><?php echo get_translate('Active Campaigns', 'Активные Кампании'); ?> - (<?php echo $campaignsCountActive; ?>) | <?php echo get_translate('Unactive Campaigns', 'Не Активные Кампании'); ?> - (<?php echo $campaignsCountUnactive; ?>)</p>
                <div class="queryTable table">
                    <table class="table users-artists-table">
                        <thead>
                        <tr>
                            <th scope="col"><?php echo get_translate('#', '#'); ?></th>
                            <th scope="col"><?php echo get_translate('Cover', 'Обложка'); ?></th>
                            <th scope="col"><?php echo get_translate('Campaign Title', 'Название Кампании'); ?></th>
                            <th scope="col"><?php echo get_translate('Release Date', 'Дата Релиза'); ?></th>
                            <th scope="col"><?php echo get_translate('Creation Date', 'Дата Создания'); ?></th>
                            <th scope="col"><?php echo get_translate('Campaign Status', 'Статус Кампании'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $cid = 1; foreach ($promos as $promo) : ?>
                            <tr>
                                <th scope="row"><?php echo $cid++; ?></th>
                                <?php
                                if ( $promo['promo_cover'] ) {
                                    $promoCover = '<img class="uit-cover" src="' . base_url('view/uploads/promos/campaign/' . $promo['promo_cover']) . '" alt="' . $promo['promo_title'] . '">';
                                } else {
                                    $promoCover = '<i class="fas fa-user-circle no-user-photo"></i>';
                                }
                                ?>
                                <td><?php echo $promoCover; ?></td>
                                <td class="editCampaign">
                                    <a href="/manager/stats.php?type=statistic&campaign=<?php echo $promo['id']; ?>&action=view"><?php echo $promo['promo_title']; ?></a>
                                </td>
                                <td><?php echo $promo['promo_release_date']; ?></td>
                                <td><?php echo $promo['promo_creation_date']; ?></td>
                                <td class="campaignStatus">
                                    <?php
                                    if ( $promo['promo_status'] == 'active' ) {
                                        echo '<span class="statusActive">Active</span>';
                                    } else {
                                        echo '<span class="statusUnactive">Unactive</span>';
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
