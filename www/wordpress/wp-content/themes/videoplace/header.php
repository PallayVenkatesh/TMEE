<?php
/**
 * Header.php
 *
 * @package VideoPlace
 * @author  Jacob Martella
 * @version  1.3
 */
?>
<!doctype html>

  <html class="no-js"  <?php language_attributes(); ?>>

	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		
		<!-- Force IE to use the latest rendering engine available -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<!-- Mobile Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta class="foundation-mq">

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php wp_head(); ?>

	</head>
		
	<body <?php body_class(); ?>>

		<div class="off-canvas-wrapper">
			
			<div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
				
				<?php get_template_part( 'parts/content', 'offcanvas' ); ?>
				
				<div class="off-canvas-content" data-off-canvas-content>
					
					<header class="header" role="banner">

						<div class="top-bar hide-for-large show-for-medium-down" id="top-bar-menu">
							<div class="float-right">
								<ul class="menu">
									<li><button class="menu-icon" type="button" data-toggle="off-canvas"></button></li>
								</ul>
							</div>
						</div>

						<div class="row">
							<div class="masthead large-12 medium-12 columns">
								<?php if ( get_header_image() ) { ?>
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>'" alt="<?php echo get_bloginfo( 'name' ) . ' ' . __( 'Header Image', 'videoplace' ); ?>" /></a>
									<?php if ( ( get_theme_mod( 'videoplace-header-text' ) == 1 ) and ( display_header_text() == 1 ) ) { ?>
										<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" <?php if ( get_header_textcolor() ) { echo 'style="color:#' . get_header_textcolor() . '"'; } ?>><?php echo get_bloginfo( 'name' ); ?></a></h1>
										<h2 class="site-description"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"  <?php if ( get_header_textcolor() ) { echo 'style="color:#' . get_header_textcolor() . '"'; } ?>><?php echo get_bloginfo( 'description' ); ?></a></h2>
									<?php } ?>
							 	<?php } else { ?>
									<?php if ( display_header_text() == 1 ) { ?>
							 			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" <?php if ( get_header_textcolor() ) { echo 'style="color:#' . get_header_textcolor() . '"'; } ?>><?php echo get_bloginfo( 'name' ); ?></a></h1>
										<h2 class="site-description"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"  <?php if ( get_header_textcolor() ) { echo 'style="color:#' . get_header_textcolor() . '"'; } ?>><?php echo get_bloginfo( 'description' ); ?></a></h2>
							 		<?php } ?>
								<?php } ?>
							</div>
						</div>
						<div class="top-bar show-for-large" id="main-menu">
							<div class="row">
								<div class="top-bar-left">
									<?php wp_nav_menu( array(
											'container'	 		=> false,                           	// Remove nav container
											'menu_class' 		=> 'medium-horizontal menu',       		// Adding custom nav class
											'items_wrap' 		=> '<ul id="%1$s" class="%2$s" data-responsive-menu="accordion medium-dropdown">%3$s</ul>',
											'theme_location' 	=> 'main-nav',        					// Where it's located in the theme
											'depth' 			=> 5,                                   // Limit the depth of the nav
											'fallback_cb' 		=> false,                         		// Fallback function (see below)
											'walker' 			=> new Videoplace_Topbar_Menu_Walker()
									) ); ?>
								</div>
								<div class="large-1 medium-1 columns right">
									<button class="social-dropdown" data-toggle="example-dropdown"><span class="dashicons dashicons-plus"></span></button>
									<div class="dropdown-pane" id="example-dropdown" data-dropdown data-auto-focus="true">
										<?php echo videoplace_social_links(); ?>
									</div>
								</div>
							</div>
						</div>
		 	
					</header> <!-- end .header -->