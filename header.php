<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Adon-Theme
 * @since Adon Theme 1.0
 */

?><!doctype html>

<!--[if lt IE 7 ]>
<html
	class="ie ie6 ie-lt10 ie-lt9 ie-lt8 ie-lt7 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>
<html
	class="ie ie7 ie-lt10 ie-lt9 ie-lt8 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>
<html
	class="ie ie8 ie-lt10 ie-lt9 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>
<html class="ie ie9 ie-lt10 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<!-- the "no-js" class is for Modernizr. -->

<head data-template-set="Adon-Theme">

	<meta charset="<?php bloginfo( 'charset' ); ?>">

	<!-- Always force latest IE rendering engine (even in intranet) -->
	<!--[if IE ]>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<![endif]-->

	<?php
	if ( is_search() ) {
		echo '<meta name="robots" content="noindex, nofollow" />';
	}
	?>

	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<meta name="title" content="<?php wp_title( '|', true, 'right' ); ?>">

	<meta name="description" content="<?php bloginfo( 'description' ); ?>"/>

	<?php
	$meta_copyright = get_option( 'adon_copyright' );
	if ( empty( $meta_copyright ) ) {
		$meta_copyright = sprintf( __( 'Copyright © %d. %s. All Rights Reserved.', 'adontheme' ), date( 'Y' ), get_bloginfo( 'name' ) );
	}
	?>
	<meta name="Copyright" content="<?php echo esc_html( $meta_copyright ); ?>">

	<link rel="stylesheet"
		  href="<?php echo esc_url( get_template_directory_uri() ); ?>/reset.css"/>
	<link rel="stylesheet" href="<?php echo esc_url( get_stylesheet_uri() ); ?>"/>

	<link rel="profile" href="http://gmpg.org/xfn/11"/>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<div id="wrapper">

	<header id="header" role="banner">
		<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>"
			   title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"
			   rel="home"><?php bloginfo( 'name' ); ?></a></h1>

		<div class="description"><?php bloginfo( 'description' ); ?></div>

		<?php
		if ( get_header_image() && ! display_header_text() ) : /* If there's a header image but no header text. */ { ?>
			<a href="<?php echo esc_url( home_url() ); ?>"
			   title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" rel="home"><img
					class="header-image" src="<?php header_image(); ?>"
					width="<?php echo esc_attr( get_custom_header()->width ); ?>"
					height="<?php echo esc_attr( get_custom_header()->height ); ?>"
					alt=""/></a>
		<?php } elseif ( get_header_image() ) : /* If there's a header image. */ { ?>
			<img class="header-image" src="<?php header_image(); ?>"
				 width="<?php echo absint( get_custom_header()->width ); ?>"
				 height="<?php echo absint( get_custom_header()->height ); ?>"
				 alt=""/>
		<?php } endif; /* End check for header image. */ ?>
	</header>

	<nav id="nav" role="navigation">
		<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
	</nav>

