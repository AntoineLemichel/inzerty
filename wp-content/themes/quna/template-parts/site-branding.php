<div class="site-branding">
  <?php
  the_custom_logo();
  if ( is_front_page() && is_home() ) :
    ?>
    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
    <?php
  else :
    ?>
    <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
    <?php
  endif;
  $quna_description = get_bloginfo( 'description', 'display' );
  if ( $quna_description || is_customize_preview() ) :
    ?>
    <p class="site-description"><?php echo $quna_description; /* WPCS: xss ok. */ ?></p>
  <?php endif; ?>

  <?php echo quna_social_profiles(); ?>

</div><!-- .site-branding -->
