(function($) {

    "use strict";

    $(document).ready(function() {

        /* Show/hide custom layout settings */

        $('body').on('click', '.pinhole-template-settings', function(e) {

            var settings = $(this).val();
            var wrap = $(this).closest('.postbox').find('.pinhole-template-settings-wrap');

            if (settings == 'inherit') {
                wrap.fadeOut();
            } else {
                wrap.fadeIn();
            }

        });


        /* Layout columns/size switch */

        $('body').on('click', '.pinhole-template-settings-layout', function(e) {

            e.preventDefault();

            var layout = $(this).closest('li').find('input').val();
            var columns = $(this).closest('.postbox').find('.pinhole-template-settings-field-columns');
            var size = $(this).closest('.postbox').find('.pinhole-template-settings-field-layout_size');

            if (layout == 'justify') {
                columns.fadeOut(100, function() {
                    size.fadeIn(100);
                });

            } else {
                size.fadeOut(100, function() {
                    columns.fadeIn(100);
                });
            }

        });


        /* Gallery selection show/hide */

        $('body').on('click', '.pinhole-galleries-select', function(e) {

            var settings = $(this).val();
            var wrap = $(this).closest('.postbox').find('.pinhole-galleries-select-wrap');

            if (settings == 'hierarchy') {
                wrap.fadeOut();
            } else {
                wrap.fadeIn();
            }

        });


        /* Metabox switch - do not show every metabox for every template */

        var pinhole_is_gutenberg = pinhole_js_settings.is_gutenberg && typeof wp.apiFetch !== 'undefined';
        var pinhole_template_selector = pinhole_js_settings.is_gutenberg ? '.editor-page-attributes__template select' : '#page_template';

        if (pinhole_is_gutenberg) {

            var post_id = $('#post_ID').val();
            wp.apiFetch({ path: '/wp/v2/pages/' + post_id, method: 'GET' }).then(function(obj) {
                pinhole_template_metaboxes(false, obj.template);
            });

        } else {
            pinhole_template_metaboxes(false);
        }

        $('body').on('change', pinhole_template_selector, function(e) {
            pinhole_template_metaboxes(true);
        });

        function pinhole_template_metaboxes(scroll, t) {

            var template = t ? t : $(pinhole_template_selector).val();

            if (template == 'template-galleries.php') {
                $('#pinhole_galleries_template_options').fadeIn(300);
                $('#pinhole_galleries_select').fadeIn(300);
                $('#pinhole_albums_template_options').fadeOut(300);
            } else if (template == 'template-albums.php') {
                $('#pinhole_galleries_template_options').fadeOut(300);
                $('#pinhole_galleries_select').fadeOut(300);
                $('#pinhole_albums_template_options').fadeIn(300);
            } else {
                $('#pinhole_galleries_template_options').fadeOut(300);
                $('#pinhole_galleries_select').fadeOut(300);
                $('#pinhole_albums_template_options').fadeOut(300);
            }

        }

        /* Pinhole galleries search init */
        pinhole_live_search();

        /* Live search functionality */
        function pinhole_live_search() {

            $(".pinhole-live-search").autocomplete({
                source: function(req, response) {
                    $.getJSON(pinhole_js_settings.ajax_url + '?callback=?&action=pinhole_search', req, response);
                },
                delay: 300,
                minLength: 4,
                select: function(event, ui) {

                    var wrap = $(this).closest('.pinhole-live-search-opt');

                    wrap.find('.pinhole-live-search-items').append('<span><button type="button" class="ntdelbutton" data-id="' + ui.item.id + '"><span class="remove-tag-icon"></span></button>&nbsp;' + ui.item.label + '</span>');

                    var hidden = wrap.find('.pinhole-live-search-hidden');
                    var new_value = hidden.val() ? hidden.val() + ',' + ui.item.id : ui.item.id;
                    hidden.val(new_value);

                    wrap.find('.pinhole-live-search').val('');

                    return false;
                }
            });

            $('body').on('click', '.pinhole-live-search-opt .ntdelbutton', function() {
                var wrap = $(this).closest('.pinhole-live-search-opt');
                var data_id = $(this).attr('data-id');
                var hidden = wrap.find('.pinhole-live-search-hidden');
                var hidden_arr_val = hidden.val().split(',');
                var index = hidden_arr_val.indexOf(data_id);

                hidden_arr_val.splice(index, 1);

                hidden.val(hidden_arr_val.toString());

                $(this).parent().remove();

            });


            $(".pinhole-live-search-items.tagchecklist").sortable({
                revert: false,
                cursor: "move",
                containment: "parent",
                opacity: 0.8,
                update: function(event, ui) {
                    var wrap = $(this).closest('.pinhole-live-search-opt');
                    var hidden = wrap.find('.pinhole-live-search-hidden');
                    var hidden_val = [];

                    $(this).find('.ntdelbutton').each(function(e) {

                        hidden_val.push($(this).attr('data-id'));

                    });

                    hidden.val(hidden_val.toString());

                }
            });


        }

    });

})(jQuery);