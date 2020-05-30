<?php
    require_once '../includes/sending-test.php';
?>
<div class="container-fluid">
    <div class="row sendpageRow">
        <div class="col-md-12">
            <h1><?php echo get_translate('Send Campaign', 'Разослать Кампанию'); ?></h1>
        </div>
        <div class="col-md-12">
            <div class="card">
                <h4 class="previewTitle"><?php echo get_translate('Preview', 'Предпросмотр'); ?></h4>
                <p class="previewSubtitle">
                    <?php echo get_translate('Before you send out this campaign, check whether everything is correctly designed.', 'Прежде чем вы разошлете эту кампанию, проверьте или все правильно оформлено.'); ?>
                </p>
                <p class="choosedTemplate">
                    <?php echo get_translate('Mail Template: ', 'Шаблон Для Рассылки: '); ?><span><?php echo ucfirst($campaign->promo_mail_theme); ?></span>
                </p>
                <?php
                    echo $template;
                    get_send_campaign();
                ?>
            </div>
        </div>
    </div>
</div>