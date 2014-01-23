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
define('SITEROOT', 	"../views");
define('SITETAX', 0.07);
define('SITESHIPRATE', 0.00);
define('SITECONTACT', "Please contact the administrator at phone number 321-321-3210. Sorry for the inconvenience.");

/* Debug options */
error_reporting(E_ALL);
define("SITELOG", "../logs/app.log");
define("DEVIP", "192.168.2.4");
define("PRODIP", "10.3.4.127");

/* DB conn info */
//Testing host
if ($_SERVER["SERVER_ADDR"] == DEVIP
    || $_SERVER["SERVER_ADDR"] == "127.0.0.1"
    || $_SERVER["SERVER_ADDR"] == "localhost"
) {
    define("DB_HOST",   "127.0.0.1");
    define("DB_PORT",   "3306");    
    define("DB_NAME",   "radius");
    define("DB_TABL",   "radcheck");
    define("DB_USER",   "root");
    define("DB_PASS",   "Asdf1234");
//Prod host
} else {
    define("DB_HOST",   PRODIP);
    define("DB_PORT",   "3306");
    define("DB_NAME",   "radius");
    define("DB_TABL",   "radcheck");
    define("DB_USER",   "windsnet");
    define("DB_PASS",   "!6tu94E@A");
}

/* Edit for your locality */
date_default_timezone_set("UTC");

/* Paypal application Info */
define('PP_CLIENTID', "AVNj_hDHDYISigTl5T9x08B9Vc9b8kh9zQ_VCzsxvMUNbMrLCfLY2jNBfz4j");
define('PP_SECRET', "ECXsUBCGcNh7eOwWmNxNh9qchrnqCjB9NDbMMDWA_pZfwPr1lq3tiN1MLJCU");
define('PP_CONFIG_PATH', __DIR__);



if ( !is_dir( "../vendor" ) ) {
    print_r( "Install process not run or vendor directory moved.\nPlease see README file for details.");
    exit;
}



//Start session if not already active
session_start();