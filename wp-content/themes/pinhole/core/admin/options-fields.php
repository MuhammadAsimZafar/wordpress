<?php

/* Branding */
Redux::setSection( $opt_name , array(
        'icon'      => ' el-icon-smiley',
        'title'     => esc_html__( 'Branding', 'pinhole' ),
        'desc'     => esc_html__( 'Personalize theme by adding your own images', 'pinhole' ),
        'fields'    => array(

            array(
                'id'        => 'logo',
                'type'      => 'media',
                'url'       => true,
                'title'     => esc_html__( 'Logo', 'pinhole' ),
                'subtitle'      => esc_html__( 'Upload your logo image here, or leave empty to show the website title instead.', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'logo' ),
            ),

            array(
                'id'        => 'logo_retina',
                'type'      => 'media',
                'url'       => true,
                'title'     => esc_html__( 'Retina logo (2x)', 'pinhole' ),
                'subtitle'      => esc_html__( 'Optionally upload another logo for devices with retina displays. It should be double the size of your standard logo', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'logo_retina' ),
            ),

            array(
                'id'        => 'logo_mobile',
                'type'      => 'media',
                'url'       => true,
                'title'     => esc_html__( 'Mobile logo', 'pinhole' ),
                'subtitle'      => esc_html__( 'Optionally upload another logo which may be used as mobile/tablet logo', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'logo_mobile' ),
            ),

            array(
                'id'        => 'logo_mobile_retina',
                'type'      => 'media',
                'url'       => true,
                'title'     => esc_html__( 'Mobile retina logo (2x)', 'pinhole' ),
                'subtitle'      => esc_html__( 'Upload double sized mobile logo for devices with retina displays', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'logo_mobile_retina' ),
            ),

            array(
                'id'        => 'logo_custom_url',
                'type'      => 'text',
                'title'     => esc_html__( 'Custom logo URL', 'pinhole' ),
                'subtitle'  => esc_html__( 'Optionally specify custom URL if you want logo to point out to some other page/website instead of your home page', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'logo_custom_url' ),
            ),

            array(
                'id'        => 'default_fimg',
                'type'      => 'media',
                'url'       => true,
                'title'     => esc_html__( 'Default featured image', 'pinhole' ),
                'subtitle'      => esc_html__( 'Upload your default featured image/placeholder. It will be displayed for posts that do not have a featured image set.', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'default_fimg' ),
            )

        ) )
);


/* Stylings */
Redux::setSection( $opt_name , array(
        'icon'      => 'el-icon-brush',
        'title'     => esc_html__( 'Styling & Colors', 'pinhole' ),
        'desc'     => esc_html__( 'Styling and color settings', 'pinhole' ),
        'fields'    => array(

            array(
                'id' => 'color_bg',
                'type' => 'color',
                'title' => esc_html__( 'Background color', 'pinhole' ),
                'subtitle' => esc_html__( 'This color applies to body/content background', 'pinhole' ),
                'transparent' => false,
                'default'   => pinhole_get_default_option( 'color_bg' ),
            ),

            array(
                'id' => 'background_gradient',
                'type' => 'switch',
                'title' => esc_html__( 'Background gradient', 'pinhole' ),
                'subtitle' => esc_html__( 'Enable background gradient', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'background_gradient' ),
            ),

            array(
                'id' => 'background_gradient_color',
                'type' => 'color',
                'title' => esc_html__( 'Second background color', 'pinhole' ),
                'subtitle' => esc_html__( 'This color will be used to create gradient background', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'background_gradient_color' ),
                'transparent' => false,
                'required' => array( 'background_gradient', '=', true )
            ),

            array(
                'id' => 'background_gradient_orientation',
                'type' => 'select',
                'title' => esc_html__( 'Choose gradient orientation', 'pinhole' ),
                'subtitle' => esc_html__( 'Select your desired orientation (direction) for background gradient', 'pinhole' ),
                'transparent' => false,
                'options'  => array(
                    'to right top' => esc_html__('Left bottom to right top', 'pinhole'),
                    'to right' => esc_html__('Left to right', 'pinhole'),
                    'to right bottom' => esc_html__('Left top to right bottom', 'pinhole'),
                    'to bottom' => esc_html__('Top to bottom', 'pinhole'),
                    'to left bottom' => esc_html__('Right top to left bottom', 'pinhole'),
                    'to left' => esc_html__('Right to left', 'pinhole'),
                    'to left top' => esc_html__('Right bottom to left top', 'pinhole'),
                    'to top' => esc_html__('Bottom to top', 'pinhole'),
                    'circle' => esc_html__('Circle', 'pinhole'),
                ),
                'default'   => pinhole_get_default_option( 'background_gradient_orientation' ),
                'required' => array( 'background_gradient', '=', true )
            ),

            array(
                'id' => 'color_txt',
                'type' => 'color',
                'title' => esc_html__( 'Text color', 'pinhole' ),
                'subtitle' => esc_html__( 'This color applies to standard text', 'pinhole' ),
                'transparent' => false,
                'default'   => pinhole_get_default_option( 'color_txt' ),
            ),

            array(
                'id' => 'color_overlay',
                'type' => 'color',
                'title' => esc_html__( 'Body overlay background color', 'pinhole' ),
                'subtitle' => esc_html__( 'This is the background color for overlays (eg. sidebar overlay, popup gallery overlay)', 'pinhole' ),
                'transparent' => false,
                'default'   => pinhole_get_default_option( 'color_overlay' ),
            ),

            array(
                'id' => 'color_overlay_txt',
                'type' => 'color',
                'title' => esc_html__( 'Body overlay text color', 'pinhole' ),
                'subtitle' => esc_html__( 'This is the text color for overlays (eg. sidebar overlay, popup gallery overlay)', 'pinhole' ),
                'transparent' => false,
                'default'   => pinhole_get_default_option( 'color_overlay_txt' ),
            ),

            array(
                'id' => 'color_image_overlay',
                'type' => 'color',
                'title' => esc_html__( 'Image overlay background color', 'pinhole' ),
                'subtitle' => esc_html__( 'This is the background color for all image overlays', 'pinhole' ),
                'transparent' => false,
                'default'   => pinhole_get_default_option( 'color_image_overlay' ),
            ),

            array(
                'id' => 'color_image_overlay_txt',
                'type' => 'color',
                'title' => esc_html__( 'Image overlay text color', 'pinhole' ),
                'subtitle' => esc_html__( 'This is the text color for all image overlays', 'pinhole' ),
                'transparent' => false,
                'default'   => pinhole_get_default_option( 'color_image_overlay_txt' ),
            )

        ) )
);



/* Header */
Redux::setSection( $opt_name , array(
        'icon'      => 'el-icon-bookmark',
        'title'     => esc_html__( 'Header', 'pinhole' ),
        'desc'     => esc_html__( 'Modify and style your header', 'pinhole' ),
        'fields'    => array(

             array(
                'id'        => 'header_layout',
                'type'      => 'image_select',
                'title'     => esc_html__( 'Header layout', 'pinhole' ),
                'subtitle' => esc_html__( 'Choose a layout for your header', 'pinhole' ),
                'options'   => pinhole_get_header_layouts(),
                'default'   => pinhole_get_default_option( 'header_layout' ),

            ),

            array(
                'id'        => 'header_elements',
                'type'      => 'checkbox',
                'multi'     => true,
                'title'     => esc_html__( 'Header elements', 'pinhole' ),
                'subtitle' => esc_html__( 'Check elements you want to display in header ', 'pinhole' ),
                'options'   => array(

                    'nav' => esc_html__( 'Main Navigation', 'pinhole' ),
                    'social' => esc_html__( 'Social Menu', 'pinhole' ),
                    'sidebar' => esc_html__( 'Sidebar (hamburger icon)', 'pinhole' ),
                    'search' => esc_html__( 'Search button', 'pinhole' ),
                    'desc' => esc_html__( 'Site description', 'pinhole' ),
                ),
                'default'   => pinhole_get_default_option( 'header_elements' ),
            ),

            array(
                'id'        => 'header_sticky',
                'type'      => 'switch',
                'title'     => esc_html__( 'Display sticky header', 'pinhole' ),
                'subtitle'  => esc_html__( 'Check if you want to enable sticky header', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'header_sticky' ),
            ),

            array(
                'id'        => 'header_sticky_offset',
                'type'      => 'text',
                'class'     => 'small-text',
                'title'     => esc_html__( 'Sticky header offset', 'pinhole' ),
                'subtitle'  => esc_html__( 'Specify after how many px of scrolling the sticky header appears', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'header_sticky_offset' ),
                'validate'  => 'numeric',
                'required' => array( 'header_sticky', '=', true )
            ),

            array(
                'id'        => 'header_sticky_up',
                'type'      => 'switch',
                'title'     => esc_html__( 'Smart sticky', 'pinhole' ),
                'subtitle'  => esc_html__( 'Sticky header appears only if you scroll up', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'header_sticky_up' ),
                'required' => array( 'header_sticky', '=', true )
            ),

        ) ) );


/* Gallery settings */
Redux::setSection( $opt_name , array(
        'icon'      => 'el-icon-camera',
        'title'     => esc_html__( 'Gallery', 'pinhole' ),
        'heading' => false,
        'fields'    => array(

        ) )
);

/* Single Gallery */
Redux::setSection( $opt_name ,  array(
        'subsection' => true,
        'title'     => esc_html__( 'Single Galleries', 'pinhole' ),
        'desc'     => esc_html__( 'These settings apply to galleries inserted into your pages. You can override these settings later per each added gallery separately.', 'pinhole' ),
        'fields'    => array(

            array(
                'id'        => 'gallery_layout',
                'type'      => 'image_select',
                'title'     => esc_html__( 'Layout', 'pinhole' ),
                'subtitle'  => esc_html__( 'Choose a single gallery layout', 'pinhole' ),
                'options'   => pinhole_get_main_layouts(false, array('classic')),
                'default'   => pinhole_get_default_option( 'gallery_layout' ),
            ),

            array(
                'id'        => 'gallery_columns',
                'type'      => 'button_set',
                'title'     => esc_html__( 'Columns', 'pinhole' ),
                'subtitle'  => esc_html__( 'Choose a number of columns for a selected layout', 'pinhole' ),
                'options'   => pinhole_get_layout_columns(),
                'default'   => pinhole_get_default_option( 'gallery_columns' ),
                'required'  => array( 'gallery_layout', '!=', 'justify' )
            ),

             array(
                'id'        => 'gallery_layout_size',
                'type'      => 'button_set',
                'title'     => esc_html__( 'Size', 'pinhole' ),
                'subtitle'  => esc_html__( 'Choose a size for justify layout', 'pinhole' ),
                'options'   => pinhole_get_layout_sizes(),
                'default'   => pinhole_get_default_option( 'gallery_layout_size' ),
                'required'  => array( 'gallery_layout', '=', 'justify' )
            ),

             array(
                'id' => 'gallery_prevnext',
                'type' => 'switch',
                'title' => esc_html__( 'Display prev/next gallery links', 'pinhole' ),
                'subtitle' => esc_html__( 'Check if you want to display links to previous/next galleries inside sticky bottom bar', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'gallery_prevnext' ),
            ),

             array(
                'id'        => 'gallery_share',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Display share buttons', 'pinhole' ),
                'subtitle'  => esc_html__( 'Choose social networks that you want to use for sharing posts', 'pinhole' ),
                'desc' => !function_exists('meks_ess_share') ? wp_kses_post( sprintf( __('Note: <a href="%s">Meks Easy Social Share plugin</a> must be activated to use share option.', 'pinhole'),  admin_url( 'themes.php?page=install-required-plugins' ) ) ) : '',
                'options'   => pinhole_get_social_platforms(),
                'default'   => pinhole_get_default_option( 'gallery_share' ),
                
            ),

            array(
                'id' => 'gallery_image_limit',
                'class' => 'small-text',
                'type' => 'text',
                'title' => esc_html__( 'Set image limit', 'pinhole' ),
                'subtitle' => esc_html__( 'By setting this number, only "x" images will be initially displayed, while the rest of images will be accessible in popup mode', 'pinhole' ),
                'description' => esc_html__( 'Note: Set limit to 0 if you want to display all images', 'pinhole' ),
                'validate' => 'numeric',
                'default'   => pinhole_get_default_option( 'gallery_image_limit' ),
            ),

            array(
                'id' => 'gallery_popup_image_size',
                'class' => 'small-text',
                'type' => 'text',
                'title' => esc_html__( 'Max image size in popup', 'pinhole' ),
                'subtitle' => esc_html__( 'Specify a value to limit the size of popup images, or leave empty if you want gallery to always load full size images', 'pinhole' ),
                'description' => esc_html__('Note: value is in px', 'pinhole'),
                'validate' => 'numeric',
                'default'   => pinhole_get_default_option( 'gallery_popup_image_size' ),
            ),

            array(
                'id' => 'gallery_image_caption',
                'type' => 'switch',
                'title' => esc_html__( 'Display image captions', 'pinhole' ),
                'subtitle' => esc_html__( 'Check if you want to display image captions in pop-up', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'gallery_image_caption' ),
            ),

            array(
                'id'        => 'gallery_image_meta',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Display image meta', 'pinhole' ),
                'subtitle'  => esc_html__( 'Check and re-order what image meta data you want to display in pop-up', 'pinhole' ),
                'description' => esc_html__( 'Note: In order to pull this data, it should be present in an actual image file before it was uploaded into WordPress', 'pinhole' ),
                'options'   => pinhole_get_image_meta_opts(),
                'default'   => pinhole_get_default_option( 'gallery_image_meta' ),
            ),
            
    
            array(
                'id' => 'gallery_image_drawer_open',
                'type' => 'switch',
                'title' => esc_html__( 'Popup image bottom drawer initially open', 'pinhole' ),
                'subtitle' => esc_html__( 'If set to ON, bottom drawer which displays image caption and meta data in pop up will be initially visible', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'gallery_image_drawer_open' ),
            ),

            array(
                'id' => 'gallery_popup_autoplay',
                'type' => 'switch',
                'title' => esc_html__( 'Enable popup images auto play (rotate)', 'pinhole' ),
                'subtitle' => esc_html__( 'When popup is open, images in gallery will start playing (rotating) automatically', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'gallery_popup_autoplay' ),
            ),

            array(
                'id' => 'gallery_image_download',
                'type' => 'switch',
                'title' => esc_html__( 'Enable download for password protected galleries', 'pinhole' ),
                'subtitle' => esc_html__( 'If page with gallery is password protected, download button will appear for each image ', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'gallery_image_download' ),
            ),

            array(
                'id' => 'gallery_image_number',
                'type' => 'switch',
                'title' => esc_html__( 'Display image ordinal number for password protected galleries', 'pinhole' ),
                'subtitle' => esc_html__( 'If page with a gallery is password protected, show ordinal number over images', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'gallery_image_number' ),
            ),
            
            array(
                'id' => 'gallery_image_filename',
                'type' => 'switch',
                'title' => esc_html__( 'Display image filename for password protected galleries', 'pinhole' ),
                'subtitle' => esc_html__( 'If page with a gallery is password protected, show image filename over images', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'gallery_image_filename' ),
            )

        ) )
);

/* Galleries */
Redux::setSection( $opt_name ,  array(
        'subsection' => true,
        'title'     => esc_html__( 'Gallery Archives', 'pinhole' ),
        'desc'     => esc_html__( 'These settings apply to Galleries Page Template which lists your galleries. You can override these settings later per each Galleries page template separately.', 'pinhole' ),
        'fields'    => array(

            array(
                'id'        => 'galleries_layout',
                'type'      => 'image_select',
                'title'     => esc_html__( 'Layout', 'pinhole' ),
                'subtitle'  => esc_html__( 'Choose a your for listing galleries', 'pinhole' ),
                'options'   => pinhole_get_main_layouts(false, array('classic')),
                'default'   => pinhole_get_default_option( 'galleries_layout' ),
            ),

            array(
                'id'        => 'galleries_columns',
                'type'      => 'button_set',
                'title'     => esc_html__( 'Columns', 'pinhole' ),
                'subtitle'  => esc_html__( 'Choose a number of columns for a selected layout', 'pinhole' ),
                'options'   => pinhole_get_layout_columns(),
                'default'   => pinhole_get_default_option( 'galleries_columns' ),
                'required'  => array( 'galleries_layout', '!=', 'justify' )
            ),

            array(
                'id'        => 'galleries_layout_size',
                'type'      => 'button_set',
                'title'     => esc_html__( 'Size', 'pinhole' ),
                'subtitle'  => esc_html__( 'Choose a size for justify layout', 'pinhole' ),
                'options'   => pinhole_get_layout_sizes(),
                'default'   => pinhole_get_default_option( 'galleries_layout_size' ),
                'required'  => array( 'galleries_layout', '=', 'justify' )
            ),

            array(
                'id'        => 'galleries_items',
                'type'      => 'image_select',
                'title'     => esc_html__( 'Galleries style', 'pinhole' ),
                'subtitle'  => esc_html__( 'Choose a style for galleries', 'pinhole' ),
                'options'   => pinhole_get_layout_styles(),
                'default'   => pinhole_get_default_option( 'galleries_items' ),
            ),

            array(
                'id' => 'galleries_image_count',
                'type' => 'switch',
                'title' => esc_html__( 'Display image count', 'pinhole' ),
                'subtitle' => esc_html__( 'Check if you want to display image number below each gallery item', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'galleries_image_count' ),
            )

        ) )
);



/* Albums */
Redux::setSection( $opt_name ,  array(
        'subsection' => true,
        'title'     => esc_html__( 'Albums', 'pinhole' ),
        'desc'     => esc_html__( 'These settings apply to Albums Page Template which lists your albums. You can override these settings later per each Albums page template separately.', 'pinhole' ),
        'fields'    => array(

            array(
                'id'        => 'albums_layout',
                'type'      => 'image_select',
                'title'     => esc_html__( 'Layout', 'pinhole' ),
                'subtitle'  => esc_html__( 'Choose a your for albums listing', 'pinhole' ),
                'options'   => pinhole_get_main_layouts(false, array('classic')),
                'default'   => pinhole_get_default_option( 'albums_layout' ),
            ),

            array(
                'id'        => 'albums_columns',
                'type'      => 'button_set',
                'title'     => esc_html__( 'Columns', 'pinhole' ),
                'subtitle'  => esc_html__( 'Choose a number of columns for a selected layout', 'pinhole' ),
                'options'   => pinhole_get_layout_columns(),
                'default'   => pinhole_get_default_option( 'albums_columns' ),
                'required'  => array( 'albums_layout', '!=', 'justify' )
            ),

            array(
                'id'        => 'albums_layout_size',
                'type'      => 'button_set',
                'title'     => esc_html__( 'Size', 'pinhole' ),
                'subtitle'  => esc_html__( 'Choose a size for justify layout', 'pinhole' ),
                'options'   => pinhole_get_layout_sizes(),
                'default'   => pinhole_get_default_option( 'albums_layout_size' ),
                'required'  => array( 'albums_layout', '=', 'justify' )
            ),

            array(
                'id'        => 'albums_items',
                'type'      => 'image_select',
                'title'     => esc_html__( 'Albums style', 'pinhole' ),
                'subtitle'  => esc_html__( 'Choose a style for albums', 'pinhole' ),
                'options'   => pinhole_get_layout_styles(),
                'default'   => pinhole_get_default_option( 'albums_items' ),
            ),

            array(
                'id' => 'albums_gallery_count',
                'type' => 'switch',
                'title' => esc_html__( 'Display gallery count', 'pinhole' ),
                'subtitle' => esc_html__( 'Check if you want to display number of galleries below each album item', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'albums_gallery_count' ),
            )

        ) )
);


/* Blog settings */
Redux::setSection( $opt_name , array(
        'icon'      => 'el-icon-pencil',
        'title'     => esc_html__( 'Blog', 'pinhole' ),
        'heading' => false,
        'fields'    => array(
        ) )
);


/* Archives */
Redux::setSection( $opt_name ,  array(
        'subsection' => true,
        'title'     => esc_html__( 'Archive Templates', 'pinhole' ),
        'desc'     => esc_html__( 'These settings apply to blog archive templates i.e. category pages, tag pages, index etc...', 'pinhole' ),
        'fields'    => array(


            array(
                'id'        => 'archive_layout',
                'type'      => 'image_select',
                'title'     => esc_html__( 'Layout', 'pinhole' ),
                'subtitle'  => esc_html__( 'Choose your main post layout', 'pinhole' ),
                'options'   => pinhole_get_main_layouts(),
                'default'   => pinhole_get_default_option( 'archive_layout' ),
            ),

            array(
                'id'        => 'archive_columns',
                'type'      => 'button_set',
                'title'     => esc_html__( 'Columns', 'pinhole' ),
                'subtitle'  => esc_html__( 'Choose a number of columns for a selected layout', 'pinhole' ),
                'options'   => pinhole_get_layout_columns(),
                'default'   => pinhole_get_default_option( 'archive_columns' ),
                'required'  => array( 
                    array( 'archive_layout', '!=', 'justify' ),
                    array( 'archive_layout', '!=', 'classic' )
                )
            ),

            array(
                'id'        => 'archive_layout_size',
                'type'      => 'button_set',
                'title'     => esc_html__( 'Size', 'pinhole' ),
                'subtitle'  => esc_html__( 'Choose a size for justify layout', 'pinhole' ),
                'options'   => pinhole_get_layout_sizes(),
                'default'   => pinhole_get_default_option( 'archive_layout_size' ),
                'required'  => array( 'archive_layout', '=', 'justify' )
            ),

            array(
                'id'        => 'archive_items',
                'type'      => 'image_select',
                'title'     => esc_html__( 'Posts style', 'pinhole' ),
                'subtitle'  => esc_html__( 'Choose a posts style', 'pinhole' ),
                'options'   => pinhole_get_layout_styles(),
                'default'   => pinhole_get_default_option( 'archive_items' ),
                'required'  => array( 'archive_layout', '!=', 'classic' )
            ),

            array(
                'id' => 'archive_category',
                'type' => 'switch',
                'title' => esc_html__( 'Display category', 'pinhole' ),
                'subtitle' => esc_html__( 'Check if you want to display post category link', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'archive_category' ),
            ),

            array(
                'id'        => 'archive_meta',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Display meta data', 'pinhole' ),
                'subtitle'  => esc_html__( 'Check and re-order which post meta data you want to display', 'pinhole' ),
                'options'   => pinhole_get_meta_opts(),
                'default'   => pinhole_get_default_option( 'archive_meta' ),
            ),

            array(
                'id' => 'archive_excerpt',
                'type' => 'switch',
                'title' => esc_html__( 'Display excerpt', 'pinhole' ),
                'subtitle' => esc_html__( 'Check if you want to display text excerpt', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'archive_excerpt' ),
                'required'  => array( array( 'archive_items', '=', 'below'), array( 'archive_layout', '!=', 'justify' ) )
            ),

             array(
                'id' => 'archive_excerpt_limit',
                'type' => 'text',
                'class' => 'small-text',
                'title' => esc_html__( 'Excerpt limit', 'pinhole' ),
                'subtitle' => esc_html__( 'Specify your excerpt limit', 'pinhole' ),
                'desc' => esc_html__( 'Note: Value represents number of characters', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'archive_excerpt_limit' ),
                'validate' => 'numeric',
                'required'  => array( 'archive_excerpt', '=', true )
            ),


            array(
                'id'        => 'archive_pagination',
                'type'      => 'image_select',
                'title'     => esc_html__( 'Pagination', 'pinhole' ),
                'subtitle'  => esc_html__( 'Choose a pagination type for archive templates', 'pinhole' ),
                'options'   => pinhole_get_pagination_layouts(),
                'default'   => pinhole_get_default_option( 'archive_pagination' ),
            )

        ) )
);



/* Single Post */
Redux::setSection( $opt_name , array(
        'subsection' => true,
        'title'     => esc_html__( 'Single Post', 'pinhole' ),
         'desc'     => esc_html__( 'Manage settings for your single posts', 'pinhole' ),
        'fields'    => array(


            array(
                'id' => 'single_category',
                'type' => 'switch',
                'title' => esc_html__( 'Display category', 'pinhole' ),
                'subtitle' => esc_html__( 'Check if you want to display the post category link', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'single_category' ),
            ),

            array(
                'id'        => 'single_meta',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Meta data', 'pinhole' ),
                'subtitle'  => esc_html__( 'Check and re-order which meta data you want to display', 'pinhole' ),
                'options'   => pinhole_get_meta_opts(),
                'default'   => pinhole_get_default_option( 'single_meta' ),
            ),

            array(
                'id' => 'single_fimg',
                'type' => 'switch',
                'title' => esc_html__( 'Display featured image', 'pinhole' ),
                'subtitle' => esc_html__( 'Check if you want to display the featured image', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'single_fimg' ),
            ),

            array(
                'id' => 'single_tags',
                'type' => 'switch',
                'title' => esc_html__( 'Display tags', 'pinhole' ),
                'subtitle' => esc_html__( 'Check if you want to display tags', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'single_tags' ),
            ),

            array(
                'id'        => 'single_share',
                'type'      => 'sortable',
                'mode'      => 'checkbox',
                'title'     => esc_html__( 'Display share buttons', 'pinhole' ),
                'subtitle'  => esc_html__( 'Choose social networks that you want to use for sharing posts', 'pinhole' ),
                'desc' => !function_exists('meks_ess_share') ? wp_kses_post( sprintf( __('Note: <a href="%s">Meks Easy Social Share plugin</a> must be activated to use share option.', 'pinhole'),  admin_url( 'themes.php?page=install-required-plugins' ) ) ) : '',
                'options'   => pinhole_get_social_platforms(),
                'default'   => pinhole_get_default_option( 'single_share' ),
                
            ),
            
            array(
                'id' => 'single_author',
                'type' => 'switch',
                'title' => esc_html__( 'Display author area', 'pinhole' ),
                'subtitle' => esc_html__( 'Check if you want to display the author area', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'single_author' ),
            ),

            array(
                'id' => 'single_prevnext',
                'type' => 'switch',
                'title' => esc_html__( 'Display prev/next post links', 'pinhole' ),
                'subtitle' => esc_html__( 'Check if you want to display links to previous/next post', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'single_prevnext' ),
            ),

        ) )
);

/* Footer */

Redux::setSection( $opt_name , array(
        'icon'      => 'el-icon-bookmark-empty',
        'title'     => esc_html__( 'Footer', 'pinhole' ),
        'desc'     => esc_html__( 'Manage options for your footer area', 'pinhole' ),
        'fields'    => array(

            array(
                'id' => 'footer_copyright',
                'type' => 'editor',
                'title' => esc_html__( 'Copyright', 'pinhole' ),
                'subtitle' => esc_html__( 'Specify the copyright text to show at the bottom of the website', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'footer_copyright' ),
                'args'   => array(
                    'textarea_rows'    => 5,
                    'default_editor' => 'html'),
            )

        ) )
);


/* Typography */
Redux::setSection( $opt_name , array(
        'icon'      => 'el-icon-fontsize',
        'title'     => esc_html__( 'Typography', 'pinhole' ),
        'desc'     => esc_html__( 'Manage fonts and typography settings', 'pinhole' ),
        'fields'    => array(

            array(
                'id'          => 'main_font',
                'type'        => 'typography',
                'title'       => esc_html__( 'Main text font', 'pinhole' ),
                'google'      => true,
                'font-backup' => false,
                'font-size' => false,
                'color' => false,
                'line-height' => false,
                'text-align' => false,
                'units'       =>'px',
                'subtitle'    => esc_html__( 'This is your main font, used for standard text', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'main_font' ),
                'preview' => array(
                    'always_display' => true,
                    'font-size' => '16px',
                    'line-height' => '26px',
                    'text' => 'This is a font used for your main content on the website. Here at Meks, we believe that readability is a very important part of any WordPress theme. This is an example of how a simple paragraph of text will look like on your website.'
                )
            ),

            array(
                'id'          => 'h_font',
                'type'        => 'typography',
                'title'       => esc_html__( 'Headings font', 'pinhole' ),
                'google'      => true,
                'font-backup' => false,
                'font-size' => false,
                'color' => false,
                'line-height' => false,
                'text-align' => false,
                'units'       =>'px',
                'subtitle'    => esc_html__( 'This is a font used for titles and headings', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'h_font' ),
                'preview' => array(
                    'always_display' => true,
                    'font-size' => '35px',
                    'line-height' => '50px',
                    'text' => 'There is no good blog without great readability'
                )

            ),

            array(
                'id'          => 'nav_font',
                'type'        => 'typography',
                'title'       => esc_html__( 'Navigation font', 'pinhole' ),
                'google'      => true,
                'font-backup' => false,
                'font-size' => false,
                'color' => false,
                'line-height' => false,
                'text-align' => false,
                'units'       =>'px',
                'subtitle'    => esc_html__( 'This is a font used for main website navigation (also for meta text below headings)', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'nav_font' ),
                'preview' => array(
                    'always_display' => true,
                    'font-size' => '11px',
                    'text' => 'HOME &nbsp;&nbsp;ABOUT &nbsp;&nbsp;BLOG &nbsp;&nbsp;CONTACT'
                )

            ),

            array(
                'id'          => 'finetune',
                'type'        => 'section',
                'indent' => false,
                'title'       => esc_html__( 'Fine-tune typography', 'pinhole' ),
                'subtitle'    => esc_html__( 'Advanced options to adjust font sizes', 'pinhole' )
            ),


            array(
                'id'       => 'font_size_p',
                'type'     => 'spinner',
                'title'    => esc_html__( 'Main text font size', 'pinhole' ),
                'subtitle' => esc_html__( 'This is your default text font size', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'font_size_p' ),
                'min'      => '12',
                'step'     => '1',
                'max'      => '22',
            ),

            array(
                'id'       => 'font_size_nav',
                'type'     => 'spinner',
                'title'    => esc_html__( 'Navigation font size', 'pinhole' ),
                'subtitle' => esc_html__( 'Applies to main website navigation', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'font_size_nav' ),
                'min'      => '10',
                'step'     => '1',
                'max'      => '20',
            ),

            array(
                'id'       => 'font_size_section_title',
                'type'     => 'spinner',
                'title'    => esc_html__( 'Page/section title font size', 'pinhole' ),
                'subtitle' => esc_html__( 'Applies to main heading elements such as page/post titles etc...', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'font_size_section_title' ),
                'min'      => '14',
                'step'     => '1',
                'max'      => '30',
            ),

            array(
                'id'       => 'font_size_widget_title',
                'type'     => 'spinner',
                'title'    => esc_html__( 'Widget title font size', 'pinhole' ),
                'subtitle' => esc_html__( 'Applies to main heading elements such as page/post titles etc...', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'font_size_widget_title' ),
                'min'      => '14',
                'step'     => '1',
                'max'      => '22',
            ),

            array(
                'id'       => 'font_size_meta',
                'type'     => 'spinner', 
                'title'    => esc_html__( 'Meta text font size ', 'pinhole' ),
                'subtitle' => esc_html__( 'Applies to meta items like author link, date, category link, etc...', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'font_size_meta' ),
                'min'      => '10',
                'step'     => '1',
                'max'      => '18',
            ),


            array(
                'id'       => 'font_size_h1',
                'type'     => 'spinner',
                'title'    => esc_html__( 'H1 font size', 'pinhole' ),
                'subtitle' => esc_html__( 'Applies to H1 elements and single post/page titles', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'font_size_h1' ),
                'min'      => '25',
                'step'     => '1',
                'max'      => '50',
            ),

            array(
                'id'       => 'font_size_h2',
                'type'     => 'spinner',
                'title'    => esc_html__( 'H2 font size', 'pinhole' ),
                'subtitle' => esc_html__( 'Applies to H2 elements', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'font_size_h2' ),
                'min'      => '20',
                'step'     => '1',
                'max'      => '40',
            ),

            array(
                'id'       => 'font_size_h3',
                'type'     => 'spinner',
                'title'    => esc_html__( 'H3 font size', 'pinhole' ),
                'subtitle' => esc_html__( 'Applies to H3 elements', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'font_size_h3' ),
                'min'      => '16',
                'step'     => '1',
                'max'      => '32',
            ),

            array(
                'id'       => 'font_size_h4',
                'type'     => 'spinner',
                'title'    => esc_html__( 'H4 font size', 'pinhole' ),
                'subtitle' => esc_html__( 'Applies to H4 elements', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'font_size_h4' ),
                'min'      => '14',
                'step'     => '1',
                'max'      => '30',
            ),

            array(
                'id'       => 'font_size_h5',
                'type'     => 'spinner',
                'title'    => esc_html__( 'H5 font size', 'pinhole' ),
                'subtitle' => esc_html__( 'Applies to H5 elements and widget titles', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'font_size_h5' ),
                'min'      => '14',
                'step'     => '1',
                'max'      => '24',
            ),

            array(
                'id'       => 'font_size_h6',
                'type'     => 'spinner',
                'title'    => esc_html__( 'H6 font size', 'pinhole' ),
                'subtitle' => esc_html__( 'Applies to H6 elements', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'font_size_h6' ),
                'min'      => '14',
                'step'     => '1',
                'max'      => '22',
            ),

             array(
                'id' => 'uppercase',
                'type' => 'checkbox',
                'multi' => true,
                'title' => esc_html__( 'Uppercase text', 'pinhole' ),
                'subtitle' => esc_html__( 'Check if you want to show CAPITAL LETTERS for specific elements', 'pinhole' ),
                'options' => array(
                    '.site-title' => esc_html__( 'Site title', 'pinhole' ),
                    '.site-description' => esc_html__( 'Site description', 'pinhole' ),
                    '.pinhole-nav > li > a' => esc_html__( 'Main navigation', 'pinhole' ),
                    '.section-title .entry-title, .widget-title' => esc_html__( 'Page titles & widget titles', 'pinhole' ),
                    '.entry-category a, .entry-meta, .section-actions a, .entry-tags a' => esc_html__( 'Meta elements', 'pinhole' ),
                    'h1, h2, h3, h4, h5, h6' => esc_html__( 'H elements (inside page/post content)', 'pinhole' ),
                ),
               'default'   => pinhole_get_default_option( 'uppercase' ),
            ),

        ) )
);




/* Misc. */
Redux::setSection( $opt_name , array(
        'icon'      => 'el-icon-wrench',
        'title'     => esc_html__( 'Misc.', 'pinhole' ),
        'desc'     => esc_html__( 'These are some additional miscellaneous theme settings', 'pinhole' ),
        'fields'    => array(

            array(
                'id' => 'rtl_mode',
                'type' => 'switch',
                'title' => esc_html__( 'RTL mode (right to left)', 'pinhole' ),
                'subtitle' => esc_html__( 'Enable this option if you are using right to left writing/reading', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'rtl_mode' ),
            ),

            array(
                'id' => 'rtl_lang_skip',
                'type' => 'text',
                'title' => esc_html__( 'Skip RTL for specific language(s)', 'pinhole' ),
                'subtitle' =>  wp_kses_post( sprintf( __( 'Paste specific WordPress language %s to exclude it from the RTL mode', 'pinhole' ), '<a href="http://wpcentral.io/internationalization/" target="_blank">locale code</a>' ) ),
                'desc' => esc_html__( 'i.e. If you are using Arabic and English versions on the same WordPress installation you should put "en_US" in this field and its version will not be displayed as RTL. Note: To exclude multiple languages, separate by comma: en_US, de_DE', 'pinhole' ),                'default' => '',
                'default'   => pinhole_get_default_option( 'rtl_lang_skip' ),
                'required' => array( 'rtl_mode', '=', true )
            ),


            array(
                'id' => 'more_string',
                'type' => 'text',
                'class' => 'small-text',
                'title' => esc_html__( 'More string', 'pinhole' ),
                'subtitle' => esc_html__( 'Specify your "more" string to append after limited post excerpts', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'more_string' ),
                'validate' => 'no_html'
            ),

            array(
                'id' => 'use_gallery',
                'type' => 'switch',
                'title' => esc_html__( 'Use built-in theme gallery', 'pinhole' ),
                'subtitle' => esc_html__( 'Enable this option if you want to use built-in theme gallery style, or disable if you are using some other gallery plugin to avoid conflicts', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'use_gallery' ),
            ),

            array(
                'id' => 'disable_right_click',
                'type' => 'switch',
                'title' => esc_html__( 'Disable right click', 'pinhole' ),
                'subtitle' => esc_html__( 'Use this option to protect your images by disabling mouse right click.', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'disable_right_click' ),
            ),

            array(
                'id' => 'words_read_per_minute',
                'type' => 'text',
                'class' => 'small-text',
                'title' => esc_html__( 'Words to read per minute', 'pinhole' ),
                'subtitle' => esc_html__( 'Use this option to set number of words your visitors read per minute, in order to fine-tune calculation of post reading time meta data', 'pinhole' ),
                'validate' => 'numeric',
                'default'   => pinhole_get_default_option( 'words_read_per_minute' ),
            ),

            array(
                'id' => 'on_single_img_popup',
                'type' => 'switch',
                'title' => esc_html__( 'Open content image(s) in popup', 'pinhole' ),
                'subtitle' => esc_html__( 'Enable this option if you want images inserted in the post/page content to be open in popup', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'on_single_img_popup' ),
            ),

        )
    )
);


Redux::setSection( $opt_name , array(
        'type' => 'divide',
        'id' => 'pinhole-divide',
    ) );

/* Translation Options */

$translate_options[] = array(
    'id' => 'enable_translate',
    'type' => 'switch',
    'switch' => true,
    'title' => esc_html__( 'Enable theme translation?', 'pinhole' ),
    'default'   => pinhole_get_default_option( 'enable_translate' ),
);

$translate_strings = pinhole_get_translate_options();

foreach ( $translate_strings as $string_key => $string ) {
    $translate_options[] = array(
        'id' => 'tr_'.$string_key,
        'type' => 'text',
        'title' => esc_html( $string['text'] ),
        'subtitle' => isset( $string['desc'] ) ? $string['desc'] : '',
        'default' => ''
    );
}

Redux::setSection( $opt_name, array(
        'icon'      => 'el-icon-globe-alt',
        'title' => esc_html__( 'Translation', 'pinhole' ),
        'desc' => wp_kses_post( __( 'Use these settings to quckly translate or change the text in this theme. If you want to remove the text completely instead of modifying it, you can use <strong>"-1"</strong> as a value for particular field translation. <br/><br/><strong>Note:</strong> If you are using this theme for a multilingual website, you need to disable these options and use multilanguage plugins (such as WPML) and manual translation with .po and .mo files located inside the "languages" folder.', 'pinhole' ) ),
        'fields' => $translate_options
    ) );

/* Performance */
Redux::setSection( $opt_name , array(
        'icon'      => 'el-icon-dashboard',
        'title'     => esc_html__( 'Performance', 'pinhole' ),
        'desc'     => esc_html__( 'Use these options to put your theme to a high speed as well as save your server resources!', 'pinhole' ),
        'fields'    => array(

            array(
                'id' => 'minify_css',
                'type' => 'switch',
                'title' => esc_html__( 'Use minified CSS', 'pinhole' ),
                'subtitle' => esc_html__( 'Load all theme CSS files combined and minified into a single file.', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'minify_css' ),
            ),

            array(
                'id' => 'minify_js',
                'type' => 'switch',
                'title' => esc_html__( 'Use minified JS', 'pinhole' ),
                'subtitle' => esc_html__( 'Load all theme JavaScript files combined and minified into a single file.', 'pinhole' ),
                'default'   => pinhole_get_default_option( 'minify_js' ),
            ),

            array(
                'id' => 'disable_img_sizes',
                'type' => 'checkbox',
                'multi' => true,
                'title' => esc_html__( 'Disable additional image sizes', 'pinhole' ),
                'subtitle' => esc_html__( 'By default, theme generates an additional image size for each provided layout. You can use this option to avoid creating additional sizes if you are not using a particular layout in order to save your server space.', 'pinhole' ),
                'options' => array(
                    'col-1' => esc_html__( '1 column (used for featured image on single posts)', 'pinhole' ),
                    'col-2' => esc_html__( '2 column (used for items listed in 2 columns)', 'pinhole' ),
                    'col-3' => esc_html__( '3 column (used for items listed in 3 columns)', 'pinhole' ),
                    'col-4' => esc_html__( '4 column (used for items listed in 4 columns)', 'pinhole' ),
                    'col-2-square' => esc_html__( '2 column square (used for grid layout items listed in 2 columns)', 'pinhole' ),
                    'col-3-square' => esc_html__( '3 column square (used for grid layout items listed in 3 columns)', 'pinhole' ),
                    'col-4-square' => esc_html__( '4 column square (used for grid layout items listed in 4 columns)', 'pinhole' ),
                    'justify' => esc_html__( 'Justify layout', 'pinhole' ),
                    'popup' =>  esc_html__('Gallery popup', 'pinhole')
                ),

                'default'   => pinhole_get_default_option( 'disable_img_sizes' ),
            ),



        ) ) );


?>