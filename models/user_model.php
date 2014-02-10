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
	 * Also add teriary data to user_data table. Date like: phone, lot id, security recovery options, account, type, etc
	 *
	 * @author David J Eddy <me@davidjeddy.com>
	 * @param object $param_data [required]
	 * @return boolean
	 */
	public function createUser($param_data) {
		$this->logger->addDebug('Starting userModel->createUser() with data', (array)$param_data);

		// Check if username(email) already exists
		if ( $this->getUserdata( $param_data->email) !== false ) {
			echo json_encode(array(false, "User account already exists."));
			return false;
		}



		// Try to create the account in the radcheck tbo
		try {

			$query = "
				INSERT INTO ".DB_NAME.".`".DB_RAD_TABL."`
				(`username`, `attribute`, `op`, `value`)
				VALUES( :username, 'Clear-Text', ':=', :value);
			";

		    $pstmt = $this->conn->prepare($query);

		    $return_data = $pstmt->execute(array(
		    	'username' => $param_data->email,
		    	'value' => $param_data->password
		    ));

			$this->logger->AddInfo( $param_data->email." account added to ".DB_RAD_TABL." tbo." );



			// Get the last inserted row's ID
			$new_user_id = $this->conn->lastInsertId();



			// Add terciary data to user_data tbo.
			$query = "
				INSERT INTO `".DB_NAME."`.`".DB_DATA_TABL."`
				(`user_id`, `attribute`, `op`, `value`, `created`)
				VALUES(".$new_user_id.", :attribute, '=', :value, '".date("Y-m-d H:i:s")."');
			";

		    $pstmt = $this->conn->prepare($query);

		    // Loop for every piece of data not username(email)/password OR if the value is blank, skip it
		    foreach ($param_data as $key => $value) {

		    	if (stristr($key, "email")
		    		|| stristr($key, "password")
		    		|| $value == ""
		    	){
		    		continue;
		    	}

			    $return_data = $pstmt->execute(array(
			    	'attribute' => strtolower($key),
			    	'value'		=> strtolower($value),
			    ));

				$this->logger->AddInfo( $param_data->email." account added to ".DB_RAD_TABL." tbo." );
			}



			return true;
		} catch(PDOException $e) {
			
			$this->logger->AddError( "Error: ".$e->getMessage());

			echo json_encode(array(false, "Error: ".$e->getMessage()));

			return false;
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

		// Better way of thing this but eh...
		$query = "
			SELECT `id`,`username` FROM ".DB_NAME.".".DB_RAD_TABL."
			WHERE `username` = '".$username."'
		";

	    if ($password != null) { $query .= "AND `value` = '".$password."'"; }

	    $query .="
	    	ORDER BY `id` ASC
			LIMIT 1
		";

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

	/**
	 * Account recovery method for use when resetting the password
	 *
	 *@author David J Eddy <me@davidjeddy.com>
	 *@param string $username [optional]
	 *@param string $answer [optional]
	 *@return boolean || string
	 */
	public function accountRecovery($username, $answer = null) {

		//Get the user ID
		$query = "
			SELECT `id` FROM ".DB_NAME.".".DB_RAD_TABL."
			WHERE `username` = '".$username."'
	    	ORDER BY `id` ASC
			LIMIT 1
		";

	    $qdata = $this->conn->prepare($query);
	    $qdata->execute();
		$user_id = $qdata->fetchAll(PDO::FETCH_OBJ);



		//If the user was not found, return false
		if (!isset($user_id[0])) {return false; }



		if ($answer == null) {
		    // Now get the security question:
			$query = "
				SELECT `value` FROM ".DB_NAME.".".DB_DATA_TABL."
				WHERE `user_id` = ".$user_id[0]->id."
				&& `attribute` = 'securityquestion'
				AND `deleted` IS NULL
			";

		    $qdata = $this->conn->prepare($query);
		    $qdata->execute();
			return $qdata->fetchAll(PDO::FETCH_OBJ);

		//An answer is provided. Check if it is correct.
		} else {

		}


		return false;
	}
}
