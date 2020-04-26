<?php
    require(dirname(__DIR__) . '/../config.php');
?>
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
                <h2 class="setupTitle">Running Installation</h2>
                <?php if ( R::testConnection() ) { ?>
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
                    <meta http-equiv="refresh" content="10;url=/manager/install/result.php" />
                    <?php
                        /**
                         * Dispense tables
                         */
                        require('migrations.php');
                    ?>
                <?php } else { ?>
                    <div class="card">
                        <p class="welcome error">
                            Error. We could not establish a connection to the database. Check your fields and make sure to enter the correct data.
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
