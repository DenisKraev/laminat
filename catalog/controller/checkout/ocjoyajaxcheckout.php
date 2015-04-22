<?php
class ControllerCheckoutOcjoyajaxcheckout extends Controller {
    
    public function index() {

        if(!empty($this->request->request['product_id'])) {
            $product_id = $this->request->request['product_id'];
        }

        $this->language->load('checkout/ocjoyajaxcheckout');
        $this->load->model('catalog/product');

        $this->data['text_ocjoyajaxcheckout_errorname'] = $this->language->get('text_ocjoyajaxcheckout_errorname');
        $this->data['text_ocjoyajaxcheckout_errortelephone'] = $this->language->get('text_ocjoyajaxcheckout_errortelephone');
        $this->data['text_ocjoyajaxcheckout_erroremail'] = $this->language->get('text_ocjoyajaxcheckout_erroremail');

        $this->data['text_ocjoyajaxcheckout_head'] = $this->language->get('text_ocjoyajaxcheckout_head');
        $this->data['text_ocjoyajaxcheckout_success'] = $this->language->get('text_ocjoyajaxcheckout_success');
        $this->data['text_ocjoyajaxcheckout_selectshipping'] = $this->language->get('text_ocjoyajaxcheckout_selectshipping');
        $this->data['text_ocjoyajaxcheckout_selectpayment'] = $this->language->get('text_ocjoyajaxcheckout_selectpayment');
        $this->data['text_ocjoyajaxcheckout_cancel'] = $this->language->get('text_ocjoyajaxcheckout_cancel');
        $this->data['text_ocjoyajaxcheckout_ordernow'] = $this->language->get('text_ocjoyajaxcheckout_ordernow');
        $this->data['text_ocjoyajaxcheckout_entername'] = $this->language->get('text_ocjoyajaxcheckout_entername');
        $this->data['text_ocjoyajaxcheckout_entertelephone'] = $this->language->get('text_ocjoyajaxcheckout_entertelephone');
        $this->data['text_ocjoyajaxcheckout_enteremail'] = $this->language->get('text_ocjoyajaxcheckout_enteremail');
        $this->data['text_ocjoyajaxcheckout_enterdescription'] = $this->language->get('text_ocjoyajaxcheckout_enterdescription');
        $this->data['text_ocjoyajaxcheckout_ibuy'] = $this->language->get('text_ocjoyajaxcheckout_ibuy');
        $this->data['text_ocjoyajaxcheckout_priceof'] = $this->language->get('text_ocjoyajaxcheckout_priceof');
        $this->data['text_ocjoyajaxcheckout_inanamount'] = $this->language->get('text_ocjoyajaxcheckout_inanamount');
        $this->data['text_ocjoyajaxcheckout_selectoption'] = $this->language->get('text_ocjoyajaxcheckout_selectoption');
        $this->data['text_ocjoyajaxcheckout_loading'] = $this->language->get('text_ocjoyajaxcheckout_loading');

        $this->data['hideimg'] = $this->config->get('config_type_hideimg');
        $this->data['hidefio'] = $this->config->get('config_type_hidefio');
        $this->data['hideemail'] = $this->config->get('config_type_hideemail');
        $this->data['hidetelephone'] = $this->config->get('config_type_hidetelephone');
        $this->data['hidedescription'] = $this->config->get('config_type_hidedescription');
        $this->data['hideshipping'] = $this->config->get('config_type_hideshipping');
        $this->data['hidepayment'] = $this->config->get('config_type_hidepayment');
        $this->data['hideoptions'] = $this->config->get('config_type_hideoptions');
        $this->data['info_shipping_text'] = $this->config->get('config_info_shipping_text');
        $this->data['info_payment_text'] = $this->config->get('config_info_payment_text');
        $this->data['mask_telephone'] = $this->config->get('config_mask_telephone');
        $this->data['config_info_shipping'] = $this->config->get('config_info_shipping');
        $this->data['config_info_payment'] = $this->config->get('config_info_payment');

        $this->data['required_fio'] = $this->config->get('config_required_fio');
        $this->data['required_email'] = $this->config->get('config_required_email');
        $this->data['required_telephone'] = $this->config->get('config_required_telephone');

        $product_info = $this->model_catalog_product->getProduct($product_id);
        $this->data['product_id'] = $product_id;
        $this->data['product_info'] = $product_info;

        if ($product_info['quantity'] <= 0) {
            $this->data['stock'] = $product_info['stock_status'];
        } elseif ($this->config->get('config_stock_display')) {
            $this->data['stock'] = $product_info['quantity'];
        } else {
            $this->data['stock'] = $this->language->get('text_instock');
        }

        $this->load->model('tool/image');

        if ($product_info['image']) {
            $this->data['thumb'] = $this->model_tool_image->crop($product_info['image'], 75, 75, 'center', '_one_click');
        } else {
            $this->data['thumb'] = $this->model_tool_image->crop("no_image.jpg", 75, 75, 'center', '_one_click');
        }

        $this->data['images'] = array();

        $results = $this->model_catalog_product->getProductImages($product_id);

        foreach ($results as $result) {
            $this->data['images'][] = array(
                'popup' => $this->model_tool_image->resize($result['image'], 228, 228),
                'thumb' => $this->model_tool_image->resize($result['image'], 74, 74)
            );
        }

        if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
            $this->data['price'] = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
        } else {
            $this->data['price'] = false;
        }

        if ((float)$product_info['special']) {
            $this->data['special'] = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')));
        } else {
            $this->data['special'] = false;
        }

        if ($this->config->get('config_tax')) {
            $this->data['tax'] = $this->currency->format((float)$product_info['special'] ? $product_info['special'] : $product_info['price']);
        } else {
            $this->data['tax'] = false;
        }

        $discounts = $this->model_catalog_product->getProductDiscounts($product_id);
        $this->data['discounts'] = array();

        foreach ($discounts as $discount) {
            $this->data['discounts'][] = array(
                'quantity' => $discount['quantity'],
                'price'    => $this->currency->format($this->tax->calculate($discount['price'], $product_info['tax_class_id'], $this->config->get('config_tax')))
            );
        }

       $this->data['options'] = array();

        foreach ($this->model_catalog_product->getProductOptions($product_id) as $option) {
            if ($option['type'] == 'select' || $option['type'] == 'radio' || $option['type'] == 'checkbox' || $option['type'] == 'image') {
                $option_value_data = array();

                foreach ($option['option_value'] as $option_value) {
                    if (!$option_value['subtract'] || ($option_value['quantity'] > 0)) {
                        if ((($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) && (float)$option_value['price']) {
                            $price = $this->currency->format($this->tax->calculate($option_value['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
                        } else {
                            $price = false;
                        }

                        $option_value_data[] = array(
                            'product_option_value_id' => $option_value['product_option_value_id'],
                            'option_value_id'         => $option_value['option_value_id'],
                            'name'                    => $option_value['name'],
                            'image'                   => $this->model_tool_image->resize($option_value['image'], 50, 50),
                            'price'                   => $price,
                            'price_prefix'            => $option_value['price_prefix']
                        );
                    }
                }

                $this->data['options'][] = array(
                    'product_option_id' => $option['product_option_id'],
                    'option_id'         => $option['option_id'],
                    'name'              => $option['name'],
                    'type'              => $option['type'],
                    'option_value'      => $option_value_data,
                    'required'          => $option['required']
                );

            } elseif ($option['type'] == 'text' || $option['type'] == 'textarea' || $option['type'] == 'file' || $option['type'] == 'date' || $option['type'] == 'datetime' || $option['type'] == 'time') {
                $this->data['options'][] = array(
                    'product_option_id' => $option['product_option_id'],
                    'option_id'         => $option['option_id'],
                    'name'              => $option['name'],
                    'type'              => $option['type'],
                    'option_value'      => $option['option_value'],
                    'required'          => $option['required']
                );
            }
        }

        if ($product_info['minimum']) {
            $this->data['minimum'] = $product_info['minimum'];
        } else {
            $this->data['minimum'] = 1;
        }

        $this->data['heading_title'] = $product_info['name'];

        $this->data['art'] = $product_info['sku'];

        $attribute_groups = $this->model_catalog_product->getProductAttributes($product_id);

        $attribute_data = array();
        $attribute_data['name'] = null;
        $attribute_data['text'] = null;
        if(!empty($attribute_groups)) {
          foreach($attribute_groups[0]['attribute'] as $item) {
            if($item['name'] == 'Класс') {
              $this->data['attribute_data_name'] = $item['name'];
              $this->data['attribute_data_text'] = $item['text'];
            }
          }
        }

        $quote_data = array();
        $this->load->model('setting/extension');
        $results = $this->model_setting_extension->getExtensions('shipping');

        foreach ($results as $result) {
            if ($this->config->get($result['code'] . '_status')) {
                $this->load->model('shipping/' . $result['code']);

                $quote = $this->{'model_shipping_' . $result['code']}->getQuote('1');

                if ($quote) {
                    $quote_data[$result['code']] = array(
                        'code'      => $result['code'],
                        'title'      => $quote['title'],
                        'quote'      => $quote['quote'],
                        'sort_order' => $quote['sort_order'],
                        'error'      => $quote['error']
                    );
                }
            }
        }

        $sort_order = array();

        foreach ($quote_data as $key => $value) {
            $sort_order[$key] = $value['sort_order'];
        }

        array_multisort($sort_order, SORT_ASC, $quote_data);
        $this->session->data['shipping_methods'] = $quote_data;
        $method_data = array();
        $this->load->model('setting/extension');
        $results = $this->model_setting_extension->getExtensions('payment');

        foreach ($results as $result) {

            if ($this->config->get($result['code'] . '_status')) {
                $this->load->model('payment/' . $result['code']);
                $method = $this->{'model_payment_' . $result['code']}->getMethod(true,true);
                if ($method) {
                    $method_data[$result['code']] = $method;
                }
            }
        }

        $sort_order = array();

        foreach ($method_data as $key => $value) {
            $sort_order[$key] = $value['sort_order'];
        }

        $this->session->data['payment_methods'] = $method_data;

        if (isset($this->session->data['shipping_methods'])) {
            $this->data['shipping_methods'] = $this->session->data['shipping_methods'];
        } else {
            $this->data['shipping_methods'] = array();
        }

        if (isset($this->session->data['payment_methods'])) {
            $this->data['payment_methods'] = $this->session->data['payment_methods'];
        } else {
            $this->data['payment_methods'] = array();
        }

        $this->template = 'default/template/checkout/ocjoyajaxcheckout.tpl';
        $this->response->setOutput($this->render());
    }

    protected function ukeygen() {
        $str = str_split(DIR_SYSTEM.':'.$_SERVER['SERVER_NAME']);
        $ukey = '';
        foreach ($str as $chr){
            $ukey = md5($chr.$ukey.$chr.'ch');
        }
        return $ukey;
    }

    public function simpleorder() {
        
        $this->language->load('checkout/ocjoyajaxcheckout');

        $this->data['text_ocjoyajaxcheckout_errorname'] = $this->language->get('text_ocjoyajaxcheckout_errorname');
        $this->data['text_ocjoyajaxcheckout_errortelephone'] = $this->language->get('text_ocjoyajaxcheckout_errortelephone');
        $this->data['text_ocjoyajaxcheckout_erroremail'] = $this->language->get('text_ocjoyajaxcheckout_erroremail');

        $order = $this->request->post;
        $order_products = array();

        if (isset($this->request->post['product_id'])) {
            $product_id = $this->request->post['product_id'];
        }

        if (isset($this->request->post['option'])) {
            $option = $this->request->post['option'];
        } else {
            $option = array();
        }

        if (isset($this->request->post['quantity'])) {
            $quantity = $this->request->post['quantity'];
        }

        if (!$option) {
            $key = (int)$product_id;
        } else {
            $key = (int)$product_id . ':' . base64_encode(serialize($option));
        }

        $cart_products = $this->cart->getProducts();

        if (isset($cart_products[$key])) {
            $this->cart->remove($key);
        }

        $oldcart = $this->session->data['cart'];
        unset($this->session->data['cart']);

        $json = array();

        $this->cart->add($product_id,$quantity,$option);
         
        $products = $this->cart->getProducts();
        if (isset($products[$key])) {
          $product = $products[$key];
        }

        if (isset($product['option'])) {
            $opts = array();
            foreach ($product['option'] as $k=> $opt) {
                $opts[$k] = $opt;
                $opts[$k]['value'] = $opts[$k]['option_value'];
            }


            $product['option'] = $opts;
        }

      print_r($product['option']);

        $this->load->model('catalog/product');  
        $product_info = $this->model_catalog_product->getProduct($product_id);

        $order['http_user_agent'] = $this->request->server['HTTP_USER_AGENT'];
        $order['currency_code'] = $this->session->data['currency'];
        $order['currency_id'] = $this->currency->getId();
        $order['currency_value'] = $this->currency->getValue();
        $order['config_language_id'] = $this->config->get('config_language_id');

        if (isset($order['shipping_method'])) {
            $shipping_method = $order['shipping_method'];
            if(isset($this->session->data['shipping_methods'][$shipping_method]['quote'][$shipping_method]))  {
                $this->session->data['shipping_method']=$this->session->data['shipping_methods'][$shipping_method]['quote'][$shipping_method];
            }
        } else {
            $shipping_method = '';
        }
            
        $product['tax'] = $this->tax->getTax($product['price'], $product['tax_class_id']);
        $order_products[] = $product;
             
        $this->load->model('total/total');
        $this->load->model('setting/extension');
        
        $total_data = array();                  
        $total = 0;
        $taxes = $this->cart->getTaxes();
        
        if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
            $sort_order = array(); 
            
            $results = $this->model_setting_extension->getExtensions('total');
            
            foreach ($results as $key => $value) {
                $sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
            }
            
            array_multisort($sort_order, SORT_ASC, $results);
            
            foreach ($results as $result) {
                if ($this->config->get($result['code'] . '_status')) {
                    $this->load->model('total/' . $result['code']);
        
                    $this->{'model_total_' . $result['code']}->getTotal($total_data, $total, $taxes);
                }
                
                $sort_order = array(); 
              
                foreach ($total_data as $key => $value) {
                    $sort_order[$key] = $value['sort_order'];
                }

                array_multisort($sort_order, SORT_ASC, $total_data);            
            }
        }

        $total_end = end($total_data);
        $total_end = $total_end['value'];

        if (isset($order['shipping_method'])) {
            $shipping_method = $order['shipping_method'];
        } else {
            $shipping_method = '';
        }

        if (isset($order['payment_method'])) {
            $payment_method = $order['payment_method'];
        } else {
            $payment_method = '';
        }

        if (isset($order['firstname'])) {
            $firstname = $order['firstname'];
        } else {
            $firstname = '';
        }

        if (isset($order['telephone'])) {
            $telephone = $order['telephone'];
        } else {
            $telephone = '';
        }
        
        if (isset($order['description'])) {
            $description = $order['description'];
        } else {
            $description = '';
        }

        if ($this->config->get('config_required_email') == 1) {
            if (isset($order['email'])) {
                $orderemail = $order['email'];
            } else {
                $orderemail = 'nomail@nomail.com';
            }
        } else {
            $orderemail = 'nomail@nomail.com';
        }


        if ($this->config->get('config_type_hidefio') == 1) {
            if ($this->config->get('config_required_fio') == 1) {
                if ($firstname == null || $firstname == '') {
                    $json['error']['firstname'] = $this->data['text_ocjoyajaxcheckout_errorname'];
                }
            }
        }

        if ($this->config->get('config_type_hideemail') == 1) {
            if ($this->config->get('config_required_email') == 1) {

                if(!filter_var($orderemail, FILTER_VALIDATE_EMAIL)) {
                  $validemail = FALSE;
                } else {
                  $validemail = TRUE;
                }

                if ($orderemail == null || $orderemail == '' || $validemail == FALSE) {
                    $json['error']['email'] = $this->data['text_ocjoyajaxcheckout_erroremail'];
                }
            }
        }


        if ($this->config->get('config_type_hidetelephone') == 1) {
            if ($this->config->get('config_required_telephone') == 1) {
                if ($telephone == null || $telephone == '') {
                    $json['error']['telephone'] =  $this->data['text_ocjoyajaxcheckout_errortelephone'];
                }
            }
        }

        if (!isset($json['error'])) {

        $data = array (
            'customer_id' => '',
            'customer_group_id' => '1',
            'firstname' => $firstname,
            'lastname' => '',
            'email' => $orderemail,
            'telephone' => $telephone,
            'fax' => '',
            'shipping_firstname' => $firstname,
            'shipping_lastname' => '',
            'shipping_company' => '',
            'shipping_address_1' => '',
            'shipping_address_2' => '',
            'shipping_city' => '',
            'shipping_postcode' => '',
            'shipping_country' => '',
            'shipping_country_id' => '',
            'shipping_zone_id' => '',
            'shipping_zone' => 0,
            'shipping_address_format' => '',
            'shipping_method' => $shipping_method,
            'payment_method' => $payment_method,
            'payment_firstname' => $firstname,
            'payment_lastname' => '',
            'payment_company' => '',
            'payment_address_1' => '',
            'payment_company_id' => '',
            'payment_tax_id' => '',
            'payment_code' => '',
            'shipping_code' => '',
            'forwarded_ip' => '',
            'user_agent' => $order['http_user_agent'],
            'accept_language' => '',
            'vouchers' => array(),
            'payment_address_2' => '',
            'payment_city' => '',
            'payment_postcode' => '',
            'payment_country' => '',
            'payment_country_id' => '',
            'payment_zone' => '',
            'payment_zone_id' => '',
            'payment_address_format' => '',
            'comment' => $description,
            'total' => $total_end,
            'reward' => '',
            'affiliate_id' => null,
            'commission' => 0,
            'language_id' => $order['config_language_id'],
            'currency_id' => $order['currency_id'],
            'currency_code' => $order['currency_code'],
            'currency_value' => $order['currency_value'],
            'ip' => $_SERVER["REMOTE_ADDR"],
            'products' => $order_products,
            'totals' => $total_data,
        );

        $data['invoice_prefix'] = $this->config->get('config_invoice_prefix');
        $data['store_id'] = $this->config->get('config_store_id');
        $data['store_name'] = $this->config->get('config_name');

        if ($data['store_id']) {
            $data['store_url'] = $this->config->get('config_url');      
        } else {
            $data['store_url'] = HTTP_SERVER;
        }

        $this->load->model('checkout/order');
        $this->language->load('checkout/checkout');
      
        $this->data['text_ocjoyajaxcheckout_success'] = $this->language->get('text_ocjoyajaxcheckout_success');
        $this->data['text_ocjoyajaxcheckout_error'] = $this->language->get('text_ocjoyajaxcheckout_error');
        $this->data['text_ocjoyajaxcheckout_continue'] = $this->language->get('text_ocjoyajaxcheckout_continue');

        $product_id = $this->model_checkout_order->addOrder($data);

        $this->model_checkout_order->confirm($product_id,1);
        $this->session->data['cart'] = $oldcart;
        
        $json['output'] = $this->data['text_ocjoyajaxcheckout_success'].'<br/><br/>'.'<a onclick="$.colorbox.close();">'.$this->data['text_ocjoyajaxcheckout_continue'].'</a>';
                
        }
            
        $this->response->setOutput(json_encode($json));

    }
	
    public function calc() {
        if ((isset($this->request->request['product_id'])) && (isset($this->request->request['quantity']))) {
            $this->load->model('catalog/product');
            $product_id = $this->request->request['product_id'];
            $qt = $this->request->request['quantity'];
            $product_info = $this->model_catalog_product->getProduct($product_id);

            $option = array();
            $option_price = 0;
            if(!empty($this->request->request['option'])) $option=$this->request->request['option'];
            $product_info = $this->model_catalog_product->getProduct($product_id);

            $po = $this->model_catalog_product->getProductOptions($product_id);

            foreach ($po as $so) {
                if (is_array($so['option_value'])) {
                    foreach ($so['option_value'] as $ov) {
                        if(isset($option[$so['product_option_id']])) {
                            if(($option[$so['product_option_id']]==$ov['product_option_value_id']) OR ( (is_array($option[$so['product_option_id']])) && (in_array($ov['product_option_value_id'],$option[$so['product_option_id']])))) {
                                if ($ov['price_prefix'] == '+') {  $option_price += $ov['price']; } elseif ($ov['price_prefix'] == '-') { $option_price -= $ov['price']; }
                            }
                        }
                    }
                }
            }

            $json = array();
            $json['price'] = $this->currency->format($this->tax->calculate(($product_info['price']+$option_price)*$qt, $product_info['tax_class_id'], $this->config->get('config_tax')));
            $json['special'] = $this->currency->format($this->tax->calculate(($product_info['special']+$option_price)*$qt, $product_info['tax_class_id'], $this->config->get('config_tax')));

            $this->response->setOutput(json_encode($json));
        }
    }
}
?>