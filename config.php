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
define('TAXRATE', 0.07);
define('SHIPRATE', 0.00);

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

/* Paypal application Info */
define('PP_CLIENTID', "AVNj_hDHDYISigTl5T9x08B9Vc9b8kh9zQ_VCzsxvMUNbMrLCfLY2jNBfz4j");
define('PP_SECRET', "ECXsUBCGcNh7eOwWmNxNh9qchrnqCjB9NDbMMDWA_pZfwPr1lq3tiN1MLJCU");
define('PP_CONFIG_PATH', __DIR__);



/* DO NOT CHANGE! */
define('DATEFORMAT',"YYYY-MM-DD");
define('TIMEFORMAT',"HH-mm-ss");
define('NOW_YEAR', 	date("Y"));
define('NOW_MONTH', date("M"));
define('NOW_DAY',	date("D"));



if ( !is_dir( "../vendor" ) ) {
    print_r( "Install process not run or vendor directory moved.\nPlease see README file for details.");
    exit;
}



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
session_start();