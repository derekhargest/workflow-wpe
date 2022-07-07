<?php 
/**
 * Loop Post
 *
 * @package mindgrub-starter-theme
 */

?>
<li <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<h2 class="post__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	<p class="post__byline">Posted by <?php the_author_posts_link(); ?> on <?php the_time( 'F j, Y' ); ?> in <?php the_category( ', ' ); ?> | <?php comments_number(); ?></p>
	<div class="post__excerpt wysiwyg"><?php the_excerpt(); ?></div>
</li>
