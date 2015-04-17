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
        helpers: {  overlay: { locked: false } }
    });
    $('.popup-cancel').click(function(){
        $.fancybox.close();
    });

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
//    $('.js-popup-img').fancybox({
//        openEffect : 'elastic',
//        openSpeed  : 150,
//        closeEffect : 'elastic',
//        closeSpeed  : 150,
//        closeBtn  : true,
//        arrows    : true,
//        nextClick : true,
//        helpers : {
//            buttons	: {},
//            thumbs : {
//                width  : 90,
//                height : 50
//            },
//            beforeShow : function() {
//                var s='';
//                var alt = this.element.find('img').attr('alt');
//                var title = this.element.find('img').attr('title');
//                var ze = (title == undefined || title=='') ? true : false;
//                var te = (alt == undefined || alt=='') ? true : false;
//                if (ze) {title = this.title;}
//                if (alt == title) {title='';}
//                var ze= (title == undefined || title=='') ? true : false;
//                if (!ze && !te) s=alt + '<br>' + title;
//                if (ze && !te) s=alt;
//                if (!ze && te) s=title;
//                this.title = s;
//            },
//            overlay: {
//                locked: false
//            }
//        },
//        afterLoad : function(){if (this.group.length>1){this.title = 'Изображение ' + (this.index + 1) + ' из ' + this.group.length+(this.title ? ' - ' + this.title : '');}
//        else{this.helpers.buttons = false;return;}}
//    });
//
//    $(".js-popup-video").fancybox({
//        type: 'iframe'
//    });

});