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
 * $dbserver   = 'localhost';
 * $dbname     = 'mydatabase';
 * $dblogin    = 'root';
 * $dbpassword = 'root';
 */
$dbname     = '';
$dblogin    = '';
$dbpassword = '';
$dbserver   = 'localhost';

/**
 * Database Redbean connection class
 * Used variables above
 */
R::setup( "mysql:host={$dbserver};dbname={$dbname}", "{$dblogin}", "{$dbpassword}" );
