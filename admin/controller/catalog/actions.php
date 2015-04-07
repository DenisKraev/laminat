<?php
class ControllerCatalogActions extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('catalog/actions');

		$this->document->setTitle($this->language->get('heading_title_normal'));

		$this->load->model('catalog/actions');

		$this->getList();
	}

	public function insert() {
		$this->load->language('catalog/actions');

		$this->document->setTitle($this->language->get('heading_title_normal'));

		$this->load->model('catalog/actions');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_actions->addActions($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = (isset($this->request->get['sort'])) ? '&sort=' . $this->request->get['sort'] : '';
			$url .= (isset($this->request->get['order'])) ? '&order=' . $this->request->get['order'] : '';
			$url .= (isset($this->request->get['page'])) ? '&page=' . $this->request->get['page'] : '';

			$this->redirect($this->url->link('catalog/actions', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function update() {
		$this->load->language('catalog/actions');

		$this->document->setTitle($this->language->get('heading_title_normal'));

		$this->load->model('catalog/actions');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_actions->editActions($this->request->get['actions_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = (isset($this->request->get['sort'])) ? '&sort=' . $this->request->get['sort'] : '';
			$url .= (isset($this->request->get['order'])) ? '&order=' . $this->request->get['order'] : '';
			$url .= (isset($this->request->get['page'])) ? '&page=' . $this->request->get['page'] : '';

			$this->redirect($this->url->link('catalog/actions', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function setting() {
		$this->load->language('catalog/actions');

		$this->document->setTitle($this->language->get('heading_title_normal'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validatePermission()) {

			$this->model_setting_setting->editSetting('actions_setting', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success_setting');

			$url = (isset($this->request->get['sort'])) ? '&sort=' . $this->request->get['sort'] : '';
			$url .= (isset($this->request->get['order'])) ? '&order=' . $this->request->get['order'] : '';
			$url .= (isset($this->request->get['page'])) ? '&page=' . $this->request->get['page'] : '';

			$this->redirect($this->url->link('catalog/actions', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		/* Show Setting Form */
		$this->getFormSetting();
	}

	public function delete() {
		$this->load->language('catalog/actions');

		$this->document->setTitle($this->language->get('heading_title_normal'));

		$this->load->model('catalog/actions');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $actions_id) {
				$this->model_catalog_actions->deleteActions($actions_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = (isset($this->request->get['sort'])) ? '&sort=' . $this->request->get['sort'] : '';
			$url .= (isset($this->request->get['order'])) ? '&order=' . $this->request->get['order'] : '';
			$url .= (isset($this->request->get['page'])) ? '&page=' . $this->request->get['page'] : '';

			$this->redirect($this->url->link('catalog/actions', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	private function getList() {
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'n.date_start';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'DESC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = (isset($this->request->get['sort'])) ? '&sort=' . $this->request->get['sort'] : '';
		$url .= (isset($this->request->get['order'])) ? '&order=' . $this->request->get['order'] : '';
		$url .= (isset($this->request->get['page'])) ? '&page=' . $this->request->get['page'] : '';

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array('text' => $this->language->get('text_home'), 'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'), 'separator' => false);

		$this->data['breadcrumbs'][] = array('text' => $this->language->get('heading_title'), 'href' => $this->url->link('catalog/actions', 'token=' . $this->session->data['token'] . $url, 'SSL'), 'separator' => ' :: ');

		$this->data['insert'] = $this->url->link('catalog/actions/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['delete'] = $this->url->link('catalog/actions/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['setting'] = $this->url->link('catalog/actions/setting', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$this->data['actionss'] = array();

		$data = array('sort' => $sort, 'order' => $order, 'start' => ($page - 1) * $this->config->get('config_admin_limit'), 'limit' => $this->config->get('config_admin_limit'));

		$actions_total = $this->model_catalog_actions->getTotalActionss();

		$results = $this->model_catalog_actions->getActionss($data);

		foreach ($results as $result) {
			$action = array();
			$action[] = array('text' => $this->language->get('text_edit'), 'href' => $this->url->link('catalog/actions/update', 'token=' . $this->session->data['token'] . '&actions_id=' . $result['actions_id'] . $url, 'SSL'));

			$this->data['actionss'][] = array(
			'actions_id' => $result['actions_id'], 
			'caption' => $result['caption'],
			'date_start' => date("d-m-Y H:i", $result['date_start']), 
			'date_end' => date("d-m-Y H:i", $result['date_end']),
			'status' => $result['status'], 
			'selected' => isset($this->request->post['selected']) && in_array($result['actions_id'], $this->request->post['selected']), 
			'action' => $action
			);
		}

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_no_results'] = $this->language->get('text_no_results');

		$this->data['column_caption'] = $this->language->get('column_caption');
		$this->data['column_date_start'] = $this->language->get('column_date_start');
		$this->data['column_date_end'] = $this->language->get('column_date_end');
		$this->data['column_action'] = $this->language->get('column_action');
		$this->data['column_status'] = $this->language->get('column_status');

		$this->data['button_insert'] = $this->language->get('button_insert');
		$this->data['button_delete'] = $this->language->get('button_delete');
		$this->data['button_setting'] = $this->language->get('button_setting');

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}

		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$this->data['sort_caption'] = $this->url->link('catalog/actions', 'token=' . $this->session->data['token'] . '&sort=nd.caption' . $url, 'SSL');
		$this->data['sort_date_start'] = $this->url->link('catalog/actions', 'token=' . $this->session->data['token'] . '&sort=n.date_start' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $actions_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('catalog/actions', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$this->data['pagination'] = $pagination->render();

		$this->data['sort'] = $sort;
		$this->data['order'] = $order;

		$this->template = 'catalog/actions_list.tpl';
		$this->children = array('common/header', 'common/footer', );

		$this->response->setOutput($this->render());
	}

	private function getForm() {
		$this->setDatepickerLanguage();

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_default'] = $this->language->get('text_default');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_browse'] = $this->language->get('text_browse');
		$this->data['text_clear'] = $this->language->get('text_clear');
		$this->data['text_image_manager'] = $this->language->get('text_image_manager');

		$this->data['text_fancybox'] = $this->language->get('text_fancybox');
		$this->data['text_colorbox'] = $this->language->get('text_colorbox');

		$this->data['entry_title'] = $this->language->get('entry_title');
		$this->data['entry_h1'] = $this->language->get('entry_h1');
		$this->data['entry_caption'] = $this->language->get('entry_caption');
		$this->data['entry_meta_keywords'] = $this->language->get('entry_meta_keywords');
		$this->data['entry_meta_description'] = $this->language->get('entry_meta_description');
		$this->data['entry_anonnce'] = $this->language->get('entry_anonnce');
		$this->data['entry_description'] = $this->language->get('entry_description');
		$this->data['entry_store'] = $this->language->get('entry_store');
		$this->data['entry_keyword'] = $this->language->get('entry_keyword');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_fancybox'] = $this->language->get('entry_fancybox');
		$this->data['entry_layout'] = $this->language->get('entry_layout');
		$this->data['entry_content'] = $this->language->get('entry_content');
		$this->data['entry_date_start'] = $this->language->get('entry_date_start');
		$this->data['entry_date_end'] = $this->language->get('entry_date_end');
		$this->data['entry_image'] = $this->language->get('entry_image');
		$this->data['entry_relproducts'] = $this->language->get('entry_relproducts');
		$this->data['entry_all_products'] = $this->language->get('entry_all_products');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_remove'] = $this->language->get('button_remove');

		$this->data['tab_general'] = $this->language->get('tab_general');
		$this->data['tab_data'] = $this->language->get('tab_data');
		$this->data['tab_seo'] = $this->language->get('tab_seo');
		$this->data['tab_links'] = $this->language->get('tab_links');
		$this->data['tab_design'] = $this->language->get('tab_design');

		$this->data['token'] = $this->session->data['token'];

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->error['title'])) {
			$this->data['error_title'] = $this->error['title'];
		} else {
			$this->data['error_title'] = array();
		}

		if (isset($this->error['caption'])) {
			$this->data['error_caption'] = $this->error['caption'];
		} else {
			$this->data['error_caption'] = array();
		}

		if (isset($this->error['description'])) {
			$this->data['error_description'] = $this->error['description'];
		} else {
			$this->data['error_description'] = array();
		}

		if (isset($this->error['content'])) {
			$this->data['error_content'] = $this->error['content'];
		} else {
			$this->data['error_content'] = array();
		}

		if (isset($this->error['date_start'])) {
			$this->data['error_date_start'] = $this->error['date_start'];
		} else {
			$this->data['error_date_start'] = array();
		}

		$url = (isset($this->request->get['sort'])) ? '&sort=' . $this->request->get['sort'] : '';
		$url .= (isset($this->request->get['order'])) ? '&order=' . $this->request->get['order'] : '';
		$url .= (isset($this->request->get['page'])) ? '&page=' . $this->request->get['page'] : '';

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array('text' => $this->language->get('text_home'), 'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'), 'separator' => false);

		$this->data['breadcrumbs'][] = array('text' => $this->language->get('heading_title'), 'href' => $this->url->link('catalog/actions', 'token=' . $this->session->data['token'] . $url, 'SSL'), 'separator' => ' :: ');

		if (!isset($this->request->get['actions_id'])) {
			$this->data['action'] = $this->url->link('catalog/actions/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('catalog/actions/update', 'token=' . $this->session->data['token'] . '&actions_id=' . $this->request->get['actions_id'] . $url, 'SSL');
		}
		$this->data['cancel'] = $this->url->link('catalog/actions', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$this->data['actions_id'] = 0;
		
		if (isset($this->request->get['actions_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {

			$this->data['actions_id'] = $this->request->get['actions_id'];

			$actions_info = $this->model_catalog_actions->getActions($this->request->get['actions_id']);

			/* Format DateTime */
			if (isset($actions_info['date_start'])) {
				$actions_info['date_start'] = date("d-m-Y H:i", $actions_info['date_start']);
				$actions_info['date_end'] = date("d-m-Y H:i", $actions_info['date_end']);
			}
		}

		$this->load->model('localisation/language');

		$this->data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['actions_description'])) {
			$this->data['actions_description'] = $this->request->post['actions_description'];
		} elseif (isset($this->request->get['actions_id'])) {
			$this->data['actions_description'] = $this->model_catalog_actions->getActionsDescriptions($this->request->get['actions_id']);
		} else {
			$this->data['actions_description'] = array();
		}

		// Image
		if (isset($this->request->post['image'])) {
			$this->data['image'] = $this->request->post['image'];
		} elseif (isset($actions_info)) {
			$this->data['image'] = $actions_info['image'];
		} else {
			$this->data['image'] = '';
		}

		$this->load->model('tool/image');
		if (isset($actions_info) && $actions_info['image'] && file_exists(DIR_IMAGE . $actions_info['image'])) {
			$this->data['preview'] = $this->model_tool_image->resize($actions_info['image'], 100, 100);
		} else {
			$this->data['preview'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		}

		$this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);

		if (isset($this->request->post['fancybox'])) {
			$this->data['fancybox'] = $this->request->post['fancybox'];
		} elseif (isset($actions_info)) {
			$this->data['fancybox'] = $actions_info['fancybox'];
		} else {
			$this->data['fancybox'] = 0;
		}

		if (isset($this->request->post['status'])) {
			$this->data['status'] = $this->request->post['status'];
		} elseif (isset($actions_info)) {
			$this->data['status'] = $actions_info['status'];
		} else {
			$this->data['status'] = 1;
		}

		if (isset($this->request->post['date_start'])) {
			$this->data['date_start'] = $this->request->post['date_start'];
		} elseif (isset($actions_info['date_start'])) {
			$this->data['date_start'] = $actions_info['date_start'];
		} else {
			$this->data['date_start'] = date('d-m-Y H:i', time());
		}
		if (isset($this->request->post['date_end'])) {
			$this->data['date_end'] = $this->request->post['date_end'];
		} elseif (isset($actions_info['date_end'])) {
			$this->data['date_end'] = $actions_info['date_end'];
		} else {
			$this->data['date_end'] = date('d-m-Y H:i', time());
		}
		
		// Product Related 
		//------------------------------------------------------------------
		if (isset($this->request->post['product_related'])) {
			$this->data['product_related'] = $this->request->post['product_related'];
		} elseif (isset($actions_info['product_related'])) {
			$this->data['product_related'] = explode(',', $actions_info['product_related']);
		} else {
			$this->data['product_related'] = array();
		}

		$this->load->model('setting/store');

		$this->data['stores'] = $this->model_setting_store->getStores();

		if (isset($this->request->post['actions_store'])) {
			$this->data['actions_store'] = $this->request->post['actions_store'];
		} elseif (isset($actions_info)) {
			$this->data['actions_store'] = $this->model_catalog_actions->getActionsStores($this->request->get['actions_id']);
		} else {
			$this->data['actions_store'] = array(0);
		}

		if (isset($this->request->post['keyword'])) {
			$this->data['keyword'] = $this->request->post['keyword'];
		} elseif (isset($actions_info)) {
			$this->data['keyword'] = $actions_info['keyword'];
		} else {
			$this->data['keyword'] = '';
		}

		if (isset($this->request->post['actions_layout'])) {
			$this->data['actions_layout'] = $this->request->post['actions_layout'];
		} elseif (isset($this->request->get['actions_id'])) {
			$this->data['actions_layout'] = $this->model_catalog_actions->getActionsLayouts($this->request->get['actions_id']);
		} else {
			$this->data['actions_layout'] = array();
		}

		// Categorise
		//------------------------------------------------------------------
		$this->load->model('catalog/category');
		$categories = $this->model_catalog_category->getAllCategories();
		$this->data['categories'] = $this->getAllCategories($categories);

		// Design Layout
		//------------------------------------------------------------------
		$this->load->model('design/layout');
		$this->data['layouts'] = $this->model_design_layout->getLayouts();

		$this->template = 'catalog/actions_form.tpl';
		$this->children = array('common/header', 'common/footer', );

		$this->response->setOutput($this->render());
	}

	private function getFormSetting() {

		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['text_actions_list_setting'] = $this->language->get('text_actions_list_setting');
		$this->data['text_actions_page_setting'] = $this->language->get('text_actions_page_setting');
		$this->data['text_actions_module_setting'] = $this->language->get('text_actions_module_setting');
		
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_enabled'] = $this->language->get('text_enabled');

		$this->data['entry_actions_limit'] = $this->language->get('entry_actions_limit');
		$this->data['entry_image_size'] = $this->language->get('entry_image_size');
		$this->data['entry_show_image'] = $this->language->get('entry_show_image');
		$this->data['entry_show_date'] = $this->language->get('entry_show_date');
		$this->data['entry_maxlen'] = $this->language->get('entry_maxlen');
		$this->data['entry_relproducts_image_size'] = $this->language->get('entry_relproducts_image_size');
		$this->data['entry_title'] = $this->language->get('entry_title');
		$this->data['entry_h1'] = $this->language->get('entry_h1');
		$this->data['entry_meta_keywords'] = $this->language->get('entry_meta_keywords');
		$this->data['entry_meta_description'] = $this->language->get('entry_meta_description');
		
		$this->data['tab_general'] = $this->language->get('tab_general');
		$this->data['tab_seo'] = $this->language->get('tab_seo');

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

		$this->data['token'] = $this->session->data['token'];

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		$url = (isset($this->request->get['sort'])) ? '&sort=' . $this->request->get['sort'] : '';
		$url .= (isset($this->request->get['order'])) ? '&order=' . $this->request->get['order'] : '';
		$url .= (isset($this->request->get['page'])) ? '&page=' . $this->request->get['page'] : '';

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array('text' => $this->language->get('text_home'), 'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'), 'separator' => false);

		$this->data['breadcrumbs'][] = array('text' => $this->language->get('heading_title'), 'href' => $this->url->link('catalog/actions', 'token=' . $this->session->data['token'] . $url, 'SSL'), 'separator' => ' :: ');

		$this->data['action'] = $this->url->link('catalog/actions/setting', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['cancel'] = $this->url->link('catalog/actions', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$actions_setting = $this->config->get('actions_setting');
		
		if (!isset($actions_setting['actions_limit'])) {
			
			$this->data['actions_setting'] = array(
				'actions_limit' => 5, 
				'image_width' => 120, 
				'image_height' => 120, 
				'image_module_width' => 80, 
				'image_module_height' => 80,
				'module_maxlen' => 400,
				'show_module_image' => 1,
				'show_module_date' => 1,
				'show_image' => 1,
				'show_date' => 1,
				'image_relproduct_height' => 80,
				'image_relproduct_width' => 80,
				'show_actions_date' => 1
				);
		
		} else {
			$this->data['actions_setting'] = $actions_setting;
			
			/*if (isset($this->request->post['actions_setting']['actions_limit'])) {
				$this->data['actions_setting']['actions_limit'] = $this->request->post['actions_setting']['actions_limit'];
			} else {
				$this->data['actions_setting']['actions_limit'] =$actions_setting['actions_limit'];
			}

			if (isset($this->request->post['actions_setting']['image_width'])) {
				$this->data['actions_setting']['image_width'] = $this->request->post['actions_setting']['image_width'];
			} else {
				$this->data['actions_setting']['image_width'] =$actions_setting['image_width'];
			}

			if (isset($this->request->post['actions_setting']['image_height'])) {
				$this->data['actions_setting']['image_height'] = $this->request->post['actions_setting']['image_height'];
			} else {
				$this->data['actions_setting']['image_height'] =$actions_setting['image_height'];
			}
			
			if (isset($this->request->post['actions_setting']['image_module_width'])) {
				$this->data['actions_setting']['image_module_width'] = $this->request->post['actions_setting']['image_module_width'];
			} else {
				$this->data['actions_setting']['image_module_width'] =$actions_setting['image_module_width'];
			}

			if (isset($this->request->post['actions_setting']['image_module_height'])) {
				$this->data['actions_setting']['image_module_height'] = $this->request->post['actions_setting']['image_module_height'];
			} else {
				$this->data['actions_setting']['image_module_height'] =$actions_setting['image_module_height'];
			}

			if (isset($this->request->post['actions_setting']['module_maxlen'])) {
				$this->data['actions_setting']['module_maxlen'] = $this->request->post['actions_setting']['module_maxlen'];
			} else {
				$this->data['actions_setting']['module_maxlen'] =$actions_setting['module_maxlen'];
			}

			if (isset($this->request->post['actions_setting']['show_module_image'])) {
				$this->data['actions_setting']['show_module_image'] = $this->request->post['actions_setting']['show_module_image'];
			} else {
				$this->data['actions_setting']['show_module_image'] =$actions_setting['show_module_image'];
			}

			if (isset($this->request->post['actions_setting']['show_module_date'])) {
				$this->data['actions_setting']['show_module_date'] = $this->request->post['actions_setting']['show_module_date'];
			} else {
				$this->data['actions_setting']['show_module_date'] =$actions_setting['show_module_date'];
			}
			
			if (isset($this->request->post['actions_setting']['show_image'])) {
				$this->data['actions_setting']['show_image'] = $this->request->post['actions_setting']['show_image'];
			} else {
				$this->data['actions_setting']['show_image'] =$actions_setting['show_image'];
			}

			if (isset($this->request->post['actions_setting']['show_date'])) {
				$this->data['actions_setting']['show_date'] = $this->request->post['actions_setting']['show_date'];
			} else {
				$this->data['actions_setting']['show_date'] =$actions_setting['show_date'];
			}*/

		}

		$this->load->model('localisation/language');
		$this->data['languages'] = $this->model_localisation_language->getLanguages();

		$this->template = 'catalog/actions_form_setting.tpl';
		$this->children = array('common/header', 'common/footer', );

		$this->response->setOutput($this->render());
	}

	private function validateForm() {
		if (!$this->user->hasPermission('modify', 'catalog/actions')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		/* BEGIN Check Date & Time */
		if (!preg_match('/\d{2}-\d{2}-\d{4} \d{1,2}:\d{1,2}/', $this->request->post['date_start'])) {
			$this->error['warning'] = $this->language->get('error_date_start');
		}

		if (!preg_match('/\d{2}-\d{2}-\d{4} \d{1,2}:\d{1,2}/', $this->request->post['date_end'])) {
			$this->error['warning'] = $this->language->get('error_date_end');
		}

		foreach ($this->request->post['actions_description'] as $language_id => $value) {
			if ((strlen(utf8_decode($value['caption'])) < 3) || (strlen(utf8_decode($value['caption'])) > 254)) {
				$this->error['caption'][$language_id] = $this->language->get('error_caption');
			}

			if (strlen(utf8_decode($value['description'])) < 20) {
				$this->error['description'][$language_id] = $this->language->get('error_description');
			}
			if (strlen(utf8_decode($value['content'])) < 20) {
				$this->error['content'][$language_id] = $this->language->get('error_content');
			}
		}

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
	public function relproduct() {
		$json = array();
		
		if (isset($this->request->post['product_related'])) {
				
			$this->load->model('catalog/actions');
			$data = $this->request->post['product_related'];
			$products = $this->model_catalog_actions->getProducts($data);
			foreach ($products as $product) {
				$json[] = array(
					'product_id'	=> $product['product_id'],
					'name'			=> $product['name']
				);
			}
			
		}

		$this->response->setOutput(json_encode($json));
	}
	public function catproduct() {
		$json = array();
		if( isset($this->request->get['category_id']) ) {
			$data['category_id'] = $this->request->get['category_id'];
			
			if( isset($this->request->get['filter_special']) ) {
				$data['filter_special'] = $this->request->get['filter_special'];
			} else {
				$data['filter_special'] = NULL;
			}
			
			$this->load->model('catalog/actions');
			$products = $this->model_catalog_actions->getSpecialProductsByCategoryId($data);

			foreach ($products as $product) {
				$json[] = array(
					'product_id'	=> $product['product_id'],
					'name'			=> $product['name']
				);
			}
		}
		$this->response->setOutput(json_encode($json));
	}
	
	private function validatePermission() {
		if (!$this->user->hasPermission('modify', 'catalog/actions')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	private function setDatepickerLanguage() {
		if (isset($this->session->data['language'])) {
			if (file_exists(DIR_APPLICATION . 'view/javascript/jquery/ui/i18n/jquery.ui.datepicker-' . $this->session->data['language'] . '.js')) {
				$this->document->addScript('view/javascript/jquery/ui/i18n/jquery.ui.datepicker-' . $this->session->data['language'] . '.js');
			}
		}
	}

	private function validateDelete() {
		if (!$this->user->hasPermission('modify', 'catalog/actions')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		//$this->load->model('setting/store');
		/*
		 foreach ($this->request->post['selected'] as $actions_id) {
		 }*/

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
	
	// This Metod get from ControllerCatalogCategory Class
	//------------------------------------------------------------------
	private function getAllCategories($categories, $parent_id = 0, $parent_name = '') {
		$output = array();

		if (array_key_exists($parent_id, $categories)) {
			if ($parent_name != '') {
				$parent_name .= $this->language->get('text_separator');
			}

			foreach ($categories[$parent_id] as $category) {
				$output[$category['category_id']] = array(
					'category_id' => $category['category_id'],
					'name'        => $parent_name . $category['name']
				);

				$output += $this->getAllCategories($categories, $category['category_id'], $parent_name . $category['name']);
			}
		}

		return $output;
	}

}
?>