jQuery(function () {
    jQuery(".testimonials-content").owlCarousel({
        loop: true,
        center: true,
        items: 1,
        margin: 0,
        autoplay: true,
        dots:true,
        autoplayTimeout: 8500,
        smartSpeed: 450,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:1,
            },
            800:{
                items:1,
            },
            1500:{
                items:1,
            }
        }
    });
});