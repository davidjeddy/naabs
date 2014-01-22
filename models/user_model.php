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


	public function __construct() {
		parent::__construct();

	}

	// public methods
	/**
	 * Insert a new FREERadius user into radcheck w/ creditials.
	 *
	 * @author David J Eddy <me@davidjeddy.com>
	 * @param array $param_data [required]
	 * @return boolean
	 */
	public function createUser($param_data) {
		$this->logger->addDebug('Starting userModel->createUser() with data', (array)$param_data);

		// Check is username already exists
		if ( $this->getUserdata( $param_data->email) !== false ) {
			return "User account already exists.";
		}



		// Try to create the account
		try {

		    $pstmt = $this->conn->prepare("
		    	INSERT INTO ".DB_NAME.".`radcheck`
				(`username`, `attribute`, `op`, `value`)
				VALUES( :username, 'Clear-Text', ':=', :value);
			");

		    $return_data =  $pstmt->execute(array(
		    	'username' => $param_data->email,
		    	'value' => $param_data->password
		    ));

		    return true;
		} catch(PDOException $e) {
			
			return $this->logger->AddError( "Error: ".$e->getMessage());;
		}



		return false;
	}



	// private method
	/**
	 * Check that the username (email) is not already registered with the system
	 *
	 *@author David J Eddy <me@davidjeddy.com>
	 *@param string $username [optional]
	 *@param string $password [optional]
	 *@return object | boolean
	 *@todo iterate on this
	 */
	public function getUserdata($username = null, $password = null) {

		$query = "
			SELECT * FROM ".DB_NAME.".radcheck
			WHERE `username` = '".$username."'
		";

	    if ($password != NULL) {
	    	$query .= "AND `value` = '".$password."';";
	    }

	    $qdata = $this->conn->prepare($query);

	    $qdata->execute();
			 
		// Get array containing all of the result rows
		$return_data = $qdata->fetchAll(PDO::FETCH_OBJ);
		 
		// If one or more rows were returned...
		if ( count($return_data) ) {
		    // Combine all the objects into one, as the key 'username' as the pivot point
			return $return_data;
		} else {
		    return false;
		}

	}
}
