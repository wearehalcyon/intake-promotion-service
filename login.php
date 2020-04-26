<?php
    $base = $_SERVER['DOCUMENT_ROOT'];
    $configExist = file_exists($base . '/config.php');

    if (!$configExist) {
        header('location: /manager/install/setup.php');
        exit;
    }
    require('includes/config-login.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link rel="stylesheet" href="<?php echo get_assets('bootstrap', 'style'); ?>">
        <link rel="stylesheet" href="<?php echo get_assets('font-awesome', 'style'); ?>">
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo get_assets('login', 'style'); ?>">
    </head>
    <body>
        <div class="wrapper">
            <div class="loginFormContainer">
                <div class="intakeLogo">
                    <a href="<?php echo base_url(); ?>">
                        <img src="<?php echo get_assets('intakePromotionLogoBlack', 'images', 'png'); ?>" alt="Intake Promotion Service">
                    </a>
                </div>
                <?php
                    if ( !empty($errors) ) {
                        echo '<div class="loginError">' . array_shift($errors) . '</div>';
                    }
                ?>
                <form class="loginForm" action="login.php" method="POST">
                    <p class="formControl">
                        <input class="inputText typeUsername" type="text" name="username" placeholder="Username" value="<?php echo @$data['username']; ?>">
                    </p>
                    <p class="formControl">
                        <input class="inputText typePassword" type="password" name="userpass" placeholder="Password" value="<?php echo @$data['userpass']; ?>">
                        <!-- <a class="showPassword" href="javascript:;">
                            <i class="fas fa-eye"></i>
                        </a> -->
                    </p>
                    <p class="formSubmit">
                        <button class="button" type="submit" name="login">Login</button>
                    </p>
                </form>
                <div class="aboutApp">
                    App Version: 1.0.1
                    <p>
                        <a href="https://intakedigital.com/" target="_blank">Go to Intake Digital</a>
                    </p>
                </div>
            </div>
        </div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="<?php echo get_assets('login', 'script'); ?>"></script>
    </body>
</html>
