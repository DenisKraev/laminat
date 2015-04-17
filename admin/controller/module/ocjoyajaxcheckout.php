<?php
class ControllerModuleOcjoyajaxcheckout extends Controller {
	private $error = array(); 
	public function index() {   

		$this->load->language('module/ocjoyajaxcheckout');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {			
			$this->model_setting_setting->editSetting('ocjoyajaxcheckout', $this->request->post);	
			$this->session->data['success'] = $this->language->get('text_success');
			$this->redirect($this->url->link('module/ocjoyajaxcheckout', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_main_tab_setting'] = $this->language->get('text_main_tab_setting');
    $this->data['text_fields_tab_setting'] = $this->language->get('text_fields_tab_setting');
    $this->data['text_position_tab_setting'] = $this->language->get('text_position_tab_setting');
    $this->data['text_ocjoyajaxcheckout_yes'] = $this->language->get('text_ocjoyajaxcheckout_yes');
    $this->data['text_ocjoyajaxcheckout_no'] = $this->language->get('text_ocjoyajaxcheckout_no');
    $this->data['text_ocjoyajaxcheckout_required'] = $this->language->get('text_ocjoyajaxcheckout_required'); 
    $this->data['text_ocjoyajaxcheckout_hideimg'] = $this->language->get('text_ocjoyajaxcheckout_hideimg');
    $this->data['text_ocjoyajaxcheckout_hidefio'] = $this->language->get('text_ocjoyajaxcheckout_hidefio');
    $this->data['text_ocjoyajaxcheckout_hideemail'] = $this->language->get('text_ocjoyajaxcheckout_hideemail');
    $this->data['text_ocjoyajaxcheckout_hidetelephone'] = $this->language->get('text_ocjoyajaxcheckout_hidetelephone');
    $this->data['text_ocjoyajaxcheckout_hideshipping'] = $this->language->get('text_ocjoyajaxcheckout_hideshipping');
    $this->data['text_ocjoyajaxcheckout_hidepayment'] = $this->language->get('text_ocjoyajaxcheckout_hidepayment');
    $this->data['text_ocjoyajaxcheckout_hideoptions'] = $this->language->get('text_ocjoyajaxcheckout_hideoptions');
    $this->data['text_ocjoyajaxcheckout_hidedescription'] = $this->language->get('text_ocjoyajaxcheckout_hidedescription');
    $this->data['text_ocjoyajaxcheckout_makeachoice'] = $this->language->get('text_ocjoyajaxcheckout_makeachoice');
    $this->data['text_mask_telephone'] = $this->language->get('text_mask_telephone');
    $this->data['text_show_on_category'] = $this->language->get('text_show_on_category');
    $this->data['text_show_on_brands']   = $this->language->get('text_show_on_brands');
    $this->data['text_show_on_search']   = $this->language->get('text_show_on_search');
    $this->data['text_show_on_specials'] = $this->language->get('text_show_on_specials');
    $this->data['text_show_on_product'] = $this->language->get('text_show_on_product');
    $this->data['text_show_on_module_latest'] = $this->language->get('text_show_on_module_latest');
    $this->data['text_show_on_module_special'] = $this->language->get('text_show_on_module_special');
    $this->data['text_show_on_module_featured'] = $this->language->get('text_show_on_module_featured');
    $this->data['text_show_on_module_bestseller'] = $this->language->get('text_show_on_module_bestseller');
    $this->data['text_activationtext'] = $this->language->get('text_activationtext');
    $this->data['text_onlytext'] = $this->language->get('text_onlytext');
    $this->data['text_info_fio'] = $this->language->get('text_info_fio');
    $this->data['text_info_email'] = $this->language->get('text_info_email');
    $this->data['text_info_telephone'] = $this->language->get('text_info_telephone');
    $this->data['text_info_shipping'] = $this->language->get('text_info_shipping');
    $this->data['text_info_payment'] = $this->language->get('text_info_payment');
 		$this->data['text_copyright'] = $this->language->get('text_copyright');
    $this->data['text_licence'] = $this->language->get('text_licence');
    $this->data['text_module'] = $this->language->get('text_module');
		$this->data['text_activationcode'] = $this->language->get('text_activationcode');
    $this->data['text_youruidcode'] = $this->language->get('text_youruidcode');

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		$this->data['breadcrumbs'] = array();
 		$this->data['breadcrumbs'][] = array(
     		'text'      => $this->language->get('text_home'),
		'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
    		'separator' => false
 		);
 		$this->data['breadcrumbs'][] = array(
     		'text'      => $this->language->get('text_module'),
		'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
    		'separator' => ' :: '
 		);
 		$this->data['breadcrumbs'][] = array(
     		'text'      => $this->language->get('heading_title'),
		'href'      => $this->url->link('module/ocjoyajaxcheckout', 'token=' . $this->session->data['token'], 'SSL'),
    		'separator' => ' :: '
 		);
		
		$this->data['action'] = $this->url->link('module/ocjoyajaxcheckout', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		if (isset($this->request->post['config_mask_telephone'])) {
      $this->data['config_mask_telephone'] = $this->request->post['config_mask_telephone'];
    } else {
      $this->data['config_mask_telephone'] = $this->config->get('config_mask_telephone');
    }
    if (isset($this->request->post['config_type_hideimg'])) {
      $this->data['config_type_hideimg'] = $this->request->post['config_type_hideimg'];
    } else {
      $this->data['config_type_hideimg'] = $this->config->get('config_type_hideimg');
    }
    if (isset($this->request->post['config_type_hidefio'])) {
      $this->data['config_type_hidefio'] = $this->request->post['config_type_hidefio'];
    } else {
      $this->data['config_type_hidefio'] = $this->config->get('config_type_hidefio');
    }
    if (isset($this->request->post['config_type_hideemail'])) {
      $this->data['config_type_hideemail'] = $this->request->post['config_type_hideemail'];
    } else {
      $this->data['config_type_hideemail'] = $this->config->get('config_type_hideemail');
    }
    if (isset($this->request->post['config_type_hidetelephone'])) {
      $this->data['config_type_hidetelephone'] = $this->request->post['config_type_hidetelephone'];
    } else {
      $this->data['config_type_hidetelephone'] = $this->config->get('config_type_hidetelephone');
    }
    if (isset($this->request->post['config_type_hideshipping'])) {
      $this->data['config_type_hideshipping'] = $this->request->post['config_type_hideshipping'];
    } else {
      $this->data['config_type_hideshipping'] = $this->config->get('config_type_hideshipping');
    }
    if (isset($this->request->post['config_type_hidepayment'])) {
      $this->data['config_type_hidepayment'] = $this->request->post['config_type_hidepayment'];
    } else {
      $this->data['config_type_hidepayment'] = $this->config->get('config_type_hidepayment');
    }
    if (isset($this->request->post['config_type_hideoptions'])) {
      $this->data['config_type_hideoptions'] = $this->request->post['config_type_hideoptions'];
    } else {
      $this->data['config_type_hideoptions'] = $this->config->get('config_type_hideoptions');
    }
    if (isset($this->request->post['config_type_hidedescription'])) {
      $this->data['config_type_hidedescription'] = $this->request->post['config_type_hidedescription'];
    } else {
      $this->data['config_type_hidedescription'] = $this->config->get('config_type_hidedescription');
    }
    if (isset($this->request->post['config_activate_ajaxcart'])) {
      $this->data['config_activate_ajaxcart'] = $this->request->post['config_activate_ajaxcart'];
    } else {
      $this->data['config_activate_ajaxcart'] = $this->config->get('config_activate_ajaxcart');
    }
    if (isset($this->request->post['config_show_on_category'])) {
      $this->data['config_show_on_category'] = $this->request->post['config_show_on_category'];
    } else {
      $this->data['config_show_on_category'] = $this->config->get('config_show_on_category');
    }
    if (isset($this->request->post['config_show_on_brands'])) {
      $this->data['config_show_on_brands'] = $this->request->post['config_show_on_brands'];
    } else {
      $this->data['config_show_on_brands'] = $this->config->get('config_show_on_brands');
    }
    if (isset($this->request->post['config_show_on_search'])) {
      $this->data['config_show_on_search'] = $this->request->post['config_show_on_search'];
    } else {
      $this->data['config_show_on_search'] = $this->config->get('config_show_on_search');
    }
    if (isset($this->request->post['config_show_on_specials'])) {
      $this->data['config_show_on_specials'] = $this->request->post['config_show_on_specials'];
    } else {
      $this->data['config_show_on_specials'] = $this->config->get('config_show_on_specials');
    }
    if (isset($this->request->post['config_show_on_product'])) {
      $this->data['config_show_on_product'] = $this->request->post['config_show_on_product'];
    } else {
      $this->data['config_show_on_product'] = $this->config->get('config_show_on_product');
    }
    if (isset($this->request->post['config_show_on_module_latest'])) {
      $this->data['config_show_on_module_latest'] = $this->request->post['config_show_on_module_latest'];
    } else {
      $this->data['config_show_on_module_latest'] = $this->config->get('config_show_on_module_latest');
    }
    if (isset($this->request->post['config_show_on_module_special'])) {
      $this->data['config_show_on_module_special'] = $this->request->post['config_show_on_module_special'];
    } else {
      $this->data['config_show_on_module_special'] = $this->config->get('config_show_on_module_special');
    }
    if (isset($this->request->post['config_show_on_module_featured'])) {
      $this->data['config_show_on_module_featured'] = $this->request->post['config_show_on_module_featured'];
    } else {
      $this->data['config_show_on_module_featured'] = $this->config->get('config_show_on_module_featured');
    }
    if (isset($this->request->post['config_show_on_module_bestseller'])) {
      $this->data['config_show_on_module_bestseller'] = $this->request->post['config_show_on_module_bestseller'];
    } else {
      $this->data['config_show_on_module_bestseller'] = $this->config->get('config_show_on_module_bestseller');
    }
    if (isset($this->request->post['config_info_shipping'])) {
      $this->data['config_info_shipping'] = $this->request->post['config_info_shipping'];
    } else {
      $this->data['config_info_shipping'] = $this->config->get('config_info_shipping');
    }
    if (isset($this->request->post['config_info_payment'])) {
      $this->data['config_info_payment'] = $this->request->post['config_info_payment'];
    } else {
      $this->data['config_info_payment'] = $this->config->get('config_info_payment');
    }
    if (isset($this->request->post['config_info_shipping_text'])) {
      $this->data['config_info_shipping_text'] = $this->request->post['config_info_shipping_text'];
    } else {
      $this->data['config_info_shipping_text'] = $this->config->get('config_info_shipping_text');
    }
    if (isset($this->request->post['config_info_payment_text'])) {
      $this->data['config_info_payment_text'] = $this->request->post['config_info_payment_text'];
    } else {
      $this->data['config_info_payment_text'] = $this->config->get('config_info_payment_text');
    }
    if (isset($this->request->post['config_required_fio'])) {
      $this->data['config_required_fio'] = $this->request->post['config_required_fio'];
    } else {
      $this->data['config_required_fio'] = $this->config->get('config_required_fio');
    }
    if (isset($this->request->post['config_required_email'])) {
      $this->data['config_required_email'] = $this->request->post['config_required_email'];
    } else {
      $this->data['config_required_email'] = $this->config->get('config_required_email');
    }
    if (isset($this->request->post['config_required_telephone'])) {
      $this->data['config_required_telephone'] = $this->request->post['config_required_telephone'];
    } else {
      $this->data['config_required_telephone'] = $this->config->get('config_required_telephone');
    }
    if (isset($this->request->post['config_ukey_ch'])) {
      $this->data['config_ukey_ch'] = $this->request->post['config_ukey_ch'];
    } else {
      $this->data['config_ukey_ch'] = $this->config->get('config_ukey_ch');
    }
    $this->data['UID'] = base64_encode(DIR_SYSTEM.':'.$_SERVER['SERVER_NAME']);

		$this->template = 'module/ocjoyajaxcheckout.tpl';

		$this->children = array(
			'common/header',
			'common/footer'
		);		

		$this->response->setOutput($this->render());
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/ocjoyajaxcheckout')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}
?>