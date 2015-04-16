<div class="product-filter">
	<div class="limit"><b><?php echo $text_limit; ?></b>
		<select onchange="location = this.value;">
			<?php foreach($limits as $limits) { ?>
			<?php if($limits['value'] == $limit) { ?>
				<option value="<?php echo $limits['href']; ?>" selected="selected"><?php echo $limits['text']; ?></option>
				<?php } else { ?>
				<option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
				<?php } ?>
			<?php } ?>
		</select>
	</div>
	<div class="sort"><b><?php echo $text_sort; ?></b>
		<select onchange="location = this.value;">
			<?php foreach($sorts as $sorts) { ?>
			<?php if($sorts['value'] == $sort . '-' . $order) { ?>
				<option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
				<?php } else { ?>
				<option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
				<?php } ?>
			<?php } ?>
		</select>
	</div>
</div>
<div class="product-list">

</div>
<div class="pagination"></div>
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

      var params = $(element).find('.params').html();

      if (params != null) {
          html += '<div class="params">' + params  + '</div>';
      }

			var price = $(element).find('.price').html();
			
			if (price != null) {
				html += '<div class="price">' + price  + '</div>';
			}

			html += '</div>';
						
			$(element).html(html);
		});		
		
		$('.display').html('<b><?php echo $text_display; ?></b> <?php echo $text_list; ?> <b>/</b> <a onclick="display(\'grid\');"><?php echo $text_grid; ?></a>');
		
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
					
		$('.display').html('<b><?php echo $text_display; ?></b> <a onclick="display(\'list\');"><?php echo $text_list; ?></a> <b>/</b> <?php echo $text_grid; ?>');
		
		$.totalStorage('display', 'grid');

    $('.product-status img').tooltipster({
        position: 'left'
    });
  }
}

view = $.totalStorage('display');

if (view) {
	display(view);
} else {
	display('list');
}
//--></script> 
