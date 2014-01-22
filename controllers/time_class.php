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
# Include Controllers
require_once (__DIR__.'/base_class.php');
require_once (__DIR__.'/payment_class.php');
# Include the Models
require_once (__DIR__.'/../models/time_model.php');

use Monolog\Logger;
use Monolog\Handler\StreamHandler;


class timeClass extends baseClass {

    private $timeModel;
    private $datetime;

    public function __construct() {
        # start up parent constructor
        parent::__construct();

        $this->logger->addDebug('Starting timeClass->__construct()');

        # Instantiate the DB class.
        $this->timeModel = new timeModel();
        $this->datetime  = new Datetime();

    }

    /**
     * This method is used to create an entry for new time. Typically for firt purchases.
     *
     *@author David J Eddy <me@davidjeddy.com>
     *@version 0.0.5
     *@since 0.0.4
     *@date 2014-01-21
     *@param object $param_data [required]
     *@return boolean | string
     *
     */
    public function createTime($param_data) {
        $this->logger->addDebug('Starting timeClass->createTime()');
    


        # Has the user ever had time with us?
        $user_time_data = $this->timeModel->readTime($param_data->username);
        
        # Yes, the user has, at some point, had time with us
        if( is_numeric($user_time_data) ) {

            # Go update the experation time
            return $this->timeModel->updateTime($param_data);

        # No, the user has never had time with us.
        } else {

            # Create a Session-Start / Session-Expire entries for a new user
            return $this->timeModel->createTime($param_data, true);
        }



        return false;
    }

    /**
     * Translate UNIX timestamp into a formated response.
     */
    public function readTime($user) {
        $this->logger->addDebug('Starting timeClass->readTime()');



        $return_data = $this->timeModel->readTime($user);

        if (is_numeric($return_data)) {

            $this->datetime->setTimestamp($return_data);
            return $this->datetime->format('Y M d, h:m a');
        } else {

            return false;
        }



        return false;
    }
}