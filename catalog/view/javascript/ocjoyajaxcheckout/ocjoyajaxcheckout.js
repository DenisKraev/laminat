// Ocjoy Ajaxcheckout
$(".carousel-button-right-checkout").live('click',function(){ 
    right_carusel_checkout();
});
$(".carousel-button-left-checkout").live('click',function(){ 
    left_carusel_checkout();
});
function left_carusel_checkout(){
    var block_width = $('.carousel-block-checkout').width() + 20;
    $(".carousel-items-checkout .carousel-block-checkout").eq(-1).clone().prependTo(".carousel-items-checkout"); 
    $(".carousel-items-checkout").css({"left":"-"+block_width+"px"}); 
    $(".carousel-items-checkout").animate({left: "0px"}, 200); 
    $(".carousel-items-checkout .carousel-block-checkout").eq(-1).remove(); 
}
function right_carusel_checkout(){
    var block_width = $('.carousel-block-checkout').width() + 20;
    $(".carousel-items-checkout").animate({left: "-"+ block_width +"px"}, 200); 
    setTimeout(function () { 
        $(".carousel-items-checkout .carousel-block-checkout").eq(0).clone().appendTo(".carousel-items-checkout"); 
        $(".carousel-items-checkout .carousel-block-checkout").eq(0).remove(); 
        $(".carousel-items-checkout").css({"left":"0px"}); 
    }, 300);
}

function AjaxCheckoutOcjoy(id, product) {
    $.ajax({
        type: 'post',
        data: {product_id: id, product_detected: product},
        url: 'index.php?route=checkout/ocjoyajaxcheckout',
        dataType: 'html',
        success:  function(data) {
            $.fancybox({
                content: data,
                with : 440,
                padding: '0',
                fitToView: false,
                scrolling: 'no',
                helpers: {
                  overlay: {
                      locked: false
                  }
                }
            });

            // если м2
            if($('#ajaxorder .meters-package').size() > 0 && $('#ajaxorder .meters-package').data('unitCount') == 1){

               // если из карточки товара
               if($('#esponi_OTF_Total').size() > 0) {
                   $('#ajaxorder .price span').text($('#esponi_OTF_Total').text());
                   $('#ajaxorder .count .count-meters').val($('.product-info #option-227 .count-meters').val());
               } else { // иначе из каталога
                   count_meter_p = $('#ajaxorder .meters-package').data('metersPackage');

                   var calc_meter = function(obj){
                       count_need_m = obj.val();
                       whole_box = Math.ceil(count_need_m/count_meter_p);
                       price = $('#ajaxorder .meters-package').data('priceMeter');
                       itogo =  (whole_box*count_meter_p)*price;

                       $('#ajaxorder .price span').text(parseFloat(itogo).toFixed(2)+' р.');
                       $('#ajaxorder .count-meters').val(parseFloat(whole_box*count_meter_p).toFixed(4));
                   }

                   calc_meter($('#ajaxorder .count-meters'));
                   $('#ajaxorder .need-meters').bind("keyup", function(){calc_meter($(this));});
               }
            }

            // если шт
            if($('#ajaxorder .meters-package').size() > 0 && $('#ajaxorder .meters-package').data('unitCount') == 2){
                if($('#esponi_OTF_Total').size() > 0) { // если из карточки товара
                    $('#ajaxorder .count .quantity').val($('.product-info .cart .quantity').val());
                }
            }


            $('.popup-cancel').on('click', function(){
                $.fancybox.close();
            });
        }
    });
}