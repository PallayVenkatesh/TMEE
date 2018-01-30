<?php
/**
 * About setup
 *
 * @package Echo Magazine
 */

if ( ! function_exists( 'echo_magazine_about_setup' ) ) :

	/**
	 * About setup.
	 *
	 * @since 1.0.0
	 */
	function echo_magazine_about_setup() {

		$config = array(

			// Welcome content.
			'welcome_content' => sprintf( esc_html__( ' First off, We’d like to extend a warm welcome and thank you for choosing %1$s. %1$s is now installed and ready to use. We want to make sure you have the best experience using the theme and that is why we gathered here all the necessary information for you. Again, Thanks for using our theme!', 'echo-magazine' ), 'Echo Magazine' ),

			// Tabs.
			'tabs' => array(
				'getting-started' => esc_html__( 'Getting Started', 'echo-magazine' ),
				'support'         => esc_html__( 'Support', 'echo-magazine' ),
				'useful-plugins'  => esc_html__( 'Useful Plugins', 'echo-magazine' ),
				'demo-content'    => esc_html__( 'Demo Content', 'echo-magazine' ),
				),

			// Quick links.
			'quick_links' => array(
				'theme_url' => array(
					'text' => esc_html__( 'Theme Details', 'echo-magazine' ),
					'url'  => 'https://themeinwp.com/theme/echo-magazine/',
					),
				'demo_url' => array(
					'text' => esc_html__( 'View Demo', 'echo-magazine' ),
					'url'  => 'https://themeinwp.com/theme-demos/?demo=echo-magazine',
					),
				'documentation_url' => array(
					'text'   => esc_html__( 'View Documentation', 'echo-magazine' ),
					'url'    => 'https://docs.themeinwp.com/themes/echo-magazine/',
					'button' => 'primary',
					),
				),

			// Getting started.
			'getting_started' => array(
				'one' => array(
					'title'       => esc_html__( 'Theme Documentation', 'echo-magazine' ),
					'icon'        => 'dashicons dashicons-format-aside',
					'description' => esc_html__( 'Please check our full documentation for detailed information on how to setup and customize the theme.', 'echo-magazine' ),
					'button_text' => esc_html__( 'View Documentation', 'echo-magazine' ),
					'button_url'  => 'https://docs.themeinwp.com/themes/echo-magazine/',
					'button_type' => 'primary',
					'is_new_tab'  => true,
					),
				'two' => array(
					'title'       => esc_html__( 'Static Front Page', 'echo-magazine' ),
					'icon'        => 'dashicons dashicons-admin-generic',
					'description' => esc_html__( 'To achieve custom home page other than blog listing, you need to create and set static front page.', 'echo-magazine' ),
					'button_text' => esc_html__( 'Static Front Page', 'echo-magazine' ),
					'button_url'  => admin_url( 'customize.php?autofocus[section]=static_front_page' ),
					'button_type' => 'primary',
					),
				'three' => array(
					'title'       => esc_html__( 'Theme Options', 'echo-magazine' ),
					'icon'        => 'dashicons dashicons-admin-customizer',
					'description' => esc_html__( 'Theme uses Customizer API for theme options. Using the Customizer you can easily customize different aspects of the theme.', 'echo-magazine' ),
					'button_text' => esc_html__( 'Customize', 'echo-magazine' ),
					'button_url'  => wp_customize_url(),
					'button_type' => 'primary',
					),
				'four' => array(
					'title'       => esc_html__( 'Widget Ready', 'echo-magazine' ),
					'icon'        => 'dashicons dashicons-admin-settings',
					'description' => esc_html__( 'Echo Magazine is widget based Theme. Echo Magazine has 7 predesigned custome additional layout.', 'echo-magazine' ),
					'button_text' => esc_html__( 'View Widgets', 'echo-magazine' ),
					'button_url'  => admin_url( 'widgets.php' ),
					'button_type' => 'secondary',
					),
				'five' => array(
					'title'       => esc_html__( 'Demo Content', 'echo-magazine' ),
					'icon'        => 'dashicons dashicons-layout',
					'description' => sprintf( esc_html__( '%1$s plugin should be installed and activated. After plugin is activated, visit Import Demo Data menu under Appearance.', 'echo-magazine' ), esc_html__( 'One Click Demo Import', 'echo-magazine' ) ),
					'button_text' => esc_html__( 'Demo Content', 'echo-magazine' ),
					'button_url'  => admin_url( 'themes.php?page=echo-magazine-about&tab=demo-content' ),
					'button_type' => 'secondary',
					),
				'six' => array(
					'title'       => esc_html__( 'Theme Preview', 'echo-magazine' ),
					'icon'        => 'dashicons dashicons-welcome-view-site',
					'description' => esc_html__( 'You can check out the theme demos for reference to find out what you can achieve using the theme and how it can be customized.', 'echo-magazine' ),
					'button_text' => esc_html__( 'View Demo', 'echo-magazine' ),
					'button_url'  => 'https://themeinwp.com/theme-demos/?demo=echo-magazine',
					'button_type' => 'secondary',
					'is_new_tab'  => true,
					),
				),

			// Support.
			'support' => array(
				'one' => array(
					'title'       => esc_html__( 'Contact Support', 'echo-magazine' ),
					'icon'        => 'dashicons dashicons-sos',
					'description' => esc_html__( 'Got theme support question or found bug or got some feedbacks? Best place to ask your query is the dedicated Support forum for the theme.', 'echo-magazine' ),
					'button_text' => esc_html__( 'Contact Support', 'echo-magazine' ),
					'button_url'  => 'https://wordpress.org/support/theme/echo-magazine/',
					'button_type' => 'secondary',
					'is_new_tab'  => true,
					),
				'two' => array(
					'title'       => esc_html__( 'Theme Documentation', 'echo-magazine' ),
					'icon'        => 'dashicons dashicons-format-aside',
					'description' => esc_html__( 'Please check our full documentation for detailed information on how to setup and customize the theme.', 'echo-magazine' ),
					'button_text' => esc_html__( 'View Documentation', 'echo-magazine' ),
					'button_url'  => 'https://docs.themeinwp.com/themes/echo-magazine/',
					'button_type' => 'secondary',
					'is_new_tab'  => true,
					),
				'three' => array(
					'title'       => esc_html__( 'Child Theme', 'echo-magazine' ),
					'icon'        => 'dashicons dashicons-admin-tools',
					'description' => esc_html__( 'For advanced theme customization, it is recommended to use child theme rather than modifying the theme file itself.', 'echo-magazine' ),
					'button_text' => esc_html__( 'Learn More', 'echo-magazine' ),
					'button_url'  => 'https://developer.wordpress.org/themes/advanced-topics/child-themes/',
					'button_type' => 'secondary',
					'is_new_tab'  => true,
					),
				),

			// Useful plugins.
			'useful_plugins' => array(
				'description' => esc_html__( 'Theme supports some helpful WordPress plugins to enhance your site. But, please enable only those plugins which you need in your site. For example, enable WooCommerce only if you are using e-commerce.', 'echo-magazine' ),
				),

			// Demo content.
			'demo_content' => array(
				'description' => sprintf( esc_html__( 'To import demo content for this theme, %1$s plugin is needed. Please make sure plugin is installed and activated. After plugin is activated, you will see Import Demo Data menu under Appearance.', 'echo-magazine' ), '<a href="https://wordpress.org/plugins/one-click-demo-import/" target="_blank">' . esc_html__( 'One Click Demo Import', 'echo-magazine' ) . '</a>' ),
				),

			// Upgrade to pro.
			'upgrade_to_pro' => array(
				'description' => esc_html__( 'You can upgrade to pro version of the theme for more exciting features.', 'echo-magazine' ),
				'button_text' => esc_html__( 'Upgrade to Pro','echo-magazine' ),
				'button_url'  => 'https://themeinwp.com/theme/echo-magazine/',
				'button_type' => 'primary',
				'is_new_tab'  => true,
				),
			);

		Echo_Magazine_About::init( $config );
	}

endif;

add_action( 'after_setup_theme', 'echo_magazine_about_setup' );
