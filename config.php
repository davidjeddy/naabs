<?php
/**
 * Application core configuration settings. Edit at your own risk
 *
 * @author 	David Eddj <me@davidjeddy.com>
 * @since 	0.0.1
 * @version 0.0.1
 */
/* Standard configs */
define('SITEOWNER', "Winds.net");
define('SITEEMAIL', "admin@winds.net");
define('SITETITLE', "RV Park Wireless Network Access");
define('SITEHOME', 	"../");
define('SITEROOT', 	"../views");
define('DEBUG', 	"DEBUG");

/* Debug options */
error_reporting(E_ALL);
ini_set("display_errors", 1);

/* DB conn info */
define('DB_ADDY',	"localhost");
define('DB_NAME',	"");
define('DB_USRNM',	"");
define('DB_PASS',	"");

/* Edit for your locality */
date_default_timezone_set("UTC");

/* DO NOT CHANGE! */
define('DATEFORMAT',"YYYY-MM-DD");
define('TIMEFORMAT',"HH-mm-ss");
define('NOW_YEAR', 	date("Y"));
define('NOW_MONTH', date("M"));
define('NOW_DAY',	date("D"));



//Iteration 1 of DB conn management
//Make sure we can connect to the DB
/*
try {
    $dbconn = new PDO('mysql:host='.DB_ADDY.';dbname='.DB_NAME.'', DB_USRNM, DB_PASS);
    
    $dbconn->query( "
    	SELECT * FROM mysql WHERE id = 1
    " );

    $dbconn = null;
} catch (PDOException $e) {
    print $e->getMessage()." DB2 Error 2";
    exit;
}
*/

//Start session if not already active
if ( !isset( $_SESSION['IS_AUTH'] ) ) {
	//session_start();
	//$_SESSION = array();
	//$_SESSION'IS_AUTH'] == false;
}