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
                <div class="col-md-5">
                    <div class="cover">
                        <img src="<?php echo base_url('view/uploads/promos/campaign/' . get_promo('cover')); ?>">
                    </div>
                </div>
                <div class="col-md-7">
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
                                                <img src="<?php echo base_url('view/templates/public/dark/assets/images/trackLoading.svg'); ?>" alt="">
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
                                        <a href="javascript:;" data-track-id="<?php echo $trackID++; ?>" data-track-url="<?php echo base_url('view/uploads/promos/preview/' . str_replace(' ', '-', $track->source)); ?>"><?php echo $trackNum++ . '. ' .  $track->source; ?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="feedback">
                            <h4>Your Feedback:</h4>
                            <div class="feedForm">
                                <form action="" method="post" class="feedbackFormFlex">
                                    <div class="formControl">
                                        <input type="hidden" value="<?php echo get_user()->artist_alias; ?>">
                                    </div>
                                    <div class="formControl half-7 choose">
                                        <span class="formControlTitle">Choose best track:</span>
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
                                    </div>
                                    <div class="formControl half-3 support">
                                        <span class="formControlTitle">Do you support:</span>
                                        <select name="support" class="select">
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="formControl rate">
                                        <span class="formControlTitle">Rate this release:</span>
                                        <?php for($rate = 1; $rate <= 10; $rate++) { ?>
                                            <label class="half-1" for="item-<?php echo $rate; ?>">
                                                <input id="item-<?php echo $rate; ?>" class="checkra" name="rating" type="radio" required><span class="checkraLabel"><?php echo $rate; ?></span>
                                            </label>
                                        <?php } ?>
                                    </div>
                                    <div class="formControl feedback">
                                        <span class="formControlTitle">Your feedback:</span>
                                        <textarea name="message" required></textarea>
                                    </div>
                                    <div class="formControl submitFeedback">
                                        <button type="submit" name="submit">
                                            <span class="btnText">Submit Feedback</span>
                                            <span class="btnHover"></span>
                                        </button>
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