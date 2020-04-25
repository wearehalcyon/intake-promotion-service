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
                                        <a href="javascript:;" data-track-id="<?php echo $trackID++; ?>" data-track-url="<?php echo base_url('view/uploads/promos/preview/' . str_replace(' ', '-', $track->source)); ?>"><?php echo $trackNum++ . '. ' .  $track->source; ?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</section>