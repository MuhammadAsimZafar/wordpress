<?php 
	
	/* Font styles */
	
	$main_font = pinhole_get_font_option( 'main_font' );
	$h_font = pinhole_get_font_option( 'h_font' );
	$nav_font = pinhole_get_font_option( 'nav_font' );
	$font_size_p = number_format( absint( pinhole_get_option( 'font_size_p' ) ) / 10, 1); 
	$font_size_h1 = number_format( absint( pinhole_get_option( 'font_size_h1' ) ) / 10, 1);
	$font_size_h2 = number_format( absint( pinhole_get_option( 'font_size_h2' ) ) / 10, 1);
	$font_size_h3 = number_format( absint( pinhole_get_option( 'font_size_h3' ) ) / 10, 1) ;
	$font_size_h4 = number_format( absint( pinhole_get_option( 'font_size_h4' ) ) / 10, 1);
	$font_size_h5 = number_format( absint( pinhole_get_option( 'font_size_h5' ) ) / 10, 1);
	$font_size_h6 = number_format( absint( pinhole_get_option( 'font_size_h6' ) ) / 10, 1);
	$font_size_nav = number_format( absint( pinhole_get_option( 'font_size_nav' ) ) / 10, 1);
	$font_size_meta = number_format( absint( pinhole_get_option( 'font_size_meta' ) ) / 10, 1);
	$font_size_section_title = number_format( absint( pinhole_get_option( 'font_size_section_title' ) ) / 10, 1);
	$font_size_widget_title = number_format( absint( pinhole_get_option( 'font_size_widget_title' ) ) / 10, 1);
	

	/* Colors & stylings */

	$color_bg = esc_attr( pinhole_get_option('color_bg') );
	$color_txt = esc_attr( pinhole_get_option('color_txt') );
	$color_overlay = esc_attr( pinhole_get_option('color_overlay') );
	$color_overlay_txt = esc_attr( pinhole_get_option('color_overlay_txt') );
	$color_image_overlay = esc_attr( pinhole_get_option('color_image_overlay') );
	$color_image_overlay_txt = esc_attr( pinhole_get_option('color_image_overlay_txt') );



?>


/*Typography */

body{
	font-family: <?php echo wp_kses_post( $main_font['font-family'] ); ?>;
	font-weight: <?php echo esc_attr( $main_font['font-weight'] ); ?>;
	<?php if ( isset( $main_font['font-style'] ) && !empty( $main_font['font-style'] ) ):?>
	font-style: <?php echo esc_attr( $main_font['font-style'] ); ?>;
	<?php endif; ?>	
	font-size: <?php echo esc_attr( $font_size_p); ?>rem;
	color:<?php echo esc_attr( $color_txt ); ?>;
	<?php echo pinhole_get_background_color(); ?>
}
h1,h2,h3,h4,h5,h6,
.h1,.h2,.h3,.h4,.h5,.h6,
.wp-block-cover .wp-block-cover-image-text, .wp-block-cover .wp-block-cover-text, 
.wp-block-cover h2, .wp-block-cover-image .wp-block-cover-image-text, 
.wp-block-cover-image .wp-block-cover-text, .wp-block-cover-image h2{
	font-family: <?php echo wp_kses_post( $h_font['font-family'] ); ?>;
	font-weight: <?php echo esc_attr( $h_font['font-weight'] ); ?>;
	<?php if ( isset( $h_font['font-style'] ) && !empty( $h_font['font-style'] ) ):?>
	font-style: <?php echo esc_attr( $h_font['font-style'] ); ?>;
	<?php endif; ?>
}
.pinhole-nav,
.section-filter,
.site-description,
.entry-category a,
.entry-meta,
.submit,
.mks_read_more a,
input[type="submit"],
a.mks_button,
.pinhole-button,
.submit,
.pinhole-button-social,
.widget .mks_autor_link_wrap a,
.widget .mks_read_more a,
button,
.entry-tags a,
.tagcloud a,
.pswp__counter,
.pinhole-pagination,
.pinhole-sticky-bottom a,
.wp-block-button__link {
	font-family: <?php echo wp_kses_post( $nav_font['font-family'] ); ?>;
	font-weight: <?php echo esc_attr( $nav_font['font-weight'] ); ?>;
	<?php if ( isset( $nav_font['font-style'] ) && !empty( $nav_font['font-style'] ) ):?>
	  font-style: <?php echo esc_attr( $nav_font['font-style'] ); ?>;
	<?php endif; ?>	
}
.pinhole-nav,
.pinhole-soc-menu,
.pinhole-action-sidebar{
	 font-size: <?php echo esc_attr( $font_size_nav ); ?>rem;
}

h1, .h1 {
  font-size: <?php echo esc_attr( $font_size_h1 ); ?>rem;
}

h2, .h2,
.wp-block-cover-image .wp-block-cover-image-text, .wp-block-cover-image .wp-block-cover-text, .wp-block-cover-image h2, 
.wp-block-cover .wp-block-cover-image-text, .wp-block-cover .wp-block-cover-text, .wp-block-cover h2 {
  font-size: <?php echo esc_attr( $font_size_h2 ); ?>rem;
}

h3, .h3,
.pinhole-header-3 .h1 {
  font-size: <?php echo esc_attr( $font_size_h3 ); ?>rem;
}

h4, .h4 {
  font-size: <?php echo esc_attr( $font_size_h4 ); ?>rem;
}

h5, .h5 {
  font-size: <?php echo esc_attr( $font_size_h5 ); ?>rem;
}

h6, .h6 {
  font-size: <?php echo esc_attr( $font_size_h6 ); ?>rem;
}

.section-title .entry-title{ 
	font-size: <?php echo esc_attr( $font_size_section_title ); ?>rem;
}

.widget-title{ 
	font-size: <?php echo esc_attr( $font_size_widget_title ); ?>rem;
}
.entry-category a,
.entry-meta{
	font-size: <?php echo esc_attr( $font_size_meta ); ?>rem;
}


.pinhole-sidebar,
.pinhole-section-full-content{
	background: <?php echo esc_attr( esc_attr( $color_bg ) ); ?>;	
}
.pinhole-sidebar-overlay{
	 background: <?php echo pinhole_hex_to_rgba($color_overlay, 0.8); ?>;
}


a,
.site-title a,
.pinhole-nav a,
.section-filter a,
.entry-title a,
.entry-category a,
.pinhole-button-secondary,
.pinhole-share .meks_ess a,
body .pinhole-share .meks_ess a:focus,
.pinhole-sidebar-close,
.pswp-bottom-container-action,
.pswp-arrow,
.pinhole-soc-menu{
	color: <?php echo esc_attr( $color_txt ); ?>;
}

.pswp__button,
.pswp__counter {
	color: <?php echo esc_attr( $color_overlay_txt ); ?>;
}
.pswp__bg{
    background: <?php echo pinhole_hex_to_rgba($color_overlay, 0.95); ?>;
}
.pswp-bottom-container,
.pswp-bottom-container-action{
	background: <?php echo esc_attr( esc_attr( $color_bg ) ); ?>;
}
.site-description{
	color: <?php echo pinhole_hex_to_rgba($color_txt, 0.5); ?>;
}
.section-header:before,
.widget-title:after,
.pinhole-footer:before,
.widget_rss ul li:after,
.pinhole-vertical-separator{
    background: <?php echo pinhole_hex_to_rgba($color_txt, 0.25); ?>;
}
blockquote, q, pre{
    background: <?php echo pinhole_hex_to_rgba($color_txt, 0.1); ?>;
}

.pinhole-pagination a.page-numbers:hover{
	background: <?php echo pinhole_hex_to_rgba($color_txt, 0.1); ?>;
}

.entry-meta,
.entry-meta a,
.entry-category a,
.entry-tags a,
.pinhole-sticky-bottom span{
	color: <?php echo pinhole_hex_to_rgba($color_txt, 0.8); ?>;
}

/* Elements Colors */

table,
td, th{
	border-color: <?php echo pinhole_hex_to_rgba($color_txt, 0.25); ?>;
}
.submit,
.mks_read_more a,
input[type="submit"],
a.mks_button,
.pinhole-button,
.submit,
.pinhole-button-social,
.widget .mks_autor_link_wrap a,
.widget .mks_read_more a,
button{
	color:<?php echo esc_attr( esc_attr( $color_bg ) ); ?>;
	background: <?php echo esc_attr( $color_txt ); ?>;
}


.pinhole-button-secondary{
	background: <?php echo pinhole_hex_to_rgba($color_txt, 0.1); ?>;
}
.pinhole-button-secondary:hover,
.meks_ess a:hover {
	color: <?php echo esc_attr( esc_attr( $color_bg ) ); ?>;
	background: <?php echo pinhole_hex_to_rgba($color_txt, 1); ?> !important;
}

.submit:hover,
.mks_read_more a:hover,
input[type="submit"]:hover,
a.mks_button:hover,
.pinhole-button:hover,
.submit:hover,
.pinhole-button-social:hover,
.widget .mks_autor_link_wrap a:hover,
.widget .mks_read_more a:hover,
button:hover,
.pinhole-pagination .next a:hover,
.pinhole-pagination .prev a:hover,
.pinhole-pagination .page-numbers.prev:hover,
.pinhole-pagination .page-numbers.next:hover,
.pinhole-pagination .pinhole-prev:hover,
.pinhole-pagination .pinhole-next:hover,
.load-more a:hover,
.pinhole-loader-active a{
	background: <?php echo pinhole_hex_to_rgba($color_txt, 0.7); ?>;
}
.pinhole-image-counter,
.pinhole-item .pinhole-download,
.pswp__zoom-wrap .pinhole-download,
.post-password-protected:before,
.post-password-required:before {
	color: <?php echo esc_attr( $color_txt ); ?>;
	background: <?php echo esc_attr( esc_attr( $color_bg ) ); ?>;
}

/* Border styles */

input[type="text"], input[type="email"], input[type="url"], input[type="tel"], input[type="number"], input[type="date"], input[type="password"],input[type="search"], textarea, select{
	border-color:<?php echo pinhole_hex_to_rgba($color_txt, 0.2); ?>;
}


/* Pagination */

.load-more a,
.pinhole-pagination .page-numbers.prev,
.pinhole-pagination .page-numbers.next,
.pinhole-pagination .prev-next a,
.pinhole-pagination .prev-next a,
.pinhole-pagination .next a,
.pinhole-pagination .prev a,
.pinhole-infinite-scroll a,
.pinhole-link-pages > span,
.module-actions ul.page-numbers span.page-numbers{
  color: <?php echo esc_attr( esc_attr( $color_bg ) ); ?>;
  background-color: <?php echo esc_attr( $color_txt ); ?>;
}
.pinhole-pagination .current{
	color: <?php echo esc_attr( esc_attr( $color_bg ) ); ?>;
  	background-color: <?php echo esc_attr( $color_txt ); ?>;
}


.pinhole-nav > li > a:after{
	background-color:<?php echo esc_attr( $color_txt ); ?>;
}

.pinhole-nav .sub-menu,
.pinhole-search .sub-menu {
    background: <?php echo pinhole_hex_to_rgba($color_txt, 0.95); ?>;
    color: <?php echo esc_attr( esc_attr( $color_bg ) ); ?>;
}
.pinhole-nav .sub-menu a{
    color: <?php echo esc_attr( esc_attr( $color_bg ) ); ?>;
}
.entry-title a:after,
.entry-category a:after,
.entry-meta a:after,
.entry-content a:after,
.filter-active:after,
.section-actions a:after,
.entry-tags a:after,
.widget li a:before,
.widget p a:before{
    background-color: <?php echo esc_attr( $color_txt ); ?>;
}

/* Items */
.items-hidden .pinhole-info,
.items-overlay .pinhole-info,
.items-hidden .entry-title a,
.items-hidden .entry-category a,
.items-hidden .entry-meta a,
.items-overlay .entry-title a,
.items-overlay .entry-category a,
.items-overlay a,
.items-gradient a,
.items-gradient .entry-title a,
.items-gradient .pinhole-info,
.items-gradient .entry-category a,
.items-overlay .entry-meta a,
.items-overlay .entry-meta,
.items-hidden .entry-meta a,
.items-hidden .entry-meta,
.items-gradient .entry-meta a,
.items-gradient .entry-meta {
    color: <?php echo esc_attr( $color_image_overlay_txt ); ?>;
}
.items-overlay .pinhole-item:hover .item-link:after{
    background: <?php echo pinhole_hex_to_rgba($color_image_overlay, 0.8); ?>;
}
.items-hidden .item-link:after,
.items-overlay .item-link:after,
.items-below .item-link:after,
.items-gradient .item-link:after,
.items-hidden .pinhole-info-more .item-link:after {
    background: <?php echo pinhole_hex_to_rgba($color_image_overlay, 0.5); ?>;
}

.items-hidden .pinhole-item:hover .item-link:after{
    background: <?php echo pinhole_hex_to_rgba($color_image_overlay, 0.8); ?>;
}
.pinhole-popup.items-hidden .pinhole-item:hover .item-link:after{
    background: <?php echo pinhole_hex_to_rgba($color_image_overlay, 0.5); ?>;
}
.pinhole-popup.items-hidden .pinhole-info-more:hover .item-link:after{
    background: <?php echo pinhole_hex_to_rgba($color_image_overlay, 0.8); ?>;
}

.items-gradient .entry-title a:after,
.items-gradient .entry-category a:after,
.items-gradient .entry-meta a:after,
.items-hidden .entry-title a:after,
.items-hidden .entry-category a:after,
.items-hidden .entry-meta a:after,
.items-overlay .entry-title a:after,
.items-overlay .entry-category a:after,
.items-overlay .entry-meta a:after{
    background: <?php echo pinhole_hex_to_rgba(esc_attr( $color_bg ), 1); ?>;
}


.items-gradient .item-link:before{
    background: -moz-linear-gradient(top, <?php echo pinhole_hex_to_rgba($color_image_overlay, 0); ?> 0%, <?php echo pinhole_hex_to_rgba($color_image_overlay, 0.9); ?> 100%);
    background: -webkit-linear-gradient(top, <?php echo pinhole_hex_to_rgba($color_image_overlay, 0); ?> 0%, <?php echo pinhole_hex_to_rgba($color_image_overlay, 0.9); ?> 100%);
    background: -ms-linear-gradient(top, <?php echo pinhole_hex_to_rgba($color_image_overlay, 0); ?> 0%, <?php echo pinhole_hex_to_rgba($color_image_overlay, 0.9); ?> 100%);
    background: -o-linear-gradient(top, <?php echo pinhole_hex_to_rgba($color_image_overlay, 0); ?> 0%, <?php echo pinhole_hex_to_rgba($color_image_overlay, 0.9); ?> 100%);
    background: linear-gradient(to bottom, <?php echo pinhole_hex_to_rgba($color_image_overlay, 0); ?> 0%, <?php echo pinhole_hex_to_rgba($color_image_overlay, 0.9); ?> 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00000000', endColorstr='#a6000000',GradientType=0 );
}


.pinhole-header-sticky,
.pinhole-sticky-bottom{
	background: <?php echo esc_attr( $color_bg ); ?>;
    border-color: <?php echo pinhole_hex_to_rgba($color_txt, 0.1); ?>;
}
@media (max-width: 750px){
.pinhole-header{
	background: <?php echo esc_attr( $color_bg ); ?>;
}
}
@media (max-width: 630px){
.sticky-bottom-slot{
	border-color: <?php echo pinhole_hex_to_rgba($color_txt, 0.1); ?>;
}
}

.pinhole-sidebar-close path,
.pinhole-search-close path {
	fill:<?php echo esc_attr( $color_txt ); ?>;
}
/* Blocks */

.wp-block-button__link{
	background: <?php echo esc_attr( $color_txt ); ?>;	
}
.wp-block-image figcaption{
	color: <?php echo esc_attr( $color_txt ); ?>;
}
.wp-block-separator:not(.is-style-dots){
  background: <?php echo pinhole_hex_to_rgba($color_txt, 0.2); ?>;  
}

<?php

/* Apply uppercase options */
$uppercase = pinhole_get_option( 'uppercase' );
if ( !empty( $uppercase ) ) {
  foreach ( $uppercase as $selector => $val ) {
  	$selector_style = $val ? '{text-transform: uppercase;}' : '{text-transform: none;}';
  	echo sanitize_text_field( $selector . $selector_style );
  }
}

/* Editor font sizes */
$font_sizes = pinhole_get_editor_font_sizes();

if ( !empty( $font_sizes ) ) {
    foreach ( $font_sizes as $id => $item ) {  
        	echo '.has-'. $item['slug'] .'-font-size{ font-size: '.number_format( $item['size'] / 10,  1 ) .'rem;}';
    }
}

/* Editor colors */
$colors = pinhole_get_editor_colors();

if ( !empty( $colors ) ) {
    foreach ( $colors as $id => $item ) {  
        	echo '.has-'. $item['slug'] .'-background-color{ background-color: ' . esc_attr($item['color']) .';}';
        	echo '.has-'. $item['slug'] .'-color{ color: ' . esc_attr($item['color']) .';}';
    }
}

?>