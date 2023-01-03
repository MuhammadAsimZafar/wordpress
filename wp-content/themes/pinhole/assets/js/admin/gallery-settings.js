/**
 * Pinhole Gallery Settings
 */
(function($) {

	"use strict";
	
	var media = wp.media;

	// Wrap the render() function to append controls.
	media.view.Settings.Gallery = media.view.Settings.Gallery.extend({
		render: function() {
			var $el = this.$el;

			media.view.Settings.prototype.render.apply( this, arguments );

			// Append the type template and update the settings.
			$el.append( media.template( 'pinhole-gallery-settings' ) );
			media.gallery.defaults.pinhole_settings = 'default';
			media.gallery.defaults.pinhole_layout = 'default';
			media.gallery.defaults.pinhole_layout_size = 'default';
			media.gallery.defaults.pinhole_columns = 'default';
			media.gallery.defaults.pinhole_image_limit = '';
			this.update.apply( this, ['pinhole_settings'] );
			this.update.apply( this, ['pinhole_layout'] );
			this.update.apply( this, ['pinhole_layout_size'] );
			this.update.apply( this, ['pinhole_columns'] );
			this.update.apply( this, ['pinhole_image_limit'] );

			// Hide the default settings
			$el.find( 'select[name=columns]' ).closest( 'label.setting' ).hide();
			$el.find( 'select.link-to' ).closest( 'label.setting' ).hide();
			$el.find( 'select[name=size]' ).closest( 'label.setting' ).hide();

			// Hide the settings if not set to "custom"
			$el.find( 'select.pinhole-opt-settings' ).on( 'change', function () {
				var settings = $el.closest( '.gallery-settings' ).find('.pinhole-setting');

				if ( 'custom' === $( this ).val() ) {
					settings.show();

					$el.find( 'select.pinhole-opt-layout' ).on( 'change', function () {
						var layout_size = $el.closest( '.gallery-settings' ).find('.pinhole-opt-layout_size').closest('.pinhole-setting');
						var layout_columns = $el.closest( '.gallery-settings' ).find('.pinhole-opt-columns').closest('.pinhole-setting');
					
							if ( 'justify' === $( this ).val() ) {
								layout_size.show();
								layout_columns.hide();
							} else {
								layout_size.hide();
								layout_columns.show();
							}
							
					} ).change();


				} else {
					settings.hide();
				}

			} ).change();

			return this;
		}
	});
})(jQuery);
