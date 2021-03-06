<?php
class ControllerModuleSpecial extends Controller {
	protected function index($setting) {
		$this->language->load('module/special');
 
      	$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['button_cart'] = $this->language->get('button_cart');
		
		$this->load->model('catalog/product');
		
		$this->load->model('tool/image');

    $this->load->helper('truncate');

		$this->data['products'] = array();
		
		$data = array(
			'sort'  => 'pd.name',
			'order' => 'ASC',
			'start' => 0,
			'limit' => $setting['limit']
		);

		$results = $this->model_catalog_product->getProductSpecials($data);

		foreach ($results as $result) {
			if ($result['image']) {
        $image = $this->model_tool_image->crop($result['image'], $setting['image_width'], $setting['image_height'], 'center',  '_latest');
      } else {
				$image = false;
			}

			if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
				$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
        if($result['unit_count'] == 1){$price = $price.'/м&#178;';}
      } else {
				$price = false;
			}
					
			if ((float)$result['special']) { 
				$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
        if($result['unit_count'] == 1){$special = $special.'/м&#178;';}
      } else {
				$special = false;
			}
			
			if ($this->config->get('config_review_status')) {
				$rating = $result['rating'];
			} else {
				$rating = false;
			}

      $attribute_groups = $this->model_catalog_product->getProductAttributes($result['product_id']);

      $attribute_data = array();
      $attribute_data['name'] = null;
      $attribute_data['text'] = null;
      if(!empty($attribute_groups)) {
        foreach($attribute_groups[0]['attribute'] as $item) {
          if($item['name'] == 'Класс') {
            $attribute_data['name'] = $item['name'];
            $attribute_data['text'] = $item['text'];
          }
        }
      }

			$this->data['products'][] = array(
				'product_id' => $result['product_id'],
				'thumb'   	 => $image,
        'name'    	 => truncate($result['name'], 40),
				'price'   	 => $price,
				'special' 	 => $special,
        'attribute_data'     => $attribute_data,
        'art'        => $result['sku'],
        'statuses'    => $result['statuses']['product'],
				'rating'     => $rating,
				'reviews'    => sprintf($this->language->get('text_reviews'), (int)$result['reviews']),
				'href'    	 => $this->url->link('product/product', 'product_id=' . $result['product_id'])
			);
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/special.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/special.tpl';
		} else {
			$this->template = 'default/template/module/special.tpl';
		}

		$this->render();
	}
}
?>