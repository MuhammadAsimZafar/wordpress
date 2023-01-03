(function($) {

    "use strict";

    $(document).ready(function() {

        /* Image radio button option handler */
        $('body').on('click', 'img.pinhole-img-select', function(e) {
            e.preventDefault();
            $(this).closest('ul').find('img.pinhole-img-select').removeClass('selected');
            $(this).addClass('selected');
            $(this).closest('ul').find('input').removeAttr('checked');
            $(this).closest('li').find('input').attr('checked', 'checked');

        });

        /* Call function on every archive_layout changes */
        $('body').on('click', '.redux-image-select img', function() {
            if ($(this).siblings().prop('id').slice(0, -2) == 'archive_layout') {
                pinhole_check_classic_layout();
            }
        });

        /* Call function initially */
        pinhole_check_classic_layout();

        /** Function to show excerpt and excerpt limit on classic layout because required parm in this special case doesn't work */
        function pinhole_check_classic_layout() {

            var classic_layout = $('#archive_layout_4');
            var section_wrapper = classic_layout.closest('tbody');
            var excerpt_wrapper = section_wrapper.find('#pinhole_settings-archive_excerpt').closest('tr');
            var excerpt_limit_wrapper = section_wrapper.find('#pinhole_settings-archive_excerpt_limit').closest('tr');

            if (classic_layout.is(':checked')) {
                excerpt_wrapper.addClass('pinhole-show-option');
                excerpt_limit_wrapper.addClass('pinhole-show-option');
            } else {
                excerpt_wrapper.removeClass('pinhole-show-option');
                excerpt_limit_wrapper.removeClass('pinhole-show-option');
            }

        }

        $("body").on('click', '#pinhole_welcome_box_hide', function(e) {
            e.preventDefault();
            $(this).parent().fadeOut(300).remove();
            $.post(ajaxurl, { action: 'pinhole_hide_welcome' }, function(response) {});
        });


        $("body").on('click', '#pinhole_update_box_hide', function(e) {
            e.preventDefault();
            $(this).parent().remove();
            $.post(ajaxurl, { action: 'pinhole_update_version' }, function(response) {});
        });

        $('body').on('click', '.mks-twitter-share-button', function(e) {
            e.preventDefault();
            var data = $(this).attr('data-url');
            pinhole_social_share(data);
        });

    });

    function pinhole_social_share(data) {
        window.open(data, "Share", 'height=500,width=760,top=' + ($(window).height() / 2 - 250) + ', left=' + ($(window).width() / 2 - 380) + 'resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0');
    }

})(jQuery);