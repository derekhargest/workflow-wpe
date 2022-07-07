<?php 
/**
 * Footer
 *
 * @package mindgrub-starter-theme
 */

?>
<footer class="footer">
	<div class="footer__container container container--padded">
		<address class="footer__copyright">&copy; <?php echo esc_html( date( 'Y' ) ); // phpcs:ignore ?> <?php bloginfo( 'name' ); ?></address>

		<div class="footer__menu">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer',
					'container'      => false,
					'menu_class'     => 'menu menu--footer',
				)
			);
			?>
		</div>
	</div>

	<?php wp_footer(); ?>
</footer>
