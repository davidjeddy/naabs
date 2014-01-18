<?php
/**
 * Windsnet user controller class
 * 
 * @author David J Eddy <me@davidjeddy.com>
 * @since 0.0.2b
 * @package windsnet
 */

/**
 * userClass of windsnet
 * @author David J Eddy <me@davidjeddy.com>
 * @since 0.0.2b
 */
require_once (__DIR__.'/../config.php');
// Autoload all the classes controlled by composer
require_once (__DIR__.'/../vendor/autoload.php');

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class userClass {

	private $logger;

	function __construct (Logger $logger) {
		$this->logger = $logger;

		return true;
	}

	public function createUser($param_data) {
		return true;
	}
}