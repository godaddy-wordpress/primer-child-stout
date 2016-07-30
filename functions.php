<?php

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
function stout_add_site_header() {

	remove_action( 'primer_header', 'primer_add_site_header', 10 );
	add_action( 'primer_after_header', 'primer_add_site_header', 10 );

}
add_action( 'after_setup_theme', 'stout_add_site_header' );


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
			'label'   => esc_html__( 'Primary Font', 'primer' ),
			'default' => 'Lato',
			'css'     => array(
				'body, h4, h5, h6, input, select, textarea, .footer-widget-area a' => array(
					'font-family' => '"%s", sans-serif',
				),
			),
		),
		array(
			'name'    => 'secondary_font',
			'label'   => esc_html__( 'Secondary Font', 'primer' ),
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
			'default' => '#222222',
			'css'     => array(
				'.site-title a, .site-title a:visited' => array(
					'color' => '%1$s',
				),
			),
			'rgba_css' => array(
				'.site-title a:hover, .site-title a:visited:hover' => array(
					'color' => 'rgba(%1$s, 0.75)',
				),
			),
		),
		array(
			'name'    => 'background_color',
			'default' => '#f9f9f9',
		),
		array(
			'name'    => 'header_background_color',
			'label'   => esc_html__( 'Header Background Color', 'primer' ),
			'default' => '#f9f9f9',
			'css'     => array(
				'.site-header' => array(
					'background-color' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'tagline_text_color',
			'label'   => esc_html__( 'Tagline Text Color', 'primer' ),
			'default' => '#7c7c7c',
			'css'     => array(
				'.site-description' => array(
					'color' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'menu_background_color',
			'label'   => esc_html__( 'Menu Background Color', 'primer' ),
			'default' => '#222222',
			'css'     => array(
				'.main-navigation-container, .main-navigation, .main-navigation li a, .main-navigation li.menu-item-has-children ul' => array(
					'background-color' => '%1$s',
				),
				'.main-navigation li a, .main-navigation li a:hover' => array(
					'color' => '#ffffff',
				),
			),
		),
		array(
			'name'    => 'link_color',
			'label'   => esc_html__( 'Link Color', 'primer' ),
			'default' => '#1585cf',
			'css'     => array(
				'a, a:visited, .entry-footer a, .sticky .entry-title a:before' => array(
					'color' => '%1$s',
				),
				'button, a.button, a.button:visited, input[type="button"], input[type="reset"], input[type="submit"], .site-info-wrapper .site-info .social-menu a' => array(
					'background-color' => '%1$s',
				),
			),
			'rgba_css' => array(
				'a:hover, a:visited:hover, .entry-footer a:hover' => array(
					'color' => 'rgba(%1$s, 0.75)',
				),
				'button:hover, a.button:hover, a.button:visited:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, .site-info-wrapper:hover .site-info:hover .social-menu a:hover' => array(
					'background-color' => 'rgba(%1$s, 0.75)',
				),
			),
		),
		array(
			'name'    => 'main_text_color',
			'label'   => esc_html__( 'Main Text Color', 'primer' ),
			'default' => '#1a1a1a',
			'css'     => array(
				'.site-content, .site-content h1, .site-content h2, .site-content h3, .site-content h4, .site-content h5, .site-content h6, .site-content p, .site-content blockquote, legend' => array(
					'color' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'secondary_text_color',
			'label'   => esc_html__( 'Secondary Text Color', 'primer' ),
			'default' => '#686868',
			'css'     => array(
				'blockquote, .entry-meta, .entry-footer, .comment-list li .comment-meta .says, .comment-list li .comment-metadata, .comment-reply-link, #respond .logged-in-as, .fl-callout-text' => array(
					'color' => '%1$s',
				),
			),
		),
	);
}
add_action( 'primer_colors', 'stout_colors' );


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

