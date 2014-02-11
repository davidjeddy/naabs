Network Access Billing System (nabs)

###Dependances:###
PHP, MySQL 5+, root access (for automated install)



###Install###
###utomated###

Create a home dir for the application. 

Unpackage application into said directory.

Populate config.php with correct information.

At the terminal run: php install.php

Wait...

Consune



###Manual###
Ensure application directory is accessible by your web server and sql server.

Setup application logs and log rotation schedule:
  'chmod -R 0644 ./logs/'
  'chown -R www-data:www-data ./logs/'


Install/Update cURL and Composer
`sudo apt-get install php5-curl`

Run 'composer install' from the applications home dir.

Create the user data table:
CREATE TABLE `user_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `attribute` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `op` varchar(2) COLLATE utf8_unicode_ci DEFAULT '=',
  `value` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Secondary user account data.'

Consume