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

    protected $form_data;
    protected $logger;



    // Build in methods
    public function __construct () {
        // create a log channel
        $this->logger = new Logger('AppLogger');
        
        $this->logger->pushHandler(new StreamHandler(''.SITEDIR.SITELOG.'', Logger::DEBUG));



        $this->form_data = new stdClass();

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
        $this->logger->addDebug('Starting baseClass->validateFormData()');

        // Loop all the form field values
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

    /**
     * Goto the class and method dicatated by the form's action pair. If it does not exists and error is returned.
     *
     *@author David J Eddy <me@davidjeddy.com>
     *@version 0.0.1
     *@since 0.0.2
     *@date 2014-01-14
     *@todo Iterate on this, it is crap right now.
     */
    // Go off and do what the form was submitted to do
    private function goAction() {
        $this->logger->addDebug('Starting baseClass->goAction()');



    	switch($this->form_data->action) {
    		case 'sign_in':
                $this->logger->addDebug('Starting baseClass->goAction()->login_user');

                //Create the user account in the DB
                require_once __DIR__.'/user_class.php';           
                $userClass = new userClass();

                //Create user account
                $return_data = $userClass->loginUser($this->form_data);

                //BOOLEAN true return
                if ($return_data === true) {
                    echo json_encode(array(
                        "bool" => true,
                        "text" => "User account signed out.",
                        "url"  => SITEROOT."/my_time.php")
                    );
                //false return
                } else {
                    echo json_encode(array("bool" => false, "text" => "Incorrect login information. Please try again.") );
                }
            break;
            case 'sign_out':
                $this->logger->addDebug('Starting baseClass->goAction()->logout_user');

                //Create the user account in the DB
                require_once __DIR__.'/user_class.php';           
                $userClass = new userClass();

                //Create user account
                $return_data = $userClass->logoutUser();

                //BOOLEAN true return
                if ($return_data === true) {
                    echo json_encode(array(
                        "bool" => true,
                        "text" => "User account signed out.",
                        "url"  => SITEROOT."/sign_out.php")
                    );

                //false return
                } else {
                    echo json_encode(array("bool" => false, "text" => $return_data) );
                }
            break;
            case 'sign_up':
                $this->logger->addDebug('Starting baseClass->goAction()->create_user');

                //Create the user account in the DB
                require_once __DIR__.'/user_class.php';           
                $userClass = new userClass();

                //Create user account
                $return_data = $userClass->createUser($this->form_data);

                //BOOLEAN true return
                if ($return_data === true) {
                    echo json_encode(array(
                        "bool" => true,
                        "text" => "User account created, directing to `My Time`.",
                        "url"  => SITEROOT."/my_time.php"
                    ) );
                //false return
                } else {
                    echo json_encode(array("bool" => false, "text" => $return_data) );
                }
    		break;
            case 'create_time':
                $this->logger->addDebug('Starting baseClass->goAction()->create_time');

                $this->form_data->username = $_COOKIE['USER'];
                $return_data_paym = false;
                $return_data_time = false;

                //Create the user account in the DB
                require_once __DIR__.'/payment_class.php';  

                //Process payment
                $paymentClass = new paymentClass();

                // Exec payment attempt
                $return_data_paym = $paymentClass->createPayment($this->form_data);



                if ( $return_data_paym === true ) {
                    // Now attempt to create more time on the users account
                    //Create the user account in the DB
                    require_once __DIR__.'/time_class.php';           
                    $timeClass = new timeClass();



                    //Create user account
                    $return_data_time = $timeClass->createTime($this->form_data);



                    //BOOLEAN true return
                    if ($return_data_time === true) {
                        echo json_encode(array(
                            "bool" => true,
                            "text" => "Time has been added to your account, directing to `My History`.",
                            "url"  => SITEROOT."/my_history.php"
                        ) );
                    //false return
                    } else {
                        echo json_encode(array("bool" => false, "text" => "An error occured while crediting your account with the time specified.".SITECONTACT) );
                    }
                } else {

                    echo json_encode(array("bool" => false, "text" => "There was an error during payment processing. Please check the information and try again." ) );    
                }
            break;
            case 'account_recovery':
                $this->logger->addDebug('Starting baseClass->goAction()->account_recovery');

                //Create the user account in the DB
                require_once __DIR__.'/user_class.php';           
                $userClass = new userClass();

                //Check is username exists
                $return_data = $userClass->accountRecovery($this->form_data);

                if ($return_data === false) {

                    echo json_encode(array(
                        "bool" => false,
                        "text" => "Email address not found."
                    ) );
                    return false;
                } elseif ($return_data === true) {
                    
                    echo json_encode(array(
                        "bool" => true,
                        "text" => "Email address valid",
                        "url"  => SITEROOT."/account_recovery_2.php",
                    ) );
                    return true;
                } else {

                    return false;
                }

                return false;
            break;
            case 'account_recovery_2':
                $this->logger->addDebug('Starting baseClass->goAction()->account_recovery_2');

                //Create the user account in the DB
                require_once __DIR__.'/user_class.php';           
                $userClass = new userClass();



                //Check if the answer provided is correct
                $return_data = $userClass->accountRecovery($this->form_data);

                if ($return_data === false) {

                    echo json_encode(array(
                        "bool" => false,
                        "text" => "Answer did not match what we have on file. Please try again."
                    ) );
                    return false;
                } elseif ($return_data === true) {
                    
                    echo json_encode(array(
                        "bool" => true,
                        "text" => "Answer correct.",
                        "url"  => SITEROOT."/rest_password.php",
                    ) );
                    return true;
                } else {

                    return false;
                }
            break;
            case 'update_password':
                $this->logger->addDebug('Starting baseClass->goAction()->update_password');

                //Create the user account in the DB
                require_once __DIR__.'/user_class.php';           
                $userClass = new userClass();

                $return_data = $userClass->updatePassword($this->form_data);



                //Report on how the password update operation went
                if ($return_data === false) {

                    echo json_encode(array(
                        "bool" => false,
                        "text" => "Unable to update password. ". SITECONTACT,
                    ) );

                    return false;
                } elseif ($return_data === true) {

                    echo json_encode(array(
                        "bool" => true,
                        "text" => "Password updated. You can now log in with the updated information.",
                        "url"  => SITEROOT."/sign_in.php",
                        "callback" => true,
                    ) );

                    return true;
                }

                return false;
            break;
    		default:

    			echo json_encode(array(false, "No valid action found."));
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
     * @return string $ipaddress
     */
    private function getClientIP() {
        $this->logger->addDebug('Starting baseClass->goAction()->create_payment');

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