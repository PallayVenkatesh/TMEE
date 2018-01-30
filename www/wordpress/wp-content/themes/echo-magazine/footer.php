<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package echo-magazine
 */

?>
</div><!-- #content -->

    <?php $echo_magazine_footer_widgets_number = echo_magazine_get_option('number_of_footer_widget');
    if (1 == $echo_magazine_footer_widgets_number) {
        $col = 'col-md-12';
    } elseif (2 == $echo_magazine_footer_widgets_number) {
        $col = 'col-md-6';
    } elseif (3 == $echo_magazine_footer_widgets_number) {
        $col = 'col-md-4';
    } elseif (4 == $echo_magazine_footer_widgets_number) {
        $col = 'col-md-3';
    } else {
        $col = 'col-md-3';
    }
    if (is_active_sidebar('footer-col-one') || is_active_sidebar('footer-col-two') || is_active_sidebar('footer-col-three') || is_active_sidebar('footer-col-four')) { ?>
        <section class="section-block footer-widget-area">
            <div class="container">
                <div class="row">
                    <?php if (is_active_sidebar('footer-col-one') && $echo_magazine_footer_widgets_number > 0) : ?>
                        <div class="footer-widget-wrapper <?php echo esc_attr($col); ?>">
                            <?php dynamic_sidebar('footer-col-one'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (is_active_sidebar('footer-col-two') && $echo_magazine_footer_widgets_number > 1) : ?>
                        <div class="footer-widget-wrapper <?php echo esc_attr($col); ?>">
                            <?php dynamic_sidebar('footer-col-two'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (is_active_sidebar('footer-col-three') && $echo_magazine_footer_widgets_number > 2) : ?>
                        <div class="footer-widget-wrapper <?php echo esc_attr($col); ?>">
                            <?php dynamic_sidebar('footer-col-three'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (is_active_sidebar('footer-col-four') && $echo_magazine_footer_widgets_number > 3) : ?>
                        <div class="footer-widget-wrapper <?php echo esc_attr($col); ?>">
                            <?php dynamic_sidebar('footer-col-four'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

    <?php } ?>

<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-xs-12">
                    <?php if (has_nav_menu('social')) { ?>
                        <div class="twp-social-share">
                            <div class="social-icons ">
                                <?php
                                wp_nav_menu(
                                    array('theme_location' => 'social',
                                        'link_before' => '<span class="screen-reader-text">',
                                        'link_after' => '</span>',
                                        'menu_id' => 'social-menu',
                                        'fallback_cb' => false,
                                        'menu_class' => 'twp-social-nav',
                                        'container_class' => 'social-menu-container'
                                    )); ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <?php if (has_nav_menu('footer')) { ?>
                        <div class="site-footer-menu">
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'footer',
                                'menu_id' => 'footer-menu',
                                'container' => 'div',
                                'depth' => 1,
                                'menu_class' => false
                            )); ?>
                        </div>
                    <?php } ?>
                </div>

                <div class="col-sm-12 col-xs-12">
                    <span class="footer-divider"></span>
                </div>

                <div class="col-sm-12 col-xs-12">
                    <div class="site-copyright secondary-font font-italic">
                        <div class="row">
                            <div class="col-xs-5">
                                <?php
                                $echo_magazine_copyright_text = echo_magazine_get_option('copyright_text');
                                if (!empty ($echo_magazine_copyright_text)) {
                                    echo wp_kses_post($echo_magazine_copyright_text);
                                }
                                ?>
                            </div>
                            <div class="col-xs-2">
                                <a id="scroll-up">
                                    <i class="fa fa-angle-up"></i>
                                </a>
                            </div>
                            <div class="col-xs-5">
                                <div class="theme-info">
                                <?php printf(esc_html__('Theme: %1$s by %2$s', 'echo-magazine'), 'Echo Magazine', '<a href="https://themeinwp.com/" target = "_blank" rel="designer">ThemeinWP </a>'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>