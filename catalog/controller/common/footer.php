<?php  
class ControllerCommonFooter extends Controller {
	protected function index() {
		$this->language->load('common/footer');
		
		$this->data['text_information'] = $this->language->get('text_information');
		$this->data['text_service'] = $this->language->get('text_service');
		$this->data['text_extra'] = $this->language->get('text_extra');
		$this->data['text_contact'] = $this->language->get('text_contact');
		$this->data['text_return'] = $this->language->get('text_return');
    	$this->data['text_sitemap'] = $this->language->get('text_sitemap');
		$this->data['text_manufacturer'] = $this->language->get('text_manufacturer');
		$this->data['text_voucher'] = $this->language->get('text_voucher');
		$this->data['text_affiliate'] = $this->language->get('text_affiliate');
		$this->data['text_special'] = $this->language->get('text_special');
		$this->data['text_account'] = $this->language->get('text_account');
		$this->data['text_order'] = $this->language->get('text_order');
		$this->data['text_wishlist'] = $this->language->get('text_wishlist');
		$this->data['text_newsletter'] = $this->language->get('text_newsletter');
		
		$this->load->model('catalog/information');
		
		$this->data['informations'] = array();

		foreach ($this->model_catalog_information->getInformations() as $result) {
			if ($result['bottom']) {
				$this->data['informations'][] = array(
					'title' => $result['title'],
					'href'  => $this->url->link('information/information', 'information_id=' . $result['information_id'])
				);
			}
    	}

		$this->data['contact'] = $this->url->link('information/contact');
		$this->data['return'] = $this->url->link('account/return/insert', '', 'SSL');
    	$this->data['sitemap'] = $this->url->link('information/sitemap');
		$this->data['manufacturer'] = $this->url->link('product/manufacturer');
		$this->data['voucher'] = $this->url->link('account/voucher', '', 'SSL');
		$this->data['affiliate'] = $this->url->link('affiliate/account', '', 'SSL');
		$this->data['special'] = $this->url->link('product/special');
		$this->data['account'] = $this->url->link('account/account', '', 'SSL');
		$this->data['order'] = $this->url->link('account/order', '', 'SSL');
		$this->data['wishlist'] = $this->url->link('account/wishlist', '', 'SSL');
		$this->data['newsletter'] = $this->url->link('account/newsletter', '', 'SSL');		

		$this->data['powered'] = sprintf($this->language->get('text_powered'), $this->config->get('config_name'), date('Y', time()));
		
		// Whos Online
		if ($this->config->get('config_customer_online')) {
			$this->load->model('tool/online');
	
			if (isset($this->request->server['REMOTE_ADDR'])) {
				$ip = $this->request->server['REMOTE_ADDR'];	
			} else {
				$ip = ''; 
			}
			
			if (isset($this->request->server['HTTP_HOST']) && isset($this->request->server['REQUEST_URI'])) {
				$url = 'http://' . $this->request->server['HTTP_HOST'] . $this->request->server['REQUEST_URI'];	
			} else {
				$url = '';
			}
			
			if (isset($this->request->server['HTTP_REFERER'])) {
				$referer = $this->request->server['HTTP_REFERER'];	
			} else {
				$referer = '';
			}
						
			$this->model_tool_online->whosonline($ip, $this->customer->getId(), $url, $referer);
		}

    // Menu
    if (isset($this->request->get['path'])) {
      $parts = explode('_', (string)$this->request->get['path']);
    } else {
      $parts = array();
    }

    $this->load->model('catalog/category');

    $this->load->model('catalog/product');

    $this->data['categories'] = array();

    $categories = $this->model_catalog_category->getCategories(0);

    foreach ($categories as $category) {
      if ($category['top']) {
        $this->data['categories'][] = array(
          'name'     => $category['name'],
          'active'   => in_array($category['category_id'], $parts),
          'column'   => $category['column'] ? $category['column'] : 1,
          'href'     => $this->url->link('product/category', 'path=' . $category['category_id'])
        );
      }
    }

    $dateStart = '2015';
    if($dateStart == date('Y')) {
      $copyDate = $dateStart;
    } else {
      $copyDate = $dateStart.' — '. date('Y');
    }
     $this->data['copy'] = $copyDate;

    $this->load->model('catalog/information');

    $this->data['informations'] = array();

    foreach ($this->model_catalog_information->getInformations() as $result) {
      if ($result['main_menu']) {
        $active = null;
        if(isset($this->request->get['information_id'])){
          $parts2 = explode('_', (string)$this->request->get['information_id']);
          $active = in_array($result['information_id'], $parts2);
        }

        $this->data['informations'][] = array(
          'title' => $result['title'],
          'active' => $active,
          'href'  => $this->url->link('information/information', 'information_id=' . $result['information_id'])
        );

      }
    }
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/footer.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/common/footer.tpl';
		} else {
			$this->template = 'default/template/common/footer.tpl';
		}
		
		$this->render();
	}
}
?>