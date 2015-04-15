<?php  
class ControllerModuleCategory extends Controller {
	protected function index($setting) {
		$this->language->load('module/category');
		
    	$this->data['heading_title'] = $this->language->get('heading_title');
		
		if (isset($this->request->get['path'])) {
			$parts = explode('_', (string)$this->request->get['path']);
		} else {
			$parts = array();
		}
							
		$this->load->model('catalog/category');

		$this->load->model('catalog/product');

		$this->data['categories'] = array();

		$categories = $this->model_catalog_category->getCategories(0);

    $this->data['categories'] = array('items' => $this->buildTree($categories, $parts));

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/category.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/category.tpl';
		} else {
			$this->template = 'default/template/module/category.tpl';
		}
		
		$this->render();
  }

  protected function buildTree($categories, $parts){
    $result = array();

    foreach ($categories as $category_id) {
      $category = $this->model_catalog_category->getCategory($category_id['category_id']);

      $children = $this->model_catalog_category->getCategories($category['category_id']);

      $result[] = array(
        'name' => $category['name'],
        'category_id' => $category['category_id'],
        'href' => $this->url->link('product/category', 'path=' . $category['category_id']),
        'active' => (in_array($category['category_id'], $parts)) ? 'active' : '',
        'items' => $this->buildTree($children, $parts)
      );

    }

    return $result;
  }

}
?>