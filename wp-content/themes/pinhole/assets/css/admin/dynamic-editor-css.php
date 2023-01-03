<?php 
	
	/* Font styles */
	
	$main_font = pinhole_get_font_option( 'main_font' );
	$h_font = pinhole_get_font_option( 'h_font' );
	$nav_font = pinhole_get_font_option( 'nav_font' );
	$font_size_p = absint( pinhole_get_option( 'font_size_p' ) ); 
	$font_size_h1 = absint( pinhole_get_option( 'font_size_h1' ) );
	$font_size_h2 = absint( pinhole_get_option( 'font_size_h2' ) );
	$font_size_h3 = absint( pinhole_get_option( 'font_size_h3' ) ) ;
	$font_size_h4 = absint( pinhole_get_option( 'font_size_h4' ) );
	$font_size_h5 = absint( pinhole_get_option( 'font_size_h5' ) );
	$font_size_h6 = absint( pinhole_get_option( 'font_size_h6' ) );
	$font_size_section_title = absint( pinhole_get_option( 'font_size_section_title' ) );

	$font_size_meta = absint( pinhole_get_option( 'font_size_meta' ) );

	

	/* Colors & stylings */

	$color_bg = esc_attr( pinhole_get_option('color_bg') );
	$color_txt = esc_attr( pinhole_get_option('color_txt') );
	$color_overlay = esc_attr( pinhole_get_option('color_overlay') );
	$color_overlay_txt = esc_attr( pinhole_get_option('color_overlay_txt') );
	$color_image_overlay = esc_attr( pinhole_get_option('color_image_overlay') );
	$color_image_overlay_txt = esc_attr( pinhole_get_option('color_image_overlay_txt') );



?>


/*Typography */

.edit-post-visual-editor.editor-styles-wrapper{
	font-family: <?php echo wp_kses_post( $main_font['font-family'] ); ?>;
	font-weight: <?php echo esc_attr( $main_font['font-weight'] ); ?>;
	<?php if ( isset( $main_font['font-style'] ) && !empty( $main_font['font-style'] ) ):?>
	font-style: <?php echo esc_attr( $main_font['font-style'] ); ?>;
	<?php endif; ?>	
	font-size: <?php echo esc_attr( $font_size_p); ?>px;
	color:<?php echo esc_attr( $color_txt ); ?>;
	<?php echo pinhole_get_background_color(); ?>
}
.editor-styles-wrapper h1, 
.editor-styles-wrapper.edit-post-visual-editor .editor-post-title__block .editor-post-title__input,
.editor-styles-wrapper h2, 
.editor-styles-wrapper h3, 
.editor-styles-wrapper h4,
.editor-styles-wrapper h5,
.editor-styles-wrapper h6,
.wp-block-cover .wp-block-cover-image-text, .wp-block-cover .wp-block-cover-text, 
.wp-block-cover h2, .wp-block-cover-image .wp-block-cover-image-text, 
.wp-block-cover-image .wp-block-cover-text, .wp-block-cover-image h2{
	font-family: <?php echo wp_kses_post( $h_font['font-family'] ); ?>;
	font-weight: <?php echo esc_attr( $h_font['font-weight'] ); ?>;
	<?php if ( isset( $h_font['font-style'] ) && !empty( $h_font['font-style'] ) ):?>
	font-style: <?php echo esc_attr( $h_font['font-style'] ); ?>;
	<?php endif; ?>
}
.edit-post-visual-editor.editor-styles-wrapper p{
	font-size: <?php echo esc_attr( $font_size_p); ?>px;	
}

.edit-post-visual-editor.editor-styles-wrapper .wp-block-paragraph a{
	color: <?php echo esc_attr( $color_txt ); ?>;	
}
.edit-post-visual-editor.editor-styles-wrapper .wp-block-paragraph a:after,
.edit-post-visual-editor.editor-styles-wrapper ul li a:after{
	background-color: <?php echo esc_attr( $color_txt ); ?>;	
}


.wp-block-button__link {
	font-family: <?php echo wp_kses_post( $nav_font['font-family'] ); ?>;
	font-weight: <?php echo esc_attr( $nav_font['font-weight'] ); ?>;
	<?php if ( isset( $nav_font['font-style'] ) && !empty( $nav_font['font-style'] ) ):?>
	  font-style: <?php echo esc_attr( $nav_font['font-style'] ); ?>;
	<?php endif; ?>	
}

.editor-styles-wrapper.edit-post-visual-editor .editor-post-title__block .editor-post-title__input{
	font-size: <?php echo esc_attr( $font_size_section_title ); ?>px;	
	text-transform: uppercase;
	text-align:center;
}

.editor-styles-wrapper h1 {
  font-size: <?php echo esc_attr( $font_size_h1 ); ?>px;
}

.editor-styles-wrapper h2,
.edit-post-visual-editor.editor-styles-wrapper .wp-block-cover-image .wp-block-cover-image-text, 
.edit-post-visual-editor.editor-styles-wrapper .wp-block-cover-image .wp-block-cover-text, 
.edit-post-visual-editor.editor-styles-wrapper .wp-block-cover-image h2,
.edit-post-visual-editor.editor-styles-wrapper .wp-block-cover .wp-block-cover-image-text,
.edit-post-visual-editor.editor-styles-wrapper .wp-block-cover .wp-block-cover-text,
.edit-post-visual-editor.editor-styles-wrapper .wp-block-cover h2 {
  font-size: <?php echo esc_attr( $font_size_h2 ); ?>px;
}

.editor-styles-wrapper h3{
  font-size: <?php echo esc_attr( $font_size_h3 ); ?>px;
}

.editor-styles-wrapper h4{
  font-size: <?php echo esc_attr( $font_size_h4 ); ?>px;
}

.editor-styles-wrapper h5 {
  font-size: <?php echo esc_attr( $font_size_h5 ); ?>px;
}

.editor-styles-wrapper h6{
  font-size: <?php echo esc_attr( $font_size_h6 ); ?>px;
}

a{
	color: <?php echo esc_attr( $color_txt ); ?>;
}

blockquote, q, pre{
    background: <?php echo pinhole_hex_to_rgba($color_txt, 0.1); ?>;
}


/* Blocks */

.edit-post-visual-editor .wp-block table,
.editor-styles-wrapper .wp-block table td, 
.editor-styles-wrapper .wp-block table th{
	border: 1px solid <?php echo pinhole_hex_to_rgba($color_txt, 0.25); ?>;
}
.edit-post-visual-editor .wp-block table.is-style-stripes,
.editor-styles-wrapper .wp-block table.is-style-stripes td, 
.editor-styles-wrapper .wp-block table.is-style-stripes th{
	border: none;
}

.wp-block-button__link,
.wp-block .wp-block-search__button{
    background: <?php echo esc_attr( $color_txt ); ?>;	
		color:<?php echo esc_attr( esc_attr( $color_bg ) ); ?>;
}
.wp-block-button__link:hover{
    background: <?php echo pinhole_hex_to_rgba($color_txt, 0.7); ?>; 
	color:<?php echo esc_attr( esc_attr( $color_bg ) ); ?>;  
}

.editor-styles-wrapper .is-style-outline .wp-block-button__link {
    color: <?php echo esc_attr( esc_attr( $color_txt ) ); ?>;  
    border: 1px solid <?php echo esc_attr( esc_attr( $color_txt ) ); ?>;
}


/* Content width*/

.edit-post-visual-editor .wp-block{
	max-width: 612px;
}
.post-type-page .edit-post-visual-editor .wp-block{
	max-width: 612px;
}
.edit-post-visual-editor .wp-block[data-align="wide"],
.post-type-page .edit-post-visual-editor .wp-block[data-align="wide"]{
	max-width: 1194px;
}
.edit-post-visual-editor .wp-block[data-align="full"],
.post-type-page .edit-post-visual-editor .wp-block[data-align="full"]{
	max-width: none;
}

/* Code and preformated*/

.wp-block-code,
.editor-styles-wrapper code,
.editor-styles-wrapper pre,
.editor-styles-wrapper pre h2{
	background: <?php echo pinhole_hex_to_rgba($color_txt, 0.05); ?>;
	color: <?php echo esc_attr( $color_txt ); ?>;
}
.wp-block-code .editor-plain-text{
  background: transparent;
}

/* Pullquote and Blockquote */
.wp-block-quote,
.wp-block-quote p,
.wp-block-quote:not(.is-style-large) .editor-rich-text__tinymce p,
blockquote{
  font-size: <?php echo esc_attr($font_size_p+2); ?>px; 
}
blockquote,
blockquote p,
blockquote cite,
.wp-block-quote__citation{
  color: <?php echo esc_attr($color_txt); ?>;
}

/* Separator */
.editor-styles-wrapper .wp-block .wp-block-separator:not(.is-style-dots){
  border-bottom:1px solid <?php echo pinhole_hex_to_rgba($color_txt, 0.2); ?>;  
}
/* Search */
.editor-styles-wrapper .wp-block .wp-block-search__input{
  border: 1px solid <?php echo pinhole_hex_to_rgba($color_txt, 0.2); ?>;  
}
