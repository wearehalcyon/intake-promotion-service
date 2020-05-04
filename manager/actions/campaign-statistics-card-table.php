<?php

?>
<style media="screen">
    *{
        font-family: 'Open Sans', sans-serif;
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
        font-size: 22px;
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
        font-size: 36px;
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
        <div class="chart chartPrev">
            <h3 class="pdfTitle">
                <?php echo get_translate('Views', 'Просмотры'); ?>
            </h3>
            <p class="data">
                <?php echo $views . ' / ' . $artistlist; ?>
            </p>
            <canvas id="viewsChartDoughnut" width="9" height="10" data-views="<?php echo $views; ?>" data-all-artists="<?php echo $artistlist; ?>"></canvas>
        </div>
    </div>
    <div class="col-md-4">
        <div class="chart chartPrev">
            <h3 class="pdfTitle">
                <?php echo get_translate('Total Views', 'Все Просмотры'); ?>
            </h3>
            <p class="data">
                <?php echo $total_sum . ' / ' . $views; ?>
            </p>
            <canvas id="totalViewsChart" width="9" height="10" data-single-views="<?php echo $views; ?>" data-total-views="<?php echo $total_sum; ?>"></canvas>
        </div>
    </div>
    <div class="col-md-4">
        <div class="chart chartPrev">
            <h3 class="pdfTitle">
                <?php echo get_translate('Number Of Track Picks', 'Количество Выборов Трека'); ?>
            </h3>
            <table class="table users-artists-table tracksRating">
                <thead>
                <tr>
                    <th>#</th>
                    <th><?php echo get_translate('Track', 'Трек'); ?></th>
                    <th><?php echo get_translate('Selected', 'Выбран'); ?></th>
                </tr>
                </thead>
                <?php
                $tracksratings = R::getAll('SELECT COUNT(*) as rating, reviewer_track_choosed FROM reviews WHERE promo_id = ' . $campaignID . ' GROUP BY promo_id, reviewer_track_choosed ORDER BY rating DESC');
                $da = 1;
                foreach ( $tracksratings as $tracksrating ) {
                    ?>
                    <tr>
                        <td><?php echo $da++; ?></td>
                        <td><?php echo $tracksrating['reviewer_track_choosed']; ?></td>
                        <td class="ratenum"><?php echo $tracksrating['rating']; ?></td>
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
            echo '<p class="avrate data">' . round($avrate / $views, 1) . ' / 10</p>';
            ?>
            <canvas id="avrate" width="30" height="10" data-averge="<?php echo round($avrate / $views, 1); ?>"></canvas>
        </div>
    </div>
    <div class="col-md-12">
        <div class="campaignFeedList">
            <h2><?php echo get_translate('Campaign Feedback List', 'Список Отзывов Кампании'); ?></h2>
            <table class="table users-artists-table feedListable">
                <thead>
                <tr>
                    <th>#</th>
                    <th><?php echo get_translate('Artist', 'Артист'); ?></th>
                    <th><?php echo get_translate('Feedback', 'Фидбек'); ?></th>
                    <th class="text-center"><?php echo get_translate('Rated', 'Оценил'); ?></th>
                    <th class="text-center"><?php echo get_translate('Supported', 'Поддержал'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $feedID = 1;
                foreach($total_views as $total_view) {
                    ?>
                    <tr>
                        <td><?php echo $feedID++; ?></td>
                        <td><?php echo get_artist_by($total_view->reviewer_id, 'alias'); ?></td>
                        <td><?php echo $total_view->reviewer_track_comment; ?></td>
                        <td class="text-center"><?php echo $total_view->reviewer_track_rate; ?></td>
                        <td class="text-center"><?php echo $total_view->reviewer_track_support; ?></td>
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
