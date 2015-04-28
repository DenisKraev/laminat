<?php  
class ControllerModuleActions extends Controller {
	private $_name = 'actions';

	protected function index($module) {
		$this->load->model('catalog/actions');
		$this->load->model('tool/image');

		$this->language->load('module/actions');
    	
		$this->data['text_read_more'] = $this->language->get('text_read_more');
		$this->data['text_read_all'] = $this->language->get('text_read_all');
		
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		/*if ( $module['date'] != '' ) {
				$date_format = $module['date'];
		} else {
				$date_format = 'd.m.Y';
		}*/

		if ( isset($module['limit']) ) {
			$actions_limit = $module['limit'];
		} else {
			$actions_limit = 3;
		}

		/*$this->data['col_width'] = (int)(100 / $actions_limit);	 
		
		$this->data['style'] = $module['style'];
		*/
		
		$actions_setting = $this->config->get('actions_setting');
		
		$this->data['continue'] = $this->url->link('information/actions');
		
		$results = $this->model_catalog_actions->getActionsAll(0, $actions_limit);

		$this->data['actions'] = array();
			
		foreach ($results as $result) {

      if($result['interval'] != '' && $result['interval'] != 0){
        $cur = getdate();
        $cur = $cur[0];

        $interval =  $result['interval'] * 60 * 60; // интервал часы в секунды

        $start = $result['date_start'];

        $past_interval =  $cur - $start;
        // 3600 корректировка на час (пока не выяснил почему так работает)
        $stop = ($start + ($interval - $past_interval)) - 3600;
        $stop_text = ($start + $interval) - 3600;

        if($interval - 86400 <= 0){$count = floor(abs($start - $cur)/($interval));} else {$count = floor(abs($start - $cur)/($interval - 86400));}

        if($count >= 1){

          if($interval - 86400 <= 0){$start = $start + (($interval) * $count);} else {$start = $start + (($interval - 86400) * $count);}

          $stop = ($start + ($interval)) - 3600;

          $stop_text = $stop;
        }

        $date_start = $start;
        $date_end = date( 'j', $stop_text ) . ' ' . $this->model_catalog_actions->getMonthName(date( 'n', $stop_text ));

        $date = sprintf('до %s', $date_end);

      } else {
        if ($result['date_start'] != ''){
          $date_start = date( 'j', $result['date_start'] ) . ' ' .$this->model_catalog_actions->getMonthName(date( 'n', $result['date_start'] ));
        }	else {
          $date_start = null;
        }
        if($result['date_end'] != ''){
          $date_end = date( 'j', $result['date_end'] ) . ' ' . $this->model_catalog_actions->getMonthName(date( 'n', $result['date_end'] ));
        } else {
          $date_end = null;
        }

        if($actions_setting['show_module_date']) {
          if($date_start == null){
            $date = sprintf('до %s', $date_end);
          } else {
            $date = sprintf('C %s до %s', $date_start, $date_end);
          }
        } else {
          $date = FALSE;
        }
      }

			if ($result['image'] AND $actions_setting['show_module_image'] ) {
				$image = $this->model_tool_image->crop($result['image'], $actions_setting['image_module_width'], $actions_setting['image_module_height'], 'center', '_actions');
			} else {
				$image = FALSE;
			}

			if(!empty($result['anonnce'])) {
				$anonnce = utf8_substr(strip_tags(html_entity_decode($result['anonnce'], ENT_QUOTES, 'UTF-8')), 0, $actions_setting['module_maxlen']);
			} else {
				$anonnce = utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $actions_setting['module_maxlen']);
			}
			$this->data['actions'][] = array(
				'caption'		=> $result['caption'],
				'date_start'	=> $date_start, //date( $date_format, $result['date_start'] ),
				'date_end'		=> $date_end, //date( $date_format, $result['date_end'] ),
				'date'			=> $date,
				'thumb'			=> $image,
				'anonnce'		=> $anonnce, 
				//html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'),
				'href'			=> $this->url->link('information/actions', 'actions_id=' . $result['actions_id'])
			);					
		}
		
		/*foreach ($this->model_catalog_actions->getActionsAll(0, $actions_limit) as $result ) {
				if ($result['image']) {
						$image = $this->model_tool_image->resize($result['image'], 100, 100);
						$image_small = $this->model_tool_image->resize($result['image'], 70, 70);
				} else {
						$image = FALSE;
						$image_small = FALSE;
				}
			$this->data['actions_all'][] = array(
				'date'			=> date( $date_format, $result['date_start'] ),
				'caption'		=> $result['caption'],
				'thumb'			=> $image,
				'thumb_small'	=> $image_small,
				'description'	=> html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'),
				'href'			=> $this->url->link('information/actions', 'actions_id=' . $result['actions_id'])
			);
		}*/

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/stylesheet/actions-styles.css')) {
			$css = 'catalog/view/theme/'.$this->config->get('config_template') . '/stylesheet/actions-styles.css'; 
		} else {
			$css = 'catalog/view/theme/default/stylesheet/stylesheet-actions.css';
		}
		
		$this->document->addStyle($css);
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/actions.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/actions.tpl';
		} else {
			$this->template = 'default/template/module/actions.tpl';
		}
		$this->render();
	}
}
?>