<?php 
class ControllerInformationActions extends Controller {
	private $error = array();
	
	public function index() {  
		$this->language->load('information/actions');
		
		$this->load->model('catalog/actions');
		$this->load->model('setting/setting');
		
		$this->data['text_date_added'] = $this->language->get('text_date_added');
		
		$this->data['breadcrumbs'] = array();
		
		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
			'separator' => ''
		);
		
		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_actions'),
			'href'      => $this->url->link('information/actions'),
			'separator' => $this->language->get('text_separator')
		);
		
		if (isset($this->request->get['actions_id'])) {
			$this->getActions($this->request->get['actions_id']);
		} else {
			$this->getList();
		}
		
		
		if ($this->error && isset($this->error['error'])) {
				
	  			$this->document->setTitle($this->error['error']);

				$actions_all = NULL;

				$this->data['heading_title'] = $this->language->get('text_error');
				$this->data['text_error'] = $this->language->get('text_error');
				$this->data['button_continue'] = $this->language->get('button_continue');
				$this->data['continue'] = $this->url->link('common/home');

				if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
						$this->template = $this->config->get('config_template') . '/template/error/not_found.tpl';
				} else {
						$this->template = 'default/template/error/not_found.tpl';
				}
			
		} else {
//				if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/stylesheet/actions-styles.css')) {
//						$css = 'catalog/view/theme/'.$this->config->get('config_template') . '/stylesheet/actions-styles.css';
//				} else {
//						$css = 'catalog/view/theme/default/stylesheet/stylesheet-actions.css';
//				}
		
				//$this->document->addStyle($css);
		
				if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/actions.tpl')) {
						$this->template = $this->config->get('config_template') . '/template/information/actions.tpl';
				} else {
						$this->template = 'default/template/information/actions.tpl';
				}
		
		}
		
		$this->children = array(
			'common/column_left',
			'common/column_right',
			'common/content_top',
			'common/content_bottom',
			'common/footer',
			'common/header'
		);
				
 		$this->response->setOutput($this->render());
  	}
	
	/* Get one actions by actions_id */
	public function getActions($actions_id) {
			
			$actions_setting = $this->config->get('actions_setting');
			
			$this->load->model('catalog/product');
			$this->load->model('tool/image');
			
			$date_format = $this->language->get('date_long_format');

			$actions = $this->model_catalog_actions->getActions($actions_id);
			if (!$actions) {
					$this->error['error'] = $this->language->get('text_error');
					return;
			}
			
			// Product Related
			
			$this->data['product_related'] = array();
			
			if( !empty($actions['product_related']) ) {
				
				$products = explode(',', $actions['product_related']);
				
				foreach ($products as $product_id) {
					$product_info = $this->model_catalog_product->getProduct($product_id);
					
					if ($product_info) {
						if ($product_info['image']) {
							$image = $this->model_tool_image->crop($product_info['image'], 230, 230, 'center', '_actions_list');
						} else {
							$image = false;
						}
		
						if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
							$price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
						} else {
							$price = false;
						}
								
						if ((float)$product_info['special']) {
							$special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')));
						} else {
							$special = false;
						}
						
						if ($this->config->get('config_review_status')) {
							$rating = $product_info['rating'];
						} else {
							$rating = false;
						}
							
						$this->data['product_related'][] = array(
							'product_id' => $product_info['product_id'],
							'thumb'   	 => $image,
							'name'    	 => $product_info['name'],
							'price'   	 => $price,
							'special' 	 => $special,
							'rating'     => $rating,
							'reviews'    => sprintf($this->language->get('text_reviews'), (int)$product_info['reviews']),
							'href'    	 => $this->url->link('product/product', 'product_id=' . $product_info['product_id']),
						);
					}
				}
			}
			
			/*$this->data['breadcrumbs'][] = array(
				'text'      => $actions['caption'],
				'href'      => $this->url->link('information/actions', 'actions_id=' .  $actions_id),
				'separator' => $this->language->get('text_separator')
			);*/

			$this->data['text_relproduct_header'] = $this->language->get('text_relproduct_header');
			$this->data['text_special'] = $this->language->get('text_special');
			
			$this->data['special'] = $this->url->link('product/special');
			
			/* Add Document:Title  */
			if($actions['title']) {
				$this->document->setTitle($actions['title']);
			} else {
				$this->document->setTitle($actions['caption']);
			}
			/* Add Document:Link-Canonical */
			$this->document->addLink($this->url->link('information/actions','actions_id=' . $actions_id), 'canonical');
			
			/* Add Document:Meta-Description */
			if ($actions['meta_description']) {
				$this->document->setDescription($actions['meta_description']);
			}
			
			/* Add Document:Meta-Keywords */
			if ($actions['meta_keywords']) {
				$this->document->setKeywords($actions['meta_keywords']);
			}
			
			/* Add Document:H1 */
			if ($actions['h1']) {
				$this->data['h1'] = $actions['h1'];
			} else {
				$this->data['h1'] = $actions['caption'];
			}
			$this->data['caption']		= $actions['caption'];
			$this->data['actions_id']	= $actions['actions_id'];

    if($actions['interval'] != '' && $actions['interval'] != 0){
      $cur = getdate();
      $cur = $cur[0];

      $interval =  $actions['interval'] * 60 * 60; // интервал часы в секунды

      $start = $actions['date_start'];

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
      if ($actions['date_start'] != ''){
        $date_start = date( 'j', $actions['date_start'] ) . ' ' .$this->model_catalog_actions->getMonthName(date( 'n', $actions['date_start'] ));
      }	else {
        $date_start = null;
      }
      if($actions['date_end'] != ''){
        $date_end = date( 'j', $actions['date_end'] ) . ' ' . $this->model_catalog_actions->getMonthName(date( 'n', $actions['date_end'] ));
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

    $this->data['date'] = $date;

//			if ($actions_setting['show_actions_date'] == 1) {
//
//        if($actions['date_start'] != null){
//          $date_start = date( 'j', $actions['date_start'] ) . ' ' . $this->model_catalog_actions->getMonthName(date( 'n', $actions['date_start'] ));
//        } else {
//          $date_start = null;
//        }
//
//        if($actions['date_end'] != null){
//          $date_end = date( 'j', $actions['date_end'] ) . ' ' . $this->model_catalog_actions->getMonthName(date( 'n', $actions['date_end'] ));
//        } else {
//          $date_end = null;
//        }
//
//
//				$this->data['date']		= sprintf($this->language->get('date_actions_format'), $date_start, $date_end);
//			} else {
//				$this->data['date'] = NULL;
//			}

			$this->data['fancybox']		= $actions['fancybox'];
			
			/* Content Caching */
			$actions_content = $this->cache->get('actions_content.' . $this->config->get('config_language_id'). '.' . $actions['actions_id']);

			if ( !$actions_content ) {

				$this->data['content'] = html_entity_decode($actions['content'], ENT_QUOTES, 'UTF-8');
			
				/* BEGIN fancyBox robot */
				if ( $actions['fancybox'] ) {
					$this->load->model('tool/image');
				
					if ( preg_match_all("/<img .*? src=[\'\"](.*?)[\'\"].*?height: (\d{1,4})px.*?width: (\d{1,4})px.*?\/>/s", $this->data['content'], $img) ){
						for ($i = 0; $i < count($img[0]); $i++ ) {
							$this->model_tool_image->resize(str_replace(HTTP_IMAGE, '', $img[1][$i]), $img[3][$i],$img[2][$i] );
						}
					}
					
					$pattern = "/<img alt=[\'\"](.*?)[\'\"] src=[\'\"](.*?)[\'\"].*?\/>/s";
					
                            		if ( preg_match("/^1\.5\.2/", VERSION)  || preg_match("/^1\.5\.3/", VERSION) ) {
                                    		$replacement = '<a class="colorbox cboxElement" href="$2" rel="colorbox" title="$1">$0</a>';
                                    		$this->data['fancybox'] = 1;
                            		} else {
                                    		$replacement = '<a class="fancybox" href="$2" rel="fancybox" title="$1">$0</a>';
                                    		$this->data['fancybox'] = 2;
                            		}
					$this->data['content'] =  preg_replace($pattern, $replacement, $this->data['content']);

					$pattern = "/(<img .*?src=[\'\"])" . addcslashes(HTTP_IMAGE,'/.') . "(.*?)(\.png|\.jpg|\.gif|\.jpeg)([\'\"].*?height: (\d{1,4})px.*?width: (\d{1,4})px.*?\/>)/s";
					$replacement = '$1'.HTTP_IMAGE.'cache/$2-$6x$5$3$4';
					$this->data['content'] =  preg_replace($pattern, $replacement, $this->data['content']);
				} 
				/* END fancyBox robot */
				$this->cache->set('actions_content.' . $this->config->get('config_language_id'). '.' . $actions['actions_id'], $this->data['content']);
			} else {
				$this->data['content']  = $actions_content;
			}
			
			$this->data['button_cart'] = $this->language->get('button_cart');
			$this->data['button_continue'] = $this->language->get('button_all_actions');
			$this->data['continue'] = $this->url->link('information/actions');
	}
	
	/* Get actions list */
	public function getList() {
			$this->load->model('tool/image');
			
			$actions_setting = $this->config->get('actions_setting');
			
			$language_id = $this->config->get('config_language_id');

			$this->data['text_read_more'] = $this->language->get('text_read_more');
			
			$date_format = $this->language->get('date_long_format');
			
			/* Add Document:Title  */
			if( !empty($actions_setting['seo'][$language_id]['title']) ) {
				$this->document->setTitle($actions_setting['seo'][$language_id]['title']);
			} else {
				$this->document->setTitle($this->language->get('text_actions_title'));
			}
			/* Add Document:Link-Canonical */
			$this->document->addLink($this->url->link('information/actions'), 'canonical');
			
			/* Add Document:Meta-Description */
			if( !empty($actions_setting['seo'][$language_id]['description']) ) {
				$this->document->setDescription($actions_setting['seo'][$language_id]['description']);
			}
			/* Add Document:Meta-Keywords */
			if( !empty($actions_setting['seo'][$language_id]['keywords']) ) {
				$this->document->setKeywords($actions_setting['seo'][$language_id]['keywords']);
			}
			
			/* Add Document:H1 */
			if( !empty($actions_setting['seo'][$language_id]['h1']) ) {
				$this->data['h1'] = $actions_setting['seo'][$language_id]['h1'];
			} else {
				$this->data['h1'] = $this->language->get('text_actions');
			}
			
			
			if (isset($this->request->get['page'])) {
					$page = $this->request->get['page'];
			} else { 
					$page = 1;
			}
							
			if (isset($this->request->get['limit'])) {
					$limit = $this->request->get['limit'];
			} else {
					$limit = $actions_setting['actions_limit'];
			}
			
			$url = 'limit=' . $limit;

			$actions_total = $this->model_catalog_actions->getActionsTotal(); 
			
			$results = $this->model_catalog_actions->getActionsAll( ($page - 1) * $limit, $limit);
			
			$this->data['actions_all'] = array();
			
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
          //$stop = $start + ($interval - $past_interval);

          $count = floor($past_interval/$interval);

          if($count >= 1){
            $start = $start + ($interval * $count);
            $past_interval =  abs($cur - $start);

            $cur_t = new DateTime(date('Y-m-d'));
            $start_t = new DateTime(date('Y-m-d', $result['date_start']));
            $start_t = new DateTime($start_t->format('Y-m-d'));

            if($cur_t > $start_t) {
              $stop = ($start + ($interval - $past_interval)) - 3600;
            } else {
              $stop = ($start + ($interval - $past_interval));
            }

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

					if ($result['image'] AND $actions_setting['show_image']) {
            $image = $this->model_tool_image->crop($result['image'], 230, 230, 'center', '_actions_list');
          } else {
						$image = FALSE;
					}
					
//					if ($actions_setting['show_date']) {
//						$date = sprintf($this->language->get('date_actions_format'), $date_start, $date_end);
//					} else {
//						$date = FALSE;
//					}
					
					$this->data['actions_all'][] = array(
							'caption'		=> $result['caption'],
							'date_start'	=> $date_start, //date( $date_format, $result['date_start'] ),
							'date_end'		=> $date_end, //date( $date_format, $result['date_end'] ),
							'date'			=> $date,
							'thumb'			=> $image,
							'description'	=> html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'),
							'href'			=> $this->url->link('information/actions', 'actions_id=' . $result['actions_id'])
					);					
			}
			
			$this->data['limits'] = array();
			
			$this->data['limits'][] = array(
				'text'  => 5,
				'value' => 5,
				'href'  => $this->url->link('information/actions', 'limit=5')
			);

			$this->data['limits'][] = array(
				'text'  => 10,
				'value' => 10,
				'href'  => $this->url->link('information/actions', 'limit=10')
			);
			
			$this->data['limits'][] = array(
				'text'  => 15,
				'value' => 15,
				'href'  => $this->url->link('information/actions', 'limit=15')
			);
		
			$pagination = new Pagination();
			$pagination->total = $actions_total;
			$pagination->page = $page;
			$pagination->limit = $limit;
			$pagination->text = $this->language->get('text_pagination');
			$pagination->url = $this->url->link('information/actions', 'page={page}&limit=' .$limit);
		
			$this->data['pagination'] = $pagination->render();

			$this->data['limit'] = $limit;
	
	}
	
	public function info() {
		$this->load->model('catalog/actions');
		
		if (isset($this->request->get['actions_id'])) {
			$actions_id = $this->request->get['actions_id'];
		} else {
			$actions_id = 0;
		}      
		
		$actions_info = $this->model_catalog_actions->getActions($actions_id);

		if ($actions_info) {
			$output  = '<html dir="ltr" lang="en">' . "\n";
			$output .= '<head>' . "\n";
			$output .= '  <title>' . $actions_info['title'] . '</title>' . "\n";
			$output .= '  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">' . "\n";
			$output .= '</head>' . "\n";
			$output .= '<body>' . "\n";
			$output .= '  <br /><br /><h1>' . $actions_info['title'] . '</h1>' . "\n";
			$output .= html_entity_decode($actions_info['description'], ENT_QUOTES, 'UTF-8') . "\n";
			$output .= '  </body>' . "\n";
			$output .= '</html>' . "\n";

			$this->response->setOutput($output);
		}
	}
}
?>