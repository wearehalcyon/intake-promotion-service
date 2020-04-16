<?php
    $configExist = file_exists('config.php');
    if ($configExist) {
        /*
         * Include config file
         */
        require('../../config.php');
    }

    if ($configExist && R::testConnection()) {
        header('location: /');
        exit;
    } else {
        header('location: /manager/install/setup.php');
        exit;
    }