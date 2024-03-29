<?php
	$promos = R::findAll('promos', 'promo_status != ?', ['unactive']);
?>
<h2 class="sectionTitle">Available Promotion Campaigns Library</h2>
<div class="sectionContent">
	<p>Here you can find all current and active promotional campaigns available for you.</p>
	<div class="row">
		<?php
            if ($promoCount > 0) {
                foreach($promos as $promo) {
                    $getReviews = R::findAll('reviews', 'promo_id = ? AND reviewer_id = ?', [$promo->id, get_user()->id]);

                    foreach ($getReviews as $getReview){
                        $reviewPromoID = $getReview->promo_id;
                    }

                    if (!empty($getReviews) && 1==1) {
                        $reviewed = '<span class="reviewed">Reviewed</span>';
                    }
        ?>
			<div class="col-md-3 col-xs-6">
				<div class="campaignItem">
					<a href="<?php echo base_url('promo/index.php?campaign=' . $promo->id . '&unique=' . hash('sha256', $promo->id)); ?>" target="_blank">
						<img src="<?php echo base_url('view/uploads/promos/campaign/' . $promo->promo_cover); ?>" alt="">
                        <?php //echo $reviewed; ?>
                        <?php if ($reviewPromoID === $promo->id) { ?>
                            <span class="reviewed">Reviewed</span>
                        <?php } ?>
					</a>
					<a class="citem" href="<?php echo base_url('promo/index.php?campaign=' . $promo->id . '&unique=' . hash('sha256', $promo->id)); ?>" target="_blank">
						<span><?php echo $promo->promo_title; ?></span>
					</a>
                    <span class="relDate">
                        <strong>Release Date:</strong> <?php echo $promo->promo_release_date; ?>
                    </span>
				</div>
			</div>
		<?php
                }
            } else {
        ?>
            <div class="col-md-12">
                <div class="noAvailableCampaigns">
                    No available campaigns at the moment.
                </div>
            </div>
        <?php } ?>
	</div>
</div>