<?php
if (!function_exists('echo_magazine_featured_news')) :
    /**
     * Banner Slider
     *
     * @since echo-magazine 1.0.0
     *
     */
    function echo_magazine_featured_news()
    {
        if (1 != echo_magazine_get_option('show_featured_news_section')) {
            return null;
        }
        $echo_magazine_featured_news_category = esc_attr(echo_magazine_get_option('select_category_for_featured_news'));
        $echo_magazine_featured_news_title = esc_html(echo_magazine_get_option('featured_news_title'));
        $echo_magazine_featured_news_number = 4;
        ?>
        <section class="section-block featured-block secondary-bgcolor">
            <div class="container">
                <div class="row">
                    <?php if (!empty($echo_magazine_featured_news_title)) { ?>
                        <div class="col-sm-12">
                            <h2 class="section-title">
                                <span class="primary-font primary-bgcolor">
                                    <?php echo esc_html($echo_magazine_featured_news_title); ?>
                                </span>
                            </h2>
                        </div>
                    <?php } ?>
                    <?php
                    $echo_magazine_featured_news_args = array(
                        'post_type' => 'post',
                        'cat' => absint($echo_magazine_featured_news_category),
                        'ignore_sticky_posts' => true,
                        'posts_per_page' => absint($echo_magazine_featured_news_number),
                    ); ?>
                    <?php $echo_magazine_featured_news_post_query = new WP_Query($echo_magazine_featured_news_args);
                    if ($echo_magazine_featured_news_post_query->have_posts()) :
                        while ($echo_magazine_featured_news_post_query->have_posts()) : $echo_magazine_featured_news_post_query->the_post();
                            if (has_post_thumbnail()) {
                                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'echo-magazine-900-600');
                                $url = $thumb['0'];
                            } else {
                                $url = get_template_directory_uri() . '/images/no-image-900x600.jpg';
                            }
                            ?>
                            <div class="col-xxs-12 col-xs-6 col-sm-6 col-md-3">
                                <div class="column-post">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"
                                       class="bg-image bg-image-1">
                                        <img src="<?php echo esc_url($url); ?>">
                                    </a>
                                    <div class="article-detail">
                                        <h3 class="small-title">
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>
                                        <div class="post-meta">
                                            <span class="posted-on">
                                                    <?php echo get_the_date('F j, Y'); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </section>

        <!-- end slider-section -->
        <?php
    }
endif;
add_action('echo_magazine_action_front_page', 'echo_magazine_featured_news', 50);
