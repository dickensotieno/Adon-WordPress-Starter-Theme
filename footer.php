<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Adon-Theme
 * @since Adon Theme 1.0
 */

?>
			<footer id="footer" class="source-org vcard copyright" role="contentinfo">
				<small>
					<?php
					if ( $copyright = get_option( 'adon_copyright' ) ) {
						echo esc_html( $copyright );
					} else {
						echo sprintf( esc_html__( 'Copyright © %d. %s. All Rights Reserved.', 'adontheme' ), date( 'Y' ), get_bloginfo( 'name' ) );
					}
					?>
				</small>
			</footer>

		</div>

		<?php wp_footer(); ?>

	</body>

</html>
