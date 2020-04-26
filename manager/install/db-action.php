<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Intake Promo | Installation</title>
    <link rel="stylesheet" href="../../../includes/assets/css/bootstrap.css">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100;0,200;0,300;0,400;0,423;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,423;1,500;1,600;1,700&amp;family=Nunito+Sans:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&amp;family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../../includes/assets/css/manager.css">
    <link rel="stylesheet" href="../../../includes/assets/css/install.css">
</head>
<body>
<div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="appLogo">
                    <img src="../../../includes/assets/images/intakePromotionLogoBlack.png" alt="Intake Promo Logo">
                </div>
                <?php
                if ( isset($_POST['dbname']) && isset($_POST['dblogin']) && isset($_POST['dbserver']) ) {
                    // Get config.php Source Code
                    $dbsource = '
<?php
    /**
     * Redbean Library required
     * Redbean version 5.5 Beta 2
     */
    require(\'lib/redbean.php\');

    /**
     * Connection to Database variables
     * Insert your connection values here
     * Example:
     * $dbserver   = 1;
     * $dbname     = 2;
     * $dblogin    = 3;
     * $dbpassword = 4;
     */
    $dbname = \'' . $_POST['dbname'] . '\';
    $dblogin = \'' . $_POST['dblogin'] . '\';
    $dbpassword = \'' . $_POST['dbpassword'] . '\';
    $dbserver = \'' . $_POST['dbserver'] . '\';

    /**
     * Database Redbean connection class
     * Used variables above
     */
    R::setup("mysql:host={$dbserver};dbname={$dbname}", "{$dblogin}", "{$dbpassword}");

    /**
     * Start session
     */
    session_start();
    ';
                    $createdbconfig = fopen(dirname(__DIR__) . '/../config.php', 'w+');
                    fwrite($createdbconfig, $dbsource);
                    fclose($createdbconfig);
                    ?>
                    <h2 class="setupTitle">Connection With Database</h2>
                    <div class="card">
                        <p class="welcome">
                            Great! You are ready to install!
                        </p>
                        <p class="center">
                            By clicking the Run button, you will start the database migration, which will write the initial settings and demo content to the database. You will be redirected to the installation completion page, where you will receive all the necessary data to start working with the application.
                        </p>
                        <div class="installationButton">
                            <a class="button" href="/manager/install/run.php">Run</a>
                        </div>
                    </div>
                <?php } else { ?>
                    <h2 class="setupTitle">Connection With Database</h2>
                    <div class="card">
                        <p class="welcome">
                            Error. You have missed a field, or incorrectly filled it. Check the form please.
                        </p>
                        <div class="installationButton">
                            <a class="button" href="/manager/install/setup.php?step=two">Back To Step 2</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</div>
<script src="../../../includes/assets/js/jquery/3.4.1/jquery.min.js"></script>
<script src="../../../includes/assets/js/install.js"></script>
</body>
</html>
