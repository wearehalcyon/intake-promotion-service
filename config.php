
<?php
    /**
     * Redbean Library required
     * Redbean version 5.5 Beta 2
     */
    require('lib/redbean.php');
    
    /**
     * Connection to Database variables
     * Insert your connection values here
     * Example:
     * $dbserver   = 1;
     * $dbname     = 2;
     * $dblogin    = 3;
     * $dbpassword = 4;
     */
    $dbname = 'test.loc';
    $dblogin = 'root';
    $dbpassword = 'root';
    $dbserver = 'localhost';
    
    /**
     * Database Redbean connection class
     * Used variables above
     */
    R::setup("mysql:host={$dbserver};dbname={$dbname}", "{$dblogin}", "{$dbpassword}");
    
    /**
     * Start session
     */
    session_start();
    