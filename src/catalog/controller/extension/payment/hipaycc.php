<?php
/*
Hipay Wallet & Direct Extension for Opencart 2.3.x
Author: diogojosferreira@gmail.com
*/
class ControllerExtensionPaymentHipayCC extends Controller {


    public function index() {


        $this->load->language('extension/payment/hipaycc'); // 

        $data['button_confirm'] = $this->language->get('button_confirm');
        $data['text_loading'] = $this->language->get('text_loading');
        $data['continue'] = $this->url->link('extension/payment/hipaycc/payment');
        //$data['heading_title'] = $this->language->get('heading_title'); // set the heading_title of the module
                 
        return $this->load->view('extension/payment/hipaycc.tpl', $data);    

    }


    public function payment(){

        $this->load->model('checkout/order');
        $data = $this->model_checkout_order->getOrder($this->session->data['order_id']);
        $data['hipaycc_sandbox'] = $this->config->get('hipaycc_sandbox'); 
        if ($data['hipaycc_sandbox']){
            require_once('hipay_mapi/mapi_package_sandbox.php');
            $account = $this->config->get('hipaycc_sandbox_account');
            $website = $this->config->get('hipaycc_sandbox_website');
            $website_password = $this->config->get('hipaycc_sandbox_password');
            $website_category = $this->config->get('hipaycc_sandbox_category');
            $website_shopid = $this->config->get('hipaycc_sandbox_shopid');

        }else {
            require_once('hipay_mapi/mapi_package.php');
            $account = $this->config->get('hipaycc_account');
            $website = $this->config->get('hipaycc_website');
            $website_password = $this->config->get('hipaycc_password');
            $website_category = $this->config->get('hipaycc_category');
            $website_shopid = $this->config->get('hipaycc_shopid');           

        }    

        //add $data["email"] to hipay client email
        //read country to get country + lang
        //exceptions and errors

        $product_title = $this->config->get('hipaycc_payment_info');
        $order_title = $this->config->get('hipaycc_payment_title');

        $params = new HIPAY_MAPI_PaymentParams();
        $params->setLogin($account,$website_password);
        $params->setAccounts($account,$account);
        $lang = $this->get_current_local_for_hipay($this->language->get('code'));

        $params->setLocale($lang);
        $params->setMedia('WEB');
        $params->setRating($this->config->get('hipaycc_payment_rating'));
        if ($website_shopid != "") $params->setShopID($website_shopid);
        $params->setPaymentMethod(HIPAY_MAPI_METHOD_SIMPLE);
        $params->setCaptureDay(HIPAY_MAPI_CAPTURE_IMMEDIATE);
        $params->setCurrency($this->config->get('hipaycc_payment_currency'));
        $params->setIdForMerchant($data['order_id']);

        $params->setMerchantDatas('uid',$data['order_id']);
        $challenge_id = sha1($data['order_id'] . $this->config->get('hipaycc_secret_key'));
        $params->setMerchantDatas('challenge',$challenge_id);
        $params->setMerchantSiteId($website);
        $params->setURLOk($this->url->link('extension/payment/hipaycc/success'));
        $params->setUrlNok($this->url->link('extension/payment/hipaycc/error'));
        $params->setUrlCancel($this->url->link('extension/payment/hipaycc/cancel'));
        $params->setEmailAck($this->config->get('hipaycc_email'));
        $params->setUrlAck($this->url->link('extension/payment/hipaycc/ack'));
        $params->setLogoUrl($this->config->get('hipaycc_logo'));
        if ($this->config->get('hipaycc_background') != "")    
            $t=$params->setBackgroundColor($this->config->get('hipaycc_background'));
        else
            $t=$params->setBackgroundColor('#FFFFFF');
        $t=$params->check();
        if (!$t)
        {
            echo "An error occurred while creating the paymentParams object";
            exit;
        }

        $item1 = new HIPAY_MAPI_Product();
        if ($product_title != "")
            $item1->setName("$product_title");
        else
            $item1->setName("$order_title");
        $item1->setInfo('');
        $item1->setquantity(1);
        $item1->setRef($data['order_id']);
        $item1->setCategory(1);
        $total_order = $data['total'];
        $total_order = number_format($data['total'],2,".","");
        $item1->setPrice($total_order);
        $item1->setTax(array());
        $t=$item1->check();
        if (!$t)
        {
            echo "An error occurred while creating a product object";
            exit;
        }

        $order = new HIPAY_MAPI_Order();
        $order->setOrderTitle($order_title);
        $order->setOrderInfo('');
        $order->setOrderCategory($website_category);
        $order->setShipping(0,array());
        $order->setInsurance(0,array());
        $order->setFixedCost(0,array());
        $order->setAffiliate(array());
        $t=$order->check();
        if (!$t)
        {
            echo "An error occurred while creating a product object";
          exit;
        }

        try {
              $payment = new HIPAY_MAPI_SimplePayment($params,$order,array($item1));
        }
              catch (Exception $e) {
              echo "Error" .$e->getMessage();
        }
        $xmlTx=$payment->getXML();

        $output=HIPAY_MAPI_SEND_XML::sendXML($xmlTx);
        $r=HIPAY_MAPI_COMM_XML::analyzeResponseXML($output, $url, $err_msg);
        if ($r===true) {
                header('Location: '.$url) ;
        } else {
               echo "ERRO"; 
        }

    }

    private function get_current_local_for_hipay($lang){

        switch ($lang) {
            case 'pt':
                return "pt_PT";
                break;
            case 'fr':
                return "fr_FR";
                break;
            default:
                return "en_GB";
                break;
        }
    }
 

    public function ack(){

        if(!isset($_POST["xml"])) exit;
        $xml = $_POST['xml'];

        $operation = '';
        $status = '';
        $date = '';
        $time = '';
        $transid = '';
        $origAmount = '';
        $origCurrency = '';
        $idformerchant = '';
        $merchantdatas = array();
        $ispayment = true;

        try {
            $obj = new SimpleXMLElement(trim($xml));
        } catch (Exception $e) {
            $ispayment =  false;
        }
        if (isset($obj->result[0]->operation))
            $operation=$obj->result[0]->operation;
        else
            $ispayment =  false;

        if (isset($obj->result[0]->status))
            $status=$obj->result[0]->status;
        else 
            $ispayment =  false;

        if (isset($obj->result[0]->date))
            $date=$obj->result[0]->date;
        else 
            $ispayment =  false;

        if (isset($obj->result[0]->time))
            $time=$obj->result[0]->time;
        else 
            $ispayment =  false;

        if (isset($obj->result[0]->transid))
            $transid=$obj->result[0]->transid;
        else 
            $ispayment =  false;

        if (isset($obj->result[0]->origAmount))
            $origAmount=$obj->result[0]->origAmount;
        else 
            $ispayment =  false;

        if (isset($obj->result[0]->origCurrency))
            $origCurrency=$obj->result[0]->origCurrency;
        else 
            $ispayment = false;

        if (isset($obj->result[0]->idForMerchant))
            $idformerchant=$obj->result[0]->idForMerchant;
        else 
            $ispayment =  false;

        if (isset($obj->result[0]->merchantDatas)) {
            $d = $obj->result[0]->merchantDatas->children();
            foreach($d as $xml2) {
                if (preg_match('#^_aKey_#i',$xml2->getName())) {
                    $indice = substr($xml2->getName(),6);
                    //$xml2 = (array)$xml2;
                    $valeur = (string)$xml2[0];
                    $merchantdatas[$indice] = $valeur;
                }
            }
        }


        if ($ispayment===true) {

            if ($status=="ok" && $operation=="capture") {
                $challenge_id = sha1($idformerchant . $this->config->get('hipaycc_secret_key'));
                if ($merchantdatas['challenge'] == $challenge_id) {
                    $this->load->language('extension/payment/hipaycc'); 
                    $this->load->model('checkout/order');
                    $this->model_checkout_order->addOrderHistory($idformerchant, 2,$this->language->get('hipay_success'));
                }    
            } elseif($operation!="authorization") {

                $this->load->language('extension/payment/hipaycc'); 
                $this->load->model('checkout/order');
                $this->model_checkout_order->addOrderHistory($idformerchant, 10, $operation . $this->language->get('hipay_error_ack'));

            }
        }


        return true;
    }

    public function success(){
        if ($this->session->data['payment_method']['code'] == 'hipaycc') {
            $this->load->language('extension/payment/hipaycc'); // 
            $this->load->model('checkout/order');
            $this->model_checkout_order->addOrderHistory($this->session->data['order_id'], $this->config->get('hipaycc_order_status_id'),$this->language->get('hipay_waiting'));
        }       
        $this->response->redirect($this->url->link('checkout/success'));
    }

    public function error(){
        if ($this->session->data['payment_method']['code'] == 'hipaycc') {
            $this->load->language('extension/payment/hipaycc'); // 
            $this->load->model('checkout/order');
            $this->model_checkout_order->addOrderHistory($this->session->data['order_id'], 10,$this->language->get('hipay_error'));
        }       
        $this->response->redirect($this->url->link('checkout/failure'));
    }

    public function cancel(){
        if ($this->session->data['payment_method']['code'] == 'hipaycc') {
            $this->load->language('extension/payment/hipaycc'); // 
            $this->load->model('checkout/order');
            $this->model_checkout_order->addOrderHistory($this->session->data['order_id'], $this->config->get('hipaycc_order_status_id'),$this->language->get('hipay_cancel'));                         
        }       
        $this->response->redirect($this->url->link('checkout/checkout'));
    }

    public function confirm() {
        if ($this->session->data['payment_method']['code'] == 'hipaycc') {
            $this->load->language('extension/payment/hipaycc'); // 
            $this->load->model('checkout/order');
            $this->model_checkout_order->addOrderHistory($this->session->data['order_id'], $this->config->get('hipaycc_order_status_id'),$this->language->get('hipay_pending'));
            $this->cart->clear();            
        }
    }

}
