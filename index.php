<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Adon-Theme
 * @since Adon Theme 1.0
 */

get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

		<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>

		<div class="entry">
			<?php the_content(); ?>
		</div>

		<footer class="postmetadata">
			<?php the_tags( __( 'Tags: ', 'adontheme' ), ', ', '<br />' ); ?>
			<?php esc_html_e( 'Posted in', 'adontheme' ); ?> <?php the_category( ', ' ) ?>
			|
			<?php comments_popup_link( __( 'No Comments &#187;', 'adontheme' ), __( '1 Comment &#187;', 'adontheme' ), __( '% Comments &#187;', 'adontheme' ) ); ?>
		</footer>

	</article>

<?php endwhile; ?>

	<?php post_navigation(); ?>

<?php else : ?>

	<h2><?php esc_html_e( 'Nothing Found', 'adontheme' ); ?></h2>

<?php endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
