<?php
/**
 * Search
 *
 * @package mindgrub-starter-theme
 */

global $wp_query; ?>

<section class="content container container--padded container--max-width">
	<header class="page-header">
		<h1 class="page-header__title"><?php echo esc_html( $wp_query->found_posts ); ?> result <?php echo esc_html( 1 != $wp_query->found_posts ? 's' : '' ); ?> for "<?php the_search_query(); ?>"</h1>
	</header>

	<ol class="posts dddd">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<?php get_template_part( 'partials/loop-post' ); ?>
		<?php endwhile; ?>
	</ol>

	<?php get_template_part( 'partials/pagination' ); ?>
</section>
