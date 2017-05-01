<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Adon-Theme
 * @since Adon Theme 1.0
 */

get_header(); ?>

<?php if ( have_posts() ) :
	while ( have_posts() ) : the_post(); ?>

		<article class="post" id="post-<?php the_ID(); ?>">

			<h2><?php the_title(); ?></h2>

			<div class="entry">

				<?php the_content(); ?>

				<?php
				wp_link_pages(array(
					'before' => __( 'Pages: ', 'adontheme' ),
					'next_or_number' => 'number',
				)); ?>

			</div>

			<?php edit_post_link( __( 'Edit this entry', 'adontheme' ), '<p>', '</p>' ); ?>

		</article>

		<?php comments_template(); ?>

	<?php endwhile;
endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
