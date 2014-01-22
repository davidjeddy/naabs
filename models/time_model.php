<?php
/**
 * timeModel model class
 * 
 * @author David J Eddy <me@davidjeddy.com>
 * @since 0.0.4
 */

/**
 * timeModel
 *
 * Access-Start is a k/v pair stored in the radcheck table. k is Access-Start, v is int of UNIX timestamp
 * Access-Period is a k/v pair stored in the radcheck table. k is Access-Period, v is int of UNIX timestamp
 *
 * @author David J Eddy <me@davidjeddy.com>
 * @since 0.0.1
 */
require_once (__DIR__.'/base_model.php');



class timeModel extends baseModel {

	private $datetime;

	public function __construct() {
		parent::__construct();

		$this->datetime = new Datetime;
	}

	/**
	 * Add a session-start entry to the RADIUS server TBO
	 *
	 *@author David J Eddy <me@davidjeddy.com>
	 *@date 2014-01-22
	 *@param object $param_data [required]
	 *@return boolean
	 */
	public function createTime($param_data) {

		try {
			# New Session-Start & #Session-Expire rows
			$query = "			
				INSERT INTO `".DB_NAME."`.`radcheck`
						( `username`, `attribute`, `op`, `value`)
				VALUES 	( :username, 'Access-Expire', ':=', :value_expire)
			";

			$pstmt = $this->conn->prepare($query);

		    $pstmt->bindParam(':username'		, $username);
		    $pstmt->bindParam(':value_expire'	, $value_expire);

		    $username 		= $param_data->username;
		    $value_expire	= ($this->datetime->getTimestamp() + $param_data->serviceduration);

		    return $pstmt->execute();

		} catch (Exception $e) {
			$this->logger->AddError("timeModel->createTime() error: ". $e);
			return false;
		}
	}

	/**
	 * Read the expiration date of the users access time
	 */
	public function readTime($username) {
		$return_data = null;
		
		$query = "
			SELECT `username`,`attribute`,`value` FROM ".DB_NAME.".radcheck
			WHERE  `username` = '".$username."' AND `attribute` = 'Access-Expire'
		";

	    $qdata = $this->conn->prepare($query);

	    $qdata->execute();
			 
		# Get array containing all of the result rows (should be two)
		$return_data = $qdata->fetchAll(PDO::FETCH_OBJ);

		if (isset($return_data[0]->value)){

			return $return_data[0]->value;
		} else {

			return false;
		}
	}

	/**
	 * User has time, and is current, add more
	 *
	 */
	public function updateTime($param_data) {

		# Get the users current expiring time
		$current_expire_time = $this->readTime($param_data->username);

		if ($current_expire_time < $this->datetime->getTimestamp() ) {
			$current_expire_time = $this->datetime->getTimestamp();
		}

		# Add new amount of time to exisiting time
		$ttl_access_time = ($current_expire_time + $param_data->serviceduration);

		$query = "			
			UPDATE `".DB_NAME."`.`radcheck`
			SET `value` = ?
			WHERE `username` = ? AND `attribute` = 'Access-Expire'	
		";

		$pstmt = $this->conn->prepare($query);

		return $pstmt->execute(array(
			$ttl_access_time,
			$param_data->username
		));
	}
}
