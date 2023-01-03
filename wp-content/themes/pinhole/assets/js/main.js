(function($) {

    "use strict";

    var pinhole_app = {

        settings: {
            admin_bar: {
                height: 0,
                position: '',
            },

            logo: {
                default: '',
                mobile: '',
                width: '',
                checked: false
            },

            last_width: $(window).width(),
        },

        pushes: {
            url: [],
            up: 0,
            down: 0
        },

        init: function() {
            this.admin_bar_check();
            this.sidebar();
            this.layouts();
            this.filtering();
            this.popup([{'gallery_wrapper': '.pinhole-popup','images_selector':'a.item-link'},{ 'gallery_wrapper':'.entry-content','images_selector':'a.pinhole-popup-img'}]);
            this.accordion_widget();
            this.responsive_videos();
            this.sticky_header();
            this.sticky_bottom();
            this.logo_setup();
            this.scroll_to_comments();
            this.page_loading();
            this.push_state();
            this.load_more();
            this.infinite_scroll();
            this.disable_right_click();
            this.object_fit_IE_Edge();
            this.protected_gallery_style();
            this.search_button();
            this.align_full_fix();

        },


        resize: function() {

            if ($(window).width() != this.settings.last_width) {
                //check resize events only if width is changed, not height

                this.settings.last_width = $(window).width();

                this.layouts();
                this.admin_bar_check();
                this.sticky_header();
                this.logo_setup();
                this.align_full_fix();
                
            }

        },

        scroll: function() {


        },

        page_loading: function() {

            $('body').animate({
                opacity: 1
            }, 500);

        },

        admin_bar_check: function() {

            if ($('#wpadminbar').length && $('#wpadminbar').is(':visible')) {
                this.settings.admin_bar.height = $('#wpadminbar').height();
                this.settings.admin_bar.position = $('#wpadminbar').css('position');
            }

        },

        sticky_header: function() {

            if (pinhole_js_settings.header_sticky) {

                var last_top;
                var sticky_top = this.settings.admin_bar.position == 'fixed' ? this.settings.admin_bar.height : 0;
                $('.pinhole-header-sticky').css('top', sticky_top);

                $(window).scroll(function() {

                    var top = $(window).scrollTop();

                    if (pinhole_js_settings.header_sticky_up) {

                        if (last_top > top && top >= pinhole_js_settings.header_sticky_offset) {
                            if (!$("body").hasClass('pinhole-header-sticky-on')) {
                                $("body").addClass("pinhole-header-sticky-on");
                            }
                        } else {
                            if ($("body").hasClass('pinhole-header-sticky-on')) {
                                $("body").removeClass("pinhole-header-sticky-on");

                            }
                        }

                    } else {

                        if (top >= pinhole_js_settings.header_sticky_offset) {
                            if (!$("body").hasClass('pinhole-header-sticky-on')) {
                                $("body").addClass("pinhole-header-sticky-on");

                            }

                        } else {
                            if ($("body").hasClass('pinhole-header-sticky-on')) {
                                $("body").removeClass("pinhole-header-sticky-on");
                            }

                        }
                    }

                    last_top = top;
                });

            }

        },


        logo_setup: function() {

            if (!$('.pinhole-logo').length) {
                return false;
            }

            if (this.settings.logo.checked) {
                pinhole_app.replace_logo(pinhole_app.settings.logo.default, pinhole_app.settings.logo.mobile, pinhole_app.settings.logo.width);
                return false;
            }

            pinhole_app.settings.logo.default = pinhole_js_settings.logo;
            pinhole_app.settings.logo.mobile = pinhole_js_settings.logo_mobile ? pinhole_js_settings.logo_mobile : pinhole_js_settings.logo;
            pinhole_app.settings.logo.width = 'auto';

            if (window.devicePixelRatio > 1) {

                $('.pinhole-logo').imagesLoaded(function() {

                    if (pinhole_js_settings.logo_retina) {
                        pinhole_app.settings.logo.width = $('.pinhole-logo').width();
                        pinhole_app.settings.logo.default = pinhole_js_settings.logo_retina;
                    }

                    if (pinhole_js_settings.logo_mobile_retina) {
                        pinhole_app.settings.logo.mobile = pinhole_js_settings.logo_mobile_retina;
                    }

                    pinhole_app.replace_logo(pinhole_app.settings.logo.default, pinhole_app.settings.logo.mobile, pinhole_app.settings.logo.width);

                });

            } else {
                pinhole_app.replace_logo(pinhole_app.settings.logo.default, pinhole_app.settings.logo.mobile, pinhole_app.settings.logo.width);
            }


            $('.pinhole-logo').imagesLoaded(function() {
                $('.pinhole-logo').animate({
                    opacity: 1
                }, 300);
            });

            pinhole_app.settings.logo.checked = true;

        },

        replace_logo: function(logo, logo_mobile, logo_width) {


            if ($(window).width() <= 733) {
                $('.pinhole-header .pinhole-logo').attr('src', logo_mobile).css('width', 'auto');
            } else {
                $('.pinhole-header .pinhole-logo').attr('src', logo).css('width', logo_width);
            }

        },

        layouts: function() {

            /* Justify layout */

            var container_justify = $('.pinhole-justify');

            container_justify.justifiedGallery().on('jg.complete', function(e) {

                setTimeout(function() {
                    container_justify.addClass('pinhole-gallery-loaded');
                }, 500);


            });

            container_justify.imagesLoaded(function() {

                container_justify.each(function() {

                    pinhole_app.do_layout($(this), 'justify');

                });


            });


            /* Masonry layout */

            var container_masonry = $('.pinhole-masonry, .pinhole-grid');

            container_masonry.on('layoutComplete', function(event, items) {
                container_masonry.addClass('pinhole-gallery-loaded');
            });

            $('body').imagesLoaded(function() {
                
                setTimeout(function() {
                    container_masonry.each(function() {
                        pinhole_app.do_layout($(this), 'masonry'); 
                    });
                }, 500);

            });

        },


        filtering: function() {

            $('body').on('click', '.section-filter li a', function(e) {

                e.preventDefault();

                if (!$(this).hasClass('filter-active')) {

                    var gallery = $(this).closest('.pinhole-section').find('.pinhole-gallery');

                    var filter = $(this).closest('ul');
                    var query = $(this).attr('data-filter');

                    filter.find('li a').removeClass('filter-active');
                    $(this).addClass('filter-active');

                    if (query != 0) {

                        gallery.find('.pinhole-item:not(.' + query + ')').addClass('pinhole-hidden');
                        gallery.find('.pinhole-item.' + query).removeClass('pinhole-hidden');

                    } else {
                        gallery.find('.pinhole-item').removeClass('pinhole-hidden');
                    }

                    pinhole_app.reload_gallery_layout(gallery);


                }

            });

        },

        reload_gallery_layout: function(obj) {

            if (obj.hasClass('pinhole-masonry') || obj.hasClass('pinhole-grid')) {

                obj.removeClass('pinhole-gallery-loaded');

                setTimeout(function() {

                    obj.masonry('destroy');
                    pinhole_app.do_layout(obj, 'masonry');

                }, 200);


            } else if (obj.hasClass('pinhole-justify')) {

                pinhole_app.do_layout(obj, 'justify');

            }

        },

        add_to_layout: function(obj, elements) {

            if (obj.hasClass('pinhole-masonry') || obj.hasClass('pinhole-grid') || obj.hasClass('pinhole-classic')) {

                elements.css('opacity', 0);

                obj.append(elements).masonry('appended', elements);

                setTimeout(function() {
                        elements.animate({
                            opacity: 1
                        }, 300);
                    },
                    300);


            } else if (obj.hasClass('pinhole-justify')) {


                elements.css('opacity', 0);

                obj.append(elements);
                obj.justifiedGallery('norewind');

                setTimeout(function() {
                        elements.animate({
                            opacity: 1
                        }, 300);
                    },
                    300);
            }

        },

        do_layout: function(obj, type) {

            if (type == 'masonry') {
                
                if ( $(obj).hasClass('pinhole-grid') ) {
                    
                    $(obj).find('img').each(function() {
                        $(this).parent().css('height', $(this).parent().width());
                    });
                    
                }
                
                $(obj).masonry({
                    itemSelector: '.pinhole-item:not(.pinhole-hidden)',
                    transitionDuration: 0
                });

            }



            if (type == 'justify') {

                var add_height = 0;
                var row_height = 330;
                var minWidth = 270;
                var margins = 30;

                if (obj.hasClass('items-below')) {

                    var num_items_below = obj.find('.pinhole-info:first').children().length;

                    switch (num_items_below) {
                        case 1:
                            add_height = 32;
                            break;
                        case 2:
                            add_height = 53;
                            break;
                        case 3:
                            add_height = 75;
                            break;
                        default:
                            break;
                    }
                }

                if (obj.hasClass('small')) {
                    row_height = 200;
                    minWidth = 140;
                } else if (obj.hasClass('medium')) {
                    row_height = 250;
                    minWidth = 200;
                }

                if ($(window).width() <= 809) {
                    row_height = 200;
                    margins = 15;
                    minWidth = 140;
                }

                obj.justifiedGallery({
                    rowHeight: row_height,
                    addHeight: add_height,
                    minWidth: minWidth,
                    maxRowHeight: row_height,
                    margins: margins,
                    captions: false,
                    refreshTime: 1000,
                    filter: ':not(".pinhole-hidden")',
                    lastRow: 'justify'
                });


            }

        },

        popup: function(galleries) {
            
            var gallery = '';

            galleries.forEach(function( obj, i) {

                if ($(obj.gallery_wrapper + ' ' + obj.images_selector).length < 1) {
                    return;
                }

                $('body').on('click', obj.gallery_wrapper + ' ' + obj.images_selector, function(e) {

                    e.preventDefault();

                    var pswpElement = document.querySelectorAll('.pswp')[0];
                    var items = [];
                    var carousel = '';

                    $.each($(this).closest(obj.gallery_wrapper).find(obj.images_selector), function(ind, obj) {

                        var item = {
                            src: $(this).attr('href')
                        };

                        var meta = '';

                        if ($(this).attr('data-meta') !== undefined) {

                            var info = JSON.parse($(this).attr('data-meta'));

                            $.each(info, function(i, val) {
                                meta += '<div class="meta-item">' + val + '</div>';
                            });

                        }
                        item.meta = meta;

                        var caption = '';

                        if ($(this).attr('data-caption') !== undefined) {

                            var info = JSON.parse($(this).attr('data-caption'));


                            $.each(info, function(i, val) {
                                caption += val;
                            });

                        }
                        item.caption = caption;

                        var download = '';

                        if ($(this).attr('data-download') !== undefined) {

                            var info = JSON.parse($(this).attr('data-download'));

                            if (info.url !== undefined && info.name !== undefined) {
                                download += '<a href="' + info.url + '" download="' + info.name + '" class="pinhole-button pinhole-download"><i class="fa fa-download" aria-hidden="true"></i></a>';
                            }

                        }
                        item.download = download;
                        
                        var filename = '';

                        if ( $(this).attr('data-filename') !== undefined ) {
                            
                            var data_filename = JSON.parse( $(this).attr('data-filename') );

                            if ( !!data_filename.name ) {
                                filename += '<span class="meta-item">' + data_filename.name + '</span>';
                            }

                        }
                        item.filename = filename;

                        if ($(this).attr('data-size') !== undefined) {

                            var info = JSON.parse($(this).attr('data-size'));

                            $.each(info, function(i, val) {
                                if (i == 'width') {
                                    item.w = val;
                                } else if (i == 'height') {
                                    item.h = val;
                                }
                            });

                        }

                        items.push(item);

                        var carousel_item = $(this);
                        carousel_item.find('img').attr('data-ind', ind).removeAttr('srcset data-srcset').addClass('owl-lazy');
                        carousel += carousel_item.html();

                    });

                    var index = $(this).closest(obj.gallery_wrapper).find(obj.images_selector).index($(this));

                    var options = {
                        history: false,
                        index: index,
                        preload: [2, 2],
                        captionEl: false,
                        fullscreenEl: false,
                        zoomEl: false,
                        shareEl: false,
                        closeOnScroll: false,
                        barsSize: {
                            top: 40,
                            bottom: 40
                        }
                    };

                    // Initializes and opens PhotoSwipe
                    gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);

                    gallery.init();

                    // Set popup autoplay 
                    if ( pinhole_js_settings.gallery_popup_autoplay ) {

                        var autoplay = false;
                        var setSlider = function () {
                            autoplay = setInterval( function() {
                                gallery.next();
                            },3000);
                        };

                        $('body').on('mouseover', ' .pswp__img', function() {
                            clearInterval(autoplay);
                        });

                        $('body').on('mouseleave', ' .pswp__img', function() {
                            setSlider();
                        });

                        $('body').on('click', ' .pswp__button', function() {
                            clearInterval(autoplay);
                            setSlider();
                        });

                    }

                    // destroy carousel if we have more than one gallery  
                    if ( 
                        ($(galleries[0].gallery_wrapper + ' ' + galleries[0].images_selector).length > 1) && 
                        ($(galleries[1].gallery_wrapper + ' ' + galleries[1].images_selector).length > 1) 
                    ) {       
                        $('.owl-carousel').trigger('destroy.owl.carousel').removeClass('owl-carousel owl-loaded');
                        $('.pswp-carousel').children().remove();
                    }
                    
                    // append items and initialze carousel 
                    if ( !$('.pswp-carousel').hasClass('owl-carousel') ) {

                        $('.pswp-carousel').append(carousel);

                        $('.pswp-carousel').addClass('owl-carousel').owlCarousel({
                            loop: true,
                            margin: 17,
                            nav: false,
                            lazyLoad: true,
                            startPosition: index,
                            center: true,
                            autoWidth: false,
                            mouseDrag: false,
                            touchDrag: false,
                            stageClass: 'owl-stage',
                            responsive: {
                                0: {
                                    items: 5
                                },
                                1050: {
                                    items: 7
                                }
                            }
                        });

                    } else {
                        $('.owl-carousel').trigger('to.owl.carousel', [parseInt(index)]);
                    }


                    /* Navigate owv carousel on gallery change */
                    gallery.listen('beforeChange', function() {
                        $('.owl-carousel').trigger('to.owl.carousel', [parseInt(this.getCurrentIndex())]);
                    });
                    
                    /* Update caption and meta data */
                    gallery.listen('gettingData', function(index, item) {
                        $('.pswp-bottom-container .pswp-caption').html(this.currItem.caption);
                        $('.pswp-bottom-container .pswp-meta-items').html(this.currItem.meta);
                        $('.pswp__zoom-wrap .pinhole-download').remove();
                        $('.pswp__item .pswp__zoom-wrap').prepend(this.currItem.download);
                        $('.pswp__counter').wrapInner('<div class="meta-item"></div>');
                        $('.pswp__counter span').remove();
                        $('.pswp__counter').append(this.currItem.filename);
                    });

                });

            });


            /* Gallery botom container */
            $('body').on('click', '.pswp-bottom-container-action', function(e) {
                e.preventDefault();
                $(this).parent().toggleClass('pswp-bottom-open');
                $('.pswp__scroll-wrap').toggleClass('pswp-bottom-wrap-open');
            });

            /* Navigate popup gallery */
            $('body').on('click', '.pswp-carousel img', function(e) {
                e.preventDefault();
                var ind = $(this).attr('data-ind');
                gallery.goTo(parseInt(ind));

            });

            $('body').on('click', '.pswp-arrow', function(e) {
                e.preventDefault();
                if ($(this).hasClass('pswp-arrow-left')) {
                    gallery.prev();
                } else {
                    gallery.next();
                }
            });

        },


        sidebar: function() {

            var class_open = 'pinhole-sidebar-open pinhole-lock';

            $('body').on('click', '.pinhole-action-sidebar', function() {

                var sidebar_top = pinhole_app.settings.admin_bar.position == 'fixed' || $(window).scrollTop() < pinhole_app.settings.admin_bar.height ? pinhole_app.settings.admin_bar.height : 0;
                $('.pinhole-sidebar').css('top', sidebar_top);
                $('body').addClass(class_open);
            });

            $('body').on('click', '.pinhole-sidebar-close, .pinhole-sidebar-overlay', function() {
                $('body').removeClass(class_open);
            });

            $(document).keyup(function(e) {
                if (e.keyCode == 27 && $('body').hasClass(class_open)) {
                    $('body').removeClass(class_open);
                }
            });

        },

        accordion_widget: function() {

            $(".pinhole-responsive-menu .pinhole-nav-responsive").each(function() {

                var menu_item = $(this).find('.menu-item-has-children > a');
                menu_item.after('<span class="pinhole-nav-widget-acordion"><i class="fa fa-angle-down"></i></span>');

            });

            $('body').on('click', '.pinhole-responsive-menu .pinhole-nav-widget-acordion', function() {
                $(this).next('ul.sub-menu:first, ul.children:first').slideToggle('fast').parent().toggleClass('active');
            });

        },

        responsive_videos: function() {
            var obj = $('.entry-content');
            var iframes = [
                "iframe[src*='youtube.com/embed']",
                "iframe[src*='player.vimeo.com/video']",
                "iframe[src*='kickstarter.com/projects']",
                "iframe[src*='players.brightcove.net']",
                "iframe[src*='hulu.com/embed']",
                "iframe[src*='vine.co/v']",
                "iframe[src*='videopress.com/embed']",
                "iframe[src*='dailymotion.com/embed']",
                "iframe[src*='vid.me/e']",
                "iframe[src*='player.twitch.tv']",
                "iframe[src*='facebook.com/plugins/video.php']",
                "iframe[src*='gfycat.com/ifr/']",
                "iframe[src*='liveleak.com/ll_embed']",
                "iframe[src*='media.myspace.com']",
                "iframe[src*='archive.org/embed']",
                "iframe[src*='channel9.msdn.com']",
                "iframe[src*='content.jwplatform.com']",
                "iframe[src*='wistia.com']",
                "iframe[src*='vooplayer.com']",
                "iframe[src*='content.zetatv.com.uy']",
                "iframe[src*='embed.wirewax.com']",
                "iframe[src*='eventopedia.navstream.com']",
                "iframe[src*='cdn.playwire.com']",
                "iframe[src*='drive.google.com']",
                "iframe[src*='videos.sproutvideo.com']"
            ];
 
            obj.fitVids({
                customSelector: iframes.join(','),
                ignore: '[class^="wp-block"]'
            });
        },

        sticky_bottom: function() {

            if ($('.pinhole-sticky-bottom').length) {

                $(window).load(function() {

                    setTimeout(function() {

                        var top_offset = 100;
                        var bottom_offset = $('#pinhole-footer').offset().top - $(window).height() + 100;

                        $(window).scroll(function() {

                            var top = $(window).scrollTop();

                            if (top > top_offset && top < bottom_offset) {
                                $('body').addClass('pinhole-sticky-bottom-on');
                            } else {
                                $('body').removeClass('pinhole-sticky-bottom-on');
                            }

                        });

                    }, 500);


                });

            }

        },

        scroll_to_comments: function() {

            $('body').on('click', '.section-header .meta-comments a', function(e) {

                e.preventDefault();
                var target = this.hash;
                var $target = $(target);
                var offset = pinhole_js_settings.header_sticky ? 70 : 0;

                $('html, body').stop().animate({
                    'scrollTop': $target.offset().top - offset
                }, 900, 'swing', function() {
                    window.location.hash = target;
                });

            });
        },

        push_state: function() {

            /* Handling URL on ajax call for load more and infinite scroll case */
            if ($('.pinhole-pagination .load-more a').length || $('.pinhole-pagination .infinite-scroll').length) {

                var push_obj = {
                    prev: window.location.href,
                    next: '',
                    offset: $(window).scrollTop(),
                    prev_title: window.document.title,
                    next_title: window.document.title
                };

                pinhole_app.pushes.url.push(push_obj);
                window.history.pushState(push_obj, '', window.location.href);

                var last_up, last_down = 0;

                $(window).scroll(function() {
                    if (pinhole_app.pushes.url[pinhole_app.pushes.up].offset != last_up && $(window).scrollTop() < pinhole_app.pushes.url[pinhole_app.pushes.up].offset) {

                        last_up = pinhole_app.pushes.url[pinhole_app.pushes.up].offset;
                        last_down = 0;
                        window.document.title = pinhole_app.pushes.url[pinhole_app.pushes.up].prev_title;
                        window.history.replaceState(pinhole_app.pushes.url, '', pinhole_app.pushes.url[pinhole_app.pushes.up].prev); //1

                        pinhole_app.pushes.down = pinhole_app.pushes.up;
                        if (pinhole_app.pushes.up != 0) {
                            pinhole_app.pushes.up--;
                        }
                    }
                    if (pinhole_app.pushes.url[pinhole_app.pushes.down].offset != last_down && $(window).scrollTop() > pinhole_app.pushes.url[pinhole_app.pushes.down].offset) {

                        last_down = pinhole_app.pushes.url[pinhole_app.pushes.down].offset;
                        last_up = 0;

                        window.document.title = pinhole_app.pushes.url[pinhole_app.pushes.down].next_title;
                        window.history.replaceState(pinhole_app.pushes.url, '', pinhole_app.pushes.url[pinhole_app.pushes.down].next);

                        pinhole_app.pushes.up = pinhole_app.pushes.down;
                        if (pinhole_app.pushes.down < pinhole_app.pushes.url.length - 1) {
                            pinhole_app.pushes.down++;
                        }

                    }
                });

            }
        },

        load_more: function() {

            /* Load more button handler */

            var load_more_count = 0;

            $("body").on('click', '.pinhole-pagination .load-more a', function(e) {
                e.preventDefault();

                var start_url = window.location.href;
                var prev_title = window.document.title;
                var link = $(this);
                var page_url = link.attr("href");

                link.parent().addClass('pinhole-loader-active');

                $("<div>").load(page_url, function() {
                    var n = load_more_count.toString();
                    var container = $('.pinhole-posts').last();
                    var this_div = $(this);
                    var new_posts = this_div.find('.pinhole-posts').last().children().addClass('pinhole-new-' + n);

                    new_posts.imagesLoaded(function() {

                        pinhole_app.add_to_layout(container, new_posts);

                        if (this_div.find('.pinhole-pagination').length) {
                            $('.pinhole-pagination').html(this_div.find('.pinhole-pagination').html());
                        } else {
                            $('.pinhole-pagination').fadeOut('fast').remove();
                        }

                        if (page_url != window.location) {
                            pinhole_app.pushes.up++;
                            pinhole_app.pushes.down++;
                            var next_title = this_div.find('title').text();

                            var push_obj = {
                                prev: start_url,
                                next: page_url,
                                offset: $(window).scrollTop(),
                                prev_title: prev_title,
                                next_title: next_title
                            };

                            pinhole_app.pushes.url.push(push_obj);
                            window.document.title = next_title;
                            window.history.pushState(push_obj, '', page_url);
                        }

                        load_more_count++;

                        return false;
                    });

                });

            });
        },

        infinite_scroll: function() {

            /* Infinite scroll handler */

            if ($('.pinhole-pagination .infinite-scroll').length) {

                var pinhole_infinite_allow = true;
                var load_more_count = 0;

                $(window).scroll(function() {

                    if (pinhole_infinite_allow && ($(this).scrollTop() > ($('.pinhole-pagination').offset().top - $(this).height() - 200))) {

                        pinhole_infinite_allow = false;

                        var start_url = window.location.href;
                        var prev_title = window.document.title;
                        var link = $('.pinhole-pagination .infinite-scroll a');
                        var page_url = link.attr("href");

                        link.parent().addClass('pinhole-loader-active');

                        if (page_url !== undefined) {

                            $("<div>").load(page_url, function() {
                                var n = load_more_count.toString();
                                var container = $('.pinhole-posts').last();
                                var this_div = $(this);
                                var new_posts = this_div.find('.pinhole-posts').last().children().addClass('pinhole-new-' + n);

                                new_posts.imagesLoaded(function() {

                                    pinhole_app.add_to_layout(container, new_posts);

                                    if (this_div.find('.pinhole-pagination').length) {
                                        $('.pinhole-pagination').html(this_div.find('.pinhole-pagination').html());
                                        pinhole_infinite_allow = true;
                                    } else {
                                        $('.pinhole-pagination').fadeOut('fast').remove();
                                    }

                                    if (page_url != window.location) {
                                        pinhole_app.pushes.up++;
                                        pinhole_app.pushes.down++;
                                        var next_title = this_div.find('title').text();

                                        var push_obj = {
                                            prev: start_url,
                                            next: page_url,
                                            offset: $(window).scrollTop(),
                                            prev_title: prev_title,
                                            next_title: next_title
                                        };

                                        pinhole_app.pushes.url.push(push_obj);
                                        window.document.title = next_title;
                                        window.history.pushState(push_obj, '', page_url);
                                    }

                                    load_more_count++;

                                    return false;
                                });

                            });
                        }

                    }
                });
            }
        },

        disable_right_click : function() {
            if( !pinhole_js_settings.disable_right_click ){
                return;
            }
            $("html").on("contextmenu", "body", function(e) {
              return false;
            }); 
            $("body").on("dragstart", ".pinhole-item", function(e) {
              return false;
            });
        },

        object_fit_IE_Edge : function() {
            $('body').imagesLoaded(function(){
                objectFitImages('.pinhole-item img');
            });
        },

        protected_gallery_style : function() {
            if (pinhole_js_settings.gallery_image_counter && pinhole_js_settings.gallery_image_filename ) {
                var $width = $('.pinhole-image-counter').outerWidth();
                $('.pinhole-image-name').css('left', $width + 40);
            }
        },

        search_button : function() {
            
            $('body').on('click', '.pinhole-action-search span', function() {

                $(this).closest('.pinhole-action-search').find('.fa').toggleClass('fa-search', '');
                $(this).closest('.pinhole-action-search').toggleClass('active');
                setTimeout(function() {
                    $('.active input[type="text"]').focus();
                }, 150);
    
            }); 
        },

        align_full_fix: function() {

            var style = '.alignfull { width: ' + $(window).width() + 'px; margin-left: -' + $(window).width() / 2 + 'px; margin-right: -' + $(window).width() / 2 + 'px; left:50%; right:50%; position: relative; max-width: initial; }';

            if ($('#pinholle-align-fix').length) {
                $('#pinholle-align-fix').html(style);
            } else {
                $('head').append('<style id="pinholle-align-fix" type="text/css">' + style + '</style>');
            }

        }

    };

    $(document).ready(function() {
        pinhole_app.init();
    });

    $(window).resize(function() {
        pinhole_app.resize();
    });

    $(window).scroll(function() {
        pinhole_app.scroll();
    });

})(jQuery);