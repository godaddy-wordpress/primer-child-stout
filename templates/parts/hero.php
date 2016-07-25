<div class="hero">

	<div class="container">

		<?php if ( is_front_page() && is_active_sidebar( 'hero') ) : ?>

			<?php dynamic_sidebar( 'hero' ); ?>

		<?php endif; ?>

	</div>

</div>
