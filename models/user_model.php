<?php
/**
 * Windsnet user model class
 * 
 * @author David J Eddy <me@davidjeddy.com>
 * @since 0.0.2b
 * @package windsnet
 */

/**
 * userModel
 * @author David J Eddy <me@davidjeddy.com>
 * @since 0.0.1
 */
require_once (__DIR__.'/base_model.php');



class userModel extends baseModel {


	public function __construct() { parent::__construct(); }

	// public methods
	/**
	 * Insert a new FREERadius user into radcheck w/ creditials.
	 *
	 * @author David J Eddy <me@davidjeddy.com>
	 * @param array $param_data [required]
	 * @return boolean
	 */
	public function createUser ($param_data) {
		$this->logger->addDebug('Starting userModel->createUser() with data', (array)$param_data);

		try {

		    $pstmt = $this->conn->prepare("
		    	INSERT INTO `radius`.`radcheck`
				(`username`, `attribute`, `op`, `value`)
				VALUES( :username, 'Clear-Text', ':=', :value);
			");

		    $return_data =  $pstmt->execute(array(
		    	'username' => $param_data->email,
		    	'value' => $param_data->password
		    ));

		    return true;
		} catch(PDOException $e) {
			$this->logger->AddError( "Error: ".$e->getMessage());
			return false;
		}



		return false;
	}
}