<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function echo_magazine_widgets_init()
{

    register_sidebar(array(
        'name' => esc_html__('Main Sidebar', 'echo-magazine'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'echo-magazine'),
        'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title primary-font">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Home Page Sidebar One', 'echo-magazine'),
        'id' => 'sidebar-home-1',
        'description' => esc_html__('Add widgets here.', 'echo-magazine'),
        'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Home Page Sidebar Two', 'echo-magazine'),
        'id' => 'sidebar-home-2',
        'description' => esc_html__('Add widgets here.', 'echo-magazine'),
        'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title primary-font">',
        'after_title' => '</h2>',
    ));

    $echo_magazine_footer_widgets_number = echo_magazine_get_option('number_of_footer_widget');
    if ($echo_magazine_footer_widgets_number > 0) {
        register_sidebar(array(
            'name' => esc_html__('Footer Column One', 'echo-magazine'),
            'id' => 'footer-col-one',
            'description' => esc_html__('Displays items on footer section.', 'echo-magazine'),
            'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widget-title primary-font">',
            'after_title' => '</h2>',
        ));
        if ($echo_magazine_footer_widgets_number > 1) {
            register_sidebar(array(
                'name' => esc_html__('Footer Column Two', 'echo-magazine'),
                'id' => 'footer-col-two',
                'description' => esc_html__('Displays items on footer section.', 'echo-magazine'),
                'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h2 class="widget-title primary-font">',
                'after_title' => '</h2>',
            ));
        }
        if ($echo_magazine_footer_widgets_number > 2) {
            register_sidebar(array(
                'name' => esc_html__('Footer Column Three', 'echo-magazine'),
                'id' => 'footer-col-three',
                'description' => esc_html__('Displays items on footer section.', 'echo-magazine'),
                'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h2 class="widget-title primary-font">',
                'after_title' => '</h2>',
            ));
        }
    }
}

add_action('widgets_init', 'echo_magazine_widgets_init');
