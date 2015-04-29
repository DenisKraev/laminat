<?php echo $header; ?>
<div class="site-content inner-pages">
<?php echo $column_left; ?>
<?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>

  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>

  <h1 class="title-style border-bottom"><?php echo $heading_title; ?></h1>

  <div class="box-contacts cf">
    <div id="map-contact" class="box-map"></div>
    <div class="text"><?php echo $description; ?></div>
  </div>

  <?php echo $content_bottom; ?>
</div>
</div>
<?php echo $footer; ?>