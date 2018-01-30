jQuery(document).foundation();
/* 
These functions make sure WordPress 
and Foundation play nice together.
*/

jQuery(document).ready(function() {
    
    // Remove empty P tags created by WP inside of Accordion and Orbit
    jQuery('.accordion p:empty, .orbit p:empty').remove();
    
	 // Makes sure last grid item floats left
	jQuery('.archive-grid .columns').last().addClass( 'end' );
	
	// Adds Flex Video to YouTube and Vimeo Embeds
	jQuery('iframe[src*="youtube.com"], iframe[src*="vimeo.com"]').wrap("<div class='flex-video'/>");

	jQuery('.videoplace-featured-image').each(function(ev) {
		jQuery(this).on('click', function() {
			jQuery(this).hide();
			var playVideo = jQuery(this).parent('div').find('.fb-video iframe');
			if ( jQuery( playVideo ).length !== 0 ) {
                var playVideo = jQuery(this).parent('div').find('iframe');
			}
			if ( jQuery( playVideo ).length !== 0 ) {
                jQuery(playVideo)[0].src += '&autoplay=1';
			} else {
                var playPageVideo = jQuery(this).parent().find('iframe');
                if ( jQuery( playPageVideo ).length !== 0 ) {
                    jQuery(playPageVideo)[0].src += '&autoplay=1';
                }
			}
		})
	});

});