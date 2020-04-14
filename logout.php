<?php
    require('config.php');
    unset($_SESSION['logged_user']);
    echo '<a href="/login.php">Login</a>';
