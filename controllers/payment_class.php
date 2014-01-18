<?php
/**
 * Windsnet payment controller class
 * 
 * @author David J Eddy <me@davidjeddy.com>
 * @since 0.0.2b
 * @package windsnet
 */

/**
 * paymentClass of windsnet
 *
 * Sandbox endpoint: https://api.sandbox.paypal.com
 * Live endpoint: https://api.paypal.com
 *
 * @author David J Eddy <me@davidjeddy.com>
 * @since 0.0.2b
 */

require_once (__DIR__.'/../config.php');
// Autoload all the classes controlled by composer
require_once (__DIR__.'/../vendor/autoload.php');
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

use PayPal\Api\Address;
use PayPal\Api\CreditCard;
use PayPal\Api\FundingInstrument;
use PayPal\Api\Payer;
use PayPal\Api\AmountDetails;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\Payment;


use Monolog\Logger;
use Monolog\Handler\StreamHandler;



class paymentClass {

	private $logger;

	function __construct (Logger $logger) {
		$this->logger = $logger;

		return true;
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
	public function createTime($param_data) {

		$this->logger->addDebug('paymentClass->createTime() started.');

		try {
			$addr = new Address();
			$addr->setLine1($param_data->line1);
			$addr->setCity($param_data->city);
			$addr->setCountry_code($param_data->country);
			$addr->setPostal_code($param_data->zip);
			$addr->setState($param_data->state);

			$card = new CreditCard();
			$card->setNumber($param_data->card_number);
			$card->setType($param_data->card_type);
			$card->setExpire_month($param_data->card_expire_month);
			$card->setExpire_year($param_data->card_expire_year);
			$card->setCvv2($param_data->card_cvv2);
			$card->setFirst_name($param_data->first_name);
			$card->setLast_name($param_data->last_name);
			$card->setBilling_address($addr);

			$fi = new FundingInstrument();
			$fi->setCredit_card($card);

			$payer = new Payer();
			$payer->setPayment_method('credit_card');
			$payer->setFunding_instruments(array($fi));

			$amountDetails = new AmountDetails();
			$amountDetails->setSubtotal($this->getAmount($param_data->service_duration));
			$amountDetails->setTax('0.00');
			$amountDetails->setShipping('0.00');

			$amount = new Amount();
			$amount->setCurrency('USD');
			//$amount->setTotal('7.47');
			$amount->setTotal($this->getAmount($param_data->service_duration));
			$amount->setDetails($amountDetails);

			$transaction = new Transaction();
			$transaction->setAmount($amount);
			$transaction->setDescription('This is the payment transaction description.');

			$payment = new Payment();
			$payment->setIntent('sale');
			$payment->setPayer($payer);
			$payment->setTransactions(array($transaction));

			$apiContext = new ApiContext(new OAuthTokenCredential( PP_CLIENTID, PP_SECRET ));
			$payment->create($apiContext);

			return $payment->getState();
		} catch (Exception $e) {

			$this->logger->addError('paymentClass->createPaymentMethod() failed with an error of '.$e);
			return false;
		}
	}

	public function addTime($param_data) {
		
		$this->logger->addDebug('Starting addTime()');

		return true;
	}



	/**
	* Takes seocnds of access and convert to $ amount
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
        	default:
        		return "0.0";
        		break;
        }
	}
}