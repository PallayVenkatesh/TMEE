<?php
if (!function_exists('echo_magazine_banner_slider')) :
    /**
     * Banner Slider
     *
     * @since echo-magazine 1.0.0
     *
     */
    function echo_magazine_banner_slider()
    {
        if (1 != echo_magazine_get_option('show_slider_section')) {
            return null;
        }
        $echo_magazine_slider_category = esc_attr(echo_magazine_get_option('select_category_for_slider'));
        $echo_magazine_slider_number = 3;
        ?>
        <!-- slider News -->
        <section class="main-banner">
            <?php
            $echo_magazine_banner_slider_args = array(
                'post_type' => 'post',
                'cat' => esc_attr($echo_magazine_slider_category),
                'ignore_sticky_posts' => true,
                'posts_per_page' => absint( $echo_magazine_slider_number ),
            ); ?>
            <?php 
            $echo_magazine_slider_layout = '';
            if (echo_magazine_get_option('slider_layout_option') == 'full-width') {
                $echo_magazine_slider_layout = 'mainbanner-jumbotron-fullwidth';
            } elseif (echo_magazine_get_option('slider_layout_option') == 'boxed') {
                $echo_magazine_slider_layout = '';
            }
            ?>
            <!-- Slide -->
            <div class="mainbanner-jumbotron <?php echo esc_attr($echo_magazine_slider_layout);?>">
                <?php
                $echo_magazine_banner_slider_post_query = new WP_Query($echo_magazine_banner_slider_args);
                if ($echo_magazine_banner_slider_post_query->have_posts()) :
                    while ($echo_magazine_banner_slider_post_query->have_posts()) : $echo_magazine_banner_slider_post_query->the_post();
                        if(has_post_thumbnail()){
                            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
                            $url = $thumb['0'];
                        }
                        else{
                            $url = '';
                        }
                        global $post;
                        $author_id = $post->post_author;
                        ?>
                            <figure class="slick-item">
                                <div class="data-bg data-bg-slide" data-background="<?php echo esc_url($url); ?>">
                                    <figcaption class="slider-figcaption">
                                        <div class="slider-figcaption-wrapper">
                                            <div class="title-wrap">
                                                <div class="item-metadata twp-meta-categories posts-date">
                                                    <?php echo_magazine_entry_category(); ?>
                                                </div>
                                                <h2 class="slide-title">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php the_title(); ?>
                                                    </a>
                                                </h2>
                                                <div class="post-meta">
                                                    <span>
                                                        <?php echo esc_html__('Posted On: ', 'echo-magazine'); ?><?php the_time('F j, Y'); ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </figcaption>
                                </div>
                            </figure>
                        <?php
                        endwhile;
                endif;
                wp_reset_postdata();
                ?>
            </div>
        </section>
        <!-- end slider-section -->
        <?php
    }
endif;
add_action('echo_magazine_action_front_page', 'echo_magazine_banner_slider', 40);
