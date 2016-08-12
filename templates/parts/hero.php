<?php if ( primer_has_hero_image() ) : ?>

<div class="hero" style="background:url('<?php echo primer_get_hero_image(); ?>') no-repeat top center; background-size: cover;">

<?php else : ?>

<div class="hero">

<?php endif; ?>

	<div class="container">

		<?php if ( is_front_page() && is_active_sidebar( 'hero' ) ) : ?>

			<?php dynamic_sidebar( 'hero' ); ?>

		<?php else : ?>

			<?php get_template_part( 'templates/parts/page-title' ); ?>

		<?php endif; ?>

	</div>

</div>
