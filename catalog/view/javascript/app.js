$(document).ready(function(){

    $('input, textarea').placeholder();

    $('.slider').cycle({
        paused: true,
        speed: 600,
        manualSpeed: 500,
        prev: '.box-slider .prev',
        next: '.box-slider .next',
        slides: '.slide',
        pager: '.box-slider .pager'
    });

    $('.actions-list').cycle({
        paused: true,
        fx: 'carousel',
        visible: 2,
        speed: 600,
        manualSpeed: 500,
        prev: '.box-actions .prev',
        next: '.box-actions .next',
        slides: '.actions-item'
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
//    $(".js-main-popup").fancybox({
//        padding: '0',
//        width : 'auto',
//        height : 'auto',
//        maxWidth: "90%",
//        fitToView: false,
//        scrolling: 'no',
//        helpers: {  overlay: { locked: false } }
//    });
//    $('.popup-cancel').click(function(){
//        $.fancybox.close();
//    });
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