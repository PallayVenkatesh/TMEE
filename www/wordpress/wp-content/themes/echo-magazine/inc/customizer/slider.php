<?php
/**
 * slider section
 *
 * @package echo-magazine
 */

$default = echo_magazine_get_default_theme_options();

// Slider Main Section.
$wp_customize->add_section( 'slider_section_settings',
	array(
		'title'      => esc_html__( 'Slider Section', 'echo-magazine' ),
		'priority'   => 60,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_front_page_section',
	)
);


// Setting - show_slider_section.
$wp_customize->add_setting( 'show_slider_section',
	array(
		'default'           => $default['show_slider_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'echo_magazine_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_slider_section',
	array(
		'label'    => esc_html__( 'Enable Slider', 'echo-magazine' ),
		'section'  => 'slider_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

$wp_customize->add_setting( 'slider_layout_option',
	array(
		'default'           => $default['slider_layout_option'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'echo_magazine_sanitize_select',
	)
);
$wp_customize->add_control( 'slider_layout_option',
	array(
		'label'    => esc_html__( 'Slider Layout', 'echo-magazine' ),
		'section'  => 'slider_section_settings',
		'choices'  => array(
                'full-width' => esc_html__( 'Full Width', 'echo-magazine' ),
                'boxed' => esc_html__( 'Boxed', 'echo-magazine' ),
		    ),
		'type'     => 'select',
		'priority' => 100,
	)
);

// Setting - drop down category for slider.
$wp_customize->add_setting( 'select_category_for_slider',
	array(
		'default'           => $default['select_category_for_slider'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control( new Echo_Magazine_Dropdown_Taxonomies_Control( $wp_customize, 'select_category_for_slider',
	array(
        'label'           => esc_html__( 'Category for slider', 'echo-magazine' ),
        'description'     => esc_html__( 'Select category to be shown on tab ', 'echo-magazine' ),
        'section'         => 'slider_section_settings',
        'type'            => 'dropdown-taxonomies',
        'taxonomy'        => 'category',
		'priority'    	  => 130,
    ) ) );


