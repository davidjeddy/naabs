<?php
/**
 * Payment model class
 * 
 * Right now this is very tightly coupled with Paypal.
 *
 *@author David J Eddy <me@davidjeddy.com>
 *@since 0.0.2b
 *@package windsnet
 *@todo be payment processor agnostic
 */

/**
 * paymentModel
 *@author David J Eddy <me@davidjeddy.com>
 *@since 0.0.1
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
	public function createPaymentLog($username, $param_data) {
		$this->logger->addDebug('paymentModel->createPaymentLog() started.');

		try {
			# New Session-Start & #Session-Expire rows
			$query = "			
				INSERT INTO `".DB_NAME."`.`radtransactionlog` (
					`username`,
					`transaction_id`,
					`create_time`,
					`intent`,
					`state`,
					`amount`
				) VALUES (
					:username,
					:transaction_id,
					:create_time,
					:intent,
					:state,
					:amount
				)
			";

			$pstmt = $this->conn->prepare($query);

		    $pstmt->bindParam(':username', 		$username);
			$pstmt->bindParam(':transaction_id',$transaction_id);
			$pstmt->bindParam(':create_time', 	$create_time);
			$pstmt->bindParam(':intent', 		$intent);
			$pstmt->bindParam(':state', 		$state);
			$pstmt->bindParam(':amount', 		$amount);

		    $username 		= $username;
		    $transaction_id = $param_data['id'];	
		    $create_time 	= date("U",strtotime($param_data['create_time'])); //sloppy but works
		    $intent 		= $param_data['intent'];
		    $state 			= $param_data['state'];
		    $amount 		= $param_data['transactions']['0']['amount']['total'];

		    return $pstmt->execute();
		} catch (PDOException $e) {

			$this->logger->addError('paymentModel->createPaymentLog() failed with an error of '.$e);
			return false;
		}
	}
}
