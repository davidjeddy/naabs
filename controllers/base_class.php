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

// Autoload all the classes controlled by composer
require_once (__DIR__.'/../vendor/autoload.php');
use Respect\Validation\Validator as valClass;



class baseClass {

    private $form_data;



    // Build in methods
    function __construct () {

        // Validate data, as of v0.0.2 all data is alphanumeric only
        if ( isset($_POST) && !empty($_POST) ) {
            $this->validateFormData();
        }

        unset($_POST);

        // Get the action and class
        if ( isset($this->form_data->action) && !empty($this->form_data->action) ) {
        
            $this->goAction();
        }
    }



    // Custom methods
    private function validateFormData () {

        foreach($_POST as $key => $value) {

            // Validate form field value a-Z 0-9
            if (valClass::alnum('_-\' ')->validate($value) !== true
            	&& valClass::email()->validate($value) !== true
            ) {
                //TODO make return data class 0.0.2
                echo json_encode(array(false, "Form value ".$value." is not alphanumeric."));
                exit;
            }

            // If pair is valud
            $this->form_data->{$key} = $value;
        }
        
        return true;
    }

    // Go off and do what the form was submitted to do
    private function goAction() {

    	switch($this->form_data->action) {
    		case 'add_user':
    			//execute payment first
    			require_once __DIR__.'/payment_class.php';    		
				$paymentClass = new paymentClass();
				$paymentClass->addTime($this->form_data);

				// if that returns ok, add the user account to RADIUS
				require_once __DIR__.'/user_class.php';    		
    			$userClass = new userClass($this->form_data);

    		break;
    		default:
    			echo json_encode(array(false, "No valid cation found."));
    	}

        return true;
    }
}

$baseClass = new baseClass();