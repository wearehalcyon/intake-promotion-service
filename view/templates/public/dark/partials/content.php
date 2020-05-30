<?php
require('../promo/send-feedback.php');
foreach ($sendFeedbacks as $sendFeedback) {
    $track_comment = $sendFeedback->reviewer_track_comment;
    if (!empty($track_comment)) {
        $text_read_only = 'readonly';
    }
    $rated = $sendFeedback->reviewer_track_rate;
    $choosed = $sendFeedback->reviewer_track_choosed;
    $support = $sendFeedback->reviewer_track_support;
}
?>
<section class="content">
    <div class="container">
        <?php if ( get_option('label_banner') ) : ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="banner">
                        <img src="<?php echo base_url('view/uploads/label/' . get_option('label_banner')); ?>" alt="Label Banner">
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="campaignSection">
            <div class="row">
                <div class="col-md-12">
                    <div class="title">
                        <h1><?php echo get_promo('title'); ?></h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="cover">
                        <img src="<?php echo base_url('view/uploads/promos/campaign/' . get_promo('cover')); ?>">
                    </div>
                    <div class="availableReleases">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Available Releases:</h4>
                            </div>
                            <?php
                            $avReleases = R::find('promos', 'id != ?', [$_GET['campaign']]);
                            foreach ($avReleases as $avRelease) {
                                ?>
                                <div class="col-md-4 col-xs-4 availableRelease">
                                    <a href="<?php echo base_url('promo/index.php?campaign=' . $avRelease->id . '&unique=' . hash('sha256', $avRelease->id)); ?>">
                                        <img src="<?php echo base_url('view/uploads/promos/campaign/' . $avRelease->promo_cover); ?>" alt="">
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="followLabel">
                        <h4>Follow the label</h4>
                        <ul>
                            <?php
                            $jsonSocials = get_option('app_social');
                            $appSocials = json_decode($jsonSocials);
                            foreach ($appSocials as $appSocial) {
                                ?>
                                <li>
                                    <a href="<?php echo $appSocial; ?>" target="_blank">
                                        <?php
                                        if ( strpos($appSocial, 'facebook') == true ) {
                                            echo '<i class="fab fa-facebook-f"></i>';
                                        }
                                        if ( strpos($appSocial, 'twitter') == true ) {
                                            echo '<i class="fab fa-twitter"></i>';
                                        }
                                        if ( strpos($appSocial, 'instagram') == true ) {
                                            echo '<i class="fab fa-instagram"></i>';
                                        }
                                        if ( strpos($appSocial, 'vk') == true ) {
                                            echo '<i class="fab fa-vk"></i>';
                                        }
                                        if ( strpos($appSocial, 'linkedin') == true ) {
                                            echo '<i class="fab fa-linkedin"></i>';
                                        }
                                        if ( strpos($appSocial, 'youtube') == true ) {
                                            echo '<i class="fab fa-youtube"></i>';
                                        }
                                        ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="campaignDesc">
                        <h4>About Release:</h4>
                        <?php echo get_promo('description'); ?>
                    </div>
                    <div class="artistSocial">
                        <h4>Artist Social:</h4>
                        <ul>
                            <?php
                            $asocial = get_promo('artist_social');
                            $socialUrls = json_decode($asocial);
                            $socialArr = [];
                            foreach ($socialUrls as $socialUrl => $value) {
                                $socialArr[] = $value;
                                $facebook = $socialArr[0];
                                $twitter = $socialArr[1];
                                $instagram = $socialArr[2];
                                $vk = $socialArr[3];
                            }
                            ?>
                            <?php if ( $facebook ) : ?>
                                <li>
                                    <a href="<?php echo $facebook; ?>" target="_blank">Facebook</a>
                                </li>
                            <?php endif; ?>
                            <?php if ( $twitter ) : ?>
                                <li>
                                    <a href="<?php echo $twitter; ?>" target="_blank">Twitter</a>
                                </li>
                            <?php endif; ?>
                            <?php if ( $instagram ) : ?>
                                <li>
                                    <a href="<?php echo $instagram; ?>" target="_blank">Instagram</a>
                                </li>
                            <?php endif; ?>
                            <?php if ( $vk ) : ?>
                                <li>
                                    <a href="<?php echo $vk; ?>" target="_blank">VK</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="audioPreview">
                        <h4>Release Audio Preview:</h4>
                        <div class="playlist">
                            <ul class="player">
                                <?php
                                $tracks = json_decode(get_promo('track_preview'));
                                //var_dump($tracks);
                                $playerID = 0;
                                $containerID = 1;
                                $btnID = 1;
                                $progressbar = 0;
                                $data_progressbar = 0;
                                $class_progressbar = 0;
                                foreach ( $tracks as $track ) {
                                    ?>
                                    <li class="waveform" data-player-id="<?php echo $playerID++ ?>">
                                        <div class="playBtn">
                                            <button type="button" class="btn-play play">
                                                <i class="fa fa-play"></i>
                                            </button>
                                        </div>
                                        <div id="wavesurfer-container" class="wavesurfer-player" data-src="<?php echo base_url('view/uploads/promos/preview/' . str_replace(' ', '-', $track->source)); ?>">
                                            <div class="loadingTrack">
                                                <span class="progress_percents progress_pecents-<?php echo $class_progressbar++; ?>">0%</span>
                                                <progress id="progress-<?php echo $progressbar++; ?>" class="progress progress-striped" value="0" max="100"></progress>
<!--                                                <img src="--><?php //echo base_url('view/templates/public/dark/assets/images/trackLoading.svg'); ?><!--" alt="">-->
                                            </div>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                            <ul class="trackItems">
                                <?php
                                $trackID = 1;
                                $trackNum = 1;
                                foreach ( $tracks as $track ) {
                                    ?>
                                    <li>
                                        <span><i class="fas fa-headphones-alt"></i></span>
                                        <a href="javascript:;" data-track-id="<?php echo $trackID++; ?>" data-track-url="<?php echo base_url('view/uploads/promos/preview/' . str_replace(' ', '-', $track->source)); ?>"><?php echo $trackNum++ . '. ' .  $track->artist . ' - ' . $track->title . ' (' . $track->description . ')'; ?></a>
                                        <div class="downloadTrack"><a class="downloadTrack" href="<?php echo base_url('view/uploads/promos/preview/' . str_replace(' ', '-', $track->source)); ?>" download><i class="fas fa-download"></i></a></div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="feedback">
                            <h4>Your Feedback:</h4>
                            <div class="feedForm">
                                <form action="" method="post" class="feedbackFormFlex">
                                    <div class="formControl">
                                        <input type="hidden" name="artistid" value="<?php echo get_user()->id; ?>">
                                        <input type="hidden" name="listenplayer" value="">
                                        <input type="hidden" name="downloadtrack" value="">
                                        <input type="hidden" name="downloadzip" value="">
                                    </div>
                                    <div class="formControl half-7 choose">
                                        <span class="formControlTitle">Choose best track:</span>
                                        <?php if ( empty($choosed) ) : ?>
                                            <select name="choose" class="select">
                                                <?php
                                                foreach ( $tracks as $track ) {
                                                    $trackNameSel = $track->artist . ' - ' . $track->title . ' (' . $track->description . ')';
                                                    ?>
                                                    <option value="<?php echo $trackNameSel; ?>">
                                                        <?php echo $trackNameSel; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        <?php else : ?>
                                            <p class="alreadySubmited"><?php echo $choosed; ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="formControl half-3 support">
                                        <span class="formControlTitle">Do you support:</span>
                                        <?php if ( empty($support) ) : ?>
                                            <select name="support" class="select">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        <?php else : ?>
                                            <p class="alreadySubmited"><?php echo $support; ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="formControl rate">
                                        <span class="formControlTitle">Rate this release:</span>
                                        <?php if ( empty($rated) ) : ?>
                                            <?php for($rate = 1; $rate <= 10; $rate++) { ?>
                                                <label class="half-1" for="item-<?php echo $rate; ?>">
                                                    <input id="item-<?php echo $rate; ?>" class="checkra" name="rating" type="radio" value="<?php echo $rate; ?>" required><span class="checkraLabel"><?php echo $rate; ?></span>
                                                </label>
                                            <?php } ?>
                                        <?php else : ?>
                                            <p class="alreadySubmited"><?php echo $rated; ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="formControl feedback">
                                        <span class="formControlTitle">Your feedback:</span>
                                        <?php if ( empty($track_comment) ) : ?>
                                            <textarea name="message" required></textarea>
                                        <?php else : ?>
                                            <p class="alreadySubmited"><?php echo $track_comment; ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="formControl submitFeedback">
                                        <?php if (empty($track_comment)) : ?>
                                            <button type="submit" name="submit">
                                                <span class="btnText">Submit Feedback</span>
                                                <span class="btnHover"></span>
                                            </button>
                                        <?php else : ?>
                                            <strong>Your feedback already accepted. Thank you!</strong>
                                        <?php endif; ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>