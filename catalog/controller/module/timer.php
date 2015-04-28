<?php
class ControllerModuleTimer extends Controller {
	protected function index($setting) {
		$this->language->load('module/timer');
 
		$this->document->addScript('catalog/view/javascript/jquery/flipclock.min.js');
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . 'stylesheet/flipclock.css')) {
    		$this->document->addStyle(DIR_TEMPLATE . $this->config->get('config_template') . 'stylesheet/flipclock.css');
		}
		else {
    		$this->document->addStyle('catalog/view/theme/default/stylesheet/flipclock.css');
		}
		
      	$this->data['heading_title'] = $this->language->get('heading_title');

		$text = html_entity_decode($setting['description'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
		
		$template = new Template();

    $template->data['title'] = $setting['title'];
    $template->data['title_font_size'] = $setting['title_font_size'];

    $cur = getdate();
    $cur = $cur[0];

    $interval =  $setting['interval'] * 60 * 60;

    $str = $setting['date'].' '.$setting['time'];
    $start = strtotime($str);

    $past_interval =  $cur - $start;
    // 3600 корректировка на час (пока не выяснил почему так работает)
    $stop = ($start + ($interval - $past_interval)) - 3600;
    $stop_text = ($start + $interval) - 3600;

    //$count = floor($past_interval/$interval);
    if($interval - 86400 <= 0){$count = floor(abs($start - $cur)/($interval));} else {$count = floor(abs($start - $cur)/($interval - 86400));}


    if($count >= 1){


      if($interval - 86400 <= 0){$start = $start + (($interval) * $count);} else {$start = $start + (($interval - 86400) * $count);}
      $past_interval =  abs($cur - $start);

      $stop = ($start + ($interval - $past_interval)) - 3600;


      $stop_text = ($start + $interval) - 3600;
    }

    $template->data['start'] = $start;
    $template->data['stop'] = $stop;

    $search = mb_substr($this->rdate("d M", $stop_text), 0, 1, 'utf-8');
    if($search == 0){
      $replace = '';
      $template->data['date_stop'] = str_replace($search, $replace, $this->rdate("d M", $stop_text));
    } else {
      $template->data['date_stop'] = $this->rdate("d M", $stop_text);
    }

    //Images
    $this->load->model('tool/image');
    $template->data['image'] = $this->model_tool_image->resize($setting['image'], 100, 100);


    if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/timer_div.tpl')) {
			$timer_div = $template->fetch($this->config->get('config_template') . '/template/module/timer_div.tpl');
		} else {
			$timer_div = $template->fetch('default/template/module/timer_div.tpl');
		}

		$text = str_replace('[Timer]', $timer_div, $text);

		$this->data['text'] = $text;
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/timer.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/timer.tpl';
		} else {
			$this->template = 'default/template/module/timer.tpl';
		}
		$this->render();
	}

  protected function test($setting) {
    print_r($setting.'sds');
  }

  protected function rdate($param, $time=0) {
    if(intval($time)==0)$time=time();
    $MonthNames=array("Января", "Февраля", "Марта", "Апреля", "Мая", "Июня", "Июля", "Августа", "Сентября", "Октября", "Ноября", "Декабря");
    if(strpos($param,'M')===false) return date($param, $time);
    else return date(str_replace('M',$MonthNames[date('n',$time)-1],$param), $time);
  }
}
?>