<?php echo $header; ?>
<style>
.list tbody td {
	vertical-align: top;
}
span.cke_skin_kama {
	width: 350px;
}
</style>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/banner.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="form">
          <tr>
            <td><span class="required">*</span> <?php echo $entry_name; ?></td>
            <td><input type="text" name="name" value="<?php echo $name; ?>" size="100" />
              <?php if ($error_name) { ?>
              <span class="error"><?php echo $error_name; ?></span>
              <?php } ?></td>
          </tr>
          <tr>
            <td><?php echo $entry_status; ?></td>
            <td><select name="status">
                <?php if ($status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>
          </tr>
        </table>
        <table id="images" class="list">
          <thead>
            <tr>
              <td class="left"><?php echo $entry_title; ?></td>
              <td class="left"><?php echo $entry_subtitle; ?></td>
              <td class="left"><?php echo $entry_link; ?></td>
              <td>Цвет фона слайда</td>
              <td class="left"><?php echo $entry_image; ?></td>
              <td class="left"><?php echo $entry_sort_order; ?></td>
              <td></td>
            </tr>
          </thead>
          <?php $image_row = 0; ?>
          <?php foreach ($slider_images as $slider_image) { ?>
          <tbody id="image-row<?php echo $image_row; ?>">
            <tr>
              <td class="left"><?php foreach ($languages as $language) { ?>
				<img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><br />
                <input type="text" name="coin_slider_image[<?php echo $image_row; ?>][coin_slider_image_description][<?php echo $language['language_id']; ?>][title]" value="<?php echo isset($slider_image['coin_slider_image_description'][$language['language_id']]) ? $slider_image['coin_slider_image_description'][$language['language_id']]['title'] : ''; ?>" /><br />
                <?php if (isset($error_slider_image[$image_row][$language['language_id']])) { ?>
                <span class="error"><?php echo $error_slider_image[$image_row][$language['language_id']]; ?></span>
                <?php } ?>
                <?php } ?></td>
			  <td class="left">
				<?php foreach ($languages as $language) { ?>
<img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><br />
            <textarea id="coin_slider_image[<?php echo $image_row; ?>][coin_slider_image_description][<?php echo $language['language_id']; ?>][subtitle]" name="coin_slider_image[<?php echo $image_row; ?>][coin_slider_image_description][<?php echo $language['language_id']; ?>][subtitle]"><?php echo isset($slider_image['coin_slider_image_description'][$language['language_id']]) ? $slider_image['coin_slider_image_description'][$language['language_id']]['subtitle'] : ''; ?></textarea><br />
				<?php } ?>
			</td>
              <td class="left"><input type="text" name="coin_slider_image[<?php echo $image_row; ?>][link]" value="<?php echo $slider_image['link']; ?>" /></td>

                <td class="left">#<input type="text" name="coin_slider_image[<?php echo $image_row; ?>][slide_background_color]" value="<?php echo $slider_image['slide_background_color']; ?>" size="6" maxlength="6" /></td>

                <td class="left">
                    <div class="image">
                        <img src="<?php echo $slider_image['thumb']; ?>" alt="" id="thumb<?php echo $image_row; ?>" />
                        <input type="hidden" name="coin_slider_image[<?php echo $image_row; ?>][image]" value="<?php echo $slider_image['image']; ?>" id="image<?php echo $image_row; ?>"  />
                        <br />
                        <a onclick="image_upload('image<?php echo $image_row; ?>', 'thumb<?php echo $image_row; ?>');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb<?php echo $image_row; ?>').attr('src', '<?php echo $no_image; ?>'); $('#image<?php echo $image_row; ?>').attr('value', '');"><?php echo $text_clear; ?></a>
                    </div>
                </td>
			      <td>
            <input type="text" name="coin_slider_image[<?php echo $image_row; ?>][sort_order]" value="<?php echo $slider_image['sort_order']; ?>" size="2" maxlength="2" /></td>
              <td class="left"><a onclick="$('#image-row<?php echo $image_row; ?>').remove();" class="button"><?php echo $button_remove; ?></a></td>
            </tr>
          </tbody>
          <?php $image_row++; ?>
          <?php } ?>
          <tfoot>
            <tr>
              <td colspan="5"></td>
              <td class="left"><a onclick="addImage();" class="button"><?php echo $button_add_slider; ?></a></td>
            </tr>
          </tfoot>
        </table>
		<?php if (!empty($back_to_module)) { ?>
			<input type="hidden" name="back_to_module" value="1">
		<?php } ?>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script>
<script type="text/javascript"><!--
<?php for($i=0; $i<$image_row; $i++) { ?>
	<?php foreach ($languages as $language) { ?>
		CKEDITOR.replace(
            'coin_slider_image[<?php echo $i; ?>][coin_slider_image_description][<?php echo $language['language_id']; ?>][subtitle]'
    );
	<?php } ?>
<?php } ?>
//--></script>
<script type="text/javascript"><!--
var image_row = <?php echo $image_row; ?>;

function addImage() {
    html  = '<tbody id="image-row' + image_row + '">';
	html += '<tr>';
    html += '<td class="left">';
	<?php foreach ($languages as $language) { ?>
	html += '<img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><br /><input type="text" name="coin_slider_image[' + image_row + '][coin_slider_image_description][<?php echo $language['language_id']; ?>][title]" value="" /><br />';
    <?php } ?>
	html += '</td>';

	html += '<td>';
	<?php foreach ($languages as $language) { ?>
	html += '<img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><br /><textarea name="coin_slider_image[' + image_row + '][coin_slider_image_description][<?php echo $language['language_id']; ?>][subtitle]"></textarea><br>';
    <?php } ?>
	html += '</td>';

	html += '<td class="left"><input type="text" name="coin_slider_image[' + image_row + '][link]" value="" /></td>';	

  html += ' <td class="left">#<input type="text" name="coin_slider_image['+ image_row +'][slide_background_color]" value="" size="6" maxlength="6" /></td>';

  html += '<td class="left"><div class="image"><img src="<?php echo $no_image; ?>" alt="" id="thumb' + image_row + '" /><input type="hidden" name="coin_slider_image[' + image_row + '][image]" value="" id="image' + image_row + '" /><br /><a onclick="image_upload(\'image' + image_row + '\', \'thumb' + image_row + '\');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$(\'#thumb' + image_row + '\').attr(\'src\', \'<?php echo $no_image; ?>\'); $(\'#image' + image_row + '\').attr(\'value\', \'\');"><?php echo $text_clear; ?></a></div></td>';

	html += '<td><input type="text" name="coin_slider_image[' + image_row + '][sort_order]" value="" size="2" maxlength="2" /></td>';

	html += '<td class="left"><a onclick="$(\'#image-row' + image_row  + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
	html += '</tr>';
	html += '</tbody>'; 
	
	$('#images tfoot').before(html);

	<?php foreach ($languages as $language) { ?>
	CKEDITOR.replace('coin_slider_image[' + image_row + '][coin_slider_image_description][<?php echo $language['language_id']; ?>][subtitle]');


	<?php } ?>

    $('input[name="text_color"], input[name="coin_slider_image[' + image_row + '][slide_background_color]"]').ColorPicker({
        onSubmit: function(hsb, hex, rgb, el) {
            $(el).val(hex);
            $(el).ColorPickerHide();
        },
        onBeforeShow: function () {
            $(this).ColorPickerSetColor(this.value);
        }
    })
            .bind('keyup', function(){
                $(this).ColorPickerSetColor(this.value);
            });

	image_row++;
}
//--></script>
<script type="text/javascript"><!--
function image_upload(field, thumb) {
	$('#dialog').remove();
	
	$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
	
	$('#dialog').dialog({
		title: '<?php echo $text_image_manager; ?>',
		close: function (event, ui) {
			if ($('#' + field).attr('value')) {
				$.ajax({
					url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>&image=' + encodeURIComponent($('#' + field).attr('value')),
					dataType: 'text',
					success: function(data) {
						$('#' + thumb).replaceWith('<img src="' + data + '" alt="" id="' + thumb + '" />');
					}
				});
			}
		},	
		bgiframe: false,
		width: 800,
		height: 400,
		resizable: false,
		modal: false
	});
};
//--></script>
<script type="text/javascript"><!--
$('.digits').keydown(function(event){
	if (event.keyCode == 38) {
		var _val = parseInt($(this).val()) + 1;
		$(this).val(_val);
	}
	
	if (event.keyCode == 40) {
		var _val = parseInt($(this).val()) - 1;
		if (_val < 0) _val = 0;
		$(this).val(_val);
	}
});
$('.digits').keypress(function(event){
	if (event.which < 48 || event.which > 57) {
		return false;
	}
});
$('input[name="opacity"]').keypress(function(event){
	if (event.which == 46) {	
		return true;
	}
	
	if (event.which < 48 || event.which > 57) {
		return false;
	}
});
$('input[name="opacity"]').keyup(function(){
	var opacity_val = parseFloat($(this).val(), 10);
	if (opacity_val > 1.0) {
		$(this).val('1.0');
	}
});
//--></script>
<link rel="stylesheet" media="screen" type="text/css" href="/admin/view/javascript/jquery/colorpicker/css/colorpicker.css" />
<script type="text/javascript" src="/admin/view/javascript/jquery/colorpicker/js/colorpicker.js"></script>
<script type="text/javascript"><!--
$(document).ready(function(){
<?php for($i=0; $i<$image_row; $i++) { ?>
    $('input[name="text_color"], input[name="coin_slider_image[<?php echo $i; ?>][slide_background_color]"]').ColorPicker({
        onSubmit: function(hsb, hex, rgb, el) {
            $(el).val(hex);
            $(el).ColorPickerHide();
        },
        onBeforeShow: function () {
            $(this).ColorPickerSetColor(this.value);
        }
    })
            .bind('keyup', function(){
                $(this).ColorPickerSetColor(this.value);
            });
  <?php } ?>

});
//--></script>
<?php echo $footer; ?>
