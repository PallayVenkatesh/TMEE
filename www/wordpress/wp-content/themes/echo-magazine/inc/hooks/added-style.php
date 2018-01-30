<?php
/**
 * CSS related hooks.
 *
 * This file contains hook functions which are related to CSS.
 *
 * @package echo-magazine
 */

if (!function_exists('echo_magazine_trigger_custom_css_action')) :

    /**
     * Do action theme custom CSS.
     *
     * @since 1.0.0
     */
    function echo_magazine_trigger_custom_css_action()
    {
        $echo_magazine_enable_banner_overlay = echo_magazine_get_option('enable_overlay_option');
        ?>
        <style type="text/css">
            <?php
            /* Banner Image */
            if ( $echo_magazine_enable_banner_overlay == 1 ){
                ?>
                    .inner-header-overlay {
                        background: #282828;
                        filter: alpha(opacity=65);
                        opacity: 0.65;
                    }
            <?php
        } ?>
        </style>

    <?php }

endif;