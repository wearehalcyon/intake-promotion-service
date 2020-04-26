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
                    <?php if (!$_GET) : ?>
                        <h2 class="setupTitle">Welcome To Installation Wizard</h2>
                        <div class="card">
                            <p class="welcome">
                                Welcome to simply setup wizard. All what you need, that going to <strong>TWO</strong> step installation!
                            </p>
                            <p class="center">
                                Before starting the installation, make sure that you have the data to connect to the database. To do this, you will need the server address, database user login and user password. By filling out the form with this data, you can make the initial installation of the application, with the available basic content for example, which you can edit or delete, as well as create a new one. Good luck, and enjoy your use! Thank you for choosing us.
                            </p>
                            <div class="installationButton">
                                <a class="button" href="/manager/install/setup.php?step=one">Start Installation</a>
                            </div>
                        </div>
                    <?php elseif ($_GET['step'] == 'one') : ?>
                        <h2 class="setupTitle">Step 1</h2>
                        <div class="card">
                            <p class="welcome">
                                Read and accept the license agreement
                            </p>
                            <div class="licenseText">
                                <?php require('license-agreement.php'); ?>
                            </div>
                            <div class="installationButton">
                                <a class="iamagree" href="javascript:;">I accept the terms</a>
                                <span class="nextstepLayer">
                                    <a class="nextstep button" href="">Next Step</a>
                                </span>
                            </div>
                        </div>
                    <?php elseif ($_GET['step'] == 'two') : ?>
                        <h2 class="setupTitle">Step 2 - Installation</h2>
                        <div class="card">
                            <p class="welcome">
                                Setup Your Database Connection
                            </p>
                            <?php require('installation-form.php'); ?>
                        </div>
                    <?php elseif ($_GET['action'] == 'installation') : ?>
                        <?php
                            if ( isset($_POST['dbsubmit']) ) {
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
    session_unset();
    session_start();
                            ';
                                $createdbconfig = fopen(__DIR__ . '..\..\..\config.php', 'w+');
                                fwrite($createdbconfig, $dbsource);
                                fclose($createdbconfig);
                            }
                        ?>
                        <h2 class="setupTitle">Step 2 - Installation</h2>
                        <div class="card">
                            <p class="welcome">
                                Wait Please...
                            </p>
                            <div class="installationProgress">
                                <div class="ipLoading">
                                    <img src="../../../includes/assets/images/loading.svg" alt="Installation">
                                </div>
                                <div class="ipLoadingMsg">
                                    ...Application during installation
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>
    <script src="../../../includes/assets/js/jquery/3.4.1/jquery.min.js"></script>
    <script src="../../../includes/assets/js/install.js"></script>
</body>
</html>