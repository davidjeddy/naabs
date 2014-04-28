<?php
/**
 * Application core configuration settings. Edit at your own risk
 *
 * @author 	David Eddj <me@davidjeddy.com>
 * @since 	0.0.1
 * @version 0.0.7
 */
/* Standard configs */
define('SITEOWNER', 	"Wind Networks, LLC");
define('SITEEMAIL', 	"support@windnetworks.net");
define('SITETITLE', 	"WiFi Accounting");
define('SITETAX',   	0.0);
define('SITESHIPRATE', 	0.0);
define('SITEPHONE', 	"352-577-5127");
define('SITECONTACT', 	"Please contact the administrator at phone number ".SITEPHONE.". Sorry for the inconvenience.");

/* Debug options */
error_reporting(E_ALL);

#SITEDIR must be from the root of the file system
define("SITEROOT", 		"../views");
define("SITEDIR",		"/Users/david/Documents/repos/naabs/logs/");
define("SITELOG",		"Application.log");

/* DB config */
define("DB_HOST",   	"localhost");
define("DB_USER", 		"root");
define("DB_PASS", 		"root");
define("DB_PORT",   	"3306");
define("DB_NAME",   	"radius");
define("DB_RAD_TABL",   "radcheck");
define("DB_DATA_TABL",  "user_data");
define("DB_DTFORMAT",	"Y-m-d H:i:s");



/* Edit for your locality */
date_default_timezone_set("UTC");



/* Paypal application Info */
define('PP_CLIENTID',       "AZr4YhDpMdy4Gimqqvi-IjRWdpW5p_7L4e_NXZho3y9sG_RsrFAtC-lR0ieR");
define('PP_SECRET',         "EPHFbhDeLK95QLXr4t54DmO_iWzAkpX7vltktRnH9Inh8LriY_lenbwQVl-Q");
define('PP_CONFIG_PATH',    __DIR__);



if ( !defined('STDIN')
	&& !is_dir( "../vendor" )
) {
    print_r( "Install process not run or vendor directory moved.\nPlease see README file for details.");
    exit;
}



//Start session if not already active
if (!defined('STDIN')) {
	session_start();
}
