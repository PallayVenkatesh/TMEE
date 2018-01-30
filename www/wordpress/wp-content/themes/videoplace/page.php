<?php
/**
 * Page.php
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
				
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class( 'page-post' ); ?> role="article" itemscope itemtype="http://schema.org/WebPage">

						<?php if ( hybrid_media_grabber() ) { ?>
							<header class="article-header">
								<?php echo hybrid_media_grabber(); ?>
                                <?php if ( has_post_thumbnail() ) { ?>
                                    <div class="videoplace-featured-image">
                                        <?php the_post_thumbnail('videoplace-featured-image'); ?>
                                    </div>
                                <?php } ?>
							</header> <!-- end article header -->
						<?php } ?>

						<section class="entry-content" itemprop="articleBody">
							<h1 class="page-title"><?php the_title(); ?></h1>
							<?php the_content(); ?>
							<?php wp_link_pages(); ?>
						</section> <!-- end article section -->

						<?php comments_template(); ?>

					</article> <!-- end article -->
			    
			    <?php endwhile; endif; ?>							
			    					
			</main> <!-- end #main -->

		    <?php get_sidebar(); ?>
		    
		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>