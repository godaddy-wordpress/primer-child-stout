<?php

/**
 * Move titles above menu templates.
 *
 * @since 1.0.0
 */
function stout_move_elements() {

	remove_action( 'primer_after_header', 'primer_add_page_title' );
	remove_action( 'primer_after_header', 'primer_add_primary_navigation' );
	remove_action( 'primer_header',       'primer_add_hero' );

	add_action( 'primer_header',       'primer_add_primary_navigation' );
	add_action( 'primer_after_header', 'primer_add_hero' );

}
add_action( 'template_redirect', 'stout_move_elements' );

/**
 * Add a footer menu.
 *
 * @filter primer_nav_menus
 * @since  1.0.0
 *
 * @param  array $nav_menus
 *
 * @return array
 */
function stout_nav_menus( $nav_menus ) {

	$nav_menus['footer'] = esc_html__( 'Footer Menu', 'stout' );

	return $nav_menus;

}
add_filter( 'primer_nav_menus', 'stout_nav_menus' );

/**
 * Set images sizes.
 *
 * @filter primer_image_sizes
 * @since  1.0.0
 *
 * @param  array $sizes
 *
 * @return array
 */
function stout_image_sizes( $sizes ) {

	$sizes['primer-hero']['width']  = 2400;
	$sizes['primer-hero']['height'] = 1300;

	return $sizes;

}
add_filter( 'primer_image_sizes', 'stout_image_sizes' );

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
 * Set custom header args.
 *
 * @action primer_custom_header_args
 * @since  1.0.0
 *
 * @param  array $args
 *
 * @return array
 */
function stout_custom_header_args( $args ) {

	$args['width']  = 2400;
	$args['height'] = 1300;

	return $args;

}
add_filter( 'primer_custom_header_args', 'stout_custom_header_args' );

/**
 * Register sidebar areas.
 *
 * @filter primer_sidebars
 * @since  1.0.0
 *
 * @param  array $sidebars
 *
 * @return array
 */
function stout_sidebars( $sidebars ) {

	$sidebars['hero'] = array(
		'name'          => esc_html__( 'Hero', 'stout' ),
		'description'   => esc_html__( 'Hero widgets appear over the header image on the front page.', 'stout' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	);

	return $sidebars;

}
add_filter( 'primer_sidebars', 'stout_sidebars' );

/**
 * Set font types.
 *
 * @filter primer_font_types
 * @since  1.0.0
 *
 * @param array $font_types
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
