<?php
require_once '../includes/sending-submission.php';
?>
<div class="container-fluid">
    <div class="row sendpageRow">
        <div class="col-md-12">
            <h1><?php echo get_translate('Campaign Submission', 'Отправка кампании'); ?></h1>
        </div>
        <div class="col-md-12">
            <div class="card">
                <?php if ($_GET['status'] == 'successful') : ?>
                    <div class="congratsCampaign">
                        <h2>
                            <?php echo get_translate('Congratulation!', 'Поздравляем!'); ?>
                        </h2>
                        <p>
                            <?php echo get_translate('The campaign has been successfully sent to your artist list. Now you can follow the views and feedbacks in the <a href="' . base_url('manager/index.php?page=statistics') . '">statistics</a> section.', 'Кампания была успешно разослана по вашей базе артистов. Теперь вы можете следить за просмотрами и отзывами в разделе <a href="' . base_url('manager/index.php?page=statistics') . '">статистики</a>.'); ?>
                        </p>
                    </div>
                <?php else : ?>
                    <div class="submitCampaignAction">
                        <form action="" method="post">
                            <button type="submit" name="submit_campaign" class="button">
                                <?php echo get_translate('Send!', 'Отправить!'); ?>
                            </button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>