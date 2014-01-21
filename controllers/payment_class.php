<?php
/**
 * Payment Class
 * 
 * @author David J Eddy <me@davidjeddy.com>
 * @since 0.0.4
 */

/**
 * Paym,ent Class
 * @author David J Eddy <me@davidjeddy.com>
 * @since 0.0.4
 */
require_once (__DIR__.'/base_class.php');
// Include the model
//require_once (__DIR__.'/../models/payment_model.php');

use Monolog\Logger;
use Monolog\Handler\StreamHandler;


class paymentClass extends baseClass {

	public function __construct() {
		parent::__construct();
		
		// Instantiate the DB class.
	}

	//Public methods as CRUD
}