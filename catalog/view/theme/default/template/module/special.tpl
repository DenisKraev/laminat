<div class="box-sale site-content">

  <div class="top cf">
      <h3 class="title-style">Распродажа</h3>
      <div class="nav-slider"><div class="prev"></div><div class="next"></div></div>
  </div>

  <div class="product-list">

    <?php foreach ($products as $product) { ?>
      <div class="product-item">

        <?php if ($product['thumb']) { ?>
          <a class="box-img" href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a>
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

        <div class="actions"><div class="btn-cart-style" onclick="addToCart('<?php echo $product['product_id']; ?>');"><?php echo $button_cart; ?></div></div>
      </div>
    <?php } ?>
  </div>

</div>