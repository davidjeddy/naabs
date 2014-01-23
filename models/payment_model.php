<?php
/**
 * Payment model class
 * 
 * @author David J Eddy <me@davidjeddy.com>
 * @since 0.0.2b
 * @package windsnet
 */

/**
 * paymentModel
 * @author David J Eddy <me@davidjeddy.com>
 * @since 0.0.1
 */
require_once (__DIR__.'/base_model.php');



class paymentModel extends baseModel {


	public function __construct() {
		parent::__construct();

		$this->logger->addDebug("paymentModel->__constructor started.");
	}

	/**
	 * Save the transaction log to our transaction table
	 */
	public function createPaymentLog($payment_log_obj) {

return true;

		# New Session-Start & #Session-Expire rows
		$query = "			
			INSERT INTO `".DB_NAME."`.`".DB_TABL."` (
				`username`,
				`transaction_id`,
				`create_time`,
				`number`,
				`state`,
				`amount`,
			) VALUES (
				:username,
				:transaction_id,
				:create_time,
				:number,
				:state,
				:amount,
			)
		";

		$pstmt = $this->conn->prepare($query);

	    $pstmt->bindParam(':username', 		$username);
		$pstmt->bindParam(':transaction_id',$transaction_id);
		$pstmt->bindParam(':create_time', 	$create_time);
		$pstmt->bindParam(':number', 		$number);
		$pstmt->bindParam(':state', 		$state);
		$pstmt->bindParam(':amount', 		$amount);

	    $username 		= null;//null;//$param_data->username;
	    $transaction_id = null;//$param_data->username;
	    $create_time 	= null;//$param_data->username;
	    $number 		= null;//$param_data->username;
	    $state 			= null;//$param_data->username;
	    $amount 		= null;//$param_data->username;



	    //return $pstmt->execute();

		return true;
	}
}
