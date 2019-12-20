<?php
/*
Hipay Wallet & Direct Extension for Opencart 2.1.x
Author: diogojosferreira@gmail.com
*/
class Controllerextensionpaymenthipaycc extends Controller {
    private $error = array(); // This is used to set the errors, if any.
 
    public function index() {
        // Loading the language file of hipaycc
        $this->load->language('extension/payment/hipaycc'); 
     
        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('setting/setting');
     
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('hipaycc', $this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');
            $this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'], 'SSL'));
        }
     
        $data['heading_title'] = $this->language->get('heading_title');
     
        $data['text_edit']    = $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_content_top'] = $this->language->get('text_content_top');
        $data['text_content_bottom'] = $this->language->get('text_content_bottom');      
        $data['text_column_left'] = $this->language->get('text_column_left');
        $data['text_column_right'] = $this->language->get('text_column_right');
     
        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_payment_status'] = $this->language->get('entry_payment_status');
        $data['entry_sort_order'] = $this->language->get('entry_sort_order');
        $data['entry_sandbox'] = $this->language->get('entry_sandbox');
     
        $data['entry_sandbox_account'] = $this->language->get('entry_sandbox_account');
        $data['entry_sandbox_website'] = $this->language->get('entry_sandbox_website');
        $data['entry_sandbox_password'] = $this->language->get('entry_sandbox_password');
        $data['entry_sandbox_shopid'] = $this->language->get('entry_sandbox_shopid');
        $data['entry_sandbox_category'] = $this->language->get('entry_sandbox_category');
        $data['entry_account'] = $this->language->get('entry_account');
        $data['entry_website'] = $this->language->get('entry_website');
        $data['entry_password'] = $this->language->get('entry_password');
        $data['entry_shopid'] = $this->language->get('entry_shopid');
        $data['entry_category'] = $this->language->get('entry_category');
        $data['entry_secret_key'] = $this->language->get('entry_secret_key');

        $data['entry_email'] = $this->language->get('entry_email');
        $data['entry_backcolor'] = $this->language->get('entry_backcolor');
        $data['entry_payment_title'] = $this->language->get('entry_payment_title');
        $data['entry_logo'] = $this->language->get('entry_logo');
        $data['entry_payment_info'] = $this->language->get('entry_payment_info');
        $data['entry_payment_currency'] = $this->language->get('entry_payment_currency');
        $data['entry_payment_rating'] = $this->language->get('entry_payment_rating');
            
        $data['error_mandatory'] = $this->language->get('error_mandatory');
        $data['hipaycc_help'] = $this->language->get('text_help');
  
        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_add_payment'] = $this->language->get('button_add_payment');
        $data['button_remove'] = $this->language->get('button_remove');
         
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }
     
     

              $data['breadcrumbs'] = array();

                $data['breadcrumbs'][] = array(
                        'text' => $this->language->get('text_home'),
                        'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
                );

                $data['breadcrumbs'][] = array(
                        'text' => $this->language->get('text_extension'),
                        'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true)
                );

                $data['breadcrumbs'][] = array(
                        'text' => $this->language->get('heading_title'),
                        'href' => $this->url->link('extension/payment/hipaycc', 'token=' . $this->session->data['token'], true)
                );

                $data['action'] = $this->url->link('extension/payment/hipaycc', 'token=' . $this->session->data['token'], 'SSL');

                $data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', 'SSL');






        if (isset($this->request->post['hipaycc_sandbox_account'])) {
            $data['hipaycc_sandbox_account'] = $this->request->post['hipaycc_sandbox_account'];
        } else {
            $data['hipaycc_sandbox_account'] = $this->config->get('hipaycc_sandbox_account');
        }   
        if (isset($this->request->post['hipaycc_sandbox_password'])) {
            $data['hipaycc_sandbox_password'] = $this->request->post['hipaycc_sandbox_password'];
        } else {
            $data['hipaycc_sandbox_password'] = $this->config->get('hipaycc_sandbox_password');
        }   
        if (isset($this->request->post['hipaycc_sandbox_website'])) {
            $data['hipaycc_sandbox_website'] = $this->request->post['hipaycc_sandbox_website'];
        } else {
            $data['hipaycc_sandbox_website'] = $this->config->get('hipaycc_sandbox_website');
        }   
        if (isset($this->request->post['hipaycc_sandbox_shopid'])) {
            $data['hipaycc_sandbox_shopid'] = $this->request->post['hipaycc_sandbox_shopid'];
        } else {
            $data['hipaycc_sandbox_shopid'] = $this->config->get('hipaycc_sandbox_shopid');
        }   
        if (isset($this->request->post['hipaycc_sandbox_category'])) {
            $data['hipaycc_sandbox_category'] = $this->request->post['hipaycc_sandbox_category'];
        } else {
            $data['hipaycc_sandbox_category'] = $this->config->get('hipaycc_sandbox_category');
        }   

        if (isset($this->request->post['hipaycc_account'])) {
            $data['hipaycc_account'] = $this->request->post['hipaycc_account'];
        } else {
            $data['hipaycc_account'] = $this->config->get('hipaycc_account');
        }   
        if (isset($this->request->post['hipaycc_password'])) {
            $data['hipaycc_password'] = $this->request->post['hipaycc_password'];
        } else {
            $data['hipaycc_password'] = $this->config->get('hipaycc_password');
        }   
        if (isset($this->request->post['hipaycc_website'])) {
            $data['hipaycc_website'] = $this->request->post['hipaycc_website'];
        } else {
            $data['hipaycc_website'] = $this->config->get('hipaycc_website');
        }   
        if (isset($this->request->post['hipaycc_shopid'])) {
            $data['hipaycc_shopid'] = $this->request->post['hipaycc_shopid'];
        } else {
            $data['hipaycc_shopid'] = $this->config->get('hipaycc_shopid');
        }   
        if (isset($this->request->post['hipaycc_category'])) {
            $data['hipaycc_category'] = $this->request->post['hipaycc_category'];
        } else {
            $data['hipaycc_category'] = $this->config->get('hipaycc_category');
        }   

        if (isset($this->request->post['hipaycc_sort_order'])) {
            $data['hipaycc_sort_order'] = $this->request->post['hipaycc_sort_order'];
        } else {
            $data['hipaycc_sort_order'] = $this->config->get('hipaycc_sort_order');
        }   
        if ( $data['hipaycc_sort_order'] == "")  $data['hipaycc_sort_order'] = 1;

        if (isset($this->request->post['hipaycc_email'])) {
            $data['hipaycc_email'] = $this->request->post['hipaycc_email'];
        } else {
            $data['hipaycc_email'] = $this->config->get('hipaycc_email');
        }   
        if (isset($this->request->post['hipaycc_payment_title'])) {
            $data['hipaycc_payment_title'] = $this->request->post['hipaycc_payment_title'];
        } else {
            $data['hipaycc_payment_title'] = $this->config->get('hipaycc_payment_title');
        }   
        if (isset($this->request->post['hipaycc_logo'])) {
            $data['hipaycc_logo'] = $this->request->post['hipaycc_logo'];
        } else {
            $data['hipaycc_logo'] = $this->config->get('hipaycc_logo');
        }   
        if (isset($this->request->post['hipaycc_payment_info'])) {
            $data['hipaycc_payment_info'] = $this->request->post['hipaycc_payment_info'];
        } else {
            $data['hipaycc_payment_info'] = $this->config->get('hipaycc_payment_info');
        }   
        if (isset($this->request->post['hipaycc_backcolor'])) {
            $data['hipaycc_backcolor'] = $this->request->post['hipaycc_backcolor'];
        } else {
            $data['hipaycc_backcolor'] = $this->config->get('hipaycc_backcolor');
        }   

        if (isset($this->request->post['hipaycc_sandbox'])) {
            $data['hipaycc_sandbox'] = $this->request->post['hipaycc_sandbox'];
        } else {
            $data['hipaycc_sandbox'] = $this->config->get('hipaycc_sandbox');
        }

        if (isset($this->request->post['hipaycc_payment_currency'])) {
            $data['hipaycc_payment_currency'] = $this->request->post['hipaycc_payment_currency'];
        } else {
            $data['hipaycc_payment_currency'] = $this->config->get('hipaycc_payment_currency');
        }

        if (isset($this->request->post['hipaycc_payment_rating'])) {
            $data['hipaycc_payment_rating'] = $this->request->post['hipaycc_payment_rating'];
        } else {
            $data['hipaycc_payment_rating'] = $this->config->get('hipaycc_payment_rating');
        }

        if (isset($this->request->post['hipaycc_order_status_id'])) {
            $data['hipaycc_order_status_id'] = $this->request->post['hipaycc_order_status_id'];
        } else {
            $data['hipaycc_order_status_id'] = $this->config->get('hipaycc_order_status_id');
        }

        if (isset($this->request->post['hipaycc_secret_key'])) {
            $data['hipaycc_secret_key'] = $this->request->post['hipaycc_secret_key'];
        } else {
            $data['hipaycc_secret_key'] = $this->config->get('hipaycc_secret_key');
        }

        $this->load->model('localisation/order_status');

        $data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();


        $data["error_mandatory_sandbox_1"] = "";
        $data["error_mandatory_sandbox_2"] = "";
        $data["error_mandatory_sandbox_3"] = "";
        $data["error_mandatory_sandbox_4"] = "";

        $data["error_mandatory_live_1"] = "";
        $data["error_mandatory_live_2"] = "";
        $data["error_mandatory_live_3"] = "";
        $data["error_mandatory_live_4"] = "";
        if (!$data['hipaycc_payment_title']) 
            $data["error_mandatory_1"] =  $data['error_mandatory'];  
        else
            $data["error_mandatory_1"] = "";

        if (!$data['hipaycc_payment_info']) 
            $data["error_mandatory_2"] =  $data['error_mandatory'];  
        else
            $data["error_mandatory_2"] = "";

        if (!$data['hipaycc_secret_key']) 
            $data["error_mandatory_3"] =  $data['error_mandatory'];  
        else
            $data["error_mandatory_3"] = "";


        if ($data['hipaycc_sandbox'] == 0){

            if (!$data['hipaycc_account']) $data["error_mandatory_live_1"] =  $data['error_mandatory'];  
            if (!$data['hipaycc_website']) $data["error_mandatory_live_2"] =  $data['error_mandatory'];  
            if (!$data['hipaycc_password']) $data["error_mandatory_live_3"] =  $data['error_mandatory'];  
            if (!$data['hipaycc_category']) $data["error_mandatory_live_4"] =  $data['error_mandatory'];  

        } else {
            if (!$data['hipaycc_sandbox_account']) $data["error_mandatory_sandbox_1"] =  $data['error_mandatory'];  
            if (!$data['hipaycc_sandbox_website']) $data["error_mandatory_sandbox_2"] =  $data['error_mandatory'];  
            if (!$data['hipaycc_sandbox_password']) $data["error_mandatory_sandbox_3"] =  $data['error_mandatory'];  
            if (!$data['hipaycc_sandbox_category']) $data["error_mandatory_sandbox_4"] =  $data['error_mandatory'];         
        }
          
        if (isset($this->request->post['hipaycc_status'])) {
            $data['hipaycc_status'] = $this->request->post['hipaycc_status'];
        } else {
            $data['hipaycc_status'] = $this->config->get('hipaycc_status');
        }
        
        $data['hipaycc_soap'] = 0;
        if (extension_loaded('soap')) {
            $data['hipaycc_soap'] = 1;
        }

        $data['hipaycc_simplexml'] = 0;
        if (extension_loaded('soap')) {
            $data['hipaycc_simplexml'] = 1;
        }

        $data['hipaycc_curl'] = 0;
        if(function_exists('curl_version')) $data['hipaycc_curl'] = 1;

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/payment/hipaycc.tpl', $data));

    }

    /* Function that validates the data when Save Button is pressed */
    protected function validate() {
 

        // Block to check the user permission to manipulate the payment
        if (!$this->user->hasPermission('modify', 'extension/payment/hipaycc')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
 

        if ($this->request->post['hipaycc_sandbox'] == 0){

            if (!$this->request->post['hipaycc_account'] || !$this->request->post['hipaycc_website'] || !$this->request->post['hipaycc_password'] || !$this->request->post['hipaycc_category']) $this->error['code'] = $this->language->get('error_mandatory');       

        } else {

            if (!$this->request->post['hipaycc_sandbox_account'] || !$this->request->post['hipaycc_sandbox_website'] || !$this->request->post['hipaycc_sandbox_password'] || !$this->request->post['hipaycc_sandbox_category']) $this->error['code'] = $this->language->get('error_mandatory');       

        }

        if (!$this->request->post['hipaycc_payment_title'] ) $this->error['code'] = $this->language->get('error_mandatory');       

           /* End Block*/
 
        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }
}
