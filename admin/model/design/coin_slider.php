<?php
class ModelDesignCoinSlider extends Model {
	public function addSlider($data) {
		$this->db->query("
			INSERT INTO " . DB_PREFIX . "coin_slider 
				SET name = '" . $this->db->escape($data['name']) . "', 
					status = '" . (int)$data['status'] . "'
		");
	
		$coin_slider_id = $this->db->getLastId();
	
		if (isset($data['coin_slider_image'])) {
			foreach ($data['coin_slider_image'] as $coin_slider_image) {
				$this->db->query("
					INSERT INTO " . DB_PREFIX . "coin_slider_image SET coin_slider_id = '" . (int)$coin_slider_id . "', slide_background_color = '" .  $this->db->escape($coin_slider_image['slide_background_color']) . "', link = '" .  $this->db->escape($coin_slider_image['link']) . "', image = '" .  $this->db->escape($coin_slider_image['image']) . "', sort_order = '" .  (int)$coin_slider_image['sort_order'] . "'");
				
				$coin_slider_image_id = $this->db->getLastId();
				
				foreach ($coin_slider_image['coin_slider_image_description'] as $language_id => $coin_slider_image_description) {				
					$this->db->query("INSERT INTO " . DB_PREFIX . "coin_slider_image_description SET coin_slider_image_id = '" . (int)$coin_slider_image_id . "', language_id = '" . (int)$language_id . "', coin_slider_id = '" . (int)$coin_slider_id . "', title = '" .  $this->db->escape($coin_slider_image_description['title']) . "', subtitle = '" .  $this->db->escape($coin_slider_image_description['subtitle']) ."'");
				}
			}
		}		
	}
	
	public function editSlider($coin_slider_id, $data) {
		$this->db->query("
			UPDATE " . DB_PREFIX . "coin_slider 
				SET name = '" . $this->db->escape($data['name']) . "', 
				status = '" . (int)$data['status'] . "'
					WHERE coin_slider_id = '" . (int)$coin_slider_id . "'
		");

		$this->db->query("DELETE FROM " . DB_PREFIX . "coin_slider_image WHERE coin_slider_id = '" . (int)$coin_slider_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "coin_slider_image_description WHERE coin_slider_id = '" . (int)$coin_slider_id . "'");
			
		if (isset($data['coin_slider_image'])) {
			foreach ($data['coin_slider_image'] as $coin_slider_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "coin_slider_image SET coin_slider_id = '" . (int)$coin_slider_id . "', slide_background_color = '" .  $this->db->escape($coin_slider_image['slide_background_color']) . "', link = '" .  $this->db->escape($coin_slider_image['link']) . "', image = '" .  $this->db->escape($coin_slider_image['image']) . "', sort_order = '" .  (int)$coin_slider_image['sort_order'] . "'");
				
				$coin_slider_image_id = $this->db->getLastId();
				
				foreach ($coin_slider_image['coin_slider_image_description'] as $language_id => $coin_slider_image_description) {				
					$this->db->query("INSERT INTO " . DB_PREFIX . "coin_slider_image_description SET coin_slider_image_id = '" . (int)$coin_slider_image_id . "', language_id = '" . (int)$language_id . "', coin_slider_id = '" . (int)$coin_slider_id . "', title = '" .  $this->db->escape($coin_slider_image_description['title']) . "', subtitle = '" .  $this->db->escape($coin_slider_image_description['subtitle']) ."'");
				}
			}
		}			
	}
	
	public function deleteSlider($coin_slider_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "coin_slider WHERE coin_slider_id = '" . (int)$coin_slider_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "coin_slider_image WHERE coin_slider_id = '" . (int)$coin_slider_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "coin_slider_image_description WHERE coin_slider_id = '" . (int)$coin_slider_id . "'");
	}
	
	public function getSlider($coin_slider_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "coin_slider WHERE coin_slider_id = '" . (int)$coin_slider_id . "'");
		
		return $query->row;
	}
		
	public function getSliders($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "coin_slider";
		
		$sort_data = array(
			'name',
			'status'
		);	
		
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY name";	
		}
		
		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
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

		return $query->rows;
	}
		
	public function getSliderImages($coin_slider_id) {
		$coin_slider_image_data = array();
		
		$coin_slider_image_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "coin_slider_image WHERE coin_slider_id = '" . (int)$coin_slider_id . "' ORDER BY sort_order ASC");
		
		foreach ($coin_slider_image_query->rows as $coin_slider_image) {
			$coin_slider_image_description_data = array();
			 
			$coin_slider_image_description_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "coin_slider_image_description WHERE coin_slider_image_id = '" . (int)$coin_slider_image['coin_slider_image_id'] . "' AND coin_slider_id = '" . (int)$coin_slider_id . "'");
			
			foreach ($coin_slider_image_description_query->rows as $coin_slider_image_description) {			
				$coin_slider_image_description_data[$coin_slider_image_description['language_id']] = array('title' => $coin_slider_image_description['title'], 'subtitle' => $coin_slider_image_description['subtitle']);
			}
		
			$coin_slider_image_data[] = array(
				'coin_slider_image_description' => $coin_slider_image_description_data,
				'link'                     => $coin_slider_image['link'],
				'slide_background_color'   => $coin_slider_image['slide_background_color'],
				'image'                    => $coin_slider_image['image'],
				'sort_order'               => $coin_slider_image['sort_order'],	
			);
		}

		return $coin_slider_image_data;
	}
		
	public function getTotalSliders() {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "coin_slider");
		
		return $query->row['total'];
	}

	public function uninstall()
	{
		$this->db->query("DROP TABLE IF EXISTS " . DB_PREFIX . "coin_slider");
		$this->db->query("DROP TABLE IF EXISTS " . DB_PREFIX . "coin_slider_image");
		$this->db->query("DROP TABLE IF EXISTS " . DB_PREFIX . "coin_slider_image_description");
	}

	public function install()
	{
		$this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "coin_slider (
  `coin_slider_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_bin NOT NULL,
  `status` tinyint(1) NOT NULL,
  `spw` int(4) unsigned NOT NULL,
  `sph` int(4) unsigned NOT NULL,
  `delay` int(10) unsigned NOT NULL,
  `s_delay` int(10) unsigned NOT NULL,
  `opacity` double(2,1) unsigned NOT NULL,
  `title_speed` int(10) unsigned NOT NULL,
  `effect` tinyint(1) unsigned NOT NULL,
  `navigation` tinyint(1) unsigned NOT NULL,
  `links` tinyint(1) unsigned NOT NULL,
  `hover_pause` int(1) unsigned NOT NULL,
  `link_new_tab` tinyint(1) unsigned NOT NULL,
  `width_title` smallint(4) unsigned NOT NULL,
  `width_subtitle` smallint(4) unsigned NOT NULL,
  `padding_top` smallint(4) unsigned NOT NULL,
  `padding_left` smallint(4) unsigned NOT NULL,
  `distance` smallint(4) unsigned NOT NULL,
  `text_color` varchar(10) COLLATE utf8_bin NOT NULL,
  `background_color` varchar(10) COLLATE utf8_bin NOT NULL,
  `show_buttons_prev_next` tinyint(1) unsigned NOT NULL,
  `show_buttons_bottom` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`coin_slider_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;");

	$this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "coin_slider_image (
  `coin_slider_image_id` int(11) NOT NULL AUTO_INCREMENT,
  `coin_slider_id` int(11) NOT NULL,
  `link` varchar(255) COLLATE utf8_bin NOT NULL,
  `image` varchar(255) COLLATE utf8_bin NOT NULL,
  `sort_order` tinyint(2) unsigned NOT NULL,
  PRIMARY KEY (`coin_slider_image_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1;");

	$this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "coin_slider_image_description (
  `coin_slider_image_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `coin_slider_id` int(11) NOT NULL,
  `title` varchar(64) COLLATE utf8_bin NOT NULL,
  `subtitle` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`coin_slider_image_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");

	}	
}
