/**
 * Created by etsb on 03-Oct-2016.
 */

    $(document).on('ready', function() {
        calling_wow();
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
            autoplaySpeed: 3000,
            mobileFirst: true,
            fade: true,
            focusOnSelect: true,
            verticalSwiping: true,
            cssEase: 'linear',
			speed:2000,
            adaptiveHeight: true
        });

        jQuery('.bottom_slider').on('afterChange', function(event, slick, currentSlide, nextSlide){
          callingCustomWow();
        });


        function calling_wow(){
            wow = new WOW(
              {
                animateClass: 'animated', 
                //offset:       100,
                callback:     function(box) {
                  //console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
                }
              }
            );
            wow.init();
            
        }

        function callingCustomWow(){
            jQuery('.slider_item').css('visibility','visible');
            var wow = new WOW(
              {
                boxClass:     'custom-wow',      // animated element css class (default is wow)
                animateClass: 'animated', // animation css class (default is animated)
                live:         true,       // act on asynchronously loaded content (default is true)
                callback:     function(box) {
                  // the callback is fired every time an animation is started
                  // the argument that is passed in is the DOM node being animated
                },
                scrollContainer: null // optional scroll container selector, otherwise use window
              }
            );
            wow.init();
        }

    });

