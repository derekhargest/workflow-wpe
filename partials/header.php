<?php 
/**
 * Header
 *
 * @package mindgrub-starter-theme
 */

?>
<header class="header">
	<div class="header__container container container--padded">
		<h1 class="header__logo"><a href="<?php echo bloginfo( 'url' ); ?>"><?php echo bloginfo( 'name' ); ?></a></h1>

		<button class="header__toggle" aria-hidden="true" data-toggle-active="#header-nav">Menu</button>

		<nav class="header__nav" id="header-nav">
			<div class="header__menu">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'header',
						'container'      => false,
						'menu_class'     => 'menu menu--header',
					)
				);
				?>
			</div>

			<div class="header__search">
				<?php get_template_part( 'partials/form-search' ); ?>
			</div>
		</nav>
	</div>
</header>
