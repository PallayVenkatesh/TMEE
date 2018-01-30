<?php
/**
 * Theme-options.php
 *
 * Theme options file, using the Customizer, for VideoPlace
 *
 * @author Jacob Martella
 * @package VideoPlace
 * @version 1.3
 */

//* Create the general settings section
function videoplace_general_customizer( $wp_customize ) {
	$wp_customize->add_section(
		'general',
		array(
			'title'         => __( 'VideoPlace Settings', 'videoplace' ),
			'description'   => __( 'These are the theme options for VideoPlace.', 'videoplace' ),
			'priority'      => 35,
		)
	);

	//* Display site title and description with header
	$wp_customize->add_setting(
		'videoplace-header-text',
		array(
			'default'           => '',
			'sanitize_callback' => 'videoplace_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'videoplace-header-text',
		array(
			'label'     => __( 'Display the site title and description when a custom header image is in use: ', 'videoplace' ),
			'section'   => 'general',
			'type'      => 'checkbox',
		)
	);

    //* Get the categories for the home page options
    $schemes[ 'light' ] = __( 'Light', 'videoplace' );
    $schemes[ 'dark' ] = __( 'Dark', 'videoplace' );

    //* Home Slider Category
    $wp_customize->add_setting(
        'videoplace-color-scheme',
        array(
            'default'           => 'dark',
            'sanitize_callback' => 'videoplace_sanitize_select',
        )
    );

    $wp_customize->add_control(
        'videoplace-color-scheme',
        array(
            'label'     => __( 'Color Scheme', 'videoplace' ),
            'section'   => 'general',
            'type'      => 'select',
            'choices'   => $schemes
        )
    );

	//* Show Sticky Post on Homepage
	$wp_customize->add_setting(
		'videoplace-show-sticky-post',
		array(
			'default'           => '',
			'sanitize_callback' => 'videoplace_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'videoplace-show-sticky-post',
		array(
			'label'     => __( 'Show Latest Sticky Post at top of home page: ', 'videoplace' ),
			'section'   => 'general',
			'type'      => 'checkbox',
		)
	);

    //* Display number of comments on listing pages
    $wp_customize->add_setting(
        'videoplace-show-comments-number',
        array(
            'default'           => '',
            'sanitize_callback' => 'videoplace_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
        'videoplace-show-comments-number',
        array(
            'label'     => __( 'Display the number of comments on the home, index and archive pages: ', 'videoplace' ),
            'section'   => 'general',
            'type'      => 'checkbox',
        )
    );

	//* Social Links
	//* Facebook
	$wp_customize->add_setting(
			'videoplace-facebook',
			array(
					'default'           => '',
					'sanitize_callback' => 'videoplace_sanitize_link',
			)
	);

	$wp_customize->add_control(
			'videoplace-facebook',
			array(
					'label'     => __( 'Link to Facebook Page/Profile: ', 'videoplace' ),
					'section'   => 'general',
					'type'      => 'text',
			)
	);

	//* Twitter
	$wp_customize->add_setting(
			'videoplace-twitter',
			array(
					'default'           => '',
					'sanitize_callback' => 'videoplace_sanitize_link',
			)
	);

	$wp_customize->add_control(
			'videoplace-twitter',
			array(
					'label'     => __( 'Link to Twitter Profile: ', 'videoplace' ),
					'section'   => 'general',
					'type'      => 'text',
			)
	);

	//* Google Plus
	$wp_customize->add_setting(
			'videoplace-google-plus',
			array(
					'default'           => '',
					'sanitize_callback' => 'videoplace_sanitize_link',
			)
	);

	$wp_customize->add_control(
			'videoplace-google-plus',
			array(
					'label'     => __( 'Link to Google Plus Profile: ', 'videoplace' ),
					'section'   => 'general',
					'type'      => 'text',
			)
	);
	//* Facebook
	$wp_customize->add_setting(
			'videoplace-youtube',
			array(
					'default'           => '',
					'sanitize_callback' => 'videoplace_sanitize_link',
			)
	);

	$wp_customize->add_control(
			'videoplace-youtube',
			array(
					'label'     => __( 'Link to YouTube Channel: ', 'videoplace' ),
					'section'   => 'general',
					'type'      => 'text',
			)
	);

	//* Facebook
	$wp_customize->add_setting(
			'videoplace-tumblr',
			array(
					'default'           => '',
					'sanitize_callback' => 'videoplace_sanitize_link',
			)
	);

	$wp_customize->add_control(
			'videoplace-tumblr',
			array(
					'label'     => __( 'Link to Tumblr Blog: ', 'videoplace' ),
					'section'   => 'general',
					'type'      => 'text',
			)
	);

	//* Facebook
	$wp_customize->add_setting(
			'videoplace-instagram',
			array(
					'default'           => '',
					'sanitize_callback' => 'videoplace_sanitize_link',
			)
	);

	$wp_customize->add_control(
			'videoplace-instagram',
			array(
					'label'     => __( 'Link to Instagram Profile: ', 'videoplace' ),
					'section'   => 'general',
					'type'      => 'text',
			)
	);

	//* Facebook
	$wp_customize->add_setting(
			'videoplace-rss-feed',
			array(
					'default'            => '',
					'sanitize_callback' => 'videoplace_sanitize_link',
			)
	);

	$wp_customize->add_control(
			'videoplace-rss-feed',
			array(
					'label'     => __( 'Link to Custom RSS Feed: ', 'videoplace' ),
					'section'   => 'general',
					'type'      => 'text',
			)
	);

}
add_action( 'customize_register', 'videoplace_general_customizer' );


//* Sanitize Links
function videoplace_sanitize_link( $input ) {
	return esc_url_raw( $input );
}

//* Sanitize Checkboxes
function videoplace_sanitize_checkbox( $input ) {
	return ( ( isset( $input ) && true == $input ) ? 1 : 0 );
}

//* Sanitize Numbers
function videoplace_sanitize_num( $input, $setting ) {
	$input = absint( $input );
	return ( $input ? $input : $setting->default );
}

function videoplace_sanitize_select( $input, $setting ) {
    $input = sanitize_key( $input );
    $choices = $setting->manager->get_control( $setting->id )->choices;
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

?>