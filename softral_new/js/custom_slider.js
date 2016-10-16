/**
 * Created by etsb on 03-Oct-2016.
 */

    $(document).on('ready', function() {
        $(".regular").slick({
            dots: true,
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 5000,
            mobileFirst: true,
            fade: true,
            focusOnSelect: true,
            verticalSwiping: true,
            cssEase: 'linear',
            speed: 3000,
        });

        $(".ticker").slick({
            dots: true,
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 4000,
            mobileFirst: true,
            //fade: true,
            focusOnSelect: true,
            verticalSwiping: true,
            cssEase: 'linear',
            speed: 1500,
        });

        $(".bottom_slider").slick({
            dots: true,
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            mobileFirst: true,
            fade: true,
            focusOnSelect: true,
            verticalSwiping: true,
            cssEase: 'linear'
        });
    });

