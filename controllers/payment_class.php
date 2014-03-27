<?php
/**
 * Payment class
 * 
 *@author David J Eddy <me@davidjeddy.com>
 *@since 0.0.2b
 */

/**
 * paymentClass of windsnet
 *
 * Sandbox endpoint: https://api.sandbox.paypal.com
 * Live endpoint: https://api.paypal.com
 *
 *@author David J Eddy <me@davidjeddy.com>
 *@since 0.0.2b
 *@version 0.0.5
 */

require_once (__DIR__.'/base_class.php');

# Include the Models
require_once (__DIR__.'/../models/payment_model.php');

use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

use PayPal\Api\Address;
use PayPal\Api\CountryCode;
use PayPal\Api\CreditCard;
use PayPal\Api\FundingInstrument;
use PayPal\Api\Payer;
use PayPal\Api\AmountDetails;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\Payment;
use PayPal\Api\Sale;


use Monolog\Logger;
use Monolog\Handler\StreamHandler;



class paymentClass extends baseClass {

	private $paymentModel;

	public function __construct() {
		parent::__construct();
		
		$this->logger->addDebug("paymentClass->__construct() started.");

		// Instantiate the DB class.
		$this->paymentModel = new paymentModel;
	}

	/**
	 * Update/Submit a CC payment to Paypal for processing
	 *
	 * @author David J Eddy <me@davidjeddy.com>
	 * @version 0.0.1
	 * @since 0.0.2b
	 * @param object $param_data [required]
	 * @return boolean
	 */
	public function createPayment($param_data) {
		$this->logger->addDebug('paymentClass->createPayment() started.');



		try {
			$apiContext = new ApiContext(new OAuthTokenCredential(PP_CLIENTID, PP_SECRET));

			$addr = new Address();
			$addr->setLine1($param_data->line1);
			$addr->setCity($param_data->city);
			$addr->setState($param_data->state);
			$addr->setPostal_code($param_data->zip);
			$addr->setCountry_code($param_data->country);

			$card = new CreditCard();
			$card->setNumber($param_data->cardnumber);
			$card->setType($param_data->cardtype);
			$card->setExpire_month($param_data->cardexpiremonth);
			$card->setExpire_year($param_data->cardexpireyear);
			$card->setCvv2($param_data->cardcvv2);
			$card->setFirst_name($param_data->firstname);
			$card->setLast_name($param_data->lastname);
			$card->setBilling_address($addr);

			$fi = new FundingInstrument();
			$fi->setCredit_card($card);

			$payer = new Payer();
			$payer->setPayment_method('credit_card');
			$payer->setFunding_instruments(array($fi));

			$amount = new Amount();
			$amount->setCurrency('USD');
			$amount->setTotal($this->getAmount($param_data->serviceduration));

			$transaction = new Transaction();
			$transaction->setAmount($amount);
			$transaction->setDescription('This is the payment transaction description.');

			$payment = new Payment();
			$payment->setIntent('sale');
			$payment->setPayer($payer);
			$payment->setTransactions(array($transaction));



			### Create Payment
			# Create a payment by posting to the APIService
			# using a valid ApiContext
			# The return object contains the status;
			try {
				$payment->create($apiContext);

				if ($payment->getState() == "approved") {

					return $this->paymentModel->createPaymentLog($param_data->username, $payment->toArray());
				} else {
					$this->logger->addError( "Error with payment information.");

					return false;
				}

			} catch (\PPConnectionException $e) {
				$this->logger->addError( "Error while connecting to processing credit card: ".$e->getMessage());

				return false;
			}

			return false;
		} catch (Exception $e) {

			$this->logger->addError('paymentClass->createPaymentMethod() failed with an error of '.$e);
			return false;
		}



		return false;
	}

	/**
	* Takes seconds of access and convert to $ amount
	*
	* @author David J Eddy <me@davidjeddy.com>
	* @version 0.0.1
	* @since 0.0.2
	* @date 2014-01-17
	* @param integer $param_data [required]
	* @return string
	* @todo make this a DB call to the table containing the acces time data
	*/
	private function getAmount($param_data) {

        switch ($param_data) {
        	case  "86400":
        		return "5.95";
        		break;
        	case "604800":
        		return "11.95";
        		break;
        	case "18144000":
        		return "24.95";
        		break;
        	case "54432000":
        		return "74.85";
        		break;
        	case "108864000":
        		return "134.95";
        		break;
        	default:
        		return "0.0";
        		break;
        }
	}
}