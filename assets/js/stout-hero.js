( function( $ ) {

	function tweak_hero_padding() {

		$( '.hero' ).css( 'padding-top', $( '#masthead' ).height() );

	}

	$( document ).ready( tweak_hero_padding );

	$( window ).on( 'resize', tweak_hero_padding );

} )( jQuery );
