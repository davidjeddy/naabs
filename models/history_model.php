<?php
/**
 * historyModel model class
 * 
 * @author David J Eddy <me@davidjeddy.com>
 * @since 0.0.6
 */

/**
 * historyModel
 *
 * @author David J Eddy <me@davidjeddy.com>
 * @since 0.0.6
 */
require_once (__DIR__.'/base_model.php');



class historyModel extends baseModel {

	private $datehistory;

	public function __construct() {
		parent::__construct();

		$this->logger->addDebug("historyModel->__constructor started.");
	}

	/**
	 * Simple read logic to get a users history limited by username
	 */
	public function readHistory($username) {
		$this->logger->addDebug("historyModel->readHistory started.");

		$query = "
			SELECT * FROM `".DB_NAME."`.`radtransactionlog`
			WHERE  `username` = '".$username."'
			ORDER BY `create_time` ASC
		";

	    $qdata = $this->conn->prepare($query);

	    $qdata->execute();
			 
		# Get array containing all of the result rows (should be two)
		$return_data = $qdata->fetchAll(PDO::FETCH_OBJ);

		if (!empty($return_data)) {

			return $return_data;
		} else {

			return false;
		}
	}
}
