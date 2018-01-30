<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package echo-magazine
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php if (echo_magazine_get_option('enable_preloader_option') == 1) { ?>
    <div class="preloader">
        <div class="preloader-wrapper">
        </div>
    </div>
<?php } ?>
<div id="page" class="site site-bg">
    <a class="skip-link screen-reader-text" href="#main"><?php esc_html_e('Skip to content', 'echo-magazine'); ?></a>
    <header id="masthead" class="site-header" role="banner">
        <div class="top-bar secondary-bgcolor">
            <?php
            $navigation_collaps_enable = absint(echo_magazine_get_option('show_navigation_collaps'));
            ?>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <nav class="main-navigation" role="navigation">
                            <span class="icon-search primary-bgcolor">
                                <i class="twp-icon fa fa-search"></i>
                            </span>

                            <span class="toggle-menu" aria-controls="primary-menu" aria-expanded="false">
                                 <span class="screen-reader-text"><?php esc_html_e('Primary Menu', 'echo-magazine'); ?></span>
                                <i class="ham"></i>
                            </span>
                            <?php wp_nav_menu(array(
                                'theme_location' => 'primary',
                                'menu_id' => 'primary-menu',
                                'container' => 'div',
                                'container_class' => 'menu'
                            )); ?>
                        </nav>
                        <!-- #site-navigation -->

                    </div>
                </div>
            </div>

            <div class="popup-search">
                <div class="table-align">
                    <div class="table-align-cell v-align-middle">
                        <?php get_search_form(); ?>
                    </div>
                </div>
                <div class="close-popup"></div>
            </div>
        </div>
        <div class="header-middle">
    <div class="container">
        <div class="row twp-equal">
            <div class="col-md-4 col-xs-12 twp-equal-child">
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
            <div class="col-md-4 col-xs-12 twp-equal-child">
                <div class="site-branding">
                    <?php
                    if (is_front_page() && is_home()) : ?>
                        <span class="site-title">
                                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                    <?php bloginfo('name'); ?>
                                </a>
                            </span>
                    <?php else : ?>
                        <span class="site-title secondary-font">
                                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                    <?php bloginfo('name'); ?>
                                </a>
                            </span>
                    <?php endif;
                    echo_magazine_the_custom_logo();
                    $description = get_bloginfo('description', 'display');
                    if ($description || is_customize_preview()) : ?>
                        <p class="site-description"><?php echo $description; ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
    </header>
<!-- #masthead -->

<!-- Innerpage Header Begins Here -->
<?php
if (is_front_page()) {
        /**
     * echo_magazine_action_front_page hook
     * @since echo-magazine 0.0.2
     *
     * @hooked echo_magazine_action_front_page -  10
     * @sub_hooked echo_magazine_action_front_page -  10
     */
    do_action( 'echo_magazine_action_front_page' );
} else {
    do_action('echo-magazine-page-inner-title');
}
?>
<!-- Innerpage Header Ends Here -->
<div id="content" class="site-content">