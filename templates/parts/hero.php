<?php if ( ! empty( stout_get_custom_header() ) ) : ?>

<div class="hero" style="background:url('<?php echo stout_get_custom_header( ); ?>') no-repeat top center; background-size: cover;">

<?php else : ?>

<div class="hero">

<?php endif; ?>

	<div class="container">

		<?php if ( is_front_page() && is_active_sidebar( 'hero' ) ) : ?>

			<?php dynamic_sidebar( 'hero' ); ?>

		<?php endif; ?>

		<?php do_action( 'stout_hero' ); ?>

	</div>

</div>
