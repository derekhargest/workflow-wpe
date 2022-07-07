<?php 
/**
 * Index
 *
 * @package mindgrub-starter-theme
 */

?>
<section class="content container container--padded container--max-width">
	<ol class="posts">
		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>
			<?php get_template_part( 'partials/loop-post' ); ?>
		<?php endwhile; ?>
	</ol>

	<?php get_template_part( 'partials/pagination' ); ?>
</section>
