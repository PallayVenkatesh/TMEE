<?php
/**
 * Sidebar.php
 *
 * @package VideoPlace
 * @author  Jacob Martella
 * @version  1.3
 */
?>
<div id="sidebar1" class="sidebar large-4 medium-12 small-12 columns" role="complementary">

	<?php
	if (is_author()) { ?>
		<aside id="author-bio1" class="widget author-bio">
			<?php the_post(); ?>
			<div class="mugshot"><?php echo get_avatar(get_the_author_meta( 'ID' ), $size = 100); ?></div>
			<h4 class="author-name"><?php echo __( 'About ', 'videoplace' ) . get_the_author_meta( 'display_name' ); ?></h4>
			<p class="bio"><?php echo get_the_author_meta( 'description' ); ?></p>
			<a href="mailto:<?php echo get_the_author_meta( 'email' ); ?>" target="_blank" class="button white"><?php _e( 'Message Me', 'videoplace' ) ?></a>
			<?php rewind_posts(); ?>
		</aside>
	<?php }
	?>

	<?php if ( is_active_sidebar( 'sidebar1' ) ) : ?>

		<?php dynamic_sidebar( 'sidebar1' ); ?>

	<?php endif; ?>

</div>