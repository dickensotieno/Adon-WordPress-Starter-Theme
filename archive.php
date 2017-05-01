<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Adon-Theme
 * @since Adon Theme 1.0
 */

get_header(); ?>

<?php if ( have_posts() ) : ?>

	<?php /* If this is a category archive */
	if ( is_category() ) { ?>
		<h2><?php esc_html_e( 'Archive for the', 'adontheme' ); ?>
			&#8216;<?php single_cat_title(); ?>
			&#8217; <?php esc_html_e( 'Category', 'adontheme' ); ?></h2>

		<?php /* If this is a tag archive */
	} elseif ( is_tag() ) { ?>
		<h2><?php esc_html_e( 'Posts Tagged', 'adontheme' ); ?>
			&#8216;<?php single_tag_title(); ?>&#8217;</h2>

		<?php /* If this is a daily archive */
	} elseif ( is_day() ) { ?>
		<h2><?php esc_html_e( 'Archive for', 'adontheme' ); ?> <?php the_time( 'F jS, Y' ); ?></h2>

		<?php /* If this is a monthly archive */
	} elseif ( is_month() ) { ?>
		<h2><?php esc_html_e( 'Archive for', 'adontheme' ); ?> <?php the_time( 'F, Y' ); ?></h2>

		<?php /* If this is a yearly archive */
	} elseif ( is_year() ) { ?>
		<h2 class="pagetitle"><?php esc_html_e( 'Archive for', 'adontheme' ); ?> <?php the_time( 'Y' ); ?></h2>

		<?php /* If this is an author archive */
	} elseif ( is_author() ) { ?>
		<h2 class="pagetitle"><?php esc_html_e( 'Author Archive', 'adontheme' ); ?></h2>

		<?php /* If this is a paged archive */
	} elseif ( isset( $_GET['paged'] ) && !empty( $_GET['paged'] ) ) { ?>
		<h2 class="pagetitle"><?php esc_html_e( 'Blog Archives', 'adontheme' ); ?></h2>

	<?php } ?>

	<?php post_navigation(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<article <?php post_class() ?>>

			<h2 id="post-<?php the_ID(); ?>"><a
					href="<?php the_permalink() ?>"><?php the_title(); ?></a>
			</h2>

			<div class="entry">
				<?php the_content(); ?>
			</div>

		</article>

	<?php endwhile; ?>

	<?php post_navigation(); ?>

<?php else : ?>

	<h2><?php esc_html_e( 'Nothing Found', 'adontheme' ); ?></h2>

<?php endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
