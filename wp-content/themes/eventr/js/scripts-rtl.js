(function($) {

    'use strict';


    //FULL HEIGHT BACKGROUND IMAGE
    var vpw = $(window).width();
    var vph = $(window).height();

    $('.fh').height(vph);

    //NAVBAR ANIMATION
    var menu = $('.navbar-custom'),
        pos = menu.offset();

    $(window).scroll(function() {
        if ($(this).scrollTop() > pos.top + menu.height() && menu.hasClass('default')) {
            menu.fadeOut('fast', function() {
                $(this).removeClass('default').addClass('navbar-fixed-top fixed').fadeIn('fast');
            });
        } else if ($(this).scrollTop() <= pos.top && menu.hasClass('navbar-fixed-top fixed')) {
            menu.fadeOut('fast', function() {
                $(this).removeClass('navbar-fixed-top fixed').addClass('default').fadeIn('fast');
            });
        }
    });


     $(".dropdown, .dropdown-active").hover(function() {
        $(this).find('.dropdown-menu').eq(0).stop(true, true).delay(200).slideDown(300);
    }, function() {
        $(this).find('.dropdown-menu').eq(0).stop(true, true).delay(200).slideUp(300);
    });

    //AUTO COLLAPSE NAVBAR
    $('.navbar-collapse .dropdown-menu').click(function() {
        $(".navbar-collapse").collapse('hide');
    });

    //SEARCH TOGGLE
    $("nav.navbar.navbar-custom").each(function() {
        $("li.navsearch > a", this).on("click", function(e) {
            e.preventDefault();
            $(".top-search").slideToggle();
        });
    });
    $(".input-group-addon.close-search").on("click", function() {
        $(".top-search").slideUp();
    });


    //SMOOTH SCROLL
     $("nav.navbar ul.nav li a[href*='#']").click(function() {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') ||
            location.hostname == this.hostname) {

            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top - $('.navbar-custom').height()
                }, 1000);
                return false;
            }
        }
    });


    

    //MAGNIFIC POPUP IMAGE
    $('.image-popup').magnificPopup({
        type:'image',
        //mainClass: 'img-popup',
        showCloseBtn: false,
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0,1] // Will preload 0 - before current, and 1 after the current image
        }
        
    });


   

    //MAGNIFIC POPUP LOAD CONTENT VIA AJAX
    $('.html-popup').magnificPopup({
        type: 'ajax',
       // mainClass: 'speaker-popup',
        closeOnContentClick: true,
        closeBtnInside: true,
        closeOnBgClick: false,
        fixedBgPos: true,
        preloader: false,
    });


    delete $.magnificPopup.instance.popupsCache['html-popup'];



    //NEWS CAROUSEL
    var owl = $("#news-carousel");

    owl.owlCarousel({
        autoPlay: false,
        direction: 'rtl',
        itemsCustom: [
            [0, 1],
            [450, 1],
            [600, 2],
            [700, 2],
            [1000, 3],
            [1200, 3],
            [1600, 3]
        ],
        pagination: true,
        navigation: false,
        navigationText: ['<i class="pe-2x pe-7s-angle-left pe-border"></i>', '<i class="pe-2x  pe-7s-angle-right pe-border"></i>'],
    });


    //PRICE TABLE CAROUSEL
    var owl = $(".ptable-carousel");

    owl.owlCarousel({
        autoPlay: false,
        direction: 'rtl',
        itemsCustom: [
            [0, 1],
            [450, 1],
            [600, 3],
            [700, 3],
            [1000, 2],
            [1200, 3],
            [1600, 3]
        ],
        itemsScaleUp: true,
        autoHeight: true,
        pagination: false,
        navigation: false,
        navigationText: ['<i class="pe-2x pe-7s-angle-left pe-border"></i>', '<i class="pe-2x  pe-7s-angle-right pe-border"></i>'],
    });

    //COUNTER
    $('.counter').counterUp({
        delay: 10,
        time: 1000
    });


    //SCROLL TO TOP
    if ($('#back-to-top').length) {
        var scrollTrigger = 100, // px
            backToTop = function() {
                var scrollTop = $(window).scrollTop();
                if (scrollTop > scrollTrigger) {
                    $('#back-to-top').addClass('show');
                } else {
                    $('#back-to-top').removeClass('show');
                }
            };
        backToTop();
        $(window).on('scroll', function() {
            backToTop();
        });
        $('#back-to-top').on('click', function(e) {
            e.preventDefault();
            $('html,body').animate({
                scrollTop: 0
            }, 700);
        });
    }


    //FIX HOVER EFFECT ON IOS DEVICES
    document.addEventListener("touchstart", function() {}, true);


}(jQuery));


(function($) {

    'use strict';

    $(window).load(function() {

        //PRELOADER
        $('#preload').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.

        //MASONRY GALLERY
        var $container2 = $('.tc_masonry_gallery').masonry({
            itemSelector: '.item',
        });

        // reveal initial images
      //  $container2.masonryImagesReveal($('#images').find('.item'));

        $.fn.masonryImagesReveal = function ($items) {
            var msnry = this.data('masonry');
            var itemSelector = msnry.options.itemSelector;
            // hide by default
            $items.hide();
            // append to container
            this.append($items);
            $items.imagesLoaded().progress(function (imgLoad, image) {
                // get item
                // image is imagesLoaded class, not <img>, <img> is image.img
                var $item = $(image.img).parents(itemSelector);
                // un-hide item
                $item.show();
                // masonry does its thing
                msnry.appended($item);
            });

            return this;
        };

        //CUSTOM TOOLBAR
         $("#contentz").mCustomScrollbar({
            axis: "y",
            theme: "dark-3",
            live: "on",
            
          });

    });

}(jQuery));