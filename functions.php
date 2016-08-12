<?php

/**
 * Move titles above menu templates.
 *
 * @since 1.0.0
 */
function stout_move_element(){

	remove_action( 'primer_after_header', 'primer_add_page_title' );
	remove_action( 'primer_after_header', 'primer_add_primary_navigation' );
	remove_action( 'primer_header',       'primer_add_hero' );

	add_action( 'primer_header',       'primer_add_primary_navigation' );
	add_action( 'primer_after_header', 'primer_add_hero' );

}
add_action( 'template_redirect', 'stout_move_element' );

/**
 * Register sidebar areas.
 *
 * @link    http://codex.wordpress.org/Function_Reference/register_sidebar
 *
 * @package stout
 * @since   1.0.0
 *
 * @param array $sidebars
 *
 * @return array
 */
function stout_register_sidebars( $sidebars ) {

	/**
	 * Register Hero Widget.
	 */
	$sidebars['hero'] = array(
		'name'          => esc_html__( 'Hero', 'stout' ),
		'id'            => 'hero',
		'description'   => esc_html__( 'This sidebar is for the hero area.', 'stout' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	);

	return $sidebars;

}
add_filter( 'primer_sidebars', 'stout_register_sidebars' );

/**
 * Register Footer Menu.
 *
 * @package stout
 * @since   1.0.0
 *
 * @param array $menu
 *
 * @return array
 */
function stout_register_nav_menu( $menu ) {

	$menu[ 'footer' ] = __( 'Footer Menu', 'stout' );

	return $menu;

}
add_filter( 'primer_nav_menus', 'stout_register_nav_menu' );

/**
 * Change Stout font types.
 *
 * @action primer_font_types
 * @since 1.0.0
 * @return array
 */
function stout_font_types() {

	return array(
		'primary_font' => array(
			'label'   => esc_html__( 'Primary Font', 'stout' ),
			'default' => 'Lato',
			'css'     => array(
				'body, h4, h5, h6, input, select, textarea, .footer-widget-area a' => array(
					'font-family' => '"%s", sans-serif',
				),
			),
		),
		'secondary_font' => array(
			'label'   => esc_html__( 'Secondary Font', 'stout' ),
			'default' => 'Oswald',
			'css'     => array(
				'button, input[type="button"], input[type="reset"], input[type="submit"], .button, .comments-area .comment .comment-meta, .comments-area .comment .reply, label, h1, h2, h3, .footer-widget-area,  .footer-widget-area .widget-title, .main-navigation a, .entry-meta, .entry-footer, .nav-links, .widget-area .widget' => array(
					'font-family' => '"%s", sans-serif',
				),
			),
		),
	);

}
add_action( 'primer_font_types', 'stout_font_types' );

/**
 * Change Stout colors
 *
 * @action primer_colors
 * @since 1.0.0
 * @return array
 */
function stout_colors() {
	return array(
		'header_textcolor' => array(
			'default' => '#070a07',
			'css'     => array(
				'.site-title a, .site-title a:visited' => array(
					'color' => '%1$s',
				),
			),
			'rgba_css' => array(
				'.site-title a:hover, .site-title a:visited:hover' => array(
					'color' => 'rgba(%1$s, 0.8)',
				),
			),
		),
		'background_color' => array(
			'label'   => esc_html__( 'Background Color', 'stout' ),
			'default' => '#ffffff',
			'css'     => array(
				'body' => array(
					'background' => '%1$s',
				),
			),
		),
		'header_background_color' => array(
			'label'   => esc_html__( 'Header Background Color', 'stout' ),
			'default' => '#ffffff',
			'css'     => array(
				'.site-header-wrapper,
				.main-navigation .sub-menu' => array(
					'background-color' => '%1$s',
				),
			),
		),
		'hero_background_color' => array(
			'label'   => esc_html__( 'Hero Background Color', 'stout' ),
			'default' => '#08090a',
			'css'     => array(
				'.hero' => array(
					'background-color' => '%1$s',
				),
			),
		),
		'footer_background_color' => array(
			'label'   => esc_html__( 'Footer Background Color', 'stout' ),
			'default' => '#404c4e',
			'css'     => array(
				'.site-footer' => array(
					'background-color' => '%1$s',
				),
			),
		),
		'site_info_background_color' => array(
			'label'   => esc_html__( 'Site Info Background Color', 'stout' ),
			'default' => '#ffffff',
			'css'     => array(
				'.site-info-wrapper' => array(
					'background-color' => '%1$s',
				),
			),
		),
		'link_color' => array(
			'label'   => esc_html__( 'Link Color', 'stout' ),
			'default' => '#e3ae30',
			'css'     => array(
				'a,
				.main-navigation .current-menu-item > a,
                .main-navigation a:hover,
                .screen-reader-text:focus' => array(
					'color' => '%1$s',
				),
				'.button,
				input[type="button"],
				input[type="reset"],
				input[type="submit"]' => array(
					'background-color' => '%1$s',
				),
				'.comments-area .comment.bypostauthor,
				input[type="color"]:focus, input[type="date"]:focus, input[type="datetime"]:focus, input[type="datetime-local"]:focus, input[type="email"]:focus, input[type="month"]:focus, input[type="number"]:focus, input[type="password"]:focus, input[type="search"]:focus, input[type="tel"]:focus, input[type="text"]:focus, input[type="time"]:focus, input[type="url"]:focus, input[type="week"]:focus, input:not([type]):focus, textarea:focus' => array(
					'border-color' => '%1$s',
				),
			),
			'rgba_css' => array(
				'a:hover' => array(
					'color' => 'rgba(%1$s, 0.8)',
				),
				'.button:hover,
				input[type="button"]:hover,
				input[type="reset"]:hover,
				input[type="submit"]:hover,
				button:focus,
				input[type="button"]:focus,
				input[type="reset"]:focus,
				input[type="submit"]:focus' => array(
					'background-color' => 'rgba(%1$s, 0.8)',
				),
			),
		),
		'main_text_color' => array(
			'label'   => esc_html__( 'Main Text Color', 'stout' ),
			'default' => '#252f31',
			'css'     => array(
				'body' => array(
					'color' => '%1$s',
				),
			),
		),
		'secondary_text_color' => array(
			'label'   => esc_html__( 'Secondary Text Color', 'stout' ),
			'default' => '#686868',
			'css'     => array(
				'.main-navigation a,
				.footer-menu,
				.footer-menu ul li a,
				.site-footer' => array(
					'color' => '%1$s',
				),
				'.menu-toggle div' => array(
					'background-color' => '%1$s',
				),
				'th, td, hr, code, pre, .wp-caption, .comments-area .comment' => array(
					'border-color' => '%1$s',
				),
			),
			'rgba_css' => array(
				'.footer-menu ul li a:active, .footer-menu ul li a:focus, .footer-menu ul li a:hover' => array(
					'color' => 'rgba(%1$s, 0.8)',
				),
				'.sticky' => array(
					'background-color' => 'rgba(%1$s, 0.05)',
				),
				'.sticky' => array(
					'border-color' => 'rgba(%1$s, 0.25)',
				),
			),
		),
		'light_text_color' => array(
			'label'   => esc_html__( 'Light Text Color', 'stout' ),
			'default' => '#ffffff',
			'css'     => array(
				'.hero,
				.footer-widget-area,
				.footer-widget-area .widget-title' => array(
					'color' => '%1$s',
				),
			),
		),
	);

}
add_action( 'primer_colors', 'stout_colors' );


/**
 * Change color schemes
 *
 * @action primer_color_schemes
 * @since 1.0.0
 * @return array
 */
function stout_color_schemes() {

	return array(
		'red' => array(
			'label'  => esc_html__( 'Red', 'stout' ),
			'colors' => array(
				'header_textcolor'              => '#070a07',
				'background_color'              => '#FFFFFF',
				'header_background_color'       => '#FFFFFF',
				'hero_background_color'         => '#08090a',
				'footer_background_color'       => '#252f31',
				'site_info_background_color'    => '#ffffff',
				'link_color'                    => '#d52e37',
				'main_text_color'               => '#252f31',
				'secondary_text_color'          => '#252f31',
				'light_text_color'              => '#ffffff',
			),
		),
		'blue' => array(
			'label'  => esc_html__( 'Blue', 'stout' ),
			'colors' => array(
				'header_textcolor'              => '#070a07',
				'background_color'              => '#FFFFFF',
				'header_background_color'       => '#FFFFFF',
				'hero_background_color'         => '#2e84d5',
				'footer_background_color'       => '#252b31',
				'site_info_background_color'    => '#ffffff',
				'link_color'                    => '#2e84d5',
				'main_text_color'               => '#252b31',
				'secondary_text_color'          => '#252b31',
				'light_text_color'              => '#ffffff',
			),
		),
		'orange' => array(
			'label'  => esc_html__( 'Orange', 'stout' ),
			'colors' => array(
				'header_textcolor'              => '#070a07',
				'background_color'              => '#FFFFFF',
				'header_background_color'       => '#FFFFFF',
				'hero_background_color'         => '#df962d',
				'footer_background_color'       => '#323130',
				'site_info_background_color'    => '#ffffff',
				'link_color'                    => '#df962d',
				'main_text_color'               => '#323130',
				'secondary_text_color'          => '#323130',
				'light_text_color'              => '#ffffff',
			),
		),
		'green' => array(
			'label'  => esc_html__( 'Green', 'stout' ),
			'colors' => array(
				'header_textcolor'              => '#070a07',
				'background_color'              => '#FFFFFF',
				'header_background_color'       => '#FFFFFF',
				'hero_background_color'         => '#48c16a',
				'footer_background_color'       => '#414a44',
				'site_info_background_color'    => '#ffffff',
				'link_color'                    => '#48c16a',
				'main_text_color'               => '#414a44',
				'secondary_text_color'          => '#414a44',
				'light_text_color'              => '#ffffff',
			),
		),
		'purple' => array(
			'label'  => esc_html__( 'Purple', 'stout' ),
			'colors' => array(
				'header_textcolor'              => '#070a07',
				'background_color'              => '#FFFFFF',
				'header_background_color'       => '#FFFFFF',
				'hero_background_color'         => '#b752a3',
				'footer_background_color'       => '#423c41',
				'site_info_background_color'    => '#ffffff',
				'link_color'                    => '#b752a3',
				'main_text_color'               => '#423c41',
				'secondary_text_color'          => '#423c41',
				'light_text_color'              => '#ffffff',
			),
		),
	);

}
add_action( 'primer_color_schemes', 'stout_color_schemes' );

/**
 * Add image size for hero image
 *
 * @package stout
 * @since   1.0.0
 * @link    https://codex.wordpress.org/Function_Reference/add_image_size
 *
 * @param array $images_sizes
 *
 * @return array
 */
function stout_add_image_size( $images_sizes ) {

	$images_sizes['primer-hero'] = array(
		'width'  => 1060,
		'height' => 550,
		'crop'   => array( 'center', 'center' ),
	);

	$images_sizes['primer-hero-2x'] = array(
		'width'  => 2120,
		'height' => 1100,
		'crop'   => array( 'center', 'center' ),
	);

	return $images_sizes;

}
add_filter( 'primer_image_sizes', 'stout_add_image_size' );
