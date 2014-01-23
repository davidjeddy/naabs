###Dependances:###
Composer http://getcomposer.org/doc/00-intro.md#downloading-the-composer-executable 
GiT https://code.google.com/p/git-core/downloads/list
PHP cURL (Ubuntu) `sudo apt-get install php5-curl`
MySQL 5+


###Application install:###

Create a home dir for the application. 

Ensure dir is accessible bu your web server and sql server

Ensure the `logs` dir is accessible by the application:
	'chmod -R 0644 ./logs/'
	'chown -R www-data:www-data ./logs/'

Install Git and Composer if needed

Run 'composer install' from the applications home dir 

Create transatoin log table in your database:
	CREATE TABLE `radtransactionlog` (
  	`id` int(11) NOT NULL AUTO_INCREMENT,
  	`username` varchar(64) COLLATE utf32_unicode_ci NOT NULL,
  	`transaction_id` varchar(64) COLLATE utf32_unicode_ci NOT NULL,
  	`create_time` int(11) NOT NULL,
  	`intent` varchar(32) COLLATE utf32_unicode_ci NOT NULL,
  	`state` varchar(32) COLLATE utf32_unicode_ci NOT NULL,
  	`amount` varchar(6) COLLATE utf32_unicode_ci NOT NULL,
  	PRIMARY KEY (`id`),
  	UNIQUE KEY `id_UNIQUE` (`id`),
  	UNIQUE KEY `transaction_id_UNIQUE` (`transaction_id`)
	) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci

Consume