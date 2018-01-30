<?php
global $post;
if (!function_exists('echo_magazine_single_page_title')) :
    function echo_magazine_single_page_title()
    {
        global $post;
        $global_banner_image = get_header_image();
        $echo_magazine_banner_title = echo_magazine_get_option('banner_title_post');
        // Check if single.
        ?>
        <?php if (is_singular()) { ?>
        <div class="inner-banner-1 secondary-bgcolor">
            <header class="entry-header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="twp-bredcrumb">
                                <?php
                                /**
                                 * Hook - echo_magazine_add_breadcrumb.
                                 */
                                do_action('echo_magazine_action_breadcrumb');
                                ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                            <?php if (!is_page()) { ?>
                                <header class="entry-header">
                                    <div class="entry-meta entry-inner">
                                        <?php
                                        echo_magazine_posted_on(); ?>
                                    </div>
                                </header>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </header>
        </div>
    <?php } else { ?>
        <div class="wrapper page-inner-title inner-banner-2 twp-inner-banner data-bg" data-background="<?php echo esc_url($global_banner_image); ?>">
            <header class="entry-header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <?php if (is_404()) { ?>
                                <h1 class="entry-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'echo-magazine'); ?></h1>
                            <?php } elseif (is_archive()) {
                                the_archive_title('<h1 class="entry-title">', '</h1>');
                                the_archive_description('<div class="taxonomy-description">', '</div>');
                            } elseif (is_search()) { ?>
                                <h1 class="entry-title"><?php printf(esc_html__('Search Results for: %s', 'echo-magazine'), '<span>' . get_search_query() . '</span>'); ?></h1>
                            <?php } else { ?>
                                <h1 class="entry-title"><?php echo esc_html($echo_magazine_banner_title); ?></h1>
                            <?php }
                            ?>
                        </div>
                        <div class="col-md-12">
                            <div class="twp-bredcrumb">
                                <?php
                                /**
                                 * Hook - echo_magazine_add_breadcrumb.
                                 */
                                do_action('echo_magazine_action_breadcrumb');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <div class="inner-header-overlay"></div>
        </div>
    <?php } ?>

        <?php
    }
endif;
add_action('echo-magazine-page-inner-title', 'echo_magazine_single_page_title', 15);
