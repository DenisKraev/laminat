<div class="box-total">
  <?php foreach ($totals as $total) { ?>
    <?php if($total['code'] == 'total'){ ?>
      <div class="item">
        <span class="name">Итого к оплате: </span>
        <span class="value"><?php echo $total['text']; ?></span>
      </div>
    <?php } ?>
  <?php } ?>
</div>
