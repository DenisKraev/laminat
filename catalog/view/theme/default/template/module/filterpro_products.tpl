<?php foreach ($products as $product) { ?>
<div class="product-item">

  <?php if ($product['thumb']) { ?>
  <div class="box-img">
      <a href="<?php echo $product['href']; ?>">
          <img src="<?php echo $product['thumb']; ?>" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>" />
      </a>
      <div class="statuses"><?php echo $product['statuses']['category']; ?></div>
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

  <div class="actions">
      <div class="btn-cart-style" onclick="addToCart('<?php echo $product['product_id']; ?>');"><?php echo $button_cart; ?></div>

      <?php if ($product['quantity'] > 0) { ?>
        <a onclick="AjaxCheckoutOcjoy('<?php echo $product['product_id']; ?>', false);" class="ajaxbutton button btn-style"><?php echo $ajaxbutton_cart; ?></a>
      <?php } ?>
  </div>

</div>
<?php } ?>