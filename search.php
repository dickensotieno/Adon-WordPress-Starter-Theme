<?php
/**
 * The template for displaying search results pages
 *
 * @package WordPress
 * @subpackage Adon-Theme
 * @since Adon Theme 1.0
 */

get_header(); ?>

<?php if ( have_posts() ) : ?>

	<h2><?php esc_html_e( 'Search Results', 'adontheme' ); ?></h2>

	<?php post_navigation(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

			<h2><?php the_title(); ?></h2>

			<div class="entry">

				<?php the_excerpt(); ?>

			</div>

		</article>

	<?php endwhile; ?>

	<?php post_navigation(); ?>

<?php else : ?>

	<h2><?php esc_html_e( 'Nothing Found', 'adontheme' ); ?></h2>

<?php endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
