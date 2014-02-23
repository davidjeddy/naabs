Network Access And Billing System (naabs)

###Dependances:###
PHP, MySQL 5+, root/sudo access (for install)



###Install###
###Easy###


Create a home dir for the application (/var/www/html/naabs for example). 

Populate config.php with correct information.
Change to install dir. `cd install`.
At the terminal run: `sudo php install.php` from the applications home dir.

Log ito your RDBM of choice, select your radius DB.
Run the user data SQL file (./install/user_data_tbo.sql).

If this does not work. Open install.php and manually step through the process.
