<?php
/**
 * functions.php
 *
 * @package VideoPlace
 * @author Jacob Martella
 * @version 1.3
 */
/**
 * Table of Contents
 * I. General Functions
 * II. Header Functions
 * III. Home Functions
 * IV. Footer Functions
 * V. Single Post Functions
 * VI. Archive Functions
 * VII. Author Functions
 * VIII. Comments Functions
 * IX. Other Functions
 */
/**
 ******************** I. General Functions *********************************
 */
/**
 * Enqueue the necessary scripts
 */
function videoplace_scripts() {
	
	//* Load What-Input files in footer
	wp_enqueue_script( 'what-input', get_template_directory_uri() . '/vendor/what-input/what-input.min.js', array(), '', true );

	//* Adding Foundation scripts file in the footer
	wp_enqueue_script( 'foundation-js', get_template_directory_uri() . '/assets/js/foundation.min.js', array( 'jquery' ), '6.0', true );

	//* Adding scripts file in the footer
	wp_enqueue_script( 'videoplace-js', get_template_directory_uri() . '/assets/js/scripts.js', array( 'jquery' ), '', true );

	//* Enqueue the Roboto, Roboto Slab and Playfiar Display fonts
	wp_enqueue_style( 'roboto', '//fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,700', array(), '', 'all' );
	wp_enqueue_style( 'roboto-slab', '//fonts.googleapis.com/css?family=Roboto+Slab:400,300,700', array(), '', 'all' );
	wp_enqueue_style( 'playfair-display', '//fonts.googleapis.com/css?family=Playfair+Display:400,400italic,700', array(), '', 'all' );

	//* Enqueue the dashicons
	wp_enqueue_style( 'dashicons' );

	//* Register main stylesheet
	wp_enqueue_style( 'videoplace-css', get_template_directory_uri() . '/style.css', array('dashicons'), '', 'all' );
	if ( get_theme_mod( 'videoplace-color-scheme' ) == 'light' ) {
		wp_enqueue_style( 'videoplace-light', get_template_directory_uri() . '/assets/css/light.css', array('dashicons'), '', 'all' );
	}

	//* Comment reply script for threaded comments
	if ( is_singular() AND comments_open() AND (get_option( 'thread_comments' ) == 1)) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'videoplace_scripts', 999 );
/**
 * Add in theme supports
 */
function videoplace_theme_support() {

	//* Add WP Thumbnail Support
	add_theme_support( 'post-thumbnails' );

	//* Default thumbnail size
	set_post_thumbnail_size( 125, 125, true );

	//* Add Image Sizes
    add_image_size( 'videoplace-featured-image', 800, 440, true );

	//* Add RSS Support
	add_theme_support( 'automatic-feed-links' );

	//* Add Support for WP Controlled Title Tag
	add_theme_support( 'title-tag' );

	//* Add HTML5 Support
	add_theme_support( 'html5',
		array(
			'comment-list',
			'comment-form',
			'search-form',
		)
	);

	//* Add the Editor Stylesheet
	add_editor_style( 'assets/css/editor-styles.css' );

	//* Add support for custom background
	$args = array(
			'default-color' => '252525',
	);
	add_theme_support( 'custom-background', $args );

	//* Add Support for Custom Header
	$args = array(
			'flex-width' 			=> true,
			'width'					=> 1000,
			'flex-height'			=> true,
			'height'				=> 250,
			'default-image' 		=> '',
			'default-text-color' 	=> '777777',
			'upload'				=> true,
	);
	add_theme_support( 'custom-header', $args );

	//* Add Support for Translation
	load_theme_textdomain( 'videoplace', get_template_directory() .'/assets/translations' );

	//* Set content width
	if ( ! isset( $content_width ) ) $content_width = 785;

	/**
	 * Register Menus
	 */
	register_nav_menus(
		array(
			'main-nav' => __( 'Main Menu', 'videoplace' ),   // Main nav in header
		)
	);

	//* Add support for the custom logo
	add_theme_support( 'custom-logo', array(
		'height'      	=> 300,
		'width'       	=> 300,
		'flex-width' 	=> true,
	) );

    add_theme_support(
        'post-formats', array(
            'image',
            'video'
        )
    );

}
add_action('after_setup_theme','videoplace_theme_support', 16);
/**
 * Include theme options
 */
require('assets/functions/theme-options.php');
/**
 * Include custom functions
 */
require('assets/functions/menu-walkers.php');
/**
 * Include custom classes
 */
require('assets/functions/class-media-grabber.php');
/**
 * Register Sidebar
 */
function videoplace_register_sidebars() {
	register_sidebar(array(
			'id' 			=> 'sidebar1',
			'name' 			=> __( 'Sidebar', 'videoplace' ),
			'description' 	=> __( 'The primary sidebar.', 'videoplace' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<h4 class="widgettitle">',
			'after_title' 	=> '</h4>',
	));
	register_sidebar(array(
			'id' 			=> 'footer-center',
			'name' 			=> __( 'Footer Center', 'videoplace' ),
			'description' 	=> __( 'The footer center widget area.', 'videoplace' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<h4 class="widgettitle">',
			'after_title' 	=> '</h4>',
	));
	register_sidebar(array(
			'id' 			=> 'footer-right',
			'name' 			=> __( 'Footer Right', 'videoplace' ),
			'description' 	=> __( 'The footer right widget area.', 'videoplace' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<h4 class="widgettitle">',
			'after_title' 	=> '</h4>',
	));
}
add_action( 'widgets_init', 'videoplace_register_sidebars' );
/**
 ******************** II. Header Functions *********************************
 */
/**
 * Returns the HTML to social media links and images.
 *
 * @return string, HTML of social media images and links
 */
function videoplace_social_links() {
	$html = '<div class="social-links">';
	if ( esc_attr( get_theme_mod( 'videoplace-facebook' ) ) ) { $html .= '<div class="social-link facebook"><a href="' . esc_url( get_theme_mod( 'videoplace-facebook' ) ) . '" target="_blank"><img src="' . get_template_directory_uri() . '/assets/images/facebook.png" /></a></div>'; }
	if ( esc_attr( get_theme_mod( 'videoplace-twitter' ) ) ) { $html .= '<div class="social-link twitter"><a href="' . esc_url( get_theme_mod( 'videoplace-twitter' ) ) . '" target="_blank"><img src="' . get_template_directory_uri() . '/assets/images/twitter.png" /></a></div>'; }
	if ( esc_attr( get_theme_mod( 'videoplace-google-plus' ) ) ) { $html .= '<div class="social-link google-plus"><a href="' . esc_url( get_theme_mod( 'videoplace-google-plus' ) ) . '" target="_blank"><img src="' . get_template_directory_uri() . '/assets/images/googleplus.png" /></a></div>'; }
	if ( esc_attr( get_theme_mod( 'videoplace-youtube' ) ) ) { $html .= '<div class="social-link youtube"><a href="' . esc_url( get_theme_mod( 'videoplace-youtube' ) ) . '" target="_blank"><img src="' . get_template_directory_uri() . '/assets/images/youtube.png" /></a></div>'; }
	if ( esc_attr( get_theme_mod( 'videoplace-tumblr' ) ) ) { $html .= '<div class="social-link tumblr"><a href="' . esc_url( get_theme_mod( 'videoplace-tumblr' ) ) . '" target="_blank"><img src="' . get_template_directory_uri() . '/assets/images/tumblr.png" /></a></div>'; }
	if ( esc_attr( get_theme_mod( 'videoplace-instagram' ) ) ) { $html .= '<div class="social-link instagram"><a href="' . esc_url( get_theme_mod( 'videoplace-instagram' ) ) . '" target="_blank"><img src="' . get_template_directory_uri() . '/assets/images/instagram.png" /></a></div>'; }
	if ( esc_attr( get_theme_mod( 'videoplace-rss-feed' ) ) ) { $html .= '<div class="social-link rss"><a href="' . esc_url( get_theme_mod( 'videoplace-rss-feed' ) ) . '" target="_blank"><img src="' . get_template_directory_uri() . '/assets/images/rss.png" /></a></div>'; } else { $html .= '<div class="social-link rss"><a href="' . get_feed_link('rss') . '" target="_blank"><img src="' . get_template_directory_uri() . '/assets/images/rss.png" /></a></div>'; }
	$html .= '</div>';
	return $html;
}
/**
 ******************** III. Home Functions *********************************
 */
/**
 ******************** IV. Footer Functions *********************************
 */
/**
 ******************** V. Single Post Functions *********************************
 */
/**
 * Returns the section to show related posts in the single post template
 *
 * @since 1.0
 */
function videoplace_related_posts() {
	global $post;
	$tags = wp_get_post_tags( $post->ID );
	if( $tags ) {
		foreach( $tags as $tag ) {
			$tag_arr = $tag->slug . ',';
		}
		$args = array(
				'tag' 			=> $tag_arr,
				'numberposts' 	=> 3, /* you can change this to show more */
				'post__not_in'	 => array( $post->ID )
		);
		$related_posts = get_posts( $args );
		if( $related_posts ) {
			echo'<section class="related-posts">';
			echo '<h4>Related Videos</h4>';
			foreach ( $related_posts as $post ) : setup_postdata( $post ); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'video-post' ); ?>>
						<h5 class="post-category"><?php $cats = get_the_category(); echo $cats[ 0 ]->name; ?></h5>
                        <div class="photo-video">
                            <?php if ( has_post_format( 'image' ) ) { ?>
                                <?php if ( has_post_thumbnail() ) {
                                    the_post_thumbnail('videoplace-featured-image');
                                } else {
                                    $media = get_attached_media( 'image' );
                                    foreach ( $media as $image ) {
                                        echo '<img width="800" height="440" src="' . esc_url( $image->guid ) . '" />';
                                        break;
                                    }
                                } ?>
                            <?php } elseif ( has_post_format( 'video' ) ) { ?>
                                <?php echo hybrid_media_grabber( array( 'split_media' => true ) ); ?>
                            <?php } else { ?>
                                <?php echo hybrid_media_grabber( array( 'split_media' => true ) ); ?>
                            <?php } ?>
                        </div>
						<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<div class="post-details clearfix">
							<?php echo get_avatar( get_the_author_meta( 'ID' ), 50 ); ?>
							<h4 class="post-detail"><?php echo __( 'Posted by ', 'videoplace' ) . get_the_author_link() . __( ' on ', 'videoplace' ) . get_the_date( get_option( 'date_format' ) ); ?></h4>
						</div>
						<a href="<?php the_permalink(); ?>" class="button white"><?php _e( 'View More Info', 'videoplace' ); ?></a>
					</article>
			<?php endforeach; }
	}
	wp_reset_postdata();
	echo '</section>';
}
/**
 ******************** VI. Archive Functions *********************************
 */
/**
 * Numeric Archive Page Navigation
 *
 * @param string $before
 *
 * @param string $after
 *
 * @since 1.0
 */
function videoplace_page_navi( $before = '', $after = '' ) {
	global $wpdb, $wp_query;
	$request = $wp_query->request;
	$posts_per_page = intval( get_query_var( 'posts_per_page' ) );
	$paged = intval( get_query_var( 'paged' ) );
	$numposts = $wp_query->found_posts;
	$max_page = $wp_query->max_num_pages;
	if ( $numposts <= $posts_per_page ) { return; }
	if( empty( $paged ) || $paged == 0 ) {
		$paged = 1;
	}
	$pages_to_show = 7;
	$pages_to_show_minus_1 = $pages_to_show-1;
	$half_page_start = floor( $pages_to_show_minus_1 / 2 );
	$half_page_end = ceil( $pages_to_show_minus_1 / 2 );
	$start_page = $paged - $half_page_start;
	if( $start_page <= 0 ) {
		$start_page = 1;
	}
	$end_page = $paged + $half_page_end;
	if( ( $end_page - $start_page ) != $pages_to_show_minus_1 ) {
		$end_page = $start_page + $pages_to_show_minus_1;
	}
	if( $end_page > $max_page ) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = $max_page;
	}
	if( $start_page <= 0 ) {
		$start_page = 1;
	}
	echo $before . '<nav class="page-navigation"><ul class="pagination">' . "";
	if ( $start_page >= 2 && $pages_to_show < $max_page ) {
		$first_page_text = __( 'First', 'videoplace' );
		echo '<li><a href="' . get_pagenum_link() . '" title="' . $first_page_text . '">' . $first_page_text . '</a></li>';
	}
	if ( get_previous_posts_link() ) {
		echo '<li>';
		previous_posts_link( __( '&laquo;&laquo; Previous', 'videoplace' ), $max_page );
		echo '</li>';
	}
	for( $i = $start_page; $i  <= $end_page; $i++ ) {
		if( $i == $paged ) {
			echo '<li class="current"> ' . $i . ' </li>';
		} else {
			echo '<li><a href="' . get_pagenum_link( $i ) . '">' . $i . '</a></li>';
		}
	}
	if ( get_next_posts_link() ) {
		echo '<li>';
		next_posts_link( __( 'Next &#187;&#187;', 'videoplace' ), $max_page );
		echo '</li>';
	}
	if ( $end_page < $max_page ) {
		$last_page_text = __( 'Last', 'videoplace' );
		echo '<li><a href="' . get_pagenum_link( $max_page ) . '" title="' . $last_page_text . '">' . $last_page_text . '</a></li>';
	}
	echo '</ul></nav>' . $after . "";
}

/**
 * Change the read more text
 */
function videoplace_new_excerpt_more( $more ) {
	return '';
}
add_filter( 'excerpt_more', 'videoplace_new_excerpt_more' );
/**
 * Changes the archive page title text
 *
 * @return string, the title for the page
 *
 * @since 1.0
 */
function videoplace_archive_title( $title ) {
	if ( is_day() ) {
		$title = get_the_time( 'F j, Y' );
	}
	else if (is_month()) {
		$title = get_the_time( 'F Y' );
	}
	else if (is_year()) {
		$title = get_the_time( 'Y' );
	}
	else if ( is_category() ) {
		$title = single_cat_title( '', false );
	}
	else if ( is_search() ) {
		$title = __( 'Search results for ', 'videoplace' ) . get_search_query();
	}
	else if (is_tag()) {
		$title = single_tag_title( '', false );
	}
	else if (is_author()) {
		$title = __( 'Videos Posted By: ', 'videoplace' ) . get_the_author();
	}
	else {
		$page = get_query_var( 'paged' );
		$title = __( 'Page ', 'videoplace' ) . $page;
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'videoplace_archive_title' );
/**
 ******************** VII. Author Functions *********************************
 */
/**
 ******************** VIII. Comments Functions *********************************
 */
function videoplace_comments( $comment, $args, $depth ) {
	$GLOBALS[ 'comment' ] = $comment; ?>
<li <?php comment_class( 'panel' ); ?>>
	<div class="media-object">
		<div class="media-object-section">
			<?php echo get_avatar( $comment, 75 ); ?>
		</div>
		<div class="media-object-section">
			<article id="comment-<?php comment_ID(); ?>" class="clearfix large-12 columns">
				<header class="comment-author">
					<?php
					// create variable
					$bgauthemail = get_comment_author_email();
					?>
					<h3><?php printf( __('%s', 'videoplace'), get_comment_author_link() ) ?></h3>
					<h5><time datetime="<?php echo comment_time( 'Y-m-j' ); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time( __( ' F jS, Y - g:ia', 'videoplace' ) ); ?> </a></time> <?php edit_comment_link( __( '(Edit)', 'videoplace' ),'  ','' ) ?></h5>
				</header>
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<div class="alert alert-info">
						<p><?php _e( 'Your comment is awaiting moderation.', 'videoplace' ) ?></p>
					</div>
				<?php endif; ?>
				<section class="comment_content clearfix">
					<?php comment_text() ?>
				</section>
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args[ 'max_depth' ] ) ) ) ?>
			</article>
		</div>
	</div>
	<!-- </li> is added by WordPress automatically -->
	<?php
}
/**
 ******************** IX. Other Functions *********************************
 */