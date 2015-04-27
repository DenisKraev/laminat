<?php
function renderCategoriesTree($tree, $filter_category_id) {
  if (empty($tree['items'])) return;
  foreach ($tree['items'] as $item) {
    $selected = ($item['category_id'] == $filter_category_id) ? 'selected=selected' : '';
    echo "<option ".$selected." value='".$item['category_id']."'>".$item['tab'].$item['name']."</option>";

    foreach ($item['items'] as $data) {
      $selected = ($data['category_id'] == $filter_category_id) ? 'selected=selected' : '';
      echo "<option ".$selected." value='".$data['category_id']."'>".$data['tab'].$data['name']."</option>";
      renderCategoriesTree($data, $filter_category_id);
    }
  }
}
?>

<?php echo $header; ?>
<div class="site-content inner-pages page-search">

<?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>

  <h1 class="title-style"><?php echo $heading_title; ?></h1>

  <div class="content search-panel">

    <div class="search-field ib">
      <?php if ($search) { ?>
        <input type="text" class="style-form-text" name="search" size="50" value="<?php echo $search; ?>" />
      <?php } else { ?>
        <input type="text" class="style-form-text" name="search" size="50" value="<?php echo $search; ?>" onclick="this.value = '';" onkeydown="this.style.color = '000000'" style="color: #999;" />
      <?php } ?>
    </div>

    <select name="filter_category_id"  class="style-form-select">
      <option value='0'>Все категории</option>
      <?php echo renderCategoriesTree($categories, $filter_category_id) ?>
    </select>

    <input type="button" value="<?php echo $button_search; ?>" id="button-search" class="button btn-style volume" />

    <div class="bottom">
      <div class="sub-cat ib">
        <?php if ($sub_category) { ?>
          <input type="checkbox" class="style-form-checkbox" name="sub_category" value="1" id="sub_category" checked="checked" />
        <?php } else { ?>
          <input type="checkbox" class="style-form-checkbox" name="sub_category" value="1" id="sub_category" />
        <?php } ?>
        <label class="style-form-label" for="sub_category"><?php echo $text_sub_category; ?></label>
      </div>

      <div class="desc ib"></div>
        <?php if ($description) { ?>
          <input type="checkbox" class="style-form-checkbox" name="description" value="1" id="description" checked="checked" />
        <?php } else { ?>
          <input type="checkbox" class="style-form-checkbox" name="description" value="1" id="description" />
        <?php } ?>
        <label class="style-form-label" for="description"><?php echo $entry_description; ?></label>
      </div>
    </div>
  </div>



  <?php if ($products) { ?>
    <div class="top-sort cf">

      <h2><?php echo $text_search; ?></h2>

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

  <div class="product-list list">
    <?php foreach ($products as $product) { ?>
    <div class="product-item">

      <?php if ($product['thumb']) { ?>
        <div class="image box-img"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>" /></a></div>
      <?php } ?>

      <div class="box-name-params">
        <div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>

        <div class="params">
          <?php if (!empty($product['attribute_data']['text'])) {  ?>
            <span><?php echo $product['attribute_data']['text'] ?> <?php echo $product['attribute_data']['name'] ?>, </span>
          <?php } ?>
          <?php if($product['art']){ ?>
            <span>арт. <?php echo $product['art']; ?></span>
          <?php } ?>
        </div>
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

      <div class="cart actions">
          <input type="button" value="<?php echo $button_cart; ?>" onclick="addToCart('<?php echo $product['product_id']; ?>');" class="button btn-cart-style" />

        <?php if ($product['quantity'] > 0) { ?>
          <a onclick="AjaxCheckoutOcjoy('<?php echo $product['product_id']; ?>', false);" class="btn-style ajaxbutton button"><?php echo $ajaxbutton_cart; ?></a>
        <?php } ?>
      </div>

    </div>
    <?php } ?>

  </div>

  <div class="pagination"><?php echo $pagination; ?></div>
  <?php } else { ?>
  <div class="content"><?php echo $text_empty; ?></div>
  <?php }?>

  <?php echo $content_bottom; ?>

</div>

<script type="text/javascript"><!--
$('#content input[name=\'search\']').keydown(function(e) {
	if (e.keyCode == 13) {
		$('#button-search').trigger('click');
	}
});

$('select[name=\'filter_category_id\']').bind('change', function() {
	if (this.value == '0') {
		$('input[name=\'sub_category\']').attr('disabled', 'disabled');
		$('input[name=\'sub_category\']').removeAttr('checked');
	} else {
		$('input[name=\'sub_category\']').removeAttr('disabled');
	}
});

$('select[name=\'filter_category_id\']').trigger('change');

$('#button-search').bind('click', function() {
	url = 'index.php?route=product/search';
	
	var search = $('#content input[name=\'search\']').attr('value');
	
	if (search) {
		url += '&search=' + encodeURIComponent(search);
	}

	var filter_category_id = $('#content select[name=\'filter_category_id\']').attr('value');
	
	if (filter_category_id > 0) {
		url += '&filter_category_id=' + encodeURIComponent(filter_category_id);
	}
	
	var sub_category = $('#content input[name=\'sub_category\']:checked').attr('value');
	
	if (sub_category) {
		url += '&sub_category=true';
	}
		
	var filter_description = $('#content input[name=\'description\']:checked').attr('value');
	
	if (filter_description) {
		url += '&description=true';
	}

	location = url;
});

function display() {
		
		$('.product-list > div').each(function(index, element) {
			html = '';
			
			var image = $(element).find('.image').html();
			
			if (image != null) {
				html += '<div class="image">' + image + '</div>';
			}
			
			html += '<div class="name">' + $(element).find('.name').html() + '</div>';

			var price = $(element).find('.price').html();
			
			if (price != null) {
				html += '<div class="price">' + price  + '</div>';
			}

      var params = $(element).find('.params').html();

      if (params != null) {
          html += '<div class="params">' + params  + '</div>';
      }
						
			html += '<div class="cart">' + $(element).find('.cart').html() + '</div>';
			
			$(element).html(html);
		});	
					
		$('.display').html('<b><?php echo $text_display; ?></b> <a onclick="display(\'list\');"><?php echo $text_list; ?></a> <b>/</b> <?php echo $text_grid; ?>');

	}

//display();

//--></script>
</div>
<?php echo $footer; ?>