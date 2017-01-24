<?php
/**
 * Portfolio single template
 *
 * @package Angle
 * @subpackage Frontend
 * @since 1.3
 *
 * @copyright (c) 2014 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.12.2
 */

if ( have_posts() ):
    the_post();
    global $post;
    $custom_fields = get_post_custom($post->ID);
    $show_position = "show";
    $image_shape   = "round";
    $image_size    = "big";
    $image_shadow  = "hide";
    $show_position = "show";
    $show_content  = "show";
    $content_size  = "big";
    $align_content = "center";
    $show_social   = "show";
    $link_target   = "_self";

    ob_start();
    include( locate_template( 'partials/shortcodes/staff/featured.php' ) );
    $content = ob_get_contents();
    ob_end_clean();

    echo oxy_shortcode_section( array(
        'show_header'     => 'hide',
        'swatch'          => get_post_meta( $post->ID, THEME_SHORT. '_staff_swatch', true ),
    ),$content);

    the_content(true); ?>
<?php endif;