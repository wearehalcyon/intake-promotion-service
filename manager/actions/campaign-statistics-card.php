<div class="row">
    <div class="col-md-4">
        <div class="chart chartPrev">
            <h3>
                <?php echo get_translate('Views', 'Просмотры'); ?>
            </h3>
            <p>
                <?php echo $views . ' / ' . $artistlist; ?>
            </p>
            <canvas id="viewsChartDoughnut" width="9" height="10" data-views="<?php echo $views; ?>" data-all-artists="<?php echo $artistlist; ?>"></canvas>
        </div>
    </div>
    <div class="col-md-4">
        <div class="chart chartPrev">
            <h3>
                <?php echo get_translate('Total Views', 'Все Просмотры'); ?>
            </h3>
            <p>
                <?php echo $total_sum . ' / ' . $views; ?>
            </p>
            <canvas id="totalViewsChart" width="9" height="10" data-single-views="<?php echo $views; ?>" data-total-views="<?php echo $total_sum; ?>"></canvas>
        </div>
    </div>
    <div class="col-md-4">
        <div class="chart chartPrev">
            <h3>
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
            <h3>
                <?php echo get_translate('Average Rating', 'Средний Рейтинг'); ?>
            </h3>
            <?php
            $avrate = 0;
            foreach($total_views as $total_view) {
                $avrate += $total_view->reviewer_track_rate;
            }
            echo '<p class="avrate">' . round($avrate / $views, 1) . ' / 10</p>';
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