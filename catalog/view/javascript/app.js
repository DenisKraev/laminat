$(document).ready(function(){

    $('input, textarea').placeholder();

    if($('.slider').size() > 0){
        $('.slider').cycle({
            paused: true,
            speed: 600,
            manualSpeed: 500,
            prev: '.box-slider .prev',
            next: '.box-slider .next',
            slides: '.slide',
            pager: '.box-slider .pager'
        });
    }

    if($('.actions-list').size() > 0){
        $('.actions-list').cycle({
            paused: true,
            fx: 'carousel',
            allowWrap: false,
            speed: 600,
            manualSpeed: 500,
            prev: '.box-actions .prev',
            next: '.box-actions .next',
            slides: '.actions-item'
        });
    }

    if($('.box-latest .product-list').size() > 0){
        $('.box-latest .product-list').cycle({
            paused: true,
            fx: 'carousel',
            allowWrap: false,
            speed: 600,
            manualSpeed: 500,
            prev: '.box-latest .prev',
            next: '.box-latest .next',
            slides: '.product-item'
        });
    }

    if($('.box-sale .product-list').size() > 0){
        $('.box-sale .product-list').cycle({
            paused: true,
            fx: 'carousel',
            allowWrap: false,
            speed: 600,
            manualSpeed: 500,
            prev: '.box-sale .prev',
            next: '.box-sale .next',
            slides: '.product-item'
        });
    }

    $('#filterpro .more').click(function(){
        $('#filterpro .box-add').slideToggle(100);
    });

    $('.action-filter').click(function(){
        doFilter(false, false);
    });

    $('#filterpro .option_box').each(function(){
       if($(this).hasClass('hide') == true) {
           var removeBox = $(this).detach();
           removeBox.appendTo('.box-add');
       }
    });

//    jQuery(function ($){
//        $('#callbackphone-link').click(function (e) {
//            $('#callbackphone').modal();
//            return false;
//        });
//    });

    $(".js-main-popup").fancybox({
        padding: '0',
        width : 'auto',
        height : 'auto',
        maxWidth: "90%",
        fitToView: false,
        scrolling: 'no',
        helpers: {  overlay: { locked: false }}
    });
    $('.popup-cancel').click(function(){
        $.fancybox.close();
    });

    $('.product-info .statuses img').tooltipster({
        position: 'right'
    });

    // считаем на КЛИЕНТЕ для визуализации метры и коробки
    if($('.product-info #option-227 input[name="option[227]"]').size() > 0){
        $('.product-info #option-227 input[name="option[227]"]').attr('disabled', 'disabled').val($('.product-info .meters-package').data('metersPackage')).addClass('count-meters');

        count_meter_p = $('.product-info .meters-package').data('metersPackage');

        box_calc = "<div class='wrap-need-meters table'><label class='cell'>Требуемая площадь: </label><div class='cell'><input type='text' class='need-meters style-form-text'> (м&#178)</div></div>";
        box_calc_boxes = "<div class='count-box table'><div class=' cell'>Коробки: </div> <span class='cell'></span></div>";

        $('.product-info #option-227').prepend(box_calc).append(box_calc_boxes);

        var calc_meter = function(obj){
            count_need_m = obj.val();
            whole_box = Math.ceil(count_need_m/count_meter_p);
            $('.product-info #option-227 .count-box span').text(whole_box);
            $('.product-info #option-227 .count-meters').val(parseFloat(whole_box*count_meter_p).toFixed(4));
        }

        calc_meter($('.product-info #option-227 .count-meters'));
        $('.product-info #option-227 .need-meters').bind("keyup", function(){calc_meter($(this));});
    }

//    $('.prod-slider').lightSlider({
//        gallery: true,
//        loop: true,
//        item: 1,
//        thumbItem: 3,
//        thumbMargin: 5,
//        mode: 'fade',
//        speed: 300,
//        currentPagerPosition: 'middle',
//        onSliderLoad: function() {
//            $('.prod-slider').removeClass('slider-hidden');
//        }
//    });

//    var myMap;
//
//    ymaps.ready(init);
//
//    function init () {
//
//        myMap = new ymaps.Map('map-contact', {
//            center: [58.602901, 49.668077],
//            zoom: 12
//        }),
//        myPlacemark = new ymaps.Placemark(
//            myMap.getCenter(),
//            {
//                hintContent: "Терраса",
//                iconContent: "Терраса"
//            },
//            {preset: 'islands#brownStretchyIcon'}
//        );
//        myMap.geoObjects.add(myPlacemark);
//
//    }
//

//
//    var boxen = [];
//    $("a[class^=js-popup-img]").each(function() {
//        if ($.inArray($(this).attr('class'),boxen)) boxen.push($(this).attr('class'));
//    });
//    $(boxen).each(function(i,val) {
//        $('a[class='+val+']').attr('rel',val).fancybox({
//            fitToView		: false,
//            padding		: '0',
//            helpers : {overlay: {locked: false}}
//        });
//    });
//
    $('.js-popup-img').fancybox({
        openSpeed  : 150,
        closeSpeed  : 150,
        closeBtn  : true,
        arrows    : true,
        nextClick : true,
        helpers : {
            buttons	: {},
            thumbs : {
                width  : 90,
                height : 50
            },
            beforeShow : function() {
                var s='';
                var alt = this.element.find('img').attr('alt');
                var title = this.element.find('img').attr('title');
                var ze = (title == undefined || title=='') ? true : false;
                var te = (alt == undefined || alt=='') ? true : false;
                if (ze) {title = this.title;}
                if (alt == title) {title='';}
                var ze= (title == undefined || title=='') ? true : false;
                if (!ze && !te) s=alt + '<br>' + title;
                if (ze && !te) s=alt;
                if (!ze && te) s=title;
                this.title = s;
            },
            overlay: {
                locked: false
            }
        },
        afterLoad : function(){if (this.group.length>1){this.title = 'Изображение ' + (this.index + 1) + ' из ' + this.group.length+(this.title ? ' - ' + this.title : '');}
        else{this.helpers.buttons = false;return;}}
    });
//
//    $(".js-popup-video").fancybox({
//        type: 'iframe'
//    });

});