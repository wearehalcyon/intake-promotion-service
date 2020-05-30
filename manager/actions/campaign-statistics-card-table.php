<?php

?>
<style media="screen">
    *{
        font-family: 'DejaVu Sans', sans-serif;
        background-color: #fff;
    }
    table{
        width:100%;
        height:auto;
        border:1px solid rgba(0,0,0,0.1);
        padding:20px;
    }
    .pdfLogo{
        width:auto;
        height:60px;
        background-color: #fff;
    }
    .pdfTitle{
        text-align: center;
        font-size: 18px;
    }
    td.powered{
        text-align: right;
        font-size: 13px;
    }
    td.powered strong{
        display: block;
    }
    h1.statsTitle{
        display: block;
        text-align: center;
        padding-top: 40px;
        font-weight: 100;
        font-size: 30px;
    }
    .data{
        display: block;
        text-align: center;
        font-size: 20px;
    }
    table.feedListable tbody tr:nth-child(2n){
        background-color: red;
    }
    .footerTable{
        margin-top: 100px;
    }
</style>
<table>
    <tr>
        <td>
            <img class="pdfLogo" src="<?php echo get_site_logo_url(); ?>">
        </td>
        <td></td>
        <td class="powered">
            <strong>Powered by INTAKE Promotion Service</strong>
            To get this service visit <a href="https://intakedigital.com/" target="_blank">www.intakedigital.com</a>
        </td>
    </tr>
</table>
<h1 class="statsTitle"><?php echo get_promo('title'); ?></h1>
<div class="row">
    <div class="col-md-4">
        <h3 class="pdfTitle">
            <?php echo get_translate('Views', 'Просмотры'); ?>
        </h3>
        <table class="table users-artists-table tracksRating" cellspacing="0" cellpadding="0" style="margin: 0;">
            <thead>
            <tr>
                <th style="width:50%;background-color: #efe7dc;text-align: center;"><?php echo get_translate('Views', 'Просмотры'); ?></th>
                <th style="width:50%;background-color: #efe7dc;text-align: center;"><?php echo get_translate('Total Views', 'Все Просмотры'); ?></th>
            </tr>
            </thead>
            <tr>
                <td style="width:50%;padding: 5px;border:1px solid #ccc;font-size: 12px;text-align: center;background-color: #e2ecea;" class="ratenum"><?php echo $views . ' / ' . $artistlist; ?></td>
                <td style="width:50%;padding: 5px;border:1px solid #ccc;font-size: 12px;text-align: center;background-color: #e2ecea;" class="ratenum"><?php echo $total_sum . ' / ' . $views; ?></td>
            </tr>
        </table>
    </div>
    <div class="col-md-4">
        <div class="chart chartPrev">
            <h3 class="pdfTitle">
                <?php echo get_translate('Number Of Track Picks', 'Количество Выборов Трека'); ?>
            </h3>
            <table class="table users-artists-table tracksRating" cellspacing="0" cellpadding="0" style="margin: 0;">
                <thead>
                <tr>
                    <th style="background-color: #efe7dc;text-align: center;">#</th>
                    <th style="background-color: #efe7dc;"><?php echo get_translate('Track', 'Трек'); ?></th>
                    <th style="background-color: #efe7dc;text-align: center;"><?php echo get_translate('Selected', 'Выбран'); ?></th>
                </tr>
                </thead>
                <?php
                $tracksratings = R::getAll('SELECT COUNT(*) as rating, reviewer_track_choosed FROM reviews WHERE promo_id = ' . $campaignID . ' GROUP BY promo_id, reviewer_track_choosed ORDER BY rating DESC');
                $da = 1;
                foreach ( $tracksratings as $tracksrating ) {
                    ?>
                    <tr>
                        <td style="padding: 5px;border:1px solid #ccc;font-size: 12px;text-align: center;background-color: #e2ecea;"><?php echo $da++; ?></td>
                        <td style="padding: 5px;border:1px solid #ccc;font-size: 12px;background-color: #e2ecea;"><?php echo $tracksrating['reviewer_track_choosed']; ?></td>
                        <td style="padding: 5px;border:1px solid #ccc;font-size: 12px;text-align: center;background-color: #e2ecea;" class="ratenum"><?php echo $tracksrating['rating']; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
        <div class="chart chartPrev">
            <h3 class="pdfTitle">
                <?php echo get_translate('Average Rating', 'Средний Рейтинг'); ?>
            </h3>
            <?php
                $avrate = 0;
                foreach($total_views as $total_view) {
                    $avrate += $total_view->reviewer_track_rate;
                }
            ?>
            <table class="table users-artists-table tracksRating" cellspacing="0" cellpadding="0" style="margin: 0;">
                <thead>
                    <tr>
                        <th style="background-color: #efe7dc;text-align: center;"><?php echo get_translate('Points', 'Очки'); ?></th>
                    </tr>
                </thead>
                <tr>
                    <td style="padding: 5px;border:1px solid #ccc;font-size: 14px;text-align: center;background-color: #e2ecea;"><?php echo round($avrate / $views, 1) . ' / 10'; ?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-md-12">
        <div class="campaignFeedList">
            <h3 style="text-align: center;" class="pdfTitle"><?php echo get_translate('Campaign Feedback List', 'Список Отзывов Кампании'); ?></h3>
            <table class="table users-artists-table feedListable" cellspacing="0" cellpadding="0" style="margin: 0;">
                <thead>
                <tr>
                    <th style="background-color: #efe7dc;text-align: center;">#</th>
                    <th style="background-color: #efe7dc;"><?php echo get_translate('Artist', 'Артист'); ?></th>
                    <th style="background-color: #efe7dc;"><?php echo get_translate('Feedback', 'Фидбек'); ?></th>
                    <th style="background-color: #efe7dc;text-align: center;"><?php echo get_translate('Rated', 'Оценил'); ?></th>
                    <th style="background-color: #efe7dc;text-align: center;"><?php echo get_translate('Supported', 'Поддержал'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $feedID = 1;
                    foreach($total_views as $total_view) {
                        ?>
                        <tr>
                            <td style="padding: 5px;border:1px solid #ccc;font-size: 12px;text-align: center;background-color: #e2ecea;"><?php echo $feedID++; ?></td>
                            <td style="padding: 5px;border:1px solid #ccc;font-size: 12px;font-weight:600;background-color: #e2ecea;"><?php echo get_artist_by($total_view->reviewer_id, 'alias'); ?></td>
                            <td style="padding: 5px;border:1px solid #ccc;font-size: 12px;background-color: #e2ecea;"><?php echo $total_view->reviewer_track_comment; ?></td>
                            <td style="padding: 5px;border:1px solid #ccc;font-size: 12px;text-align: center;background-color: #e2ecea;"><?php echo $total_view->reviewer_track_rate; ?></td>
                            <td style="padding: 5px;border:1px solid #ccc;font-size: 12px;text-align: center;background-color: #e2ecea;"><?php echo $total_view->reviewer_track_support; ?></td>
                        </tr>
                        <?php
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-12">
        <div class="campaignFeedList">
            <h3 style="text-align: center;" class="pdfTitle"><?php echo get_translate('Download And Listening Activity', 'Активность Загрузок и Прослушивания'); ?></h3>
            <table class="table users-artists-table feedListable" cellspacing="0" cellpadding="0" style="margin: 0;">
                <thead>
                <tr>
                    <th style="background-color: #efe7dc;text-align: center;">#</th>
                    <th style="background-color: #efe7dc;"><?php echo get_translate('Artist', 'Артист'); ?></th>
                    <th style="background-color: #efe7dc;text-align: center;"><?php echo get_translate('Track Listened', 'Трек Прослушан'); ?></th>
                    <th style="background-color: #efe7dc;text-align: center;"><?php echo get_translate('Track Download', 'Скачивание Трека'); ?></th>
                    <th style="background-color: #efe7dc;text-align: center;"><?php echo get_translate('ZIP Download', 'Скачивание ZIP'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $feedID = 1;
                    foreach($total_views as $total_view) {
                        ?>
                        <tr>
                            <td style="padding: 5px;border:1px solid #ccc;font-size: 12px;text-align: center;background-color: #e2ecea;"><?php echo $feedID++; ?></td>
                            <td style="padding: 5px;border:1px solid #ccc;font-size: 12px;font-weight:600;background-color: #e2ecea;"><?php echo get_artist_by($total_view->reviewer_id, 'alias'); ?></td>
                            <td style="padding: 5px;border:1px solid #ccc;font-size: 12px;text-align: center;background-color: #e2ecea;">
                                <?php
                                    if ($total_view->promo_track_listened == 1) {
                                        echo get_translate('Yes', 'Да');
                                    } else {
                                        echo get_translate('No', 'Нет');
                                    }
                                ?>
                            </td>
                            <td style="padding: 5px;border:1px solid #ccc;font-size: 12px;text-align: center;background-color: #e2ecea;">
                                <?php
                                    if ($total_view->promo_download_track == 1) {
                                        echo get_translate('Yes', 'Да');
                                    } else {
                                        echo get_translate('No', 'Нет');
                                    }
                                ?>
                            </td>
                            <td style="padding: 5px;border:1px solid #ccc;font-size: 12px;text-align: center;background-color: #e2ecea;">
                                <?php
                                    if ($total_view->promo_download_zip == 1) {
                                        echo get_translate('Yes', 'Да');
                                    } else {
                                        echo get_translate('No', 'Нет');
                                    }
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<table class="footerTable">
    <tr>
        <td>
            <img class="pdfLogo" src="<?php echo get_site_logo_url(); ?>">
        </td>
        <td></td>
        <td class="powered">
            <strong>Powered by INTAKE Promotion Service</strong>
            To get this service visit <a href="https://intakedigital.com/" target="_blank">www.intakedigital.com</a>
        </td>
    </tr>
</table>
