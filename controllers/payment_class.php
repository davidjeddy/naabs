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
	private $accessToken;

	function __construct (Logger $logger) {
		$this->logger = $logger;

		return true;
	}

	/**
	 * Create a payment method for Paypal. Paypal abstracts the method of payment from the act of processing a transaction.
	 *
	 * @author David J Eddy <me@davidjeddy.com>
	 * @version 0.0.1
	 * @since 0.0.2b
	 * @param object $param_data [required]
	 * @return boolean
	 */
	public function createPaymentMethod($param_data) {

		$this->logger->addDebug('paymentClass->createPaymentMethod() started.');

		try {

			$creditCardId ="3210321032103210";
			$total = "0.01";
			$currency = 'USD';
			$paymentDesc = "Test CC payment";
			
			$card = new CreditCard();
			$card->setType("visa");
			$card->setNumber("4446283280247004");
			$card->setExpire_month("11");
			$card->setExpire_year("2018");
			$card->setFirst_name("Joe");
			$card->setLast_name("Shopper");


			$fundingInstrument = new FundingInstrument();
			$fundingInstrument->setCredit_card($card);

			$payer = new Payer();
			$payer->setPayment_method("credit_card");
			$payer->setFunding_instruments(array($fundingInstrument));

			$amount = new Amount();
			$amount->setCurrency("USD");
			$amount->setTotal("12");

			$transaction = new Transaction();
			$transaction->setAmount($amount);
			$transaction->setDescription("creating a direct payment with credit card");

			$payment = new Payment();
			$payment->setIntent("sale");
			$payment->setPayer($payer);
			$payment->setTransactions(array($transaction));

			$apiContext = new ApiContext(new OAuthTokenCredential( PP_CLIENTID, PP_SECRET ));
			$payment->create($apiContext);

			return $payment;
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
	private function getAmounts($param_data) {

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
        		return "11.95";
        		break;
        	default:
        		return "0.0";
        		break;
        }
	}
}