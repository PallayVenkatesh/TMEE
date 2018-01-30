<?php
/**
 * Theme widgets.
 *
 * @package Echo Magazine
 */
// Load widget base.
require_once get_template_directory() . '/inc/widgets/widget-base-class.php';
if (!function_exists('echo_magazine_load_widgets')) :
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function echo_magazine_load_widgets()
    {
// Echo_Magazine_Grid_Panel widget.
        register_widget('Echo_Magazine_widget_style_1');
// list panel widget.
        register_widget('Echo_Magazine_widget_style_2');
// Recent Post widget.
        register_widget('Echo_Magazine_sidebar_widget');
// Tabbed widget.
        register_widget('Echo_Magazine_Tabbed_Widget');
        register_widget('Echo_Magazine_widget_social');
        register_widget('Echo_Magazine_widget_slider');
    }
endif;
add_action('widgets_init', 'echo_magazine_load_widgets');
/*Grid Panel widget*/
if (!class_exists('Echo_Magazine_widget_style_1')) :
    /**
     * Latest news widget Class.
     *
     * @since 1.0.0
     */
    class Echo_Magazine_widget_style_1 extends Echo_Magazine_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'echo_magazine_grid_panel_widget',
                'description' => __('Displays posts from selected category.', 'echo-magazine'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'echo-magazine'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category' => array(
                    'label' => __('Select Category:', 'echo-magazine'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'echo-magazine'),
                ),
                'excerpt_length' => array(
                    'label' => __('Excerpt Length:', 'echo-magazine'),
                    'description' => __('Number of words', 'echo-magazine'),
                    'type' => 'number',
                    'css' => 'max-width:60px;',
                    'default' => 20,
                    'min' => 0,
                    'max' => 200,
                ),
                'post_number' => array(
                    'label' => __('Number of Posts:', 'echo-magazine'),
                    'type' => 'number',
                    'default' => 5,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 5,
                ),
                'view_detail' => array(
                    'label' => __('View Detail Text:', 'echo-magazine'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
            );
            parent::__construct('echo-magazine-grid-layout', __('EM: Single Category Widget', 'echo-magazine'), $opts, array(), $fields);
        }
        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {
            $params = $this->get_params($instance);
            echo $args['before_widget'];
            $qargs = array(
                'posts_per_page' => absint($params['post_number']),
                'no_found_rows' => true,
            );
            if (absint($params['post_category']) > 0) {
                $qargs['category'] = absint($params['post_category']);
            }
            $all_posts = get_posts($qargs);
            ?>
            <?php if (!empty($all_posts)) : ?>
            <?php global $post;
            $author_id = $post->post_author;
            $i = 1;
            ?>
            <div class="home_category_news clearfix">
                <div class="border-top"></div>
                <?php if (!empty($params['title'])) {
                    echo $args['before_title'] . $params['title'] . $args['after_title'];
                } ?>
                <div class="widget-row clearfix">
                    <?php foreach ($all_posts as $key => $post) : ?>
                        <?php setup_postdata($post); ?>
                        <?php if ($i == 1) {
                            $feature_post = 'first-post';
                        } else {
                            $feature_post = 'all-post';
                        } ?>
                        <div class="widget-half-column <?php echo esc_attr($feature_post); ?>">
                            <div class="post-image">
                                <a class="twp-image-wrapper" href="<?php the_permalink(); ?>">
                                    <?php if (has_post_thumbnail()) {
                                        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                                        $url = $thumb['0'];
                                    } else {
                                        $url = get_template_directory_uri() . '/images/no-image-900x600.jpg';
                                    }
                                    ?>
                                    <img src="<?php echo esc_url($url); ?>" alt="<?php the_title_attribute(); ?>">
                                </a></div>
                            <div class="post-content">
                                <h3 class="small-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?>
                                    </a>
                                </h3>
                                <div class="post-meta">
                        <span>
                            <?php echo esc_html__('Posted On: ', 'echo-magazine'); ?><?php the_time('F j, Y'); ?>
                        </span>
                                </div>
                            </div>
                            <div class="post-description">
                                <?php if (absint($params['excerpt_length']) > 0) : ?>
                                    <?php
                                    $excerpt = echo_magazine_words_count(absint($params['excerpt_length']), get_the_content());
                                    echo wp_kses_post(wpautop($excerpt));
                                    ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php $i++; endforeach; ?>
                </div>
                <?php $post_cat_id = absint($params['post_category']); ?>
                <?php if (!empty($params['view_detail'])) { ?>
                    <div class="view-all"><a
                                href="<?php echo esc_url(get_category_link($post_cat_id)); ?>"><?php echo esc_html($params['view_detail']) ?></a>
                    </div>
                <?php } ?>   </div>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>
            <?php echo $args['after_widget'];
        }
    }
endif;
/*Grid Panel widget*/
if (!class_exists('Echo_Magazine_widget_style_2')) :
    /**
     * Latest news widget Class.
     *
     * @since 1.0.0
     */
    class Echo_Magazine_widget_style_2 extends Echo_Magazine_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'echo_magazine_list_panel_widget',
                'description' => __('Displays post form selected category on List Format.', 'echo-magazine'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title_1' => array(
                    'label' => __('Title For Category 1:', 'echo-magazine'),
                    'default' => __('Title 1', 'echo-magazine'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category_1' => array(
                    'label' => __('Select Category 1:', 'echo-magazine'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'echo-magazine'),
                ),
                'title_2' => array(
                    'label' => __('Title For Category 2:', 'echo-magazine'),
                    'default' => __('Title 2', 'echo-magazine'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category_2' => array(
                    'label' => __('Select Category 2:', 'echo-magazine'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'echo-magazine'),
                ),
                'post_number' => array(
                    'label' => __('Number of Posts:', 'echo-magazine'),
                    'type' => 'number',
                    'default' => 4,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 4,
                ),
                'excerpt_length' => array(
                    'label' => __('Excerpt Length:', 'echo-magazine'),
                    'description' => __('Number of words', 'echo-magazine'),
                    'type' => 'number',
                    'css' => 'max-width:60px;',
                    'default' => 20,
                    'min' => 0,
                    'max' => 200,
                ),
                'view_detail' => array(
                    'label' => __('View Detail Text:', 'echo-magazine'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
            );
            parent::__construct('echo-magazine-list-layout', __('EM: Double Category Widget', 'echo-magazine'), $opts, array(), $fields);
        }
        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {
            $params = $this->get_params($instance);
            echo $args['before_widget'];
            $q_1_args = array(
                'posts_per_page' => absint($params['post_number']),
                'no_found_rows' => true,
            );
            if (absint($params['post_category_1']) > 0) {
                $q_1_args['category'] = absint($params['post_category_1']);
            }
            $all_posts_1 = get_posts($q_1_args);
// query for 2nd cat
            $q_2_args = array(
                'posts_per_page' => absint($params['post_number']),
                'no_found_rows' => true,
            );
            if (absint($params['post_category_2']) > 0) {
                $q_2_args['category'] = absint($params['post_category_2']);
            }
            $all_posts_2 = get_posts($q_2_args);
            ?>
            <div class="widget-row clearfix">
                <?php if (!empty($all_posts_1)) : ?>
                    <?php global $post;
                    $author_id = $post->post_author;
                    $i = 1;
                    ?>
                    <div class="widget-half-column clearfix">
                        <div class="border-top"></div>
                        <?php if (!empty($params['title_1'])) {
                            echo $args['before_title'] . $params['title_1'] . $args['after_title'];
                        } ?>
                        <div class="widget-list clearfix">
                            <?php foreach ($all_posts_1 as $key => $post) : ?>
                                <?php setup_postdata($post); ?>
                                <?php if ($i == 1) {
                                    $feature_post = 'first-post';
                                } else {
                                    $feature_post = '';
                                } ?>
                                <div class="article-block-wrapper <?php echo esc_attr($feature_post); ?>">
                                    <div class="post-image">
                                        <a class="twp-image-wrapper" href="<?php the_permalink(); ?>">
                                            <?php if (has_post_thumbnail()) {
                                                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                                                $url = $thumb['0'];
                                            } else {
                                                $url = get_template_directory_uri() . '/images/no-image-900x600.jpg';
                                            }
                                            ?>
                                            <img src="<?php echo esc_url($url); ?>"
                                                 alt="<?php the_title_attribute(); ?>">
                                        </a></div>
                                    <div class="post-content">
                                        <h3 class="small-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?>
                                            </a>
                                        </h3>
                                        <div class="post-meta">
                            <span>
                                <?php echo esc_html__('Posted On: ', 'echo-magazine'); ?><?php the_time('F j, Y'); ?>
                            </span>
                                        </div>
                                    </div>
                                    <div class="post-description">
                                        <?php if (absint($params['excerpt_length']) > 0) : ?>
                                            <?php
                                            $excerpt = echo_magazine_words_count(absint($params['excerpt_length']), get_the_content());
                                            echo wp_kses_post(wpautop($excerpt));
                                            ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php $i++; endforeach; ?>
                        </div>
                        <?php $post_cat_id = absint($params['post_category_1']); ?>
                        <?php if (!empty($params['view_detail'])) { ?>
                            <div class="view-all"><a
                                        href="<?php echo esc_url(get_category_link($post_cat_id)); ?>"><?php echo esc_html($params['view_detail']) ?></a>
                            </div>
                        <?php } ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                <?php endif; ?>
                <!-- second category -->
                <?php if (!empty($all_posts_2)) : ?>
                    <?php global $post;
                    $author_id = $post->post_author;
                    $i = 1;
                    ?>
                    <div class="widget-half-column clearfix">
                        <div class="border-top"></div>
                        <?php if (!empty($params['title_2'])) {
                            echo $args['before_title'] . $params['title_2'] . $args['after_title'];
                        } ?>
                        <div class="items-wrap">
                            <?php foreach ($all_posts_2 as $key => $post) : ?>
                                <?php setup_postdata($post); ?>
                                <?php if ($i == 1) {
                                    $feature_post = 'first-post';
                                } else {
                                    $feature_post = '';
                                } ?>
                                <div class="article-block-wrapper <?php echo esc_attr($feature_post); ?>">
                                    <div class="post-image">
                                        <a class="twp-image-wrapper" href="<?php the_permalink(); ?>">
                                            <?php if (has_post_thumbnail()) {
                                                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                                                $url = $thumb['0'];
                                            } else {
                                                $url = get_template_directory_uri() . '/images/no-image-900x600.jpg';
                                            }
                                            ?>
                                            <img src="<?php echo esc_url($url); ?>"
                                                 alt="<?php the_title_attribute(); ?>">
                                        </a></div>
                                    <div class="post-content">
                                        <h3 class="small-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                        <div class="post-meta">
                            <span>
                                <?php echo esc_html__('Posted On: ', 'echo-magazine'); ?><?php the_time('F j, Y'); ?>
                            </span>
                                        </div>
                                    </div>
                                    <div class="post-description">
                                        <?php if (absint($params['excerpt_length']) > 0) : ?>
                                            <?php
                                            $excerpt = echo_magazine_words_count(absint($params['excerpt_length']), get_the_content());
                                            echo wp_kses_post(wpautop($excerpt));
                                            ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php $i++; endforeach; ?>
                        </div>
                        <?php $post_cat_id = absint($params['post_category_2']); ?>
                        <?php if (!empty($params['view_detail'])) { ?>
                            <div class="view-all"><a
                                        href="<?php echo(get_category_link($post_cat_id)); ?>"><?php echo esc_html($params['view_detail']) ?></a>
                            </div>
                        <?php } ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php echo $args['after_widget'];
        }
    }
endif;
/*Grid Panel widget*/
if (!class_exists('Echo_Magazine_sidebar_widget')) :
    /**
     * Popular widget Class.
     *
     * @since 1.0.0
     */
    class Echo_Magazine_sidebar_widget extends Echo_Magazine_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'echo_magazine_popular_post_widget',
                'description' => __('Displays post form selected category specific for popular post in sidebars.', 'echo-magazine'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'echo-magazine'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category' => array(
                    'label' => __('Select Category:', 'echo-magazine'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'echo-magazine'),
                ),
                'enable_discription' => array(
                    'label' => __('Enable Description:', 'echo-magazine'),
                    'type' => 'checkbox',
                    'default' => false,
                ),
                'excerpt_length' => array(
                    'label' => __('Excerpt Length:', 'echo-magazine'),
                    'description' => __('Number of words', 'echo-magazine'),
                    'default' => 15,
                    'css' => 'max-width:60px;',
                    'min' => 0,
                    'max' => 200,
                ),
                'post_number' => array(
                    'label' => __('Number of Posts:', 'echo-magazine'),
                    'type' => 'number',
                    'default' => 4,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 6,
                ),
            );
            parent::__construct('echo-magazine-popular-sidebar-layout', __('EM: Recent Post Widget', 'echo-magazine'), $opts, array(), $fields);
        }
        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {
            $params = $this->get_params($instance);
            echo $args['before_widget'];
            if (!empty($params['title'])) {
                echo $args['before_title'] . $params['title'] . $args['after_title'];
            }
            $qargs = array(
                'posts_per_page' => absint($params['post_number']),
                'no_found_rows' => true,
            );
            if (absint($params['post_category']) > 0) {
                $qargs['category'] = absint($params['post_category']);
            }
            $all_posts = get_posts($qargs);
            global $post;
            ?>
            <?php if (!empty($all_posts)) : ?>
            <div class="twp-recent-widget">
                <ul class="recent-widget-list">
                    <?php foreach ($all_posts as $key => $post) : ?>
                        <?php setup_postdata($post); ?>
                        <li class="full-item">
                            <div class="row">
                                <div class="item-image col col-four pull-left">
                                    <?php if (has_post_thumbnail()) {
                                        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'echo-magazine-400-260');
                                        $url = $thumb['0'];
                                    } else {
                                        $url = get_template_directory_uri() . '/images/no-image.jpg';
                                    }
                                    ?>
                                    <figure class="twp-article">
                                        <div class="twp-article-item">
                                            <div class="article-item-image">
                                                <img src="<?php echo esc_url($url); ?>"
                                                     alt="<?php the_title_attribute(); ?>">
                                            </div>
                                        </div>
                                    </figure>
                                </div>
                                <div class="full-item-details col col-six">
                                    <div class="full-item-content">
                                        <h3 class="small-title">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>
                                    </div>
                                    <div class="post-meta">
                        <span>
                            <?php echo esc_html__('Posted On: ', 'echo-magazine'); ?><?php the_time('F j, Y'); ?>
                        </span>
                                    </div>
                                    <div class="full-item-discription">
                                        <?php if (true === $params['enable_discription']) { ?>
                                            <div class="post-description">
                                                <?php if (absint($params['excerpt_length']) > 0) : ?>
                                                    <?php
                                                    $excerpt = echo_magazine_words_count(absint($params['excerpt_length']), get_the_content());
                                                    echo wp_kses_post(wpautop($excerpt));
                                                    ?>
                                                <?php endif; ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php
                    endforeach; ?>
                </ul>
            </div>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>
            <?php echo $args['after_widget'];
        }
    }
endif;
/*tabed widget*/
if (!class_exists('Echo_Magazine_Tabbed_Widget')) :
    /**
     * Tabbed widget Class.
     *
     * @since 1.0.0
     */
    class Echo_Magazine_Tabbed_Widget extends Echo_Magazine_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'echo_magazine_widget_tabbed',
                'description' => __('Tabbed widget.', 'echo-magazine'),
            );
            $fields = array(
                'popular_heading' => array(
                    'label' => __('Popular', 'echo-magazine'),
                    'type' => 'heading',
                ),
                'popular_number' => array(
                    'label' => __('No. of Posts:', 'echo-magazine'),
                    'type' => 'number',
                    'css' => 'max-width:60px;',
                    'default' => 5,
                    'min' => 1,
                    'max' => 10,
                ),
                'enable_discription' => array(
                    'label' => __('Enable Description:', 'echo-magazine'),
                    'type' => 'checkbox',
                    'default' => true,
                ),
                'excerpt_length' => array(
                    'label' => __('Excerpt Length:', 'echo-magazine'),
                    'description' => __('Number of words', 'echo-magazine'),
                    'default' => 10,
                    'css' => 'max-width:60px;',
                    'min' => 0,
                    'max' => 200,
                ),
                'recent_heading' => array(
                    'label' => __('Recent', 'echo-magazine'),
                    'type' => 'heading',
                ),
                'recent_number' => array(
                    'label' => __('No. of Posts:', 'echo-magazine'),
                    'type' => 'number',
                    'css' => 'max-width:60px;',
                    'default' => 5,
                    'min' => 1,
                    'max' => 10,
                ),
                'comments_heading' => array(
                    'label' => __('Comments', 'echo-magazine'),
                    'type' => 'heading',
                ),
                'comments_number' => array(
                    'label' => __('No. of Comments:', 'echo-magazine'),
                    'type' => 'number',
                    'css' => 'max-width:60px;',
                    'default' => 5,
                    'min' => 1,
                    'max' => 10,
                ),
            );
            parent::__construct('echo-magazine-tabbed', __('EM: Tab Widgets', 'echo-magazine'), $opts, array(), $fields);
        }
        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {
            $params = $this->get_params($instance);
            $tab_id = 'tabbed-' . $this->number;
            echo $args['before_widget'];
            ?>
            <div class="tabbed-container">
                <div class="section-head primary-bgcolor">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="tab tab-popular active">
                            <a href="#<?php echo esc_attr($tab_id); ?>-popular"
                               aria-controls="<?php esc_html_e('Popular', 'echo-magazine'); ?>" role="tab"
                               data-toggle="tab" class="primary-bgcolor">
                                <?php esc_html_e('Popular', 'echo-magazine'); ?>
                            </a>
                        </li>
                        <li class="tab tab-recent">
                            <a href="#<?php echo esc_attr($tab_id); ?>-recent"
                               aria-controls="<?php esc_html_e('Recent', 'echo-magazine'); ?>" role="tab"
                               data-toggle="tab" class="primary-bgcolor">
                                <?php esc_html_e('Recent', 'echo-magazine'); ?>
                            </a>
                        </li>
                        <li class="tab tab-comments">
                            <a href="#<?php echo esc_attr($tab_id); ?>-comments"
                               aria-controls="<?php esc_html_e('Comments', 'echo-magazine'); ?>" role="tab"
                               data-toggle="tab" class="primary-bgcolor">
                                <?php esc_html_e('Comments', 'echo-magazine'); ?>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div id="<?php echo esc_attr($tab_id); ?>-popular" role="tabpanel" class="tab-pane active">
                        <?php $this->render_news('popular', $params); ?>
                    </div>
                    <div id="<?php echo esc_attr($tab_id); ?>-recent" role="tabpanel" class="tab-pane">
                        <?php $this->render_news('recent', $params); ?>
                    </div>
                    <div id="<?php echo esc_attr($tab_id); ?>-comments" role="tabpanel" class="tab-pane">
                        <?php $this->render_comments($params); ?>
                    </div>
                </div>
            </div>
            <?php
            echo $args['after_widget'];
        }
        /**
         * Render news.
         *
         * @since 1.0.0
         *
         * @param array $type Type.
         * @param array $params Parameters.
         * @return void
         */
        function render_news($type, $params)
        {
            if (!in_array($type, array('popular', 'recent'))) {
                return;
            }
            switch ($type) {
                case 'popular':
                    $qargs = array(
                        'posts_per_page' => $params['popular_number'],
                        'no_found_rows' => true,
                        'orderby' => 'comment_count',
                    );
                    break;
                case 'recent':
                    $qargs = array(
                        'posts_per_page' => $params['recent_number'],
                        'no_found_rows' => true,
                    );
                    break;
                default:
                    break;
            }
            $all_posts = get_posts($qargs);
            ?>
            <?php if (!empty($all_posts)) : ?>
            <?php global $post;
            ?>
            <ul class="article-item article-list-item article-tabbed-list article-item-left">
                <?php foreach ($all_posts as $key => $post) : ?>
                    <?php setup_postdata($post); ?>
                    <li class="full-item">
                        <div class="row">
                            <div class="item-image col col-four">
                                <a href="<?php the_permalink(); ?>" class="news-item-thumb">
                                    <?php if (has_post_thumbnail($post->ID)) : ?>
                                        <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'echo-magazine-900-600'); ?>
                                        <?php if (!empty($image)) : ?>
                                            <img src="<?php echo esc_url($image[0]); ?>" alt=""/>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <img
                                                src="<?php echo esc_url(get_template_directory_uri() . '/images/no-image-900x600.jpg'); ?>"
                                                alt=""/>
                                    <?php endif; ?>
                                </a>
                            </div>
                            <div class="full-item-details col col-six">
                                <div class="full-item-content">
                                    <h3 class="small-title">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                    <div class="post-meta">
                        <span>
                            <?php echo esc_html__('Posted On: ', 'echo-magazine'); ?><?php the_time('F j, Y'); ?>
                        </span>
                                    </div>
                                    <div class="full-item-desc">
                                        <?php if (true === $params['enable_discription']) { ?>
                                            <div class="post-description">
                                                <?php if (absint($params['excerpt_length']) > 0) : ?>
                                                    <?php
                                                    $excerpt = echo_magazine_words_count(absint($params['excerpt_length']), get_the_content());
                                                    echo wp_kses_post(wpautop($excerpt));
                                                    ?>
                                                <?php endif; ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .news-content -->
                    </li>
                <?php endforeach; ?>
            </ul><!-- .news-list -->
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>
            <?php
        }
        /**
         * Render comments.
         *
         * @since 1.0.0
         *
         * @param array $params Parameters.
         * @return void
         */
        function render_comments($params)
        {
            $comment_args = array(
                'number' => $params['comments_number'],
                'status' => 'approve',
                'post_status' => 'publish',
            );
            $comments = get_comments($comment_args);
            ?>
            <?php if (!empty($comments)) : ?>
            <ul class="article-item article-list-item article-item-left comments-tabbed--list">
                <?php foreach ($comments as $key => $comment) : ?>
                    <li class="article-panel clearfix">
                        <figure class="article-thumbmnail">
                            <?php $comment_author_url = get_comment_author_url($comment); ?>
                            <?php if (!empty($comment_author_url)) : ?>
                                <a href="<?php echo esc_url($comment_author_url); ?>"><?php echo get_avatar($comment, 65); ?></a>
                            <?php else : ?>
                                <?php echo get_avatar($comment, 65); ?>
                            <?php endif; ?>
                        </figure><!-- .comments-thumb -->
                        <div class="comments-content">
                            <?php echo get_comment_author_link($comment); ?>
                            &nbsp;<?php echo esc_html_x('on', 'Tabbed Widget', 'echo-magazine'); ?>&nbsp;<a
                                    href="<?php echo esc_url(get_comment_link($comment)); ?>"><?php echo get_the_title($comment->comment_post_ID); ?></a>
                        </div><!-- .comments-content -->
                    </li>
                <?php endforeach; ?>
            </ul><!-- .comments-list -->
        <?php endif; ?>
            <?php
        }
    }
endif;
if (!class_exists('Echo_Magazine_widget_social')) :
    /**
     * Social Menu widget Class.
     *
     * @since 1.0.0
     */
    class Echo_Magazine_widget_social extends Echo_Magazine_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'echo_magazine_social_widget',
                'description' => __('Displays social menu if you have set it(social menu)', 'echo-magazine'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'echo-magazine'),
                    'description' => __('Note: Displays social menu if you have set it(social menu)', 'echo-magazine'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'description' => array(
                    'label' => __('Description:', 'echo-magazine'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
            );
            parent::__construct('echo-magazine-social-layout', __('EM: Social Menu Widget', 'echo-magazine'), $opts, array(), $fields);
        }
        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {
            $params = $this->get_params($instance);
            echo $args['before_widget'];
            echo "<div class='widget-header-wrapper'>";
            if (!empty($params['title'])) {
                echo $args['before_title'] . $params['title'] . $args['after_title'];
            }
            if (!empty($params['description'])) {
                echo "<p class='widget-description'>";
                echo esc_html($params['description']);
                echo "</p>";
            }
            echo "</div>";
            ?>
            <div class="social-widget-menu">
                <?php
                if ( has_nav_menu( 'social' ) ) {
                    wp_nav_menu( array(
                        'theme_location' => 'social',
                        'link_before' => '<span class="screen-reader-text">',
                        'link_after'     => '</span>',
                    ) );
                } ?>
            </div>
            <?php if ( ! has_nav_menu( 'social' ) ) : ?>
            <p>
                <?php esc_html_e( 'Social menu is not set. You need to create menu and assign it to Social Menu on Menu Settings.', 'echo-magazine' ); ?>
            </p>
        <?php endif; ?>
            <?php echo $args['after_widget'];
        }
    }
endif;
if (!class_exists('Echo_Magazine_widget_slider')) :
    /**
     * Latest news widget Class.
     *
     * @since 1.0.0
     */
    class Echo_Magazine_widget_slider extends Echo_Magazine_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'echo_magazine_slider_widget',
                'description' => __('Displays posts from selected category in slider', 'echo-magazine'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'post_category' => array(
                    'label' => __('Select Category:', 'echo-magazine'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'echo-magazine'),
                ),
                'post_number' => array(
                    'label' => __('Number of Posts:', 'echo-magazine'),
                    'type' => 'number',
                    'default' => 4,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 5,
                ),
            );
            parent::__construct('echo_magazine-slider-layout', __('EM: Slider Widget', 'echo-magazine'), $opts, array(), $fields);
        }
        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {
            $params = $this->get_params($instance);
            echo $args['before_widget'];
            $qargs = array(
                'posts_per_page' => esc_attr($params['post_number']),
                'no_found_rows' => true,
            );
            if (absint($params['post_category']) > 0) {
                $qargs['category'] = absint($params['post_category']);
            }
            $all_posts = get_posts($qargs);
            ?>
            <?php if (!empty($all_posts)) : ?>
            <?php global $post;
            $author_id = $post->post_author;
            ?>
            <div class="twp-slider-widget">
                <?php foreach ($all_posts as $key => $post) : ?>
                    <?php setup_postdata($post); ?>
                    <?php if (has_post_thumbnail()) {
                        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'echo_magazine-1140-600');
                        $url = $thumb['0'];
                    } else {
                        $url = get_template_directory_uri() . '/assets/images/no-image-1200x800.jpg';
                    }
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
                <?php endforeach; ?>
            </div>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>
            <?php echo $args['after_widget'];
        }
    }
endif;