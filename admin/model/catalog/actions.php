<?php
class ModelCatalogActions extends Model {
	
	public function addActions($data) {
		/* Format date & time */
		$data['date_start'] = strtotime( preg_replace('|^([0-9]{2})-([0-9]{2})-([0-9]{4})|', "\\3-\\2-\\1", $data['date_start']) . ':00' );
		$data['date_end'] = strtotime( preg_replace('|^([0-9]{2})-([0-9]{2})-([0-9]{4})|', "\\3-\\2-\\1", $data['date_end']). ':00' );
		
		if( isset($data['product_related']) && $data['product_related'] != '' ) {
			$product_related = implode(',', $data['product_related']);
		} else {
			$product_related = '';
		}
		
		$this->db->query("INSERT INTO `" . DB_PREFIX . "actions` SET 
			`image` = '" . (string)$data['image'] . "', 
			`status` = '" . (int)$data['status'] . "',
			`fancybox` = '".(int)$data['fancybox']."',
			`date_start` = '".$data['date_start']."',
			`date_end` = '".$data['date_end']."',
			`product_related` = '" . $product_related . "'
			");

		$actions_id = $this->db->getLastId(); 
		$this->updateActionsDescription($actions_id, $data['actions_description']);
		
		if (isset($data['actions_store'])) {
			foreach ($data['actions_store'] as $store_id) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "actions_to_store` SET `actions_id` = '" . (int)$actions_id . "', `store_id` = '" . (int)$store_id . "'");
			}
		}

		if (isset($data['actions_layout'])) {
			foreach ($data['actions_layout'] as $store_id => $layout) {
				if ($layout) {
					$this->db->query("INSERT INTO `" . DB_PREFIX . "actions_to_layout` SET `actions_id` = '" . (int)$actions_id . "', `store_id` = '" . (int)$store_id . "', `layout_id` = '" . (int)$layout['layout_id'] . "'");
				}
			}
		}

		if ($data['keyword']) {
			$this->updateActionsKeyword($actions_id, $data['keyword']);
		}
		
		$this->cache->delete('actions_content');
	}
	
	private function updateActionsKeyword($actions_id, $keyword) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "url_alias` WHERE `query` = 'actions_id=" . (int)$actions_id. "'");
		$query = $this->db->query("SELECT `keyword` FROM `" . DB_PREFIX . "url_alias` WHERE `keyword` = '" . $this->db->escape($keyword) . "'");
		if ( count($query->rows) > 0 ){
			$keyword = 'n' . (int)$actions_id . '-' .  $keyword;
		}
		$this->db->query("INSERT INTO `" . DB_PREFIX . "url_alias` SET `query` = 'actions_id=" . (int)$actions_id . "', `keyword` = '" . $this->db->escape($keyword) . "'");
	}
	
	private function updateActionsDescription($actions_id, $data) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "actions_description` WHERE `actions_id` = '" . (int)$actions_id . "'");
		foreach ($data as $language_id => $value) {
			$this->db->query("INSERT INTO `" . DB_PREFIX . "actions_description` SET 
				`actions_id` = '" . (int)$actions_id . "', 
				`language_id` = '" . (int)$language_id . "', 
				`title` = '" . $this->db->escape($value['title']) . "',
				`h1` = '" . $this->db->escape($value['h1']) . "',
				`caption` = '" . $this->db->escape($value['caption']) . "',
				`meta_keywords` = '" . $this->db->escape($value['meta_keywords']) . "',
				`meta_description` = '" . $this->db->escape($value['meta_description']) . "',
				`anonnce` = '" . $this->db->escape($value['anonnce']) . "',
				`description` = '" . $this->db->escape($value['description']) . "', 
				`content` = '" . $this->db->escape($value['content']) . "'");
		}
	}
	public function editActions($actions_id, $data) {
		/* Format date & time */
		$data['date_start'] = strtotime( preg_replace('|^([0-9]{2})-([0-9]{2})-([0-9]{4})|', "\\3-\\2-\\1", $data['date_start']) . ':00' );
		$data['date_end'] = strtotime( preg_replace('|^([0-9]{2})-([0-9]{2})-([0-9]{4})|', "\\3-\\2-\\1", $data['date_end']) . ':00' );
		
		if( isset($data['product_related']) && $data['product_related'] != '' ) {
			$product_related = implode(',', $data['product_related']);
		} else {
			$product_related = '';
		}
		
		$this->db->query("UPDATE `" . DB_PREFIX . "actions` SET
			`image` = '" . (string)$data['image'] . "',
			`date_start` = '" . $data['date_start'] . "',
			`date_end` = '" . $data['date_end'] . "',
			`status` = '" . (int)$data['status'] . "',
			`fancybox` = '" . (int)$data['fancybox'] . "',
			`product_related` = '" . $product_related . "'
			WHERE `actions_id` = '" . (int)$actions_id . "'");

		$this->updateActionsDescription($actions_id, $data['actions_description']);

		$this->db->query("DELETE FROM `" . DB_PREFIX . "actions_to_store` WHERE `actions_id` = '" . (int)$actions_id . "'");
		
		if (isset($data['actions_store'])) {
			foreach ($data['actions_store'] as $store_id) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "actions_to_store` SET `actions_id` = '" . (int)$actions_id . "', `store_id` = '" . (int)$store_id . "'");
			}
		}
		
		$this->db->query("DELETE FROM `" . DB_PREFIX . "actions_to_layout` WHERE `actions_id` = '" . (int)$actions_id . "'");

		if (isset($data['actions_layout'])) {
			foreach ($data['actions_layout'] as $store_id => $layout) {
				if ($layout['layout_id']) {
					$this->db->query("INSERT INTO `" . DB_PREFIX . "actions_to_layout` SET actions_id = '" . (int)$actions_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout['layout_id'] . "'");
				}
			}
		}

		if ($data['keyword']) {
			$this->updateActionsKeyword($actions_id, $data['keyword']);
		}
		
		$this->cache->delete('actions_content');
	}
	
	public function deleteActions($actions_id) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "actions` WHERE `actions_id` = '" . (int)$actions_id . "'");
		$this->db->query("DELETE FROM `" . DB_PREFIX . "actions_description` WHERE `actions_id` = '" . (int)$actions_id . "'");
		$this->db->query("DELETE FROM `" . DB_PREFIX . "actions_to_store` WHERE `actions_id` = '" . (int)$actions_id . "'");
		$this->db->query("DELETE FROM `" . DB_PREFIX . "url_alias` WHERE `query` = 'actions_id=" . (int)$actions_id . "'");

		$this->cache->delete('actions_content');
	}	

	public function getActions($actions_id) {
		$query = $this->db->query(
			"SELECT DISTINCT *, (
			    SELECT keyword FROM `" . DB_PREFIX . "url_alias` WHERE `query` = 'actions_id=" . (int)$actions_id . "') AS keyword 
			    FROM `" . DB_PREFIX . "actions` WHERE `actions_id` = '" . (int)$actions_id . "'");
		return $query->row;
	}
		
	public function getActionss($data = array()) {
		/*  Update actions ofline status */
		//$this->db->query("UPDATE `" . DB_PREFIX . "actions` n SET n.status = 0 WHERE n.date_end < '".(int)(time())."' AND n.date_end <> 0");
		
		if ($data) {
			$sql = "SELECT * FROM `" . DB_PREFIX . "actions` n 
				LEFT JOIN `" . DB_PREFIX . "actions_description` nd ON (n.actions_id = nd.actions_id) 
				WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		
			$sort_data = array(
				'n.date_start', 
				'nd.title'
			);		
		
			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];	
			} else {
				$sql .= " ORDER BY n.date_start";
			}
			
			if (isset($data['order']) && ($data['order'] == 'ASC')) {
				$sql .= " ASC";
			} else {
				$sql .= " DESC";
			}
		
			if (isset($data['start']) || isset($data['limit'])) {
				if ($data['start'] < 0) {
					$data['start'] = 0;
				}		

				if ($data['limit'] < 1) {
					$data['limit'] = 20;
				}	
			
				$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
			}	
			
			$query = $this->db->query($sql);
			
			$actions_data = $query->rows;
		} else {
			$actions_data = $this->cache->get('actions.' . $this->config->get('config_language_id'));
		
			if (!$actions_data) {
				$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "actions` n LEFT JOIN `" . DB_PREFIX . "actions_description` nd ON (n.actions_id = nd.actions_id) WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY n.date_start");
	
				$actions_data = $query->rows;
			
				$this->cache->set('actions.' . $this->config->get('config_language_id'), $actions_data);
			}	
			
		}

		return $actions_data;
	}
	
	public function getActionsDescriptions($actions_id) {
		$actions_description_data = array();
		
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "actions_description` WHERE actions_id = '" . (int)$actions_id . "'");

		foreach ($query->rows as $result) {
			$actions_description_data[$result['language_id']] = array(
				'title'			=> $result['title'],
				'h1'			=> $result['h1'],
				'caption'		=> $result['caption'],
				'meta_keywords'		=> $result['meta_keywords'],
				'meta_description'      => $result['meta_description'],
				'anonnce'      => $result['anonnce'],
				'description'		=> $result['description'],
				'content'		=> $result['content']
			);
		}
		
		return $actions_description_data;
	}
	
	public function getActionsStores($actions_id) {
		$actions_store_data = array();
		
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "actions_to_store` WHERE actions_id = '" . (int)$actions_id . "'");

		foreach ($query->rows as $result) {
			$actions_store_data[] = $result['store_id'];
		}
		
		return $actions_store_data;
	}
		
	public function getTotalActionss() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "actions`");
		return $query->row['total'];
	}	
	
	public function getActionsLayouts($actions_id) {
		$actions_layout_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "actions_to_layout WHERE actions_id = '" . (int)$actions_id . "'");
		
		foreach ($query->rows as $result) {
			$actions_layout_data[$result['store_id']] = $result['layout_id'];
		}
		
		return $actions_layout_data;
	}
	
	public function getTotalActionssByLayoutId($layout_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "actions_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->row['total'];
	}
	
	// Get Special Products
	
	public function getSpecialProductsByCategoryId($data = array()) {
		
		if(isset($data['category_id']) AND $data['category_id'] > 0) {

			$this->load->model('catalog/product');
			
			if(!empty($data['filter_special'])) {
				$query = $this->db->query("SELECT DISTINCT ps.product_id, pd.name FROM " . DB_PREFIX . "product_special ps
					LEFT JOIN " . DB_PREFIX . "product_description pd ON (ps.product_id = pd.product_id) 
					LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (ps.product_id = p2c.product_id) 
					WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' 
					AND p2c.category_id = '" . (int)$data['category_id'] . "' 
					ORDER BY priority, price");
				
				return $query->rows;
				
			} else {
				
				$products = $this->model_catalog_product->getProductsByCategoryId($data['category_id']);
				
				return $products;
			}
		}
		return NULL;
		
	}
	
	public function getProducts($data = array()) {
		if ( count($data) > 0 ) {
				
			$sql = "SELECT p.product_id, pd.name
				FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id)
				WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'
				AND p.product_id IN (" . implode(',', $data) . ")";
			
			$query = $this->db->query($sql);
			
			return $query->rows;
		} else {
			return NULL;
		}
	}

	public function install() {
		$sql_actions = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "actions` (
		  `actions_id` int(11) NOT NULL AUTO_INCREMENT,
		  `image` varchar(255) NULL, 
		  `image_size` int(1) NOT NULL default '0', 
		  `date_start` int(11) NOT NULL DEFAULT '0',
		  `date_end` int(11) NOT NULL DEFAULT '0',
		  `status` int(1) NOT NULL DEFAULT '0',
		  `fancybox` int(1) NOT NULL DEFAULT '0',
		  `product_related` text NULL,
		  PRIMARY KEY (`actions_id`)
		) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;";

		$sql_actions_description = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "actions_description` (
		  `actions_id` int(11) NOT NULL,
		  `language_id` int(11) NOT NULL,
		  `title` varchar(255) NOT NULL DEFAULT '',
		  `meta_keywords` varchar(255) NOT NULL DEFAULT '',
		  `meta_description` varchar(255) NOT NULL DEFAULT '',
		  `h1` varchar(255) NOT NULL DEFAULT '',
		  `caption` varchar(255) NOT NULL DEFAULT '',
		  `anonnce` text NOT NULL DEFAULT '',
		  `description` text NOT NULL DEFAULT '',
		  `content` text NOT NULL DEFAULT '',
		  PRIMARY KEY (`actions_id`,`language_id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;";

		$sql_actions_to_layout = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "actions_to_layout` (
		  `actions_id` int(11) NOT NULL,
		  `store_id` int(11) NOT NULL,
		  `layout_id` int(11) NOT NULL,
		  PRIMARY KEY (`actions_id`,`store_id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;";

		$sql_actions_to_store = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "actions_to_store` (
		  `actions_id` int(11) NOT NULL,
		  `store_id` int(11) NOT NULL,
		  PRIMARY KEY (`actions_id`,`store_id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;";
		
		$this->db->query($sql_actions);
		$this->db->query($sql_actions_description);
		$this->db->query($sql_actions_to_layout);
		$this->db->query($sql_actions_to_store);
		$this->db->query("DELETE FROM `" . DB_PREFIX . "url_alias` WHERE `query` LIKE 'actions_id=%';");
		
		$this->load->model('setting/setting');
		$config['actions_setting'] = array(
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
		
		$this->model_setting_setting->editSetting('actions_setting', $config);
		return TRUE;
	}
        public function uninstall() {
                $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "actions`;");
                $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "actions_description`;");
                $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "actions_to_layout`;");
                $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "actions_to_store`;");
                $this->db->query("DELETE FROM `" . DB_PREFIX . "url_alias` WHERE `query` LIKE 'actions_id=%';");
                $this->cache->delete('actions_content');
        }
}
?>