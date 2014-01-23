Dependances:
Composer http://getcomposer.org/doc/00-intro.md#downloading-the-composer-executable 
GiT https://code.google.com/p/git-core/downloads/list
PHP cURL (Ubuntu) `sudo apt-get install php5-curl`

Application install:
Create a home dir for the application. 
Ensure dir is accessible bu your web server and sql server
Ensure the `logs` dir is accessible by the application:
	'chmod -R 0644 ./logs/'
	'chown -R www-data:www-data ./logs/'

Install Git and Composer if needed
Run 'composer install' from the applications home dir 
Create transatoin log table in your database:
	CREATE  TABLE `radius`.`radtransactionlog` (
	  `id` INT NOT NULL AUTO_INCREMENT ,
	  `username` VARCHAR(64) NULL ,
	  `transaction_id` VARCHAR(64) NULL ,
	  `create_time` INT NULL ,
	  `number` INT(4) NULL ,
	  `state` VARCHAR(32) NULL ,
	  `amount` DECIMAL NULL ,
	  PRIMARY KEY (`id`) ,
	  UNIQUE INDEX `id_UNIQUE` (`id` ASC) );
Consume