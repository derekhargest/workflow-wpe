<?php
/**
 * Page
 *
 * @package mindgrub-starter-theme
 */

the_post(); ?>

<article class="content container container--padded container--max-width">
	<header class="page-header">
		<h1 class="page-header__title"><?php the_title(); ?></h1>
		<div class="page-header__meta">Posted by <?php the_author_posts_link(); ?> on <?php the_time( 'F j, Y' ); ?> in <?php the_category( ', ' ); ?> | <?php comments_number(); ?></div>
	</header>

	<div class="wysiwyg">
		<?php the_content(); ?>
	</div>
</article>
