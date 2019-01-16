jQuery(window).on('load', function(){
    jQuery(".attractions .owl-carousel").owlCarousel({
            items:1,
            margin:0,
            loop:true,
            autoHeight:true,
            dots:false,
            nav:false,
            responsive:{
                    0:{
                            items:1
                    },
                    768:{
                            items:2
                    },
                    960:{
                            items:1
                    },
                    1300:{
                            items:3
                    },
            }
    });

    jQuery(".partners .owl-carousel").owlCarousel({
            items:1,
            margin:30,
            loop:true,
            autoHeight:true,
            dots:false,
            nav:false,
            responsive:{
                    0:{
                            items:2
                    },
                    450:{
                            items:3
                    },
                    600:{
                            items:4
                    },
                    960:{
                            items:3
                    },
                    1100:{
                            items:4
                    },
            }
    });

    jQuery(".slideshow .owl-carousel").owlCarousel({
            items:1,
            margin:0,
            loop:true,
            navContainer: '.slideshow__nav_buttons',
            dotsContainer: '.slideshow__nav_bullets',
            autoHeight:true,
            dots:true,
            nav:true,
            responsive:{
                    0:{
                        items:1
                    },
            }
    });

    var $attractionOwlCarousel = jQuery('.attractions .owl-carousel');
    var $partnersOwlCarousel = jQuery('.partners .owl-carousel');

    jQuery('.slider__arrow--right').click(function() {
            $attractionOwlCarousel.trigger('next.owl.carousel');
    });
    jQuery('.slider__arrow--left').click(function() {
            $attractionOwlCarousel.trigger('prev.owl.carousel');
    });

    /* new gallery/slider */
    jQuery(".owl-carousel--internal").owlCarousel({
				autoHeight: true,
        loop: true,
        autoplay: 3000,
        responsive:{
                    0:{
                            items:1
                    },
                    450:{
                            items:1
                    },
                    600:{
                            items:2
                    },
                    960:{
                            items:3
                    },
            }
    });

});