(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	 $(document).ready(function() {
		var getPostID = $('#post_ID').val();

		$('#shortcode_tab_to_copy').html('[tab_awesome id="'+getPostID+'"]');

		$('[href*="https://themesawesome.zendesk.com/hc/en-us/categories/360004553992-TAB-Awesome"]').addClass('doc-link');
		$('li a[href*="https://1.envato.market/QBG1A"]').addClass('pro-link');
	});

})( jQuery );
