<?php
/**
 * Footer.php
 *
 * @package VideoPlace
 * @author  Jacob Martella
 * @version  1.3
 */
?>
					<footer class="footer" role="contentinfo">
						<div id="inner-footer" class="row">
							<div class="footer-info footer-column large-4 medium-4 small-12 columns">
								<?php if ( function_exists( 'the_custom_logo' ) ) {
									the_custom_logo();
								} ?>
								<h3 class="footer-text">&copy; <?php echo date( 'Y' ); ?> <?php echo get_bloginfo( 'name' ); ?><br />
								<?php _e( 'VideoPlace Theme', 'videoplace' ); ?><br />
								<?php wp_loginout(); ?></h3>
							</div>
							<div class="footer-column large-4 medium-4 small-12 columns">
								<?php if ( is_active_sidebar( 'footer-center' ) ) : ?>

									<?php dynamic_sidebar( 'footer-center' ); ?>

								<?php endif; ?>
							</div>
							<div class="footer-column large-4 medium-4 small-12 columns">
								<?php if ( is_active_sidebar( 'footer-right' ) ) : ?>

									<?php dynamic_sidebar( 'footer-right' ); ?>

								<?php endif; ?>
							</div>
						</div> <!-- end #inner-footer -->
					</footer> <!-- end .footer -->
				</div>  <!-- end .main-content -->
			</div> <!-- end .off-canvas-wrapper-inner -->
		</div> <!-- end .off-canvas-wrapper -->
		<?php wp_footer(); ?>
	</body>
</html> <!-- end page -->