<?php echo $header; ?>
<div class="site-content inner-pages">
<?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <h1 class="title-style"><?php echo $heading_title; ?></h1>
  <p>Ваш заказ успешно создан!</p>
  <p>Спасибо за покупки в нашем интернет-магазине!</p>
  <div class="buttons">
    <div class="right"><a href="<?php echo $continue; ?>" class="button btn-style"><?php echo $button_continue; ?></a></div>
  </div>
  <?php echo $content_bottom; ?></div>
</div>
<?php echo $footer; ?>