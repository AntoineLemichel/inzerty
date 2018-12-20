<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package quna
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'quna' ); ?></a>

	<header id="masthead" class="site-header">

		<?php do_action( 'quna_before_branding' ); ?>
		<?php get_template_part( 'template-parts/site', 'branding' ); ?>
		<?php do_action( 'quna_after_branding' ); ?>

		<div class="main-navigation-wrapper">

			<?php do_action( 'quna_before_mainnav' ); ?>

			<nav id="site-navigation" class="main-navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i class="fa fa-bars"></i><span class="button-label"><?php esc_html_e( 'Menu', 'quna' ); ?></span></button>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				) );
				?>
			</nav><!-- #site-navigation -->

			<?php do_action( 'quna_after_mainnav' ); ?>

		</div>

	</header><!-- #masthead -->

	<div id="content" class="site-content">
