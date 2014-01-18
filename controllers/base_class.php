<?php
/**
 * Windsnet base controller class
 * 
 * @author David J Eddy <me@davidjeddy.com>
 * @since 0.0.2b
 * @package windsnet
 */

/**
 * baseClass of windsnet
 * @author David J Eddy <me@davidjeddy.com>
 * @since 0.0.2b
 */

require_once (__DIR__.'/../config.php');
// Autoload all the classes controlled by composer
require_once (__DIR__.'/../vendor/autoload.php');
use Respect\Validation\Validator as valClass;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;



class baseClass {

    private $form_data;
    private $logger;



    // Build in methods
    function __construct () {

        $this->form_data = new stdClass();

        // Validate data, as of v0.0.2 all data is alphanumeric only
        if ( isset($_POST) && !empty($_POST) ) {
            $this->validateFormData();
        }

        unset($_POST);

        // create a log channel
        $this->logger = new Logger('AppLogger');
        $this->logger->pushHandler(new StreamHandler('../logs/App.log', Logger::DEBUG));

        // Get the action and class
        if ( isset($this->form_data->action) && !empty($this->form_data->action) ) {
        
            $this->goAction();
        }
    }



    // Custom methods
    private function validateFormData () {

        foreach($_POST as $key => $value) {

            // Validate form field value a-Z 0-9
            if (valClass::alnum('_-\'. ')->validate($value) !== true
            	&& valClass::email()->validate($value) !== true
            ) {
                //TODO make return data class 0.0.2
                echo json_encode(array(false, "Form value ".$value." is not alphanumeric."));
                exit;
            }

            $this->form_data->{$key} = $value;
        }
        


        return true;
    }

    // Go off and do what the form was submitted to do
    private function goAction() {
        $this->logger->addDebug('Starting baseClass->goAction()');

        $return_data;

    	switch($this->form_data->action) {
    		case 'add_user':


                //Create the user account in the DB
                require_once __DIR__.'/user_class.php';           
                $userClass = new userClass($this->logger);
                echo json_encode(array(true, $userClass->createUser($this->form_data)));


                //if the account created correctly
    			//execute payment first
    			require_once __DIR__.'/payment_class.php';
				$paymentClass = new paymentClass($this->logger);
                
                //Submit a (CC) payment
                $paymentClass->createTime($this->form_data);
                // Process payment (transaction)
				echo json_encode(array(true, $paymentClass->updateTime($this->form_data)));

                // Done
                return true;
    		break;
    		default:
    			echo json_encode(array(false, "No valid cation found."));
    	}

        return true;
    }
}

$baseClass = new baseClass();