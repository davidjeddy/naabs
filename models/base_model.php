<?php
/**
 * Windsnet user model class
 * 
 * @author David J Eddy <me@davidjeddy.com>
 * @since 0.0.2b
 * @package windsnet
 */

/**
 * baseModel
 * @author David J Eddy <me@davidjeddy.com>
 * @since 0.0.1
 */
require_once (__DIR__.'/../config.php');
// Autoload all the classes controlled by composer
require_once (__DIR__.'/../vendor/autoload.php');

//Load DB modals
use Monolog\Logger;
use Monolog\Handler\StreamHandler;



class baseModel {

	protected $logger;
	protected $conn;

	public function __construct () {
        // Create a log channel
        $this->logger = new Logger('AppLogger');
        $this->logger->pushHandler(new StreamHandler(SITEDIR.SITELOG, Logger::DEBUG));

		$this->logger->addDebug('Starting baseModel->__construct()');



		// Create the DB connection
		try {
			// Setup conn string
			$this->conn = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';', ''.DB_USER.'', ''.DB_PASS.'');

			// Pass back PDO errors and exceptions.
		    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		    return true;
		} catch(PDOException $e) {
			// Log errors
			$this->logger->addError('ERROR: ' . $e->getMessage());
			return false;
		}

		return false;
	}
}