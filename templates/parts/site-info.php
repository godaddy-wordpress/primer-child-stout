<?php
/**
 * Displays the footer site info.
 *
 * @package Stout
 */
?>

<div class="site-info-wrapper">

	<div class="site-info">

		<div class="site-info-text"><?php

			get_template_part( 'templates/parts/footer-navigation' );

			do_action( 'primer_site_info' );

		?></div><!-- .site-info-text -->

		<?php get_template_part( 'templates/parts/social-navigation' ); ?>

	</div><!-- .site-info -->

</div><!-- .site-info-wrapper -->
