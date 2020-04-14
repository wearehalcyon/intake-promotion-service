<?php
require('../kernel.php');

// Action
$data = $_POST;
if (isset($data['submit'])) {
    $update = R::findOne('options', 'id=?', [1]);
    $update->site_name = $_POST['sitename'];
    $update->site_description = $_POST['sitedescription'];
    $update->site_email = $_POST['siteemail'];
    if (isset($_POST['debuger'])) {
        $update->debuger_enabler = 1;
    } elseif (!isset($_POST['debuger'])) {
        $update->debuger_enabler = 0;
    }
    // if (isset($data['pjax'])) {
    //     $update->pjax_enabler = 1;
    // } elseif (!isset($data['pjax'])) {
    //     $update->pjax_enabler = 0;
    // }
    // if (get_option('debuger_enabler') || isset($data['debuger'])) {
    //     $update->pjax_enabler = 0;
    // }
    $update->app_language = $_POST['app_language'];
    R::store($update);
    //echo '<meta http-equiv="refresh" content="0; URL=/manager/index.php?page=settings">';
}
header('Location: /manager/index.php?page=settings');
exit;
