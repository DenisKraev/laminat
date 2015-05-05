<?php
$this->load->model('catalog/actions');
$actions_setting = $this->config->get('actions_setting');

$results = $this->model_catalog_actions->getActionsAll(0, 100);

$actionsArr = array();
foreach($results as $result) {
  $products = explode(',', $result['product_related']);
  if (in_array($this->request->get['product_id'], $products)){

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

    $actionsArr[] = array(
      'caption' => $result['caption'],
      'date' => $date,
      'href' => $this->url->link('information/actions', 'actions_id=' . $result['actions_id']),
    );
  }
}
?>

<div class="box-product-actions">
    <?php foreach($actionsArr as $action){ ?>
      <div class="item">
          <div class="mark btn-style">Акция</div>
          <div class="name"><?php echo $action['caption']; ?></div>
          <div class="interval"><?php echo $action['date']; ?></div>
          <div class="more"><a href="<?php echo $action['href']; ?>">Подробнее</a></div>
      </div>
    <?php } ?>
</div>