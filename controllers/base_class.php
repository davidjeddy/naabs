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

            //If the field name is a repeat field, ignore it for business logic
            
            if (substr($key, 0, 6) == "repeat") {
                continue;
            }

            // Validate field key's
            if (valClass::alnum('')->validate($key) !== true) {
                echo json_encode(array(false, "Form key ".$key." is not alphanumeric."));
            }

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
        
        $this->form_data->client_ip = $this->getClientIP();



        return true;
    }

    // Go off and do what the form was submitted to do
    private function goAction() {
        $this->logger->addDebug('Starting baseClass->goAction()');



    	switch($this->form_data->action) {
    		case 'create_user':
                //Create the user account in the DB
                require_once __DIR__.'/user_class.php';           
                $userClass = new userClass($this->logger);

                //Create user account
                if ($userClass->createUser($this->form_data)) {
                    echo json_encode(array("bool" => true, "text" => "User account created."));
                } else {
                    echo json_encode(array("bool" => false, "text" => "Failed to create user account."));
                }

    		break;
            case 'create_payment':

                //if the account created correctly
                //execute payment first
                require_once __DIR__.'/payment_class.php';
                $paymentClass = new paymentClass($this->logger);
                
                //Submit a (CC) payment
                $paymentClass->createTime($this->form_data);
                // Process payment (transaction)
                if ($paymentClass->updateTime($this->form_data) == true) {
                    //Update user record with new time amount.
                };
            break;
    		default:
    			echo json_encode(array(false, "No valid cation found."));
    	}

        return true;
    }

    /**
     * Get the clients IP.
     *
     * @Source: http://stackoverflow.com/questions/15699101/get-client-ip-address-using-php
     * @Author Sivanesh Govindan
     * @Author David J Eddy <me@davidjeddy.com>
     * @data 2014-01-20
     */
    private function getClientIP() {
         $ipaddress = NULL;
         if ( isset($_SERVER['HTTP_CLIENT_IP']) && $ipaddress == NULL)
             $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
         else if( isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $ipaddress == NULL)
             $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
         else if( isset($_SERVER['HTTP_X_FORWARDED']) && $ipaddress == NULL)
             $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
         else if( isset($_SERVER['HTTP_FORWARDED_FOR']) && $ipaddress == NULL)
             $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
         else if( isset($_SERVER['HTTP_FORWARDED']) && $ipaddress == NULL)
             $ipaddress = $_SERVER['HTTP_FORWARDED'];
         else if( isset($_SERVER['REMOTE_ADDR']) && $ipaddress == NULL)
             $ipaddress = $_SERVER['REMOTE_ADDR'];
         else
             $ipaddress = '0.0.0.0';

         return $ipaddress; 
    }
}

$baseClass = new baseClass();