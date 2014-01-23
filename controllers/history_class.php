<?php
/**
 * History Class controller
 * 
 * @author David J Eddy <me@davidjeddy.com>
 * @since 0.0.6
 * @package windsnet
 */

/**
 * historyClass
 * @author David J Eddy <me@davidjeddy.com>
 * @since 0.0.6
 * @date 2014-01-21
 */
# Include Controllers
require_once (__DIR__.'/base_class.php');
require_once (__DIR__.'/payment_class.php');
# Include the Models
require_once (__DIR__.'/../models/history_model.php');

use Monolog\Logger;
use Monolog\Handler\StreamHandler;


class historyClass extends baseClass {

    private $historyModel;

    public function __construct() {
        # start up parent constructor
        parent::__construct();

        $this->logger->addDebug('Starting historyClass->__construct()');

        # Instantiate the DB class.
        $this->historyModel = new historyModel();
    }

    /**
     * Read a users history
     */
    public function readHistory($username) {
        $this->logger->addDebug('Starting historyClass->readHistory()');

        return $this->historyModel->readHistory($username);
    }
}