Dependances:
Composer http://getcomposer.org/doc/00-intro.md#downloading-the-composer-executable 
GiT https://code.google.com/p/git-core/downloads/list
PHP cURL (Ubuntu) `sudo apt-get install php5-curl`

Application install:
Create a home dir for the application. 
Ensure dir is accessible bu your web server and sql server
Ensure the `logs` dir is accessible by the application; 'chmod -R 0777 ./logs/' if needed.
Install Git and Composer if needed
Run 'composer install' from the applications home dir 
Consume