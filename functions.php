<?php

/**
 * Move titles above menu templates.
 *
 * @since 1.0.0
 */
function stout_remove_titles(){

	remove_action( 'primer_after_header', 'primer_add_page_builder_template_title', 100 );
	remove_action( 'primer_after_header', 'primer_add_blog_title', 100 );
	remove_action( 'primer_after_header', 'primer_add_archive_title', 100 );

	if( ! is_front_page() ):
		add_action( 'stout_hero', 'primer_add_page_builder_template_title' );
		add_action( 'stout_hero', 'primer_add_blog_title' );
		add_action( 'stout_hero', 'primer_add_archive_title' );
	endif;

}
add_action( 'init', 'stout_remove_titles' );

/**
 * Display primary navigation menu after the header.
 *
 * @action after_setup_theme
 * @since  1.0.0
 */
function stout_move_primary_navigation() {

	remove_action( 'primer_after_header', 'primer_add_primary_navigation', 20 );
	add_action( 'primer_header', 'primer_add_primary_navigation', 20 );

}
add_action( 'after_setup_theme', 'stout_move_primary_navigation', 20 );

/**
 * Display the hero before the header.
 *
 * @action after_setup_theme
 * @since 1.0.0
 */
function stout_add_hero() {

	remove_action( 'primer_header', 'primer_add_hero', 10 );
	add_action( 'primer_after_header', 'primer_add_hero', 10 );

}
add_action( 'after_setup_theme', 'stout_add_hero' );

/**
 * Add additional sidebars
 *
 * @action primer_register_sidebars
 * @since 1.0.0
 * @param $sidebars
 * @return array
 */
function stout_add_sidebars( $sidebars ) {

	$new_sidebars = array(
		array(
			'name'          => esc_html__( 'Hero', 'stout' ),
			'id'            => 'hero',
			'description'   => esc_html__( 'This sidebar is for the hero area.', 'stout' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		),
	);

	return array_merge( $sidebars, $new_sidebars );

}

add_filter( 'primer_register_sidebars', 'stout_add_sidebars' );


/**
 * Add a footer menu.
 *
 * @action primer_nav_menus
 * @since 1.0.0
 * @param $nav_menus
 * @return array
 */
function stout_add_nav_menus( $nav_menus ) {

	$new_nav_menus = array(
		'footer' => esc_html__( 'Footer Menu', 'stout' ),
	);

	return array_merge( $nav_menus, $new_nav_menus );

}
add_filter( 'primer_nav_menus', 'stout_add_nav_menus' );

/**
 * Change Stout font types.
 *
 * @action primer_font_types
 * @since 1.0.0
 * @return array
 */
function stout_font_types() {
	return array(
		array(
			'name'    => 'primary_font',
			'label'   => esc_html__( 'Primary Font', 'stout' ),
			'default' => 'Lato',
			'css'     => array(
				'body, h4, h5, h6, input, select, textarea, .footer-widget-area a' => array(
					'font-family' => '"%s", sans-serif',
				),
			),
		),
		array(
			'name'    => 'secondary_font',
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
		array(
			'name'    => 'header_textcolor',
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
		array(
			'name'    => 'background_color',
			'label'   => esc_html__( 'Background Color', 'stout' ),
			'default' => '#ffffff',
			'css'     => array(
				'body' => array(
					'background' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'header_background_color',
			'label'   => esc_html__( 'Header Background Color', 'stout' ),
			'default' => '#ffffff',
			'css'     => array(
				'.site-header-wrapper,
				.main-navigation .sub-menu' => array(
					'background-color' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'hero_background_color',
			'label'   => esc_html__( 'Hero Background Color', 'stout' ),
			'default' => '#08090a',
			'css'     => array(
				'.hero' => array(
					'background-color' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'footer_background_color',
			'label'   => esc_html__( 'Footer Background Color', 'stout' ),
			'default' => '#404c4e',
			'css'     => array(
				'.site-footer' => array(
					'background-color' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'site_info_background_color',
			'label'   => esc_html__( 'Site Info Background Color', 'stout' ),
			'default' => '#ffffff',
			'css'     => array(
				'.site-info-wrapper' => array(
					'background-color' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'link_color',
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
		array(
			'name'    => 'main_text_color',
			'label'   => esc_html__( 'Main Text Color', 'stout' ),
			'default' => '#252f31',
			'css'     => array(
				'body' => array(
					'color' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'secondary_text_color',
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
		array(
			'name'    => 'light_text_color',
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
		'scribbles_2' => array(
			'label'  => esc_html__( 'Scribbles 2', 'stout' ),
			'colors' => array(
				'header_textcolor'              => '#070a07',
				'background_color'              => '#FFFFFF',
				'header_background_color'       => '#FFFFFF',
				'hero_background_color'         => '#08090a',
				'footer_background_color'       => '#404c4e',
				'site_info_background_color'    => '#ffffff',
				'link_color'                    => '#d52e37',
				'main_text_color'               => '#252f31',
				'secondary_text_color'          => '#686868',
				'light_text_color'              => '#ffffff',
			),
		),
	);
}
add_action( 'primer_color_schemes', 'stout_color_schemes' );


/**
 * Return the custom header
 *
 * @since 1.0.0
 * @return false|string
 */
function stout_get_custom_header() {
	$image_size = (int) get_theme_mod( 'full_width' ) === 1 ? 'hero-2x' : 'hero';
	$custom_header = get_custom_header();

	if ( ! empty( $custom_header->attachment_id ) ) {

		$image = wp_get_attachment_image_url( $custom_header->attachment_id, $image_size );

		if ( getimagesize( $image ) ) {
			return $image;
		}
	}

	$header_image = get_header_image();
	return $header_image;
}

/**
 * Add additional image sizes
 *
 * @action after_setup_theme
 * @since 1.0.0
 */
function stout_add_image_sizes() {
	add_image_size( 'hero', 1060, 550, array( 'center', 'center' ) );
	add_image_size( 'hero-2x', 2120, 1100, array( 'center', 'center' ) );
}
add_action( 'after_setup_theme', 'stout_add_image_sizes' );

