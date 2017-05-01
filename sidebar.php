<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Adon-Theme
 * @since Adon Theme 1.0
 */

?>
<aside id="sidebar">

	<?php if ( function_exists( 'dynamic_sidebar' ) && dynamic_sidebar( 'Sidebar Widgets' ) ) :
	else : ?>

		<!-- All this stuff in here only shows up if you DON'T have any widgets active in this zone -->

		<?php get_search_form(); ?>

		<h2><?php esc_html_e( 'Archives', 'adontheme' ); ?></h2>
		<ul>
			<?php wp_get_archives( 'type=monthly' ); ?>
		</ul>

		<h2><?php esc_html_e( 'Meta', 'adontheme' ); ?></h2>
		<ul>
			<?php wp_register(); ?>
			<li><?php wp_loginout(); ?></li>
			<?php wp_meta(); ?>
		</ul>

	<?php endif; ?>

</aside>
