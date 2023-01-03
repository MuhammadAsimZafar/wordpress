<?php  
        $popup_wrapper_class = '';
        $bottom_box_class = '';
        
        if ( pinhole_get_option('gallery_image_drawer_open') ) {
            $popup_wrapper_class = 'pswp-bottom-wrap-open';
            $bottom_box_class = 'pswp-bottom-open';
        }
    ?>
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="pswp__bg"></div>
    <div class="pswp__scroll-wrap <?php echo esc_attr( $popup_wrapper_class ); ?>">
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>
        <div class="pswp__ui pswp__ui--hidden">
            <div class="pswp__top-bar">
                <div class="pswp__counter"></div>
                <button class="pswp__button pswp__button--close" title="Close (Esc)">×</button>
                <button class="pswp__button pswp__button--share" title="Share"></button>
                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>
            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>
            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>
            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>
        </div>
    </div>
    <div class="pswp-bottom-container <?php echo esc_attr( $bottom_box_class ); ?>">
        <div class="pswp-caption">
        </div>
        <span class="pswp-bottom-container-action"></span>
        <div class="pswp-nav">
            <a href="javascript: void(0);" class="pswp-arrow pswp-arrow-left"></a>
            <div class="pswp-carousel"></div>
            <a href="javascript: void(0);" class="pswp-arrow pswp-arrow-right"></a>
        </div>
        <div class="pswp-meta"><div class="pswp-meta-items"></div></div>
    </div>
</div>