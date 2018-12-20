<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package quna
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function quna_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Adds a class of post-excerpt-thumbnail-layout when Excerpt+Thumbnail of post archive option enabled.
	if ( ! is_singular() ) {
		$classes[] = 'post-excerpt-thumbnail-layout';
	}

	if( true == quna_mod_is_no_right_sidebar_on_default_page() ) {
		$classes[] = 'hide-right-sidebar-on-default-page';
	}

	if( true == quna_mod_is_no_right_sidebar_on_home() ) {
		$classes[] = 'hide-right-sidebar-on-home';
	}

	if( true == quna_mod_is_no_right_sidebar_on_post() ) {
		$classes[] = 'hide-right-sidebar-on-single-post';
	}

	if( true == quna_is_no_right_sidebar() ) {
		$classes[] = 'right-sidebar-disabled';
	}

	$pages = array();
	if( is_page( apply_filters('quna_main_header_pages', $pages) ) ) {
		$classes[] = 'use-main-header-footer';
	}

	if( is_page_template('page-templates/page_frontpage.php') ) {
		$classes[] = 'use-main-header-footer';	
	}

	return $classes;
}
add_filter( 'body_class', 'quna_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function quna_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'quna_pingback_header' );

/**
 * Social profiles
 */
function quna_social_profiles() {
	$soc = array();
	$soc['facebook'] = get_theme_mod('quna_facebook');
	$soc['twitter'] = get_theme_mod('quna_twitter');
	$soc['instagram'] = get_theme_mod('quna_instagram');

	$socials = array(
    'linkedin'    => __('Linkedin', 'quna'),
    'vk'          => __('VK', 'quna'),
    'youtube'     => __('YouTube', 'quna'),
    'github'      => __('GitHub', 'quna'),
    'googleplus'  => __('Google Plus', 'quna'),
    'behance'     => __('Behance', 'quna')
  );

  foreach( $socials as $key => $label ) {
		$soc[$key] = get_theme_mod('quna_'.$key);
	}

	$soc_item = '';
	if($soc['facebook'] != '') {
		$soc_item .= '<li><a target="_blank" href="' . esc_url($soc['facebook']) . '" title="'.esc_attr(__('Facebook', 'quna')).'"><i class="fab fa-facebook"></i></a></li>';
	}
	if($soc['twitter'] != '') {
		$soc_item .= '<li><a target="_blank" href="' . esc_url($soc['twitter']) . '" title="'.esc_attr(__('Twitter', 'quna')).'"><i class="fab fa-twitter"></i></a></li>';
	}
	if($soc['instagram'] != '') {
		$soc_item .= '<li><a target="_blank" href="' . esc_url($soc['instagram']) . '" title="'.esc_attr(__('Instagram', 'quna')).'"><i class="fab fa-instagram"></i></a></li>';
	}

	foreach( $socials as $key => $label ) {
		if($soc[$key] != '') {
			$soc_icon = '';
			switch ($key) {
				case 'linkedin':
					$soc_icon = 'fa-linkedin-in';
					break;
				case 'vk':
					$soc_icon = 'fa-vk';
					break;
				case 'youtube':
					$soc_icon = 'fa-youtube';
					break;
				case 'github':
					$soc_icon = 'fa-github';
					break;
				case 'googleplus':
					$soc_icon = 'fa-google-plus';
					break;
				case 'behance':
					$soc_icon = 'fa-behance';
					break;
				default:
					break;
			}
			$soc_item .= '<li><a target="_blank" href="' . esc_url($soc[$key]) . '" title="' . esc_attr($label) . '"><i class="fab ' . esc_attr($soc_icon) . '"></i></a></li>';
		}
	}

	if($soc_item != '') {
		return '<ul class="social-profiles">' . $soc_item . '</ul>';
	}

	return;

}

/**
 * Instagram feed
 */

function quna_display_instagram_feed() {

	if( class_exists('null_instagram_widget') ) {
	  $settings = array();
	  if( '' != get_theme_mod('quna_ig_feed') ) {
	    $settings['username'] = esc_html( get_theme_mod('quna_ig_feed') );
	    $settings['number']   = 4;
	    $settings['size']     = 'small';
	    $settings['target']   = '_blank';
	  ?>
	  <div class="quna_bundled-widget">
		<?php do_action('quna_before_instagram_feed'); ?>
	  <?php the_widget( 'null_instagram_widget', $settings ); ?>
		<?php do_action('quna_after_instagram_feed'); ?>
	  </div>
	  <?php
	  }
	}

}

/**
 * Check if hide sidebar on default page
 */
function quna_mod_is_no_right_sidebar_on_default_page() {

	if( null !== get_theme_mod('quna_page_hide_right_sidebar') ) {
		if( is_page() && '' == is_page_template() && true == get_theme_mod('quna_page_hide_right_sidebar') ) {
			return true;
		}
	}
	return false;

}

/**
 * Check if hide sidebar on home/blog archive
 */
function quna_mod_is_no_right_sidebar_on_home() {

	if( null !== get_theme_mod('quna_home_hide_right_sidebar') ) {
		if( is_home() && true == get_theme_mod('quna_home_hide_right_sidebar') ) {
			return true;
		}
	}

	if( is_page_template('page-templates/page_frontpage.php') ) {
		return true;
	}

	return false;

}

/**
 * Check if hide sidebar on single post
 */
function quna_mod_is_no_right_sidebar_on_post() {

	if( null !== get_theme_mod('quna_post_hide_right_sidebar') ) {
		if( is_singular( 'post' ) && '' == is_page_template() && true == get_theme_mod('quna_post_hide_right_sidebar') ) {
			return true;
		}
	}
	return false;

}

/**
 * Is hide right sidebar check
 */
function quna_is_no_right_sidebar() {

	$context = array();
	$context['home'] = quna_mod_is_no_right_sidebar_on_home();
	$context['page'] = quna_mod_is_no_right_sidebar_on_default_page();
	$context['post'] = quna_mod_is_no_right_sidebar_on_post();

	if( (true == $context['home']) || (true == $context['page']) || (true == $context['post']) ) {
		return true;
	}

	return false;

}

/**
 * Check if disable comment on static homepage
 */
function quna_is_disable_comment_on_homepage() {

	if( null !== get_theme_mod('quna_disable_comment_homepage') ) {
		if( true == get_theme_mod('quna_disable_comment_homepage') ) {
			return true;
		}
	}
	return false;

}

/**
 * Check if hide page title on static homepage
 */
function quna_is_hide_title_on_homepage() {

	if( null !== get_theme_mod('quna_hide_title_homepage') ) {
		if( true == get_theme_mod('quna_hide_title_homepage') ) {
			return true;
		}
	}
	return false;

}

/**
 * Social shortcode
 */
function quna_social_profiles_icons() {
	return quna_social_profiles();
}

/**
 * Single post navigation at bottom
 */
add_filter('previous_post_link', 'quna_post_nav_thumbnail', 20, 5 );
add_filter('next_post_link', 'quna_post_nav_thumbnail', 20, 5 );
function quna_post_nav_thumbnail($output, $format, $link, $post, $adjacent) {

	if( !$output ) {
 		return;
  }

	$rel   = $adjacent;
  $date  = mysql2date( get_option( 'date_format' ), $post->post_date );
  $thumb = get_the_post_thumbnail($post->ID);
  $title = '<h3>' . $post->post_title . '</h3>';

  $string = '<a href="' . get_permalink( $post->ID ) . '" rel="' . $rel . '">' . $thumb;
  $inlink = str_replace( '%title', $title, $link );
  $inlink = str_replace( '%date', $date, $inlink );
  $inlink = $string . $inlink . '</a>';
  $output = str_replace( '%link', $inlink, $format );

  if( !$post->ID ) {
    return;
  }

  return $output;

}

/**
 * Gutenber editor CSS
 */
function quna_editor_css() {

	$prefix = 'quna_';

	$body_font = get_theme_mod($prefix.'body_gfont', 'Roboto:400,400i,500,700,700i,900,900i');
	$heading_font = get_theme_mod($prefix.'heading_gfont', 'Dosis:400,500,600,700,800');
	$body_font_css = get_theme_mod($prefix.'body_gfont_css', '\'Roboto\', sans-serif;');
	$heading_font_css = get_theme_mod($prefix.'heading_gfont_css', '\'Dosis\', sans-serif;');

  $font_size_site_title = get_theme_mod($prefix.'site_title_font_size', 32);
  $font_size_page_title = get_theme_mod($prefix.'post_font_size', 26);
  $font_size_widget_title = get_theme_mod($prefix.'widget_title_font_size', 22);
  $font_size_h1 = get_theme_mod($prefix.'heading1_font_size', 26);
  $font_size_h2 = get_theme_mod($prefix.'heading2_font_size', 24);
  $font_size_h3 = get_theme_mod($prefix.'heading3_font_size', 20);
  $font_size_h4 = get_theme_mod($prefix.'heading4_font_size', 18);
  $font_size_h5 = get_theme_mod($prefix.'heading5_font_size', 16);
  $font_size_h6 = get_theme_mod($prefix.'heading6_font_size', 16);

	$css = ".wp-block.editor-post-title__block .editor-post-title__input, .wp-block h1, .wp-block h2, .wp-block h3, .wp-block h4, .wp-block h5, .wp-block h6 { font-family: " . $heading_font_css . " }" . "\n";
	$css .= ".wp-block { font-family: " . $body_font_css . " }" . "\n";

	$css .= '.wp-block.editor-post-title__block .editor-post-title__input{font-size: '. absint($font_size_page_title) .'px !important}';
	$css .= '.wp-block .wp-block-heading h1{font-size: '. absint($font_size_h1) .'px !important}';
	$css .= '.wp-block .wp-block-heading h2{font-size: '. absint($font_size_h2) .'px !important}';
	$css .= '.wp-block .wp-block-heading h3{font-size: '. absint($font_size_h3) .'px !important}';
	$css .= '.wp-block .wp-block-heading h4{font-size: '. absint($font_size_h4) .'px !important}';
	$css .= '.wp-block .wp-block-heading h5{font-size: '. absint($font_size_h5) .'px !important}';
	$css .= '.wp-block .wp-block-heading h6{font-size: '. absint($font_size_h6) .'px !important}';

	return apply_filters('quna_editor_css', $css);

}
