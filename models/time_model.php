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


	public function __construct() {
		parent::__construct();
	}

	public function readTime($username){
		$return_data = null;
		
		$query = "
			SELECT `username`,`attribute`,`value` FROM ".DB_NAME.".radcheck
			WHERE 
			`username` = '".$username."' AND `attribute` = 'Access-Start'
			OR `username` = '".$username."' AND `attribute` = 'Access-Period'
		";

	    $qdata = $this->conn->prepare($query);

	    $qdata->execute();
			 
		// Get array containing all of the result rows (should be two)
		$return_data = $qdata->fetchAll(PDO::FETCH_OBJ);

		// Using the 'start' and 'length' timestamps we get the timestamp of ending
		if ( isset($return_data[0]->value) 
			&& isset($return_data[1]->value)
		) {
			return ($return_data[0]->value + $return_data[1]->value);
		} else {
			return false;
		}
	}
}
