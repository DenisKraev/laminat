<?php
class ModelCatalogProductStatus extends Model
{
  public function getStatusDescriptions($ac231c6812af75a72668a5235f5b40836)
  {
    $ae53140b8778180ed320c3fbf516dd093 = array();
    $ab84bb8e23a7c6dcf8162b05536318aab = $this->db->query("SELECT * FROM " . DB_PREFIX . "status WHERE status_id = '" . (int) $ac231c6812af75a72668a5235f5b40836 . "'");
    foreach ($ab84bb8e23a7c6dcf8162b05536318aab->rows as $a54e5d9823d4cd8300b46f8092b2fdb91) {
      $ae53140b8778180ed320c3fbf516dd093[$a54e5d9823d4cd8300b46f8092b2fdb91['language_id']] = array(
        'name' => $a54e5d9823d4cd8300b46f8092b2fdb91['name'],
        'image' => $a54e5d9823d4cd8300b46f8092b2fdb91['image'],
        'url' => $a54e5d9823d4cd8300b46f8092b2fdb91['url'],
        'status_id' => $a54e5d9823d4cd8300b46f8092b2fdb91['status_id']
      );
    }
    return $ae53140b8778180ed320c3fbf516dd093;
  }
  public function getStatus($ac231c6812af75a72668a5235f5b40836)
  {
    $a260023c2d3cf6815a29dba36ddffafbf = "SELECT * FROM " . DB_PREFIX . "status s WHERE s.language_id = '" . (int) $this->config->get('config_language_id') . "' AND s.status_id = '" . (int) $ac231c6812af75a72668a5235f5b40836 . "'";
    $ab84bb8e23a7c6dcf8162b05536318aab = $this->db->query($a260023c2d3cf6815a29dba36ddffafbf);
    return $ab84bb8e23a7c6dcf8162b05536318aab->row;
  }
  public function addStatus($a49782679d3a1306373cdc1949daded24)
  {
    $ab84bb8e23a7c6dcf8162b05536318aab = $this->db->query("SELECT MAX(status_id) as status_id FROM " . DB_PREFIX . "status");
    if ($ab84bb8e23a7c6dcf8162b05536318aab->row) {
      $ac231c6812af75a72668a5235f5b40836 = $ab84bb8e23a7c6dcf8162b05536318aab->row['status_id'];
    } else {
      $ac231c6812af75a72668a5235f5b40836 = 0;
    }
    $ac231c6812af75a72668a5235f5b40836++;
    foreach ($a49782679d3a1306373cdc1949daded24['status_description'] as $a8d410c338000d36dd725e01c5e0d73aa => $af83ec830468caf06b95a896fcba47abb) {
      $this->db->query("INSERT INTO " . DB_PREFIX . "status SET status_id = '" . (int) $ac231c6812af75a72668a5235f5b40836 . "', language_id = '" . (int) $a8d410c338000d36dd725e01c5e0d73aa . "', `image` = '" . $this->db->escape(html_entity_decode($af83ec830468caf06b95a896fcba47abb['image'], ENT_QUOTES, 'UTF-8')) . "', `name` = '" . $this->db->escape(html_entity_decode($af83ec830468caf06b95a896fcba47abb['name'], ENT_QUOTES, 'UTF-8')) . "', url = '" . $this->db->escape(html_entity_decode($af83ec830468caf06b95a896fcba47abb['url'], ENT_QUOTES, 'UTF-8')) . "'");
    }
  }
  public function editStatus($ac231c6812af75a72668a5235f5b40836, $a49782679d3a1306373cdc1949daded24)
  {
    $this->db->query("DELETE FROM " . DB_PREFIX . "status WHERE status_id = '" . (int) $ac231c6812af75a72668a5235f5b40836 . "'");
    foreach ($a49782679d3a1306373cdc1949daded24['status_description'] as $a8d410c338000d36dd725e01c5e0d73aa => $af83ec830468caf06b95a896fcba47abb) {
      $this->db->query("INSERT INTO " . DB_PREFIX . "status SET status_id = '" . (int) $ac231c6812af75a72668a5235f5b40836 . "', language_id = '" . (int) $a8d410c338000d36dd725e01c5e0d73aa . "', `image` = '" . $this->db->escape(html_entity_decode($af83ec830468caf06b95a896fcba47abb['image'], ENT_QUOTES, 'UTF-8')) . "', `name` = '" . $this->db->escape(html_entity_decode($af83ec830468caf06b95a896fcba47abb['name'], ENT_QUOTES, 'UTF-8')) . "', url = '" . $this->db->escape(html_entity_decode($af83ec830468caf06b95a896fcba47abb['url'], ENT_QUOTES, 'UTF-8')) . "'");
    }
  }
  public function deleteStatus($ac231c6812af75a72668a5235f5b40836)
  {
    $this->db->query("DELETE FROM " . DB_PREFIX . "status WHERE status_id = '" . (int) $ac231c6812af75a72668a5235f5b40836 . "'");
    $this->db->query("DELETE FROM " . DB_PREFIX . "product_status WHERE status_id = '" . (int) $ac231c6812af75a72668a5235f5b40836 . "'");
  }
  public function getStatuses($a49782679d3a1306373cdc1949daded24 = array())
  {
    $a260023c2d3cf6815a29dba36ddffafbf = "SELECT * FROM " . DB_PREFIX . "status s WHERE s.language_id = '" . (int) $this->config->get('config_language_id') . "' ";
    if (!empty($a49782679d3a1306373cdc1949daded24['filter_name'])) {
      $a260023c2d3cf6815a29dba36ddffafbf .= " AND s.name LIKE '%" . $this->db->escape($a49782679d3a1306373cdc1949daded24['filter_name']) . "%'";
    }
    $a260023c2d3cf6815a29dba36ddffafbf .= " ORDER BY s.name";
    if (isset($a49782679d3a1306373cdc1949daded24['order']) && ($a49782679d3a1306373cdc1949daded24['order'] == 'DESC')) {
      $a260023c2d3cf6815a29dba36ddffafbf .= " DESC";
    } else {
      $a260023c2d3cf6815a29dba36ddffafbf .= " ASC";
    }
    if (isset($a49782679d3a1306373cdc1949daded24['start']) || isset($a49782679d3a1306373cdc1949daded24['limit'])) {
      if ($a49782679d3a1306373cdc1949daded24['start'] < 0) {
        $a49782679d3a1306373cdc1949daded24['start'] = 0;
      }
      if ($a49782679d3a1306373cdc1949daded24['limit'] < 1) {
        $a49782679d3a1306373cdc1949daded24['limit'] = 20;
      }
      $a260023c2d3cf6815a29dba36ddffafbf .= " LIMIT " . (int) $a49782679d3a1306373cdc1949daded24['start'] . "," . (int) $a49782679d3a1306373cdc1949daded24['limit'];
    }
    $ab84bb8e23a7c6dcf8162b05536318aab = $this->db->query($a260023c2d3cf6815a29dba36ddffafbf);
    return $ab84bb8e23a7c6dcf8162b05536318aab->rows;
  }
  public function getTotalStatuses()
  {
    $ab84bb8e23a7c6dcf8162b05536318aab = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "status s WHERE s.language_id = '" . (int) $this->config->get('config_language_id') . "'");
    return $ab84bb8e23a7c6dcf8162b05536318aab->row['total'];
  }
  public function getProductStatuses($af77ce1260170727cc45c8abd5b365ccc)
  {
    $a260023c2d3cf6815a29dba36ddffafbf = "SELECT ps.product_show, ps.category_show, ps.sort_order, ps.product_id, s.* FROM " . DB_PREFIX . "product_status ps LEFT JOIN " . DB_PREFIX . "status s ON ps.status_id = s.status_id WHERE s.language_id = '" . (int) $this->config->get('config_language_id') . "' AND ps.product_id = '" . (int) $af77ce1260170727cc45c8abd5b365ccc . "' ORDER BY ps.sort_order ASC";
    $ab84bb8e23a7c6dcf8162b05536318aab = $this->db->query($a260023c2d3cf6815a29dba36ddffafbf);
    $a88a4e2cc938b3c6db9b0dfe0dca3d5ba = array();
    foreach ($ab84bb8e23a7c6dcf8162b05536318aab->rows as $ac5b1fddbcc74c17b92b0d4dfc92e0f27) {
      $ac5b1fddbcc74c17b92b0d4dfc92e0f27['thumb'] = $this->getThumb($ac5b1fddbcc74c17b92b0d4dfc92e0f27['image']);
      $a88a4e2cc938b3c6db9b0dfe0dca3d5ba[]        = $ac5b1fddbcc74c17b92b0d4dfc92e0f27;
    }
    return $a88a4e2cc938b3c6db9b0dfe0dca3d5ba;
  }
  public function addProductStatuses($af77ce1260170727cc45c8abd5b365ccc, $a49782679d3a1306373cdc1949daded24)
  {
    if (isset($a49782679d3a1306373cdc1949daded24['product_status'])) {
      $this->deleteProductStatuses($af77ce1260170727cc45c8abd5b365ccc);
      foreach ($a49782679d3a1306373cdc1949daded24['product_status'] as $ab3d9628d5ac7b2b56f9d5d4c19afafcb) {
        if ($ab3d9628d5ac7b2b56f9d5d4c19afafcb['status_id']) {
          $ac231c6812af75a72668a5235f5b40836 = $ab3d9628d5ac7b2b56f9d5d4c19afafcb['status_id'];
          $a3f4e556d9098ea16d49a34d7aad7062c = isset($ab3d9628d5ac7b2b56f9d5d4c19afafcb['product_show']) ? $ab3d9628d5ac7b2b56f9d5d4c19afafcb['product_show'] : 0;
          $a5440e965bd7d15410eed10d67c607abc = isset($ab3d9628d5ac7b2b56f9d5d4c19afafcb['category_show']) ? $ab3d9628d5ac7b2b56f9d5d4c19afafcb['category_show'] : 0;
          $afa09fa0b7aeb47a472621d7a46bc75a1 = isset($ab3d9628d5ac7b2b56f9d5d4c19afafcb['sort_order']) ? $ab3d9628d5ac7b2b56f9d5d4c19afafcb['sort_order'] : 0;
          $this->db->query("INSERT INTO " . DB_PREFIX . "product_status SET status_id = '" . (int) $ac231c6812af75a72668a5235f5b40836 . "', product_id = '" . (int) $af77ce1260170727cc45c8abd5b365ccc . "', product_show = '" . (int) $a3f4e556d9098ea16d49a34d7aad7062c . "', category_show = '" . (int) $a5440e965bd7d15410eed10d67c607abc . "', sort_order = '" . (int) $afa09fa0b7aeb47a472621d7a46bc75a1 . "'");
        }
      }
    }
  }
  public function deleteProductStatuses($af77ce1260170727cc45c8abd5b365ccc)
  {
    $this->db->query("DELETE FROM " . DB_PREFIX . "product_status WHERE product_id = '" . (int) $af77ce1260170727cc45c8abd5b365ccc . "'");
  }
  public function getThumb($a7a33f61f16f67c1be945e4ea4b01c484, $a06dee0aab9da3a856736a38f2d30ee3f = 'product')
  {
    $this->load->model('tool/image');
    $a776f5c4135b037603b74c97cdbebba18 = $this->config->get('product_status_options');
    $ac2b58574c9be213976ad15f8a14bed73 = $this->config->get('config_url') . 'image/' . $a7a33f61f16f67c1be945e4ea4b01c484;
    if (!isset($a7a33f61f16f67c1be945e4ea4b01c484) || !$a7a33f61f16f67c1be945e4ea4b01c484 || !file_exists(DIR_IMAGE . $a7a33f61f16f67c1be945e4ea4b01c484)) {
      $a7a33f61f16f67c1be945e4ea4b01c484 = 'no_image.jpg';
    }
    if ($a776f5c4135b037603b74c97cdbebba18[$a06dee0aab9da3a856736a38f2d30ee3f]['image_width'] || $a776f5c4135b037603b74c97cdbebba18[$a06dee0aab9da3a856736a38f2d30ee3f]['image_height']) {
      $ac2b58574c9be213976ad15f8a14bed73 = $this->model_tool_image->resize($a7a33f61f16f67c1be945e4ea4b01c484, $a776f5c4135b037603b74c97cdbebba18[$a06dee0aab9da3a856736a38f2d30ee3f]['image_width'], $a776f5c4135b037603b74c97cdbebba18[$a06dee0aab9da3a856736a38f2d30ee3f]['image_height']);
    }
    return $ac2b58574c9be213976ad15f8a14bed73;
  }
  public function getDefaultOptions()
  {
    return array(
      'product' => array(
        'image_width' => 50,
        'image_height' => 50,
        'name_display' => 'tip',
        'status_display' => 'inline',
        'css' => '.statuses img {
                  margin-right: 15px;
                }
                .statuses .status-name {
                  position: relative;
                  bottom: 20px;
                }'
      ),
      'category' => array(
        'image_width' => 50,
        'image_height' => 50,
        'name_display' => 'tip',
        'status_display' => 'inline',
        'css' => '.statuses img {
                  margin-right: 3px;
                }'
      )
    );
  }
  public function install()
  {
    $this->uninstall();
    $this->db->query("
            CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "status (
                `status_id` int(11) NOT NULL,
                `language_id` int(11) NOT NULL,
                `image` varchar(255) NOT NULL,
                `name` text NOT NULL,
                `url` varchar(255) NOT NULL,
                PRIMARY KEY (`status_id`, `language_id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8  COLLATE=utf8_general_ci
        ");
    $this->db->query("
            CREATE TABLE  IF NOT EXISTS " . DB_PREFIX . "product_status (
                `product_id` int(11) NOT NULL,
                `status_id` int(11) NOT NULL,
                `product_show` int(1) NOT NULL,
                `category_show` tinyint(1) NOT NULL,
                `sort_order` INT(3) NOT NULL DEFAULT '0',
                KEY (`status_id`),
                KEY (`product_id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci
        ");
  }
  public function uninstall()
  {
    $this->db->query("DROP TABLE IF EXISTS " . DB_PREFIX . "status");
    $this->db->query("DROP TABLE IF EXISTS " . DB_PREFIX . "product_status");
  }
}
//author sv2109 (sv2109@gmail.com) license for 1 product copy granted for feofan (feofan.net, am@feofan.net)