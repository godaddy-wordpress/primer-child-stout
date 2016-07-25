<?php

/**
 * Display primary navigation menu after the header.
 *
 * @action primer_header
 * @since  1.0.0
 */
function stout_move_primary_navigation() {

	add_action( 'primer_header', 'primer_add_primary_navigation', 20 );
	remove_action( 'primer_after_header', 'primer_add_primary_navigation', 20 );

}
add_action( 'after_setup_theme', 'stout_move_primary_navigation', 20 );


/**
 * Display the hero before the header.
 *
 * @action primer_before_header
 * @since 1.0.0
 */
function stout_add_hero() {

	get_template_part( 'templates/parts/hero' );

}
add_action( 'primer_after_header', 'stout_add_hero' );


/**
 * Add additional sidebars
 *
 * @action primer_register_sidebars
 *
 * @since 1.0.0
 *
 * @param $sidebars
 *
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
