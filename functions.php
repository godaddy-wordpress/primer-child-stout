<?php

/**
 * Move some elements around.
 *
 * @action template_redirect
 * @since  1.0.0
 */
function stout_move_elements() {

	remove_action( 'primer_header',       'primer_add_hero' );
	remove_action( 'primer_after_header', 'primer_add_primary_navigation' );
	remove_action( 'primer_after_header', 'primer_add_page_title' );

	add_action( 'primer_after_header', 'primer_add_hero' );
	add_action( 'primer_header',       'primer_add_primary_navigation' );

	if ( ! is_front_page() ) {

		add_action( 'primer_hero', 'primer_add_page_title' );

	}

}
add_action( 'template_redirect', 'stout_move_elements' );

/**
 * Set hero image target element.
 *
 * @filter primer_hero_image_selector
 * @since  1.0.0
 *
 * @return string
 */
function stout_hero_image_selector() {

	return '.hero';

}
add_filter( 'primer_hero_image_selector', 'stout_hero_image_selector' );

/**
 * Set the default hero image description.
 *
 * @filter primer_default_hero_images
 * @since  1.0.0
 *
 * @param  array $defaults
 *
 * @return array
 */
function stout_default_hero_images( $defaults ) {

	$defaults['default']['description'] = esc_html__( 'Glass of dark beer', 'stout' );

	return $defaults;

}
add_filter( 'primer_default_hero_images', 'stout_default_hero_images' );

/**
 * Set custom logo args.
 *
 * @filter primer_custom_logo_args
 * @since  1.0.0
 *
 * @param  array $args
 *
 * @return array
 */
function stout_custom_logo_args( $args ) {

	$args['width']  = 248;
	$args['height'] = 100;

	return $args;

}
add_filter( 'primer_custom_logo_args', 'stout_custom_logo_args' );

/**
 * Set fonts.
 *
 * @filter primer_fonts
 * @since  1.0.0
 *
 * @param  array $fonts
 *
 * @return array
 */
function stout_fonts( $fonts ) {

	$fonts[] = 'Lato';
	$fonts[] = 'Oswald';

	return $fonts;

}
add_filter( 'primer_fonts', 'stout_fonts' );

/**
 * Set font types.
 *
 * @filter primer_font_types
 * @since  1.0.0
 *
 * @param  array $font_types
 *
 * @return array
 */
function stout_font_types( $font_types ) {

	$overrides = array(
		'site_title_font' => array(
			'default' => 'Oswald',
		),
		'navigation_font' => array(
			'default' => 'Oswald',
		),
		'heading_font' => array(
			'default' => 'Oswald',
		),
		'primary_font' => array(
			'default' => 'Lato',
		),
		'secondary_font' => array(
			'default' => 'Lato',
		),
	);

	return primer_array_replace_recursive( $font_types, $overrides );

}
add_filter( 'primer_font_types', 'stout_font_types' );

/**
 * Set colors.
 *
 * @filter primer_colors
 * @since  1.0.0
 *
 * @param  array $colors
 *
 * @return array
 */
function stout_colors( $colors ) {

	unset(
		$colors['content_background_color']
	);

	$overrides = array(
		/**
		 * Text colors
		 */
		'header_textcolor' => array(
			'default'  => '#e3ad31',
		),
		'tagline_text_color' => array(
			'default'  => '#686868',
		),
		'menu_text_color' => array(
			'default' => '#686868',
		),
		'footer_widget_text_color' => array(
			'default' => '#ffffff',
		),
		/**
		 * Link / Button colors
		 */
		'link_color' => array(
			'default'  => '#e3ad31',
		),
		'button_color' => array(
			'default'  => '#e3ad31',
		),
		/**
		 * Background colors
		 */
		'background_color' => array(
			'default' => '#ffffff',
		),
		'hero_background_color' => array(
			'default' => '#686868',
		),
		'menu_background_color' => array(
			'default' => '#ffffff',
			'css'     => array(
				'.site-header-wrapper' => array(
					'background-color' => '%1$s',
				),
			),
		),
		'footer_widget_background_color' => array(
			'default' => '#686868',
		),
		'footer_background_color' => array(
			'default' => '#ffffff',
		),
	);

	$overrides = primer_array_replace_recursive( $colors, $overrides );

	unset( $overrides['tagline_text_color'] );

	return $overrides;

}
add_filter( 'primer_colors', 'stout_colors' );

/**
 * Set color schemes.
 *
 * @filter primer_color_schemes
 * @since  1.0.0
 *
 * @param  array $color_schemes
 *
 * @return array
 */
function stout_color_schemes( $color_schemes ) {

	unset( $color_schemes['canary'] );

	$overrides = array(
		'blush' => array(
			'colors' => array(
				'header_textcolor'               => '#b84247',
				'menu_text_color'                => '#686868',
				'background_color'               => '#ffffff',
				'menu_background_color'          => '#ffffff',
				'footer_widget_background_color' => '#f5f5f5',
				'footer_background_color'        => '#ffffff',
			),
		),
		'bronze' => array(
			'colors' => array(
				'header_textcolor'               => '#a0917d',
				'menu_text_color'                => '#686868',
				'background_color'               => '#ffffff',
				'menu_background_color'          => '#ffffff',
				'footer_widget_background_color' => '#f5f5f5',
				'footer_background_color'        => '#ffffff',
			),
		),
		'dark' => array(
			'colors' => array(
				'hero_background_color' => '#333333',
				'menu_background_color' => '#222222',
			),
		),
		'iguana' => array(
			'colors' => array(
				'header_textcolor'               => '#58ac70',
				'menu_text_color'                => '#686868',
				'background_color'               => '#ffffff',
				'menu_background_color'          => '#ffffff',
				'footer_widget_background_color' => '#f5f5f5',
				'footer_background_color'        => '#ffffff',
			),
		),
		'muted' => array(
			'colors' => array(
				'header_textcolor'               => '#5a6175',
				'menu_text_color'                => '#5a6175',
				'background_color'               => '#ffffff',
				'menu_background_color'          => '#ffffff',
				'footer_widget_background_color' => '#d5d6e0',
				'footer_background_color'        => '#ffffff',
			),
		),
		'plum' => array(
			'colors' => array(
				'header_textcolor'               => '#54496d',
				'menu_text_color'                => '#686868',
				'background_color'               => '#ffffff',
				'menu_background_color'          => '#ffffff',
				'footer_widget_background_color' => '#f5f5f5',
				'footer_background_color'        => '#ffffff',
			),
		),
		'rose' => array(
			'colors' => array(
				'header_textcolor'               => '#dc8582',
				'menu_text_color'                => '#686868',
				'background_color'               => '#ffffff',
				'menu_background_color'          => '#ffffff',
				'footer_widget_background_color' => '#f5f5f5',
				'footer_background_color'        => '#ffffff',
			),
		),
		'tangerine' => array(
			'colors' => array(
				'header_textcolor'               => '#e38f47',
				'menu_text_color'                => '#686868',
				'background_color'               => '#ffffff',
				'menu_background_color'          => '#ffffff',
				'footer_widget_background_color' => '#f5f5f5',
				'footer_background_color'        => '#ffffff',
			),
		),
		'turquoise' => array(
			'colors' => array(
				'header_textcolor'               => '#41cfaf',
				'menu_text_color'                => '#686868',
				'background_color'               => '#ffffff',
				'menu_background_color'          => '#ffffff',
				'footer_widget_background_color' => '#f5f5f5',
				'footer_background_color'        => '#ffffff',
			),
		),
	);

	return primer_array_replace_recursive( $color_schemes, $overrides );

}
add_filter( 'primer_color_schemes', 'stout_color_schemes' );
