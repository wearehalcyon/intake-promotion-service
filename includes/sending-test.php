<?php
    require_once '../lib/swiftmailer/autoload.php';

    $campaign = R::findOne('promos', 'id = ?', [$_GET['campaign_id']]);
    $userkey = $_SESSION['logged_user']->artist_secret_key;
    $pmLink = base_url('promo/index.php?campaign=' . $_GET['campaign_id'] . '&unique=' . hash('sha256', $promo['id']) . '&usrk=' . $userkey);
    $pmCover = base_url('view/uploads/promos/campaign/' . $campaign->promo_cover);
    $pmTitle = $campaign->promo_title;
    $pmDescrition = mb_strimwidth($campaign->promo_description, 0, 150, '...');
    function print_tracks($echo = false){
        $campaign = R::findOne('promos', 'id = ?', [$_GET['campaign_id']]);
        $tracklist = json_decode($campaign->promo_track_preview);
        foreach ($tracklist as $trackitem) {
            if ( $echo == true ) {
                echo '<li style="margin-top: 10px;font-size: 13px;font-weight: 700;color: #10a98d;">' . $trackitem->artist . ' - ' . $trackitem->title . ' (' . $trackitem->description . ')</li>';
            }
        }
    }
    $tracks = print_tracks();
    $mailTpl = $campaign->promo_mail_theme;
    ob_start();
        if ( $mailTpl == 'light' ) {
            include('../view/templates/mail/' . $mailTpl . '/index.php');
        } else {
            include('../view/templates/mail/' . $mailTpl . '/index.php');
        }
    $output = ob_get_contents();
    ob_end_clean();
$template = <<<EOD
    $output
EOD;

    if (isset($_POST['test_email'])) {
        $reciever = $_POST['test_email'];
    } else {
        $reciever = get_option('site_email');
    }

    $stmpSettings = get_option('mailer_settings');
    $stmpSetting = json_decode($stmpSettings);

    $transport = (new Swift_SmtpTransport($stmpSetting->{'server'}, $stmpSetting->{'port'}))
        ->setUsername($stmpSetting->{'username'})
        ->setPassword($stmpSetting->{'password'})
    ;

    // Create the Mailer using your created Transport
    $mailer = new Swift_Mailer($transport);

    // Create a message
    $message = (new Swift_Message('Promo: ' . $pmTitle))
        ->setFrom([$stmpSetting->{'sendfrom'} => get_option('site_name')])
        ->setTo([$reciever => 'A name'])
        ->setBody($template, 'text/html')
    ;

    if (isset($_POST['test_send'])) {
        $result = $mailer->send($message);
        header('Location: /manager/edit.php?type=campaign&campaign_id=' . $_GET['campaign_id'] . '&action=edit&preparation=send&status=sent');
    }