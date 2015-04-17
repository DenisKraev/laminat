<?php echo $header; ?>
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
    <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
    <div class="buttons">
      <a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a>
      <a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a>
    </div>
  </div>
 <div class="content">
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
  <div class="content">
       <div id="tab-ocjoyajaxcheckout">
    <div class="vtabs">
      <a href="#ocjoyajaxcheckout-settingmain"><?php echo $text_main_tab_setting; ?></a>
      <a href="#ocjoyajaxcheckout-settingfields"><?php echo $text_fields_tab_setting; ?></a>
      <a href="#ocjoyajaxcheckout-settingposition"><?php echo $text_position_tab_setting; ?></a>
      <a href="#ocjoyajaxcheckout-licence"><?php echo $text_licence; ?></a>
    </div>
    <div id="ocjoyajaxcheckout-settingmain" class="vtabs-content">
      <table class="form">
                <tr>
                  <td><?php echo $text_mask_telephone; ?></td>
                  <td>
                      <input value="<?php echo $config_mask_telephone; ?>" type="text" name="config_mask_telephone" size="40" />
                  </td>
                </tr>
                <tr>
                  <td><?php echo $text_info_shipping; ?></td>
                  <td>
                      <?php echo $text_activationtext; ?>&nbsp 
                      <select name="config_info_shipping">
                          <?php if ($config_info_shipping == "1") { ?>
                          <option value="1" selected="selected"><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } elseif ($config_info_shipping == "2") { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" selected="selected"><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } else { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  selected="selected"><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } ?>
                      </select>
                      &nbsp 
                      <?php echo $text_onlytext; ?>&nbsp<input value="<?php echo $config_info_shipping_text; ?>" type="text" name="config_info_shipping_text" size="40" />
                  </td>
                </tr>
                 <tr>
                  <td><?php echo $text_info_payment; ?></td>
                  <td>
                      <?php echo $text_activationtext; ?>&nbsp
                      <select name="config_info_payment">
                          <?php if ($config_info_payment == "1") { ?>
                          <option value="1" selected="selected"><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } elseif ($config_info_payment == "2") { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" selected="selected"><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } else { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  selected="selected"><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } ?>
                      </select>
                      &nbsp
                      <?php echo $text_onlytext; ?>&nbsp<input value="<?php echo $config_info_payment_text; ?>" type="text" name="config_info_payment_text" size="40" />
                  </td>
                </tr>

        </table>
    </div>
    <div id="ocjoyajaxcheckout-settingposition" class="vtabs-content">
      <table class="form">
                <tr>
                  <td><?php echo $text_show_on_product; ?></td>
                  <td>
                      <select name="config_show_on_product">
                          <?php if ($config_show_on_product == "1") { ?>
                          <option value="1" selected="selected"><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } elseif ($config_show_on_product == "2") { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" selected="selected"><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } else { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  selected="selected"><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } ?>
                      </select>
                  </td>
                </tr>
                <tr>
                  <td><?php echo $text_show_on_category; ?></td>
                  <td>
                      <select name="config_show_on_category">
                          <?php if ($config_show_on_category == "1") { ?>
                          <option value="1" selected="selected"><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } elseif ($config_show_on_category == "2") { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" selected="selected"><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } else { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  selected="selected"><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } ?>
                      </select>
                  </td>
                </tr>
                <tr>
                  <td><?php echo $text_show_on_brands; ?></td>
                  <td>
                      <select name="config_show_on_brands">
                          <?php if ($config_show_on_brands == "1") { ?>
                          <option value="1" selected="selected"><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } elseif ($config_show_on_brands == "2") { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" selected="selected"><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } else { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  selected="selected"><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } ?>
                      </select>
                  </td>
                </tr>
                <tr>
                  <td><?php echo $text_show_on_search; ?></td>
                  <td>
                      <select name="config_show_on_search">
                          <?php if ($config_show_on_search == "1") { ?>
                          <option value="1" selected="selected"><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } elseif ($config_show_on_search == "2") { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" selected="selected"><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } else { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  selected="selected"><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } ?>
                      </select>
                  </td>
                </tr>
                <tr>
                  <td><?php echo $text_show_on_specials; ?></td>
                  <td>
                      <select name="config_show_on_specials">
                          <?php if ($config_show_on_specials == "1") { ?>
                          <option value="1" selected="selected"><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } elseif ($config_show_on_specials == "2") { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" selected="selected"><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } else { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  selected="selected"><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } ?>
                      </select>
                  </td>
                </tr>
                <tr>
                  <td><?php echo $text_show_on_module_latest; ?></td>
                  <td>
                      <select name="config_show_on_module_latest">
                          <?php if ($config_show_on_module_latest == "1") { ?>
                          <option value="1" selected="selected"><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } elseif ($config_show_on_module_latest == "2") { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" selected="selected"><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } else { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  selected="selected"><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } ?>
                      </select>
                  </td>
                </tr>
                <tr>
                  <td><?php echo $text_show_on_module_special; ?></td>
                  <td>
                      <select name="config_show_on_module_special">
                          <?php if ($config_show_on_module_special == "1") { ?>
                          <option value="1" selected="selected"><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } elseif ($config_show_on_module_special == "2") { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" selected="selected"><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } else { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  selected="selected"><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } ?>
                      </select>
                  </td>
                </tr>
                <tr>
                  <td><?php echo $text_show_on_module_featured; ?></td>
                  <td>
                      <select name="config_show_on_module_featured">
                          <?php if ($config_show_on_module_featured == "1") { ?>
                          <option value="1" selected="selected"><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } elseif ($config_show_on_module_featured == "2") { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" selected="selected"><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } else { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  selected="selected"><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } ?>
                      </select>
                  </td>
                </tr>
                <tr>
                  <td><?php echo $text_show_on_module_bestseller; ?></td>
                  <td>
                      <select name="config_show_on_module_bestseller">
                          <?php if ($config_show_on_module_bestseller == "1") { ?>
                          <option value="1" selected="selected"><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } elseif ($config_show_on_module_bestseller == "2") { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" selected="selected"><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } else { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  selected="selected"><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } ?>
                      </select>
                  </td>
                </tr>
        </table>
    </div>
    <div id="ocjoyajaxcheckout-settingfields" class="vtabs-content">
      <table class="form">
                <tr>
                  <td><?php echo $text_ocjoyajaxcheckout_hideimg; ?></td>
                  <td>
                      <select name="config_type_hideimg">
                          <?php if ($config_type_hideimg == "1") { ?>
                          <option value="1" selected="selected"><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } elseif ($config_type_hideimg == "2") { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" selected="selected"><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } else { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  selected="selected"><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } ?>
                      </select>
                  </td>
                </tr>
                 
                 <tr>
                  <td><?php echo $text_ocjoyajaxcheckout_hideshipping; ?></td>
                  <td>
                      <select name="config_type_hideshipping">
                          <?php if ($config_type_hideshipping == "1") { ?>
                          <option value="1" selected="selected"><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } elseif ($config_type_hideshipping == "2") { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" selected="selected"><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } else { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  selected="selected"><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } ?>
                      </select>
                  </td>
                </tr>
                 <tr>
                  <td><?php echo $text_ocjoyajaxcheckout_hidepayment; ?></td>
                  <td>
                      <select name="config_type_hidepayment">
                          <?php if ($config_type_hidepayment == "1") { ?>
                          <option value="1" selected="selected"><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } elseif ($config_type_hidepayment == "2") { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" selected="selected"><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } else { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  selected="selected"><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } ?>
                      </select>
                  </td>
                </tr>
                 <tr>
                  <td><?php echo $text_ocjoyajaxcheckout_hideoptions; ?></td>
                  <td>
                      <select name="config_type_hideoptions">
                          <?php if ($config_type_hideoptions == "1") { ?>
                          <option value="1" selected="selected"><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } elseif ($config_type_hideoptions == "2") { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" selected="selected"><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } else { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  selected="selected"><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } ?>
                      </select>
                  </td>
                </tr>
                <tr>
                  <td><?php echo $text_ocjoyajaxcheckout_hidedescription; ?></td>
                  <td>
                      <select name="config_type_hidedescription">
                          <?php if ($config_type_hidedescription == "1") { ?>
                          <option value="1" selected="selected"><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } elseif ($config_type_hidedescription == "2") { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" selected="selected"><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } else { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  selected="selected"><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } ?>
                      </select>
                  </td>
                </tr>
                <tr>
                  <td><?php echo $text_ocjoyajaxcheckout_hidefio; ?></td>
                  <td>
                      <select name="config_type_hidefio">
                          <?php if ($config_type_hidefio == "1") { ?>
                          <option value="1" selected="selected"><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } elseif ($config_type_hidefio == "2") { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" selected="selected"><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } else { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  selected="selected"><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } ?>
                      </select>
                      &nbsp<?php echo $text_ocjoyajaxcheckout_required; ?>&nbsp
                      <select name="config_required_fio">
                          <?php if ($config_required_fio == "1") { ?>
                          <option value="1" selected="selected"><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } elseif ($config_required_fio == "2") { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" selected="selected"><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } else { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  selected="selected"><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } ?>
                      </select>
                  </td>
                </tr>
                <tr>
                  <td><?php echo $text_ocjoyajaxcheckout_hideemail; ?></td>
                  <td>
                      <select name="config_type_hideemail">
                          <?php if ($config_type_hideemail == "1") { ?>
                          <option value="1" selected="selected"><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } elseif ($config_type_hideemail == "2") { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" selected="selected"><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } else { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  selected="selected"><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } ?>
                      </select>
                      &nbsp<?php echo $text_ocjoyajaxcheckout_required; ?>&nbsp
                      <select name="config_required_email">
                          <?php if ($config_required_email == "1") { ?>
                          <option value="1" selected="selected"><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } elseif ($config_required_email == "2") { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" selected="selected"><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } else { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  selected="selected"><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } ?>
                      </select>
                  </td>
                </tr>
                 <tr>
                  <td><?php echo $text_ocjoyajaxcheckout_hidetelephone; ?></td>
                  <td>
                      <select name="config_type_hidetelephone">
                          <?php if ($config_type_hidetelephone == "1") { ?>
                          <option value="1" selected="selected"><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } elseif ($config_type_hidetelephone == "2") { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" selected="selected"><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } else { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  selected="selected"><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } ?>
                      </select>
                      &nbsp<?php echo $text_ocjoyajaxcheckout_required; ?>&nbsp
                      <select name="config_required_telephone">
                          <?php if ($config_required_telephone == "1") { ?>
                          <option value="1" selected="selected"><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } elseif ($config_required_telephone == "2") { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" selected="selected"><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  ><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } else { ?>
                          <option value="1" ><?php echo $text_ocjoyajaxcheckout_yes; ?></option>
                          <option value="2" ><?php echo $text_ocjoyajaxcheckout_no; ?></option>
                          <option value=""  selected="selected"><?php echo $text_ocjoyajaxcheckout_makeachoice; ?></option>
                          <?php } ?>
                      </select>
                  </td>
                </tr>
              </table>
            </div>
            <div id="ocjoyajaxcheckout-licence" class="vtabs-content" style="min-height:400px;">
                <table class="form">
                  <tr>
                    <td><?php echo $text_youruidcode; ?></td>
                    <td><input value="<?php echo base64_encode(DIR_SYSTEM.':'.$_SERVER['SERVER_NAME']); ?>" type="text" size="100"  readonly /></td>
                  </tr>
                  <tr>
                    <td><?php echo $text_activationcode; ?></td>
                    <td><input value="<?php echo $config_ukey_ch; ?>" type="text" name="config_ukey_ch" size="100" /></td>
                  </tr>
                </table>
            </div>
            <script type="text/javascript"><!--
            $('.vtabs a').tabs();
            //--></script>
          </div>
  </form>
  </div>
  <div id="ocjoy-copyright"><?php echo $text_copyright; ?></div>
</div>
</div>
<style type="text/css">
#ocjoy-copyright {clear:both;padding:15px 15px;border:1px solid #ccc;margin-top:15px;box-shadow:0 0px 5px rgba(0,0,0,0.1);}
#tab-ocjoyajaxcheckout {min-height: 320px;}
</style>
<?php echo $footer; ?>