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
require_once (__DIR__.'/base_class.php');
// Include the model
require_once (__DIR__.'/../models/user_model.php');

use Monolog\Logger;
use Monolog\Handler\StreamHandler;


class userClass extends baseClass {

	public function __construct() { parent::__construct(); }

	/**
	 * No real business logic to do when creating a user
	 */
	public function createUser($param_data) {
		$this->logger->addDebug('Starting baseClass->goAction()');

		// Instantiate the DB class.
		$userModel = new userModel();

		// Go make a new user
		return $userModel->createUser($param_data);
	}
}