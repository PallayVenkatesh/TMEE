<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package echo-magazine
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if (!is_single()) { ?>
        <?php $archive_layout = echo_magazine_get_option('archive_layout'); ?>
        <?php $archive_layout_image = echo_magazine_get_option('archive_layout_image'); ?>
        <?php if ('full' == $archive_layout_image) {
            $full_width_content = 'archive-image-full clearfix';
        } else {
            $full_width_content = 'twp-archive-lr clearfix';
        }
        ?>
        <div class="<?php echo esc_attr($full_width_content); ?>">
        <?php $archive_layout_image = echo_magazine_get_option('archive_layout_image'); ?>
            <?php if (has_post_thumbnail()) :
                if ('left' == $archive_layout_image) {
                    echo "<div class='twp-image-archive image-left'>";
                    the_post_thumbnail('medium');
                } elseif ('right' == $archive_layout_image) {
                    echo "<div class='twp-image-archive image-right'>";
                    the_post_thumbnail('medium');
                } elseif ('full' == $archive_layout_image) {
                    echo "<div class='twp-image-archive image-full'>";
                    the_post_thumbnail('full');
                } else {
                    echo "<div>";
                }
                echo "</div>";/*div end*/

            endif; ?>
        <div class="entry-content twp-entry-content <?php echo esc_attr( $twp_no_image ) ?>">
            <?php $archive_layout = echo_magazine_get_option('archive_layout'); ?>

            <div class="twp-meta-categories">
                <?php echo_magazine_entry_category(); ?>
            </div>
            <h2 class="entry-title archive-entry-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>

            <?php if ('full' == $archive_layout) : ?>
                <?php
                    $read_more_text = esc_html(echo_magazine_get_option('read_more_button_text'));
                    the_content(sprintf(
                    /* translators: %s: Name of current post. */
                        wp_kses($read_more_text, __('%s <i class="ion-ios-arrow-right read-more-right"></i>', 'echo-magazine'), array('span' => array('class' => array()))),
                        the_title('<span class="screen-reader-text">"', '"</span>', false)
                    )); ?>
                    <?php wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'echo-magazine'),
                        'after' => '</div>',
                    )); ?>
            <?php else : ?>
                <div>
                    <?php the_excerpt(); ?>
                </div>
            <?php endif ?>

            <div class="twp-meta-info">
                <?php echo_magazine_posted_on(); ?>
            </div>
        </div><!-- .entry-content -->
        <?php } else { ?>

        <div class="entry-content">
            <?php
            $image_values = get_post_meta($post->ID, 'echo-magazine-meta-image-layout', true);
            if (empty($image_values)) {
                $values = esc_attr(echo_magazine_get_option('single_post_image_layout'));
            } else {
                $values = esc_attr($image_values);
            }
            if (has_post_thumbnail()) {
                if ('no-image' != $values) {
                    if ('left' == $values) {
                        echo "<div class='image-left twp-featured-image'>";
                        the_post_thumbnail('medium');
                    } elseif ('right' == $values) {
                        echo "<div class='image-right twp-featured-image'>";
                        the_post_thumbnail('medium');
                    } else {
                        echo "<div class='image-full twp-featured-image'>";
                        the_post_thumbnail('full');
                    }
                    echo "</div>";/*div end */
                }
            }
            ?>
            <?php the_content(); ?>
            <?php
            wp_link_pages(array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'echo-magazine'),
                'after' => '</div>',
            ));
            ?>
        </div><!-- .entry-content -->

        <footer class="entry-footer">
            <?php echo_magazine_entry_footer(); ?>
        </footer><!-- .entry-footer -->
    <?php } ?>

</article><!-- #post-## -->
