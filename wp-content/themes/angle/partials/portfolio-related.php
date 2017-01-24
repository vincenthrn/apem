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
// get related posts excluding this one.
$cats = wp_get_post_terms( $post->ID, 'oxy_portfolio_categories' );
if( !empty( $cats ) ) :
    $args = array(  'post_type' => 'oxy_portfolio_image' ,
                    'numberposts' => 3 ,
                    'post__not_in' => array($post->ID) ,
                    'orderby' => 'rand',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'oxy_portfolio_categories',
                            'field' => 'slug',
                            'terms' => $cats[0]->slug
                        )
                    )
                );

    $posts = get_posts($args);
    if( $posts ) :
        $shape = oxy_get_option('portfolio_related_shape');
        $image_size = $shape === 'round' ? 'square-image' : $shape . '-image';
        $columns = 3;
        $show_overlay = 'show';
        $show_title = 'show';
        $show_excerpt = 'show';
        $magnific_caption = 'post_title_caption';
        $pagination = 'off';
        $container_class = array();
        $show_shadow = oxy_get_option( 'portfolio_related_shadow' );
        $count = 9;
        ob_start();
        include( locate_template( 'partials/shortcodes/portfolio/items.php' ) );
        $content = ob_get_contents();
        ob_end_clean();

        echo oxy_shortcode_section( array(
            'show_header'     => 'show',
            'title'           => oxy_filter_title( oxy_get_option( 'portfolio_related_title' ) ),
            'title_size'      => 'super',
            'title_weight'    => 'hairline',
            'height'           => oxy_get_option('related_items_height'),
            'swatch'          => oxy_get_option( 'portfolio_related_swatch' ),
            'top_decoration'  => oxy_get_option( 'portfolio_related_decoration' ),
        ),$content);
    endif;
    wp_reset_postdata();
endif;