/**********************

custom.js
=============

Author:  Gino Aliaj
Template: Swimmerland - Water Park HTML Template
Version: 1.0

Author URI: gnodesign.com
***************************/


(function ($) {

    "use strict";


    $(window).on('load', function () {
        /*----------------------------------------------------
          LOADING PAGE
        ----------------------------------------------------*/


    }); // end of window load function





    $(document).ready(function () {


        /*----------------------------------------------------
           PUSH MENU
         ----------------------------------------------------*/

        (function ($) {

            $.fn.jPushMenu = function (customOptions) {
                var o = $.extend({}, $.fn.jPushMenu.defaultOptions, customOptions);

                /* add class to the body.*/

                $('body').addClass(o.bodyClass);
                $(this).addClass('jPushMenuBtn');
                $(this).on('click', function () {
                    var target = '',
                        push_direction = '';


                    if ($(this).is('.' + o.showLeftClass)) {
                        target = '.cbp-spmenu-left';
                        push_direction = 'toright';
                    } else if ($(this).is('.' + o.showRightClass)) {
                        target = '.cbp-spmenu-right';
                        push_direction = 'toleft';
                    } else if ($(this).is('.' + o.showTopClass)) {
                        target = '.cbp-spmenu-top';
                    } else if ($(this).is('.' + o.showBottomClass)) {
                        target = '.cbp-spmenu-bottom';
                    }


                    $(this).toggleClass(o.activeClass);
                    $(target).toggleClass(o.menuOpenClass);

                    if ($(this).is('.' + o.pushBodyClass)) {
                        $('body').toggleClass('cbp-spmenu-push-' + push_direction);
                    }

                    /* disable all other button*/
                    $('.jPushMenuBtn').not($(this)).toggleClass('disabled');

                    return false;
                });
                var jPushMenu = {
                    close: function (o) {
                        $('.jPushMenuBtn,body,.cbp-spmenu').removeClass('disabled active cbp-spmenu-open cbp-spmenu-push-toleft cbp-spmenu-push-toright');
                    }
                }

                if (o.closeOnClickOutside) {
                    $(document).on('click', function () {
                        jPushMenu.close();
                    });

                    $(document).on('click touchstart', function () {
                        jPushMenu.close();
                    });

                    $('.cbp-spmenu,.toggle-menu').on('click', function (e) {
                        e.stopPropagation();
                    });

                    $('.cbp-spmenu,.toggle-menu').on('click touchstart', function (e) {
                        e.stopPropagation();
                    });
                }

                // On Click Link
                if (o.closeOnClickLink) {
                    $('.cbp-spmenu a').on('click', function () {
                        jPushMenu.close();
                    });
                }
            };

            /* in case you want to customize class name,
             *  do not directly edit here, use function parameter when call jPushMenu.
             */
            $.fn.jPushMenu.defaultOptions = {
                bodyClass: 'cbp-spmenu-push',
                activeClass: 'menu-active',
                showLeftClass: 'menu-left',
                showRightClass: 'menu-right',
                showTopClass: 'menu-top',
                showBottomClass: 'menu-bottom',
                menuOpenClass: 'cbp-spmenu-open',
                pushBodyClass: 'push-body',
                closeOnClickOutside: true,
                closeOnClickInside: true,
                closeOnClickLink: true
            };
        })(jQuery);

        //initilizer
        $('.toggle-menu').jPushMenu({
            closeOnClickLink: false
        });

        $('.dropdown-toggle').dropdown();


        /*----------------------------------------------------
          INITIALIZE WOW
        ----------------------------------------------------*/
        new WOW().init();



        /*----------------------------------------------------
          INITIALIZE SWIPER
        ----------------------------------------------------*/
        var swiper = new Swiper('.swiper-container', {
            pagination: '.swiper-pagination',
            paginationClickable: true,
            autoplay: 7000,
            loop: true,
            simulateTouch: false
        });



        /*----------------------------------------------------
          SCROLL DOWN
        ----------------------------------------------------*/
        var $scrolldown = $('.scroll-down a');

        $scrolldown.on('click', function (e) {
            e.preventDefault();

            var target = this.hash;
            var $target = $(target);

            $('html, body').stop().animate({
                'scrollTop': $target.offset().top
            }, 1300, function () {
                window.location.hash = target;
            });
        });



        /*----------------------------------------------------
          SHUFFLE IMAGE GALLERY
        ----------------------------------------------------*/

        var shuffleme = (function ($) {
            'use strict';
            var $grid = $('#grid'), //locate what we want to sort 
                $filterOptions = $('.gallery-sorting li'), //locate the filter categories
                $sizer = $grid.find('.shuffle_sizer'), //sizer stores the size of the items

                init = function () {

                    // None of these need to be executed synchronously
                    setTimeout(function () {
                        listen();
                        setupFilters();
                    }, 100);

                    // initialize the plugin
                    $grid.shuffle({
                        itemSelector: '[class*="col-"]',
                        sizer: $sizer,
                        speed: 300
                    });
                },



                // Set up button clicks
                setupFilters = function () {
                    var $btns = $filterOptions.children();
                    $btns.on('click', function (e) {
                        e.preventDefault();
                        var $this = $(this),
                            isActive = $this.hasClass('active'),
                            group = isActive ? 'all' : $this.data('group');

                        // Hide current label, show current label in title
                        if (!isActive) {
                            $('.gallery-sorting li a').removeClass('active');
                        }

                        $this.toggleClass('active');

                        // Filter elements
                        $grid.shuffle('shuffle', group);
                    });

                    $btns = null;
                },


                // Re layout shuffle when images load. This is only needed
                // below 768 pixels because the .picture-item height is auto and therefore

                listen = function () {
                    var debouncedLayout = $.throttle(300, function () {
                        $grid.shuffle('update');
                    });

                    // Get all images inside shuffle
                    $grid.find('img').each(function () {
                        var proxyImage;

                        // Image already loaded
                        if (this.complete && this.naturalWidth !== undefined) {
                            return;
                        }

                        // If none of the checks above matched, simulate loading on detached element.
                        proxyImage = new Image();
                        $(proxyImage).on('load', function () {
                            $(this).off('load');
                            debouncedLayout();
                        });

                        proxyImage.src = this.src;
                    });

                    setTimeout(function () {
                        debouncedLayout();
                    }, 500);
                };

            return {
                init: init
            };
        }(jQuery));

        shuffleme.init(); //filter portfolio




        /*----------------------------------------------------
          MAGNIFIC POP UP
        ----------------------------------------------------*/

        $('section#gallery .gallery-items').each(function () { // the containers for all your galleries
            $(this).magnificPopup({
                delegate: 'a', // the selector for gallery item
                type: 'image',
                mainClass: 'mfp-fade',

                gallery: {
                    enabled: true
                },

                retina: {
                    ratio: 1, // Increase this number to enable retina image support.
                    replaceSrc: function (item, ratio) {
                        return item.src.replace(/\.\w+$/, function (m) {
                            return '@2x' + m;
                        });
                    }
                },

                zoom: {
                    enabled: true, // change to 'false' if you want to disable the zoming effect
                    duration: 300, // duration of the effect, in milliseconds
                    easing: 'ease-in-out', // CSS transition easing function
                    opener: function (openerElement) {
                        return openerElement.is('img') ? openerElement : openerElement.find('img');
                    }
                }

            });
        });

        $('.popup-video').magnificPopup({
            type: 'iframe',
            mainClass: 'mfp-fade',

            iframe: {
                markup: '<div class="mfp-iframe-scaler">' +
                    '<div class="mfp-close"></div>' +
                    '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>' +
                    '</div>', // HTML markup of popup, `mfp-close` will be replaced by the close button

                patterns: {
                    youtube: {
                        index: 'youtube.com/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).

                        id: 'v=', // String that splits URL in a two parts, second part should be %id%
                        // Or null - full URL will be returned
                        // Or a function that should return %id%, for example:
                        // id: function(url) { return 'parsed id'; }

                        src: '//www.youtube.com/embed/%id%?autoplay=1' // URL that will be set as a source for iframe.
                    },
                    vimeo: {
                        index: 'vimeo.com/',
                        id: '/',
                        src: '//player.vimeo.com/video/%id%?autoplay=1'
                    },
                    gmaps: {
                        index: '//maps.google.',
                        src: '%id%&output=embed'
                    }

                    // you may add here more sources

                },

                srcAction: 'iframe_src', // Templating object key. First part defines CSS selector, second attribute. "iframe_src" means: find "iframe" and set attribute "src".
            }
        });




        /*----------------------------------------------------
          TRAINING COURSES
        ----------------------------------------------------*/
        var trainingCourse = $('.training-course'),
            courseImg = $('.training-course a img');

        $(courseImg).on('click', function () {
            $(trainingCourse).removeClass('active');
            $(this).closest(trainingCourse).addClass('active');
        });



        /*----------------------------------------------------
          INITIALIZE COUNT UP
        ----------------------------------------------------*/
        $('section#countup').on('inview', function (event, visible, visiblePartX, visiblePartY) {
            if (visible) {
                $(this).find('.counter').each(function () {
                    var $this = $(this);
                    $('.counter').countTo({
                        speed: 3000,
                        refreshInterval: 50
                    });
                });
                $(this).unbind('inview');
            }
        });




        /*----------------------------------------------------
          TESTIMONIAL OWL SLIDER
        ----------------------------------------------------*/
        var sync1 = $("#sync1");
        var sync2 = $("#sync2");

        sync1.owlCarousel({
            singleItem: true,
            slideSpeed: 1000,
            navigation: false,
            pagination: false,
            afterAction: syncPosition,
            responsiveRefreshRate: 200,
        });

        sync2.owlCarousel({
            items: 3,
            itemsDesktop: [1199, 3],
            itemsDesktopSmall: [979, 3],
            itemsTablet: [768, 3],
            itemsMobile: [479, 1],
            pagination: true,
            responsiveRefreshRate: 100,
            afterInit: function (el) {
                el.find(".owl-item").eq(0).addClass("synced");
            }
        });

        function syncPosition(el) {
            var current = this.currentItem;
            $("#sync2")
                .find(".owl-item")
                .removeClass("synced")
                .eq(current)
                .addClass("synced")
            if ($("#sync2").data("owlCarousel") !== undefined) {
                center(current)
            }
        }

        $("#sync2").on("click", ".owl-item", function (e) {
            e.preventDefault();
            var number = $(this).data("owlItem");
            sync1.trigger("owl.goTo", number);
        });

        function center(number) {
            var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
            var num = number;
            var found = false;
            for (var i in sync2visible) {
                if (num === sync2visible[i]) {
                    var found = true;
                }
            }

            if (found === false) {
                if (num > sync2visible[sync2visible.length - 1]) {
                    sync2.trigger("owl.goTo", num - sync2visible.length + 2)
                } else {
                    if (num - 1 === -1) {
                        num = 0;
                    }
                    sync2.trigger("owl.goTo", num);
                }
            } else if (num === sync2visible[sync2visible.length - 1]) {
                sync2.trigger("owl.goTo", sync2visible[1])
            } else if (num === sync2visible[0]) {
                sync2.trigger("owl.goTo", num - 1)
            }

        }



        /*----------------------------------------------------
          PARTNERS OWL SLIDER
        ----------------------------------------------------*/
        $('.partners-slider').owlCarousel({
            // Most important features
            items: 6,
            itemsDesktop: [1199, 6],
            itemsDesktopSmall: [992, 4],
            itemsTablet: [768, 3],
            itemsTabletSmall: false,
            itemsMobile: [479, 2],

            //Basic Speeds
            slideSpeed: 200,
            paginationSpeed: 800,

            //Autoplay
            autoPlay: 8000,
            stopOnHover: false,

            // Navigation
            navigation: false,
            navigationText: ["prev", "next"],
            rewindNav: true,
            scrollPerPage: false,

            //Pagination
            pagination: true,

            // Responsive 
            responsive: true,
            responsiveRefreshRate: 200
        });




        /*----------------------------------------------------
          MAILCHIMP
        ----------------------------------------------------*/
        $('.mailchimp').ajaxChimp({
            callback: mailchimpFunct,
            url: "your-mailchimp-url-here" //Replace this with your own mailchimp post URL. Paste the url inside "".  
        });

        function mailchimpFunct(response) {
            if (response.result === 'success') {
                $('#subscribe-result').html('<div class="alert alert-success">' + resp.msg + '</div>').fadeIn(500);
                $("#subscribe-result").delay(5000).fadeOut(1000);

            } else if (response.result === 'error') {
                $('#subscribe-result').html('<div class="alert alert-danger">' + resp.msg + '</div>').fadeIn(500);
                $("#subscribe-result").delay(5000).fadeOut(1000);
            }
        }





        /*----------------------------------------------------
          CONTACT FORM
        ----------------------------------------------------*/
        $("#contact-form").on('submit', function (e) {
            e.preventDefault();

            //Get input field values from HTML form
            var user_name = $("input[name=name]").val();
            var user_email = $("input[name=email]").val();
            var user_phone = $("input[name=phone]").val();
            var user_subject = $("input[name=subject]").val();
            var user_message = $("textarea[name=message]").val();


            //Input validation
            var proceed = true; //Set proceed as true

            //If empty set border colors red
            if (user_name == "") {
                $("input[name=name]").css('border-color', 'red');
                proceed = false;
            }

            if (user_email == "") {
                $("input[name=email]").css('border-color', 'red');
                proceed = false;
            }

            if (user_message == "") {
                $("textarea[name=message]").css('border-color', 'red');
                proceed = false;
            }

            if (user_subject == "") {
                $("input[name=subject]").css('border-color', 'red');
                proceed = false;
            }


            //Everything it's ok...
            if (proceed) {

                //Data to be sent to server
                var post_data;
                var output;
                post_data = {
                    'user_name': user_name,
                    'user_email': user_email,
                    'user_phone': user_phone,
                    'user_subject': user_subject,
                    'user_message': user_message
                };

                //Ajax post data to server
                $.post('php/email.php', post_data, function (response) {

                    //Response server message
                    if (response.type == 'error') {
                        output = '<div class="alert alert-danger">' + response.text + '</div>';

                    } else {
                        output = '<div class="alert alert-success">' + response.text + '</div>';
                        //If success clear inputs
                        $("input").val('');
                        $("textarea").val('');
                    }

                    $("#contact-result").fadeIn(500).html(output).fadeIn(500);
                    $("#contact-result").delay(5000).fadeOut(1000);
                }, 'json');

            }
        });

        //Reset border colors
        $("input, textarea").on("change keyup", function (event) {
            $("input, textarea").css('border-color', '');
            $("#contact-result").fadeOut(500);
        });





        /*----------------------------------------------------
          LOAD MORE BLOG POSTS
        ----------------------------------------------------*/
        $(function () {
            $("article.blog-listing").slice(0, 4).show();
            $("#loadMore").on('click', function (e) {
                e.preventDefault();
                $("article.blog-listing:hidden").slice(0, 2).slideDown(400);
                if ($("article.blog-listing:hidden").length == 0) {
                    $('#loadmsg').html('<div class="alert alert-success">No more posts to load.</div>').fadeIn(700);
                    $("#loadMore").fadeOut(600);
                }
            });
        });
        
        
        
        
        /*----------------------------------------------------
          LOAD MORE EVENTS - TIMELINE
        ----------------------------------------------------*/
        $(function () {
            $(".timeline > li").slice(0, 2).show();
            $("section#timeline .load a").on('click', function (e) {
                e.preventDefault();
                $(".timeline > li").slice(0, 4).fadeIn(600);
                if ($(".timeline > li:hidden").length == 0) {
                    $('#loadmsg').html('<div class="alert alert-success">No more timeline events to load.</div>').fadeIn(700);
                    $("section#timeline .load a").fadeOut(600);
                }
            });
        });






    }); //end of document ready function



})(jQuery);