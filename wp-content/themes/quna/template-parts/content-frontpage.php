<?php
/**
 * This code looks for this plugin be enabled
 * https://wordpress.org/plugins/wp-instagram-widget/
 */
if( !is_front_page() ) {
  return;
}

quna_display_instagram_feed();
