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
$(document).ready(function() {
    //var ocjoyajaxcheckoutresize = $('#ajaxorder').parents();
    //ocjoyajaxcheckoutresize.colorbox.resize();
//    $("#colorbox").draggable({
//      cursor: "crosshair",
//      containment: "parent"
//    });
});
function AjaxCheckoutOcjoy(id) {  
    $.ajax({
        type: 'post',
        data: 'product_id=' + id,
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

            $('.popup-cancel').click(function(){
                $.fancybox.close();
            });
        }
    });
}