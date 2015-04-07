<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  
  <?php if(isset($actions_id)) { ?>
  	<div id="actionsInfo" itemscope="" itemtype="http://schema.org/Article">
		<div class="actionsHeader"><h1 itemprop="headline"><?php echo $h1 ?></h1></div>
		<div class="actionsContent" itemprop="articleBody">
			<?php if(!empty($date)) { ?><div class="actionsDate"><?php echo $date; ?></div> <?php } ?>
			<div class="actionsDescription" itemprop="description"><?php echo $content; ?></div>
		</div>
	</div>
	<?php if( count($product_related) > 0) { ?>
	<div class="actionsRelHeader"><div class="left"><?php echo $text_relproduct_header; ?></div> <div class="right"><a href="<?php echo $special; ?>" title="<?php echo $text_special; ?>"><?php echo $text_special; ?></a></div></div>
	<div class="box-product actionsRelProducts">
      <?php foreach ($product_related as $product) { ?>
      <div>
        <?php if ($product['thumb']) { ?>
        <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a></div>
        <?php } ?>
        <div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
        <?php if ($product['price']) { ?>
        <div class="price">
          <?php if (!$product['special']) { ?>
          <?php echo $product['price']; ?>
          <?php } else { ?>
          <span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>
          <?php } ?>
        </div>
        <?php } ?>
        <?php if ($product['rating']) { ?>
        <div class="rating"><img src="catalog/view/theme/default/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
        <?php } ?>
        <div class="cart"><input type="button" value="<?php echo $button_cart; ?>" onclick="addToCart('<?php echo $product['product_id']; ?>');" class="button" /></div>
      </div>
      <?php } ?>
    </div>
	<?php } ?>

<?php if ($fancybox > 0) { ?>
<script type="text/javascript"><!--
$(document).ready(function() {
    if($('.colorbox').length) {
        $('.colorbox').colorbox({
                overlayClose: true,
                opacity: 0.5
        });
    }
});
//--></script>
<?php } ?>

  <?php } else {?>
  	
  <?php if ($actions_all) { ?>
  
<!--  <div class="product-filter">

    <div class="limit"><b><?php echo $text_limit; ?> </b>
      <select onchange="location = this.value;">
        <?php foreach ($limits as $limits) { ?>
        <?php if ($limits['value'] == $limit) { ?>
        <option value="<?php echo $limits['href']; ?>" selected="selected"><?php echo $limits['text']; ?></option>
        <?php } else { ?>
        <option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
        <?php } ?>
        <?php } ?>
      </select>
    </div>
  </div>
  <div>&nbsp;</div>
  -->
  <h1><?php echo $h1; ?></h1>
  <div id="actionsList">
  	<?php foreach ($actions_all as $actions) { ?>
 		<div itemscope="" itemtype="http://schema.org/Article">
      		<?php if ($actions['thumb']) { ?><div class="actionsImage"><a href="<?php echo $actions['href']; ?>"><img src="<?php echo $actions['thumb']; ?>" title="<?php echo $actions['caption']; ?>" alt="<?php echo $actions['caption']; ?>" itemprop="image" /></a></div><?php } ?>
	      		<div class="actionsHeader"><h1 itemprop="name"><a href="<?php echo $actions['href']; ?>"><?php echo $actions['caption']; ?></a></h1></div>
	      		<?php if ($actions['date']) { ?><div class="actionsDate"><?php echo $actions['date']; ?></div><?php } ?>
	      		<div class="actionsDescription" itemprop="description"><?php echo $actions['description']; ?></div>
	      	
      		<div class="actionsReadMore"><a href="<?php echo $actions['href']; ?>" title="<?php echo $actions['caption']; ?>"><?php echo $text_read_more; ?></a></div>
    	</div>
    <?php } ?>
    </div>
  
  <?php } ?>	
  <div class="pagination"><?php echo $pagination; ?></div>	
  <?php } ?>
  <?php echo $content_bottom; ?></div>
<?php echo $footer; ?>