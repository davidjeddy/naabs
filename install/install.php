<?php
/**
 * Install script for `naabs`
 */

require_once( "../config.php" );

echo "Attempting to create application log files...\n";
exec( "mkdir -p ".SITEDIR." 2>&1");
// Application log
exec( "touch ".SITEDIR.SITELOG );
// Paypal log
exec( "touch ".SITEDIR."PayPal.log" );
exec( "chmod -R 0745 ".SITEDIR );
exec( "chown -R www-data:www-data ".SITEDIR );

// Add to log rotation
//TODO add log rotation as part of the install script

// Install dependances
//update apt-get
echo "Attempting to update apt-get...\n";
exec( "apt-get update" );

//install composer
echo "Attempting `composer` install...\n";
exec( "apt-get install composer" );

// Install php5 cURL
echo "Attempting `PHP5 cURL` install...\n";
exec( "apt-get install php5-curl" );


//run composer at the application root
echo "Attempting to install application dependancies. This could take several minutes...\n";
chdir("../");
exec("composer self-update");
exec("composer install");
exec("composer update");
chdir("./install/");

echo "Done. Make sure you install the database table(s).\n";
