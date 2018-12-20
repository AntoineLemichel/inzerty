<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @see https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */
?>

	<?php
    $pages = array();
    $pages = apply_filters('quna_main_header_pages', $pages);
    if ((null != $pages && is_page($pages)) || is_page_template('page-templates/page_frontpage.php')) {
        quna_display_instagram_feed();
    }
    ?>

	</div><!-- #content -->

	<div id="footer-widgets-section">
		<div class="footer-widgets widget-area widget-col-5">
			<?php if (is_active_sidebar('sidebar-2')) {
        ?>
				<div class="footer-widget-area"><?php dynamic_sidebar('sidebar-2'); ?></div>
			<?php
    } ?>
			<?php if (is_active_sidebar('sidebar-3')) {
        ?>
				<div class="footer-widget-area"><?php dynamic_sidebar('sidebar-3'); ?></div>
			<?php
    } ?>
			<?php if (is_active_sidebar('sidebar-4')) {
        ?>
				<div class="footer-widget-area"><?php dynamic_sidebar('sidebar-4'); ?></div>
			<?php
    } ?>
			<?php if (is_active_sidebar('sidebar-5')) {
        ?>
				<div class="footer-widget-area"><?php dynamic_sidebar('sidebar-5'); ?></div>
			<?php
    } ?>
			<?php if (is_active_sidebar('sidebar-6')) {
        ?>
				<div class="footer-widget-area last"><?php dynamic_sidebar('sidebar-6'); ?></div>
			<?php
    } ?>
		</div>
	</div>

	<footer id="colophon" class="site-footer">

		<div class="site-info">
			<a href="<?php echo esc_url(__('https://wordpress.org/', 'quna')); ?>">
				<?php
                /* translators: %s: CMS name, i.e. WordPress. */
                printf(esc_html__('Designed by : %1s Site : %2s. Theme used : Quna', 'Antoine LEMICHEL'), 'Antoine LEMICHEL', "<a href='https://antoine-lemichel.fr' target='_new'>Portfolio</a>");
                ?>
			</a>
			<span class="sep"> | </span>
			<?php
            printf(esc_html__('Powered by %s', 'quna'), 'WordPress');
                ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
