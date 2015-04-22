<?php
class ModelCatalogActions extends Model {
	public function getActions($actions_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM `" . DB_PREFIX . "actions` n LEFT JOIN `" . DB_PREFIX . "actions_description` nd ON (n.actions_id = nd.actions_id) LEFT JOIN `" . DB_PREFIX . "actions_to_store` n2s ON (n.actions_id = n2s.actions_id) WHERE n.actions_id = '" . (int)$actions_id . "' AND nd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND n2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND n.status = '1'");
		return $query->row;
	}

	public function getActionsAll($start = 0, $limit = 5) {
		$query = $this->db->query("SELECT
				*
			FROM `" . DB_PREFIX . "actions` n 
				LEFT JOIN `" . DB_PREFIX . "actions_description` nd ON (n.actions_id = nd.actions_id)
				LEFT JOIN `" . DB_PREFIX . "actions_to_store` n2s ON (n.actions_id = n2s.actions_id)
			WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "'  
				AND n2s.store_id = '" . (int)$this->config->get('config_store_id') . "'
				AND n.status = '1'
				ORDER BY n.date_start DESC LIMIT " . (int)$start . "," . (int)$limit);
		return $query->rows;
	}
	
	/*public function getActionsAnonce($actions_id, $limit = 3) {
		$query = $this->db->query("SELECT
				n.actions_id,
				n.image,
				n.date_start,
				n.date_end,
				nd.caption,
				nd.description
			FROM `" . DB_PREFIX . "actions` n 
				LEFT JOIN `" . DB_PREFIX . "actions_description` nd ON (n.actions_id = nd.actions_id)
				LEFT JOIN `" . DB_PREFIX . "actions_to_store` n2s ON (n.actions_id = n2s.actions_id)
			WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "'  
				AND n2s.store_id = '" . (int)$this->config->get('config_store_id') . "'
				AND n.status = '1'
				AND n.actions_id <> '".(int)$actions_id. "'
				ORDER BY n.date_start DESC LIMIT 0," . (int)$limit);
		return $query->rows;
	}*/
	
	public function getActionsLayoutId($actions_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "actions_to_layout WHERE actions_id = '" . (int)$actions_id . "' AND store_id = '" . (int)$this->config->get('config_store_id') . "'");
		 
		if ($query->num_rows) {
			return $query->row['layout_id'];
		} else {
			return $this->config->get('config_layout_actions');
		}
	}
	public function getActionsTotal() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "actions` n WHERE n.status = '1'");
	        return $query->row['total'];
	}
	
	public function getMonthName($m) {
		// Russian
		$month['ru'] = array('января','февраля','марта','апреля','мая','июня','июля','августа','сентября','октября','ноября','декабря');
		
		return $month['ru'][$m - 1];
	}
}
?>