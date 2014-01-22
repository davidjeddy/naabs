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
        parent::__construct();
        
        # Instantiate the DB class.
        $this->timeModel = new timeModel();
        $this->datetime  = new Datetime();
    }

    /**
     * Fiogure out if s user A) has had time, B) do they have valid time still, C) if we add more time or create new entries
     *
     *@author David J Eddy <me@davidjeddy.com>
     *@version 0.0.2
     *@since 0.0.4
     *@date 2014-01-21
     *@param object $param_data [required]
     *@return boolean | string
     *
     */
    public function createTime($param_data) {
        $this->logger->addDebug('Starting timeClass->createTime()');
    

        
        # Yes, the user has, at some point, had time with us
        if( is_numeric($this->timeModel->readTime($param_data->username)) ) {

            # Has the time expired?
            # No, the user still has time and is adding more.
            if ($this->datetime->getTimestamp() < $user_time_data) {
                
                echo 'time is still valid.';

                return $this->timeModel->updateTime($param_data, true);
                return true;
                
            # Yes, the time is over with            
            } else {
                
                echo 'add new time amount to expired amounts';exit;
                return false;
            }
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

        if (is_integer($return_data)) {
            return date('Y M d, h:m a', $return_data );
        } else {
            return false;
        }
    }
}