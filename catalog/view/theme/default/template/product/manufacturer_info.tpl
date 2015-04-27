<?php echo $header; ?>
<div class="site-content inner-pages">
<?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>

<?php if ($products) { ?>
    <div class="top-sort cf">

    <h1><?php echo $heading_title; ?></h1>

    <div class="product-filter product-sorting">
        <div class="limit"><b><?php echo $text_limit; ?></b>
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
        <div class="sort"><b><?php echo $text_sort; ?></b>
            <select onchange="location = this.value;">
              <?php foreach ($sorts as $sorts) { ?>
              <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
                    <option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
                <?php } else { ?>
                    <option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
                <?php } ?>
              <?php } ?>
            </select>
        </div>
    </div>
  </div>

  <div class="product-list">
    <?php foreach ($products as $product) { ?>
    <div class="product-item">

      <?php if ($product['thumb']) { ?>
        <div class="box-img">
            <a href="<?php echo $product['href']; ?>">
                <img src="<?php echo $product['thumb']; ?>" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>" />
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

      <div class="actions">
          <div class="btn-cart-style" onclick="addToCart('<?php echo $product['product_id']; ?>');"><?php echo $button_cart; ?></div>
      </div>

    </div>
    <?php } ?>
  </div>
  <div class="pagination"><?php echo $pagination; ?></div>
  <?php if ($description) { ?>
  <div class="manufacturer-info"><?php echo $description; ?></div>
  <?php } ?>
  <?php } else { ?>
  <div class="content"><?php echo $text_empty; ?></div>
  <div class="buttons">
    <div class="right"><a href="<?php echo $continue; ?>" class="button"><?php echo $button_continue; ?></a></div>
  </div>
  <?php }?>
  <?php echo $content_bottom; ?></div>
    <script type="text/javascript"><!--
    function display(view) {
        if (view == 'list') {
            $('.product-grid').attr('class', 'product-list');

            $('.product-list > div.product-item').each(function(index, element) {

                html += '<div class="left">';

                var image = $(element).find('.box-img').html();

                if (image != null) {
                    html += '<div class="box-img">' + image + '<div class="statuses">' + $(element).find('.statuses').html() + '</div></div>';
                }

                html += '  <div class="name">' + $(element).find('.name').html() + '</div>';

                var price = $(element).find('.price').html();

                if (price != null) {
                    html += '<div class="price">' + price  + '</div>';
                }

                var params = $(element).find('.params').html();

                if (params != null) {
                    html += '<div class="params">' + params  + '</div>';
                }

                html += '</div>';

                $(element).html(html);
            });

            $.totalStorage('display', 'list');

            $('.product-status img').tooltipster({
                position: 'left'
            });

        } else {
            $('.product-list').attr('class', 'product-grid');

            $('.product-grid > div.product-item').each(function(index, element) {
                html = '';

                var image = $(element).find('.box-img').html();

                if (image != null) {
                    html += '<div class="box-img">' + image + '<div class="statuses">' + $(element).find('.statuses').html() + '</div></div>';
                }

                html += '<div class="name">' + $(element).find('.name').html() + '</div>';


                var params = $(element).find('.params').html();

                if (params != null) {
                    html += '<div class="params">' + params  + '</div>';
                }

                var price = $(element).find('.price').html();

                if (price != null) {
                    html += '<div class="price">' + price  + '</div>';
                }

                html += '<div class="actions">' + $(element).find('.actions').html() + '</div>';

                $(element).html(html);
            });

            $.totalStorage('display', 'grid');

            $('.product-status img').tooltipster({
                position: 'left'
            });
        }
    }

    view = $.totalStorage('display');

    if (view) {
        //display(view);
    } else {
        //display('list');
    }

    //--></script>
    </div>
<?php echo $footer; ?>