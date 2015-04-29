<div id="callbackphone" class="showtwosides callback-form" style="display: none">

    <div class="modal-header">Заказ звонка</div>

    <div id="callbackphone-left">

        <div id="callbackphone-left-required"><?php echo $callbackphone_required; ?></div>
        <div id="callbackphone-result" ></div>

        <form action="" id="callbackphone-form" >
            <div class="form-row">
              <div class="icon-user">
                <input type="text" name="callbackphonename" id="callbackphonename" placeholder="<?php echo $text_placeholder_name; ?>" class="callbackphone-left-forma-input style-form-text " /><div class="callbackphone-left-forma-input-req"></div>
              </div>
            </div>

            <div class="form-row">
              <div class="icon-phone">
                <input type="text" name="callbackphonetel" id="callbackphonetel" placeholder="<?php echo $text_placeholder_telphone; ?>" class="callbackphone-left-forma-input style-form-text " /><div class="callbackphone-left-forma-input-req"></div>
              </div>
            </div>

            <?php if ($callbackphone_active_time == "1") { ?>
              <div class="form-row">
                <input type="text" name="callup" id="callup" class="callbackphone-left-forma-inputtime style-form-text " placeholder="<?php echo $text_placeholder_callup; ?>" /> <input type="text" name="callto" class="callbackphone-left-forma-inputtime" id="callto" placeholder="<?php echo $text_placeholder_callto; ?>" />
              </div>
            <?php } ?>

            <?php if ($callbackphone_active_comment == "1") { ?>
              <div class="form-row">
                <textarea type="text" name="callbackphonecomment" id="callbackphonecomment style-form-text " placeholder="<?php echo $text_placeholder_comment; ?>" class="callbackphone-left-forma-input"></textarea>
              </div>
            <?php } ?>

            <div class="actions">
                <div onclick="send();" class="btn-style volume">Отправить</div>
            </div>

        </form>



    </div>
</div>

<script type="text/javascript">
function send() {
  var callbackphonename = $('#callbackphonename').val();
  var callbackphonetel = $('#callbackphonetel').val();
  var callup = $('#callup').val();
  var callto = $('#callto').val();
  var callbackphonecomment = $('#callbackphonecomment').val();

  $.ajax({
    type: "POST",
    url: "/index.php?route=module/callbackphone/send",
    data: 'callbackphonename=' + callbackphonename + '&callbackphonetel=' + callbackphonetel + '&callup=' + callup + '&callto=' + callto + '&callbackphonecomment=' + callbackphonecomment,
    success: function(html) {
      $('.callback-form input').val('');
      $("#result").empty();
      $("#callbackphone-left-forma").hide();
      $("#callbackphone-result").text('');
      $("#callbackphone-result").append(html);
    }
  });
}
</script>

<script type="text/javascript">
  callbackphone=jQuery.noConflict();
      jQuery(document).ready(function() { 
        //callbackphone('#callup').datetimepicker();
        //callbackphone('#callto').datetimepicker();
        //callbackphone('#callbackphonetel').mask('<?php echo $callbackphone_mask; ?>');
      });
  $=jQuery.noConflict();
</script>

<script type="text/javascript">
function hasPlaceholderSupport() {
  var input = document.createElement('input');
  return ('placeholder' in input);
}

if(!hasPlaceholderSupport()){
    var inputs = $('input');
    for(var i=0,  count = inputs.length;i<count;i++){
        if(inputs[i].getAttribute('placeholder')){
            inputs[i].style.cssText = "color:#777;"
            inputs[i].value = inputs[i].getAttribute("placeholder");
            inputs[i].onclick = function(){
                if(this.value == this.getAttribute("placeholder")){
                    this.value = '';
                    this.style.cssText = "color:#777;"
                }
            }
            inputs[i].onblur = function(){
                if(this.value == ''){
                    this.value = this.getAttribute("placeholder");
                    this.style.cssText = "color:#777;"
                }
            }
        }
    }
}
</script>