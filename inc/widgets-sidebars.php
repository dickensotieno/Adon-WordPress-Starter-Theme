<?php
/**
 * Widgets and Sidebars
 *
 * WordPress Widgets add content and features to your Sidebars. Examples are
 * the default widgets that come with WordPress; for post categories, tag
 * clouds, navigation, search, etc.
 *
 * Sidebar is a theme feature introduced with Version 2.2. It's basically a
 * vertical column provided by a theme for displaying information other than
 * the main content of the web page. Themes usually provide at least one
 * sidebar at the left or right of the content. Sidebars usually contain
 * widgets that an administrator of the site can customize.
 *
 * @link https://codex.wordpress.org/WordPress_Widgets
 * @link https://codex.wordpress.org/Widgets_API
 * @link https://codex.wordpress.org/Sidebars
 *
 * @package WordPress
 * @subpackage Adon-Theme
 */

if ( function_exists( 'register_sidebar' ) ) {
	/**
	 * Add Widget.
	 */
	function adontheme_widgets_init() {
		register_sidebar( array(
			'name'          => __( 'Sidebar Widgets', 'adontheme' ),
			'id'            => 'sidebar-primary',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_widget( 'Adon_Contacts_Widget' );
		register_widget( 'Adon_Social_Profiles_Widget' );

	}
	add_action( 'widgets_init', 'adontheme_widgets_init' );
}

/**
 * Adon Contacts Widget Class
 */
class Adon_Contacts_Widget extends WP_Widget {


	/** Constructor -- name this the same as the class above */
	function Adon_Contacts_Widget() {
		parent::WP_Widget( false, $name = __( '[Adon] Contacts', 'adontheme' ) );
	}

	/** @see WP_Widget::widget -- do not rename this */
	function widget( $args, $instance ) {
		extract( $args );
		$title  = apply_filters( 'widget_title', $instance['title'] ); /* The widget title. */
		$items	= $instance['items'];
		$phone_url = $instance['phone_url'];
		$skype_url = $instance['skype_url'];
		$item_titles = $instance['item_titles'];
		$address = get_option( 'adon_contacts_address' );
		$phones = get_option( 'adon_contacts_phones' );
		$skype = get_option( 'adon_contacts_skype' );
		echo $before_widget; ?>

		<?php if ( $title ) { echo $before_title . $title . $after_title; } ?>
			<?php
			if ( ! empty( $address ) || ! empty( $phones ) || ! empty( $skype ) ) { ?>
				<ul class="contacts-list">
				<?php
				foreach ( $items as $item ) {
					switch ( $item ) {
						case 'address':
							if ( ! empty( $address ) ) { ?>
								<li>
									<?php if ( ! empty( $item_titles ) ) : ?>
										<h4><?php esc_html_e( 'Address:', 'adontheme' );?></h4>
									<?php endif; ?>
									<?php echo esc_html( $address ); ?>
								</li>
							<?php }
							break;
						case 'phones':
							if ( ! empty( $phones ) ) { ?>
								<li>
									<?php
									if ( ! empty( $item_titles ) ) : ?>
										<h4><?php esc_html_e( 'Phones:', 'adontheme' );?></h4>
									<?php endif;
									foreach ( explode( ',', $phones ) as $phone ) {
										if ( ! empty( $phone ) ) { ?>
												<?php if ( ! empty( $phone_url ) ) : ?>
													<a href="tel:<?php echo esc_attr( trim( $phone ) ); ?>"><?php echo esc_html( trim( $phone ) ); ?></a>&nbsp;
												<?php else : ?>
													<?php echo esc_html( trim( $phone ) ); ?>&nbsp;
												<?php endif; ?>
										<?php }
									} ?>
								</li>
							<?php }
							break;
						case 'skype':
							if ( ! empty( $skype ) ) : ?>
								<li>
									<?php if ( ! empty( $item_titles ) ) : ?>
										<h4><?php esc_html_e( 'Skype:', 'adontheme' );?></h4>
									<?php endif; ?>
									<?php if ( ! empty( $skype_url ) ) : ?>
										<a href="skype:<?php echo esc_attr( $skype ); ?>"><?php echo esc_html( $skype ); ?></a>&nbsp;
									<?php else : ?>
										<?php echo esc_html( $skype ); ?>
									<?php endif; ?>
								</li>
							<?php endif; ?>
							<?php break;
					} ?>
				<?php } ?>
				</ul>
			<?php }
		 echo $after_widget;
	}

	/** @see WP_Widget::update -- do not rename this */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['items'] = $new_instance['items'];
		$instance['item_titles'] = $new_instance['item_titles'];
		$instance['phone_url'] = $new_instance['phone_url'];
		$instance['skype_url'] = $new_instance['skype_url'];

		return $instance;
	}

	/** @see WP_Widget::form -- do not rename this */
	function form( $instance ) {
		$item_list = array(
			'Address' => 'address',
			'Phones' => 'phones',
			'Skype' => 'skype',
		);
		// Set up some default widget settings.
		$defaults = array( 'title' => __( 'Contacts', 'adontheme' ), 'items' => array(), 'skype_url' => true, 'phone_url' => true, 'item_titles' => false );
		$instance = wp_parse_args( (array) $instance, $defaults );

		// Get widget fields values.
		if ( ! empty( $instance ) ) {
			$title 	= esc_attr( $instance['title'] );
			$items	= $instance['items'];
			$phone_url = $instance['phone_url'];
			$skype_url = $instance['skype_url'];
			$item_titles = $instance['item_titles'];
		} ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'adontheme' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'items' ) ); ?>"><?php esc_html_e( 'Choose the Contacts to display:', 'adontheme' ); ?></label>
			<select  id="<?php echo esc_attr( $this->get_field_id( 'items' ) ); ?>" class="select-toggle" size="3" multiple="multiple" name="<?php echo esc_attr( $this->get_field_name( 'items' ) ); ?>[]">
				<?php foreach ( $item_list as $label => $item ) { ?>
					<option <?php echo in_array( $item, (array) $items, true ) ? ' selected="selected" ' : ''; ?> value="<?php echo esc_attr( $item ); ?>"><?php echo esc_html( $label ); ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $item_titles, 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'item_titles' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'item_titles' ) ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'item_titles' ) ); ?>"><?php esc_html_e( 'Display item titles', 'adontheme' ) ?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $phone_url, 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'phone_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'phone_url' ) ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'phone_url' ) ); ?>"><?php esc_html_e( 'Phones as URL', 'adontheme' ) ?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $skype_url, 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'skype_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'skype_url' ) ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'skype_url' ) ); ?>"><?php esc_html_e( 'Skype as URL', 'adontheme' ) ?></label>
		</p>
	<?php
	}
} /* End class Adon_Contacts_Widget. */

/**
 * Adon Social Profiles Widget Class
 */
class Adon_Social_Profiles_Widget extends WP_Widget {


	/** Constructor -- name this the same as the class above */
	function Adon_Social_Profiles_Widget() {
		parent::WP_Widget( false, $name = __( '[Adon] Social Profiles', 'adontheme' ) );
	}

	/** @see WP_Widget::widget -- do not rename this */
	function widget( $args, $instance ) {
		extract( $args );
		$title  = apply_filters( 'widget_title', $instance['title'] ); /* The widget title. */
		$items	= $instance['items'];
		echo $before_widget;
		if ( $title ) { echo $before_title . $title . $after_title; }
		$social_profiles = get_option( 'adon_social_profiles' );
		if ( ! empty( $items ) && ! empty( $social_profiles ) ) {
			$social_profile_index = array();
			foreach ( (array) $social_profiles as $name => $element ) {
				foreach ( $element as $index => $value ) {
					array_push( $social_profile_index, $name . '_' . $index );
				}
			} ?>
			<ul class="social-profile-list">
			<?php
			foreach ( (array) $social_profiles as $name => $element ) {
				foreach ( $element as $index => $value ) { ?>
					<?php if ( in_array( (string) ( $name . '_' . $index ), (array) $items, true ) ) { ?>
						<li>
							<a class="<?php echo esc_attr( $name ); ?>" href="<?php echo esc_url( $value ) ?>"><?php echo esc_html( $name ); ?></a>
						</li>
					<?php } ?>
				<?php }
			} ?>
			</ul>
		<?php }
		echo $after_widget;
	}

	/** @see WP_Widget::update -- do not rename this */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['items'] = $new_instance['items'];

		return $instance;
	}

	/** @see WP_Widget::form -- do not rename this */
	function form( $instance ) {
		// Set up some default widget settings.
		$defaults = array( 'title' => __( 'Social Profiles', 'adontheme' ), 'items' => array() );
		$instance = wp_parse_args( (array) $instance, $defaults );

		// Get widget fields values.
		if ( ! empty( $instance ) ) {
			$title 	= esc_attr( $instance['title'] );
			$items	= $instance['items'];
		}
		$social_profiles = get_option( 'adon_social_profiles' );
		$social_profile_index = array();
		if ( ! empty( $social_profiles ) ) {
			foreach ( (array) $social_profiles as $name => $element ) {
				foreach ( $element as $index => $value ) {
					array_push( $social_profile_index, $name . '_' . $index );
				}
			}
		} ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'adontheme' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'items' ) ); ?>"><?php esc_html_e( 'Choose the Social Profiles to display:', 'adontheme' ); ?></label><br>
			<select id="<?php echo esc_attr( $this->get_field_id( 'items' ) ); ?>" class="select-toggle" size="<?php echo count( $social_profile_index ); ?>" multiple="multiple" name="<?php echo esc_attr( $this->get_field_name( 'items' ) ); ?>[]" style="min-width: 150px;">
				<?php
				if ( ! empty( $social_profiles ) ) {
					foreach ( (array) $social_profiles as $name => $element ) {
						foreach ( $element as $index => $value ) { ?>
							<option
								<?php echo in_array( (string) ( $name . '_' . $index ), (array) $items, true ) ? ' selected="selected" ' : ''; ?>
								value="<?php echo esc_attr( $name . '_' . $index ); ?>"
								tooltip="<?php echo esc_attr( $value ); ?>"
								title="<?php echo esc_attr( $value ); ?>"
							><?php echo esc_html( ucfirst( $name ) ); ?>
							</option>
						<?php }
					}
				} ?>
			</select>
		</p>
	<?php }
} /* End class Adon_Contacts_Widget. */
