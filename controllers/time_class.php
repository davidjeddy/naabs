<?php
/**
 * Time Class controller
 * 
 * @author David J Eddy <me@davidjeddy.com>
 * @since 0.0.2b
 * @package windsnet
 */

/**
 * timeClass
 * @author David J Eddy <me@davidjeddy.com>
 * @since 0.0.2b
 * @date 2014-01-21
 */
// Include Controllers
require_once (__DIR__.'/base_class.php');
require_once (__DIR__.'/payment_class.php');
// Include the Models
require_once (__DIR__.'/../models/time_model.php');

use Monolog\Logger;
use Monolog\Handler\StreamHandler;


class timeClass extends baseClass {

    private $timeModel;

    public function __construct() {
        parent::__construct();
        
        // Instantiate the DB class.
        $this->timeModel = new timeModel();
    }

    /**
     * Add time to an account
     *
     *@author David J Eddy <me@davidjeddy.com>
     *@version 0.0.1
     *@since 0.0.4
     *@date 2014-01-21
     *@param object $param_data [required]
     *@return boolean | string
     *
     */
    public function createTime($param_data) {
        //Process payment
        $paymentClass = new paymentClass();

        // Exec payment attempt
        $pay_return_data = $paymentClass->applyPayment($param_data);

        // Good
        if ( $pay_return_data === true ) {

            //Has the user ever had time with us?
            //yes
            if( $this->timeModel->readTime($user) ) {
            }
            
                //has the time expired?
                    //yes: set new access-start & access-period
                    //no: leave access-start, add current access-period w/ new period. save access-period
            //no
            // create access-start & access-period with values

            
        // payment failed
        } else {

            return $pay_return_data;
        }

        return json_encode( array("bool" => false, "text" => "Payment processing failed. Pay Error 1.") );
    }

    /**
     * Translate UNIX timestamp into a formated response.
     */
    public function readTime($user) {
        $this->logger->addDebug('Starting timeClass->readTime()');

        $return_data = $this->timeModel->readTime($user);

        if (is_integer($return_data)) {
            return date('Y M d, h:m a', $return_data );
        } else {
            return false;
        }
    }
}