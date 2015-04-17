<script type="text/javascript">
function checkout() {
    $('#gotoorderajax').attr("disabled", true);
    $.ajax({
        type: 'POST',
        url: 'index.php?route=checkout/ocjoyajaxcheckout/simpleorder',
        dataType: 'json',
        data: $('#ajaxorder input[type=\'text\'], #ajaxorder textarea, #ajaxorder input[type=\'hidden\'], #ajaxorder select, #ajaxorder input[type=\'radio\']:checked, #ajaxorder input[type=\'checkbox\']:checked'),
        success: function(json) {
            if (json['error']){
                  $("#gotoorderajax").bind("click", function () {
                    $("#cboxContent").mask("<?php echo $text_ocjoyajaxcheckout_loading; ?>");
                  });
                  //$(this).colorbox.resize();
                  if (json['error']['firstname']) {
                    $('#error_firstname').show().html(json['error']['firstname']);
                    $("#cboxContent").unmask();
                  } else {
                    $('#error_firstname').hide();
                  };
                  if (json['error']['telephone']) {
                    $('#error_telephone').show().html(json['error']['telephone']);
                    $("#cboxContent").unmask();
                  } else {
                    $('#error_telephone').hide();
                  };
                  if (json['error']['email']) {
                    $('#error_email').show().html(json['error']['email']);
                    $("#cboxContent").unmask();
                  } else {
                    $('#error_email').hide();
                  };
                  //$(this).colorbox.resize();
                  $('#gotoorderajax').attr("disabled", false);
            } else {
                if (json['output']) {
                  $("#cboxContent").unmask();
                  $('#ajaxordermainbody').html('<div id="ocjoyajaxcheckoutsuccess">'+json['output']+'</div>');
                  //$(this).colorbox.resize();
                }
            }
        }
    });
}
function validate(input) {
  input.value = input.value.replace(/[^\d,]/g, '');
}
function getIamge(id) {
  $("#currentimg").attr("src", $(id).attr("rel"));
  return false;
}
function pluscon(pid) {
  qua = parseInt($("#quant-"+pid).val())+1;
  $("#quant-"+pid).val(qua);
  $.ajax({
    url: 'index.php?route=checkout/ocjoyajaxcheckout/calc&product_id='+pid+'&qty='+qua,
    type: 'post',
    dataType: 'json',
    data: $('#ajaxorder input[type=\'text\'], #ajaxorder  input[type=\'hidden\'], #ajaxorder  input[type=\'radio\']:checked, #ajaxorder  input[type=\'checkbox\']:checked, #ajaxorder  select, #ajaxorder textarea'),
    success:function(json) {
        $("#oldprice").html(json['price']);
        $("#newprice").html(json['special']);
      } 
  });
}
function ups() { 
  $.ajax({
    url: 'index.php?route=checkout/ocjoyajaxcheckout/calc',
    type: 'post',
    dataType: 'json',
    data: $('#ajaxorder input[type=\'text\'], #ajaxorder  input[type=\'hidden\'], #ajaxorder  input[type=\'radio\']:checked, #ajaxorder  input[type=\'checkbox\']:checked, #ajaxorder  select, #ajaxorder textarea'),
    success:function(json) {
        $("#oldprice").html(json['price']);
        $("#newprice").html(json['special']);
      } 
  });
}
function minuscon(pid) {
  if (parseInt($("#quant-"+pid).val())>1) {
    qua = parseInt($("#quant-"+pid).val())-1;
 $("#quant-"+pid).val(qua);
    $.ajax({
      url: 'index.php?route=checkout/ocjoyajaxcheckout/calc&product_id='+pid+'&qty='+qua,
      type: 'post',
      dataType: 'json',
      data: $('#ajaxorder input[type=\'text\'], #ajaxorder  input[type=\'hidden\'], #ajaxorder  input[type=\'radio\']:checked, #ajaxorder  input[type=\'checkbox\']:checked, #ajaxorder  select, #ajaxorder textarea'),
      success:function(json) {
        $("#oldprice").html(json['price']);
        $("#newprice").html(json['special']);
      } 
    });
  }
}
</script>
<div id="ajaxorder">
<div id="ocjoyajaxcheckout" class="modal-header"><?php echo $text_ocjoyajaxcheckout_head; ?></div>

  <form enctype="multipart/form-data" method="post">
    <div class="box-product-info cf">
        <div class="left">
            <div class="box-img"><img src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" id="currentimg"/></div>
        </div>
        <div class="right">
            <div class="top">
                <div class="name"><?php echo $heading_title; ?></div>
                <div class="params">
                  <?php if (!empty($attribute_data_name)) {  ?>
                    <span><?php echo $attribute_data_text ?> класс, </span>
                  <?php } ?>
                  <?php if($art){ ?>
                    <span>арт. <?php echo $art; ?></span>
                  <?php } ?>
                </div>
            </div>
            <div class="count">Кол-во: <span>1</span></div>
            <div class="price">Итого: <span><?php if ($special) {echo $special;} else { echo $price; }?></span></div>
        </div>
    </div>

    <?php if ($hidefio == 1) { ?>
      <?php if ($required_fio == 1) { ?>
      <div class="sections_block_rquaired form-row">
        <div class="icon-user">
          <input type="text" name="firstname" class="ajaxorderinputsnorequired style-form-text" placeholder="<?php echo $text_ocjoyajaxcheckout_entername; ?>"/>
        </div>
        <div id="error_firstname" class="ocjoyajaxcheckout_errorfields"></div>
      </div>
      <?php } else { ?>
      <div class="sections_block form-row">
        <div class="icon-user">
          <input type="text" name="firstname" class="ajaxorderinputs style-form-text" placeholder="<?php echo $text_ocjoyajaxcheckout_entername; ?>"/>
        </div>
      </div>
      <?php } ?>
    <?php } ?>

    <?php if ($hidetelephone == 1) { ?>
    <?php if ($required_telephone == 1) { ?>
          <div class="sections_block_rquaired form-row">
              <div class="icon-phone">
                <input type="text" name="telephone" class="ajaxorderinputsnorequired style-form-text" id="fortelephonemask" placeholder="<?php echo $text_ocjoyajaxcheckout_entertelephone; ?>"/>
              </div>
              <div id="error_telephone" class="ocjoyajaxcheckout_errorfields"></div>
          </div>
      <?php } else { ?>
          <div class="sections_block form-row">
              <div class="icon-phone">
                <input type="text" name="telephone" class="ajaxorderinputs style-form-text" id="fortelephonemask" placeholder="<?php echo $text_ocjoyajaxcheckout_entertelephone; ?>"/>
              </div>
          </div>
      <?php } ?>
    <?php } ?>

    <?php if ($hideemail == 1) { ?>
      <?php if ($required_email == 1) { ?>
      <div class="sections_block_rquaired">
        <i class="icon-append_1 icon-envelope-alt"></i>
        <input type="text" name="email" class="ajaxorderinputsnorequired" placeholder="<?php echo $text_ocjoyajaxcheckout_enteremail; ?>"/>
        <div id="error_email" class="ocjoyajaxcheckout_errorfields"></div>
      </div>
      <?php } else { ?>
      <div class="sections_block">
        <i class="icon-append_1 icon-envelope-alt"></i>
        <input type="text" name="email" class="ajaxorderinputs" placeholder="<?php echo $text_ocjoyajaxcheckout_enteremail; ?>"/>
      </div>
      <?php } ?>
    <?php } ?>

    <input class="hide" type="text" name="quantity" id="quant-<?php echo $product_id; ?>" size="3" maxlength="3" disabled="disabled" value="1" />

    <?php if ($hidedescription == 1) { ?>
        <textarea name="description" class="ajaxorderinputs" placeholder="<?php echo $text_ocjoyajaxcheckout_enterdescription; ?>"></textarea>
    <?php } ?>
      <input name="product_id" value="<?php echo $product_id ?>" type="hidden" />
    <?php if ($hidepayment == 1) { ?>
      <div class="pay_ship_block">
        <div class="fieldname"><?php echo $text_ocjoyajaxcheckout_selectpayment; ?>: <?php if($config_info_payment == 1) { ?><a class="faqinfo" faq="<?php echo $info_payment_text; ?>">[?]</a><?php } ?></div>
        <select name="payment_method" class="ajaxorderinputs">
          <?php foreach ($payment_methods as $payment_method) { ?>
            <option value="<?php echo $payment_method['title']; ?>" id="<?php echo $payment_method['code']; ?>"><?php echo $payment_method['title']; ?></option>
          <?php } ?>
        </select>
      </div>
    <?php } ?>
    <?php if ($hideshipping == 1) { ?>
      <div class="pay_ship_block">
        <div class="fieldname"><?php echo $text_ocjoyajaxcheckout_selectshipping; ?>: <?php if($config_info_shipping == 1) { ?><a class="faqinfo" faq="<?php echo $info_shipping_text; ?>">[?]</a><?php } ?></div>
        <select name="shipping_method" class="ajaxorderinputs">
          <?php foreach ($shipping_methods as $shipping_method) { ?>
            <option value="<?php echo $shipping_method['title']; ?>" id="<?php echo $shipping_method['code'] ?>"><?php echo $shipping_method['title']; ?></option>
          <?php } ?>
        </select>
      </div>
    <?php } ?>
    <?php if ($hideoptions == 1) { ?>
      <?php if ($options) { ?>
        <div class="options">
          <?php foreach ($options as $option) { ?>
            <?php if ($option['type'] == 'select') { ?>
              <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
                <b><?php echo $option['name']; ?>:</b><br />
                <select onchange="ups();"  name="option[<?php echo $option['product_option_id']; ?>]" >
                  <option value=""><?php echo $text_ocjoyajaxcheckout_selectoption; ?></option>
                  <?php foreach ($option['option_value'] as $option_value) { ?>
                  <option value="<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
                  <?php if ($option_value['price']) { ?>
                  (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                  <?php } ?>
                  </option>
                  <?php } ?>
                </select>
              </div>
              <br />
            <?php } ?>
            <?php if ($option['type'] == 'radio') { ?>
              <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
                <b><?php echo $option['name']; ?>:</b>
                <br />
                <?php foreach ($option['option_value'] as $option_value) { ?>
                  <input onchange="ups();" type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" />
                  <label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
                  <?php if ($option_value['price']) { ?>
                  (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                  <?php } ?>
                  </label>
                  <br />
                <?php } ?>
              </div>
              <br />
            <?php } ?>
            <?php if ($option['type'] == 'checkbox') { ?>
            <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
              <b><?php echo $option['name']; ?>:</b>
              <br />
              <?php foreach ($option['option_value'] as $option_value) { ?>
                <input onchange="ups();" type="checkbox" name="option[<?php echo $option['product_option_id']; ?>][]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" />
                <label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
                <?php if ($option_value['price']) { ?>
                (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                <?php } ?>
                </label>
                <br />
              <?php } ?>
            </div>
            <br />
            <?php } ?>
          <?php } ?>
        </div>
      <?php } ?>
    <?php } ?>
  </form>

  <div class="actions">
      <input type="button" class="btn-style volume" onclick="checkout('orderform');" id="gotoorderajax" value="Оформить">
      <a id="cancelorderajax" class="btn-style volume grey popup-cancel">Отмена</a>
  </div>

</div>