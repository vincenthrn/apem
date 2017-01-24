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
    // create content for post
    $content = get_the_content();
    $features = wp_get_post_terms( $post->ID, 'oxy_portfolio_features' );
    $link   = get_post_meta( $post->ID, THEME_SHORT. '_link', true );
    $swatch = get_post_meta( $post->ID, THEME_SHORT. '_portfolio_swatch', true );
    // strip video embed from content if video post
    switch( get_post_format() ) {
        case 'video':
            $video_shortcode = oxy_get_content_shortcode( $post, 'embed' );
            if( $video_shortcode !== null ) {
                if( isset( $video_shortcode[0] ) ) {
                    $video_shortcode = $video_shortcode[0];
                    if( isset( $video_shortcode[0] ) ) {
                        $content = str_replace( $video_shortcode[0], '', $content );
                    }
                }
            }
        break;
        case 'gallery':
            $gallery_shortcode = oxy_get_content_shortcode( $post, 'gallery' );
            if( $gallery_shortcode !== null ) {
                if( isset( $gallery_shortcode[0] ) ) {
                    // show gallery
                    $gallery_ids = null;
                    if( array_key_exists( 3, $gallery_shortcode ) ) {
                        if( array_key_exists( 0, $gallery_shortcode[3] ) ) {
                            $gallery_attrs = shortcode_parse_atts( $gallery_shortcode[3][0] );
                            if( array_key_exists( 'ids', $gallery_attrs) ) {
                                $gallery_ids = explode( ',', $gallery_attrs['ids'] );
                            }
                        }
                    }
                    // strip shortcode from the content
                    $gallery_shortcode = $gallery_shortcode[0];
                    if( isset( $gallery_shortcode[0] ) ) {
                        $content = str_replace( $gallery_shortcode[0], '', $content );
                    }
                }
            }
        break;
        case 'audio':
            $audio_shortcode = oxy_get_content_shortcode( $post, 'audio' );
            if( $audio_shortcode !== null){
                $audio_src = null;
                if( array_key_exists( 3, $audio_shortcode ) ) {
                    if( array_key_exists( 0, $audio_shortcode[3] ) ) {
                        $audio_attrs = shortcode_parse_atts( $audio_shortcode[3][0] );
                        if( array_key_exists( 'src', $audio_attrs) ) {
                            $audio_src =  $audio_attrs['src'];
                        }
                    }
                }
            }
        break;
    }?>

<section class="section <?php echo $swatch; ?>">
    <div class="container">
        <div class="text-center small-screen-center portfolio-header super">
            <h1 class="headline super hairline entry-title"><?php
                the_title(); ?>
            </h1><?php
    if( get_post_meta( $post->ID, THEME_SHORT. '_navigation', true ) == 'on' ) :
        if( get_previous_post() ) : ?>
            <a class="prev-portfolio-item" data-original-title="<?php echo __('Previous', 'angle-td' ); ?>" data-toggle="tooltip" href="<?php echo get_permalink(get_adjacent_post(false, '', true)); ?>">
                <i class="fa fa-angle-left"></i>
            </a><?php
        endif;
        if( get_next_post() ) : ?>
            <a class="next-portfolio-item" data-original-title="<?php echo __('Next', 'angle-td' ); ?>" data-toggle="tooltip" href="<?php echo get_permalink(get_adjacent_post(false, '', false)); ?>">
                <i class="fa fa-angle-right"></i>
            </a><?php
        endif;
    endif; ?>
        </div>
        <div class="row">
            <div class="col-md-8"><?php
            switch( get_post_format() ) {
                case '':
                case 'image':
                    if( has_post_thumbnail( $post->ID ) ) : ?>
                    <figure class="portfolio-figure">
                        <?php $img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); ?>
                        <a class="magnific hover-animate" href="<?php echo $img[0]; ?>">
                            <?php the_post_thumbnail( 'full'); ?>
                            <i class="fa fa-search-plus"></i>
                        </a>
                    </figure><?php
                    endif;
                break;
                case 'gallery':
                    if( $gallery_ids !== null ) :?>
                        <div class="portfolio-gallery">
                        <?php oxy_create_flexslider( $gallery_ids ); ?>
                        </div><?php
                    endif;
                break;
                case 'video':
                    // get video embed shortcpde
                    if( isset( $video_shortcode[0] ) ) :
                        // use the video in the archives ?>
                        <figure class="portfolio-figure"> <?php
                        global $wp_embed;
                        echo $wp_embed->run_shortcode( $video_shortcode[0] );
                        $content = str_replace( $video_shortcode[0], '', $content ); ?>
                        </figure> <?php
                    endif;
                break;
                case 'audio':
                    if($audio_src !== null){ ?>
                        <audio controls="" preload="auto">
                            <source src="<?php echo $audio_src; ?>">
                        </audio>
                        <?php
                        $content = str_replace( $audio_shortcode[0][0], '', $content );
                    }
                break;
            }
             echo apply_filters( 'the_content', $content ); ?>
            </div>
            <div class="col-md-4"><?php
            if( get_post_meta( $post->ID, THEME_SHORT. '_description', true ) != '' ) : ?>
                <p><?php
                    echo get_post_meta( $post->ID, THEME_SHORT. '_description', true ); ?>
                </p><?php
            endif;

            if ( !empty($features) ) : ?>
                <div class="portfolio-list overlay">
                    <h3 class="portfolio-list-header text-center overlay"><?php
                        _e( 'Features', 'angle-td' ); ?>
                    </h3>
                    <ul class="portfolio-list">
                    <?php foreach ($features as $feature) : ?>
                        <li>
                            <?php echo $feature->name ?>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                </div><?php
            endif;
            if( $link !=  '' ) : ?>
                <a class="portfolio-url overlay" href="<?php echo $link; ?>" target="_blank">
                    <span class="overlay"><?php
                        _e( 'URL', 'angle-td' ); ?>
                    </span>
                    <?php echo $link; ?>
                </a><?php
            endif;
            get_template_part( 'partials/portfolio-social-links' ); ?>
            </div>
        </div>
    </div>
</section><?php
    if(oxy_get_option('portfolio_show_related') == 'on'):
        get_template_part( 'partials/portfolio-related' );
    endif;

endif;