<?php echo $header; ?>
<div class="site-content inner-pages page-actions">
<?php echo $column_left; ?>
  <?php echo $column_right; ?>

<div id="content">
  <?php echo $content_top; ?>

  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  
  <?php if(isset($actions_id)) { ?>
  	<div class="action-single">
      <h1 class="title-style border-bottom"><?php echo $h1 ?></h1>
      <?php if(!empty($date)) { ?><div class="date"><?php echo $date; ?></div> <?php } ?>
      <div class="description"><?php echo $content; ?></div>
    </div>

    <?php if( count($product_related) > 0) { ?>

    <div class="action-product-related">

      <div class="top cf">
          <div class="title-style left"><?php echo $text_relproduct_header; ?></div>
          <div class="right"><a href="<?php echo $special; ?>" title="<?php echo $text_special; ?>"><?php echo $text_special; ?></a></div>
      </div>

      <div class="product-list">
        <?php foreach ($product_related as $product) { ?>
          <div class="product-item">

            <?php if ($product['thumb']) { ?>
            <div class="image box-img">
              <a href="<?php echo $product['href']; ?>">
                  <img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" />
              </a>
              <div class="statuses"><?php echo $product['statuses']; ?></div>
            </div>
            <?php } ?>

            <div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>

            <div class="params">
              <?php if (!empty($product['attribute_data']['text'])) {  ?>
                <span><?php echo $product['attribute_data']['text'] ?> <?php echo $product['attribute_data']['name'] ?>, </span>
              <?php } ?>
              <?php if($product['art']){ ?>
                <span>арт. <?php echo $product['art']; ?></span>
              <?php } ?>
            </div>

            <?php if ($product['price']) { ?>
            <div class="price">
              <?php if (!$product['special']) { ?>
              <?php echo $product['price']; ?>
              <?php } else { ?>
              <span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>
              <?php } ?>
            </div>
            <?php } ?>

            <div class="cart actions"><input type="button" value="<?php echo $button_cart; ?>" onclick="addToCart('<?php echo $product['product_id']; ?>');" class="button btn-cart-style" /></div>
          </div>
        <?php } ?>
      </div>
    </div>
    <?php } ?>

  <?php } else { ?>
  	
    <?php if ($actions_all) { ?>

      <h1 class="title-style border-bottom"><?php echo $h1; ?></h1>

      <div id="actionsList" class="actions-list">
        <?php foreach ($actions_all as $actions) { ?>

          <div class="item">

            <?php if ($actions['thumb']) { ?>
              <div class="box-image cell">
                <a href="<?php echo $actions['href']; ?>"><img src="<?php echo $actions['thumb']; ?>" title="<?php echo $actions['caption']; ?>" alt="<?php echo $actions['caption']; ?>" itemprop="image" /></a>
              </div>
            <?php } ?>

            <div class="info cell">
              <h3 class="name"><a href="<?php echo $actions['href']; ?>"><?php echo $actions['caption']; ?></a></h3>
              <?php if ($actions['date']) { ?><div class="date"><?php echo $actions['date']; ?></div><?php } ?>
              <div class="description" ><?php echo $actions['description']; ?></div>
              <div class="more"><a href="<?php echo $actions['href']; ?>" class="btn-style" title="<?php echo $actions['caption']; ?>">Подробнее</a></div>
            </div>

          </div>

        <?php } ?>
      </div>

    <?php } ?>

    <div class="pagination"><?php echo $pagination; ?></div>
  <?php } ?>

  <?php echo $content_bottom; ?></div>
</div>
<?php echo $footer; ?>