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

	unset( $font_types['primary_font']['css'] );

	$overrides = array(
		'header_font' => array(
			'default' => 'Oswald',
			'css'     => array(
				'.main-navigation ul li a' => array(
					'font-family' => '"%1$s", sans-serif',
				),
			),
		),
		'primary_font' => array(
			'default' => 'Lato',
			'css'     => array(
				'body,
				p,
				ol li,
				ul li,
				dl dd,
				.fl-callout-text' => array(
					'font-family' => '"%1$s", sans-serif',
				),
			),
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
		$colors['header_textcolor']['css'],
		$colors['header_background_color']['css'],
		$colors['menu_background_color']['css'],
		$colors['tagline_text_color']
	);

	$overrides = array(
		'header_textcolor' => array(
			'default' => '#ffffff',
			'css'     => array(
				'.hero *' => array(
					'color' => '%1$s',
				),
			),
		),
		'background_color' => array(
			'default' => '#ffffff',
		),
		'header_background_color' => array(
			'default' => '#eaeaea',
			'css'     => array(
				'.hero' => array(
					'background-color' => '%1$s',
				),
			),
		),
		'menu_background_color' => array(
			'default' => '#ffffff',
			'css'     => array(
				'.site-header-wrapper,
				.main-navigation ul ul,
				.main-navigation .sub-menu' => array(
					'background-color' => '%1$s',
				),
			),
		),
		'footer_background_color' => array(
			'default' => '#404c4e',
		),
		'link_color' => array(
			'default' => '#e3ad31',
			'css'     => array(
				'.site-title a,
				.site-title a:visited,
				.main-navigation ul li a:hover,
				.main-navigation .current_page_item > a,
				.main-navigation .current-menu-item > a,
				.main-navigation .current_page_ancestor > a,
				.main-navigation .current_page_parent > a,
				.main-navigation .current-menu-ancestor > a' => array(
					'color' => '%1$s',
				),
			),
			'rgba_css' => array(
				'.site-title a:hover,
				.site-title a:visited:hover' => array(
					'color' => 'rgba(%1$s, 0.8)',
				),
			),
		),
		'main_text_color' => array(
			'default' => '#252f31',
		),
		'secondary_text_color' => array(
			'default' => '#797979',
		),
		'menu_text_color' => array(
			'label'   => esc_html( 'Menu Text Color', 'stout' ),
			'default' => '#686868',
			'css'     => array(
				'.main-navigation ul li a' => array(
					'color' => '%1$s',
				),
				'.main-navigation .sub-menu li.menu-item-has-children > a::after' => array(
					'border-left-color'  => '%1$s',
					'border-right-color' => '%1$s', // RTL
				),
			),
		),
	);

	return primer_array_replace_recursive( $colors, $overrides );

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

	$color_schemes = array(
		'blue' => array(
			'label'  => esc_html__( 'Blue', 'stout' ),
			'colors' => array(
				'header_textcolor'        => '#2e84d5',
				'background_color'        => '#ffffff',
				'header_background_color' => '#252f31',
				'menu_background_color'   => '#ffffff',
				'footer_background_color' => '#404c4e',
				'link_color'              => '#2e84d5',
				'main_text_color'         => '#252b31',
				'secondary_text_color'    => '#252b31',
				'menu_text_color'         => '#686868',
			),
		),
		'green' => array(
			'label'  => esc_html__( 'Green', 'stout' ),
			'colors' => array(
				'header_textcolor'        => '#48c16a',
				'background_color'        => '#ffffff',
				'header_background_color' => '#252b31',
				'menu_background_color'   => '#ffffff',
				'footer_background_color' => '#404c4e',
				'link_color'              => '#48c16a',
				'main_text_color'         => '#252b31',
				'secondary_text_color'    => '#252b31',
				'menu_text_color'         => '#686868',
			),
		),
		'purple' => array(
			'label'  => esc_html__( 'Purple', 'stout' ),
			'colors' => array(
				'header_textcolor'        => '#b752a3',
				'background_color'        => '#ffffff',
				'header_background_color' => '#252b31',
				'menu_background_color'   => '#ffffff',
				'footer_background_color' => '#404c4e',
				'link_color'              => '#b752a3',
				'main_text_color'         => '#252b31',
				'secondary_text_color'    => '#252b31',
				'menu_text_color'         => '#686868',
			),
		),
		'red' => array(
			'label'  => esc_html__( 'Red', 'stout' ),
			'colors' => array(
				'header_textcolor'        => '#d52e37',
				'background_color'        => '#ffffff',
				'header_background_color' => '#252f31',
				'menu_background_color'   => '#ffffff',
				'footer_background_color' => '#252f31',
				'link_color'              => '#d52e37',
				'main_text_color'         => '#252f31',
				'secondary_text_color'    => '#252f31',
				'menu_text_color'         => '#686868',
			),
		),
	);

	return $color_schemes;

}
add_filter( 'primer_color_schemes', 'stout_color_schemes' );
