<?php

if ( ! function_exists( 'quna_custom_google_fonts' ) ) :
  function quna_custom_google_fonts() {
    $body_font = get_theme_mod('quna_body_gfont', 'Roboto:400,400i,500,700,700i,900,900i');
    $heading_font = get_theme_mod('quna_heading_gfont', 'Dosis:400,500,600,700,800');
    $body_font_css = get_theme_mod('quna_body_gfont_css', '\'Roboto\', sans-serif;');
    $heading_font_css = get_theme_mod('quna_heading_gfont_css', '\'Dosis\', sans-serif;');

    $font_css = "\n";

    if($body_font_css) {
      $font_css .= "body { font-family: " . $body_font_css . " }" . "\n";
    }

    if($heading_font_css) {
      $font_css .= "h1,h2,h3,h4,h5,h6,p.site-title { font-family: " . $heading_font_css . "}" . "\n";
    }

    return $font_css;

  }
endif;

function quna_inline_styles($custom) {

  $prefix = 'quna_';
  $font_size_site_title = get_theme_mod($prefix.'site_title_font_size', 32);
  $font_size_page_title = get_theme_mod($prefix.'post_font_size', 26);
  $font_size_widget_title = get_theme_mod($prefix.'widget_title_font_size', 22);
  $font_size_h1 = get_theme_mod($prefix.'heading1_font_size', 26);
  $font_size_h2 = get_theme_mod($prefix.'heading2_font_size', 24);
  $font_size_h3 = get_theme_mod($prefix.'heading3_font_size', 20);
  $font_size_h4 = get_theme_mod($prefix.'heading4_font_size', 18);
  $font_size_h5 = get_theme_mod($prefix.'heading5_font_size', 16);
  $font_size_h6 = get_theme_mod($prefix.'heading6_font_size', 16);

  $custom  = "";
  $custom .= quna_custom_google_fonts();

  // Site title font size
  $custom .= 'body:not(.home) .site-header .site-title, body.home .site-header .site-title a{font-size: '. absint($font_size_site_title) .'px}';

  // Post/page title font size
  $custom .= '.entry-title, .single-post .entry-title, .post-excerpt-thumbnail-layout .entry-title{font-size: '. absint($font_size_page_title) .'px}';

  // Widget title font size
  $custom .= '.widget-title{font-size: '. absint($font_size_widget_title) .'px}';

  // Heading font size
  $custom .= 'h1{font-size: '. absint($font_size_h1)  .'px}';
  $custom .= 'h2{font-size: '. absint($font_size_h2)  .'px}';
  $custom .= 'h3{font-size: '. absint($font_size_h3)  .'px}';
  $custom .= 'h4{font-size: '. absint($font_size_h4)  .'px}';
  $custom .= 'h5{font-size: '. absint($font_size_h5)  .'px}';
  $custom .= 'h6{font-size: '. absint($font_size_h6)  .'px}';

  $site_title_font_size = get_theme_mod($prefix . 'site_title_font_size');

  wp_add_inline_style( 'quna-style', apply_filters('quna_inline_css', $custom) );

}
add_action( 'wp_enqueue_scripts', 'quna_inline_styles' );
