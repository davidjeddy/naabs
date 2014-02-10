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

	private $userModel;

	public function __construct() {
		parent::__construct();
		
		// Instantiate the DB class.
		$this->userModel = new userModel();
	}

	/**
	 * No real business logic to do when creating a user
	 */
	public function createUser($param_data) {
		$this->logger->addDebug('Starting baseClass->goAction()');

		// Go make a new user
		$return_data = $this->userModel->createUser($param_data);

		//Set cookie data
		if ( $return_data === true ){
			return $this->loginUser($param_data);
		};

		return false;
	}

	/**
	 * Log a user into the web application, allows access to the my_* views
	 *
	 *@author David J Eddy <me@davidjeddy.com>
	 *@param object $param_data [requied]
	 *@return void
	 */
	public function loginUser($param_data) {
		$this->logger->addDebug('Starting baseClass->loginUser()');

		$return_data = $this->userModel->getUserdata($param_data->email, $param_data->password);

		if ( $return_data ) {
			$time = time()+(60*60);

			setcookie( "AUTH", "true", $time, "/" );
			setcookie( "USER", $param_data->email, $time,"/" );
			
			if (isset($param_data->lotid)) {
				setcookie( "LOTID",$param_data->lotid, $time,"/" );
			}

			return true;
		}
	}

	/**
	 * Log out the user from the web portal. Simply make the cookies expired.
	 */
	public function logoutUser() {
		$this->logger->addDebug('Starting baseClass->logoutUser()');

		$time = time()-(60*5);

		try {
			setcookie( "AUTH", "false", $time, "/" );

			return true;
		} catch (Excpetion $e) {
			$this->logger->addError("Could not log out user: ".$e.". For time: ".$time);
			return $e;
		}
	}

	/**
	 * Reset user login data
	 *
	 *@author David J Eddy <me@davidjeddy.com>
	 *@param string $username [optional]
	 *@param string $answer [optional]
	 *@return boolean || string
	 */
	public function accountRecovery(stdClass $param_data, $answer = null) {
		$this->logger->addDebug('Starting userClass->accountRecovery()');


		//Validate email, return question
		if ($answer == null) {

			$return_data = $this->userModel->accountRecovery($param_data->email);

			if ($return_data ==false) {

				return array(false, "Email address not found.");
			} else {

				return array(true, $return_data[0]->value);
			}

		} else {

			//Validate answer, return true
			if($answer == null) {

			} else {

			}
		}

		return false;
	}
}
