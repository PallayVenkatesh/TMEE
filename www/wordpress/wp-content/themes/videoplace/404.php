<?php
/**
 * 404.php
 *
 * @package VideoPlace
 * @author  Jacob Martella
 * @version  1.3
 */
?>
<?php get_header(); ?>
			
	<div id="content">

		<div id="inner-content" class="row">
	
			<main id="main" class="large-8 medium-12 small-12 columns" role="main">

				<article id="content-not-found">
				
					<header class="article-header">
						<h1><?php _e( '404', 'videoplace' ); ?></h1>
					</header> <!-- end article header -->
			
					<section class="entry-content">
						<h3><?php _e( 'Whoops! Content not found!', 'videoplace' ); ?></h3>
						<p><?php _e( 'We\'re terribly sorry, but we couldn\'t find what you were looking for. It might have been removed. We suggesting going to the home page or using the search form to look through our content. In the meantime, here\'s one of our amazing videos!', 'videoplace' ); ?></p>
					</section> <!-- end article section -->

					<section class="search">
					    <p><?php get_search_form(); ?></p>
					</section> <!-- end search section -->
			
				</article> <!-- end article -->
	
			</main> <!-- end #main -->

			<?php get_sidebar(); ?>

		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>