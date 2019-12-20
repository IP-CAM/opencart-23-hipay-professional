<?php
class HIPAY_MAPI_SimplePayment extends HIPAY_MAPI_Payment {

	function __construct(HIPAY_MAPI_PaymentParams $paymentParams,HIPAY_MAPI_Order $order,$items) {
		try {
			parent::__construct($paymentParams,array($order),$items);
		} catch(Exception $e) {
			throw new Exception($e->getMessage());
		}
	}

}
?>