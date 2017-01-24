<?php
/**
 * Shows a simple single post
 *
 * @package Angle
 * @subpackage Frontend
 * @since 1.0
 *
 * @copyright (c) 2014 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.12.2
 */
$post_swatch = get_post_meta( $post->ID, THEME_SHORT. '_swatch', true );
$extra_post_class  = oxy_get_option('blog_post_icons') == 'on'? 'post-showinfo':''; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $extra_post_class.' '.$post_swatch ); ?>>
    <div class="post-media overlay">
        <?php
        $stripteaser = oxy_get_option('blog_stripteaser') == 'on'? true:false;
        $content = is_single()? get_the_content( '', $stripteaser ): get_the_content('');
        $video_shortcode = oxy_get_content_shortcode( $post, 'embed' );

        if( $video_shortcode !== null ) {
            $video_src = null;

            if( isset( $video_shortcode[0] ) ) {
                if(isset($video_shortcode[5][0])) {
                    // for .mp4|webm|ogg videos
                    $video_src = $video_shortcode[5][0];
                }
                $video_shortcode = $video_shortcode[0];
                if( isset( $video_shortcode[0] ) ) {
                    $content = str_replace( $video_shortcode[0], '', $content );
                    if (preg_match("/^.*\.(mp4|webm|ogg)$/i", $video_src)) { ?>
                        <div class="video-wrapper">
                            <video controls style="width: 100%; height: 100%;">
                                <source type="video/mp4" src="<?php echo $video_src; ?>"/>
                            </video>
                        </div><?php
                    }
                    else {
                        // use the video in the archives
                        global $wp_embed;
                        echo $wp_embed->run_shortcode( $video_shortcode[0] );
                    }
                }
            }
        }
        else if( has_post_thumbnail() ) {
            $img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
            $img_link = is_single() ? $img[0] : get_permalink();
            $link_class = is_single() ? 'class="feature-image magnific hover-animate"' : 'class="feature-image hover-animate"';
            // fancybox only in single post.
            if( !is_single() || ( is_single() && oxy_get_option('blog_fancybox') == 'on' ) ) {
                echo '<a href="' . $img_link . '" ' . $link_class . '>';
            }
            echo '<img src="'.$img[0].'" alt="'.oxy_post_thumbnail_name($post).'">';
            //echo '<i class="icon-zoom-in"></i>';
            if( !is_single() || ( is_single() && oxy_get_option('blog_fancybox') == 'on' ) ) {
                $icon_class = is_single() ? 'fa fa-search-plus' : 'fa fa-link';
                echo '<i class="'.$icon_class.'"></i>';
                echo '</a>';
            }
        } ?>
    </div>
    <div class="post-head small-screen-center">
        <h2 class="post-title entry-title">
            <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'angle-td' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
                <?php the_title(); ?>
            </a>
        </h2>
        <small class="post-author">
            <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                <?php the_author(); ?>
            </a>
        </small>
        <small class="post-date">
            <?php the_time(get_option('date_format')); ?>
        </small><?php
        if(oxy_get_option('blog_post_icons') == 'on'){ ?>
        <div class="post-icon">
            <div class="hex hex-big">
                <?php oxy_post_icon($post->ID, true); ?>
            </div>
        </div><?php
        } ?>
    </div>
    <div class="post-body entry-content">
        <?php echo apply_filters( 'the_content', $content );
            if( !is_single() && oxy_get_option('blog_show_readmore') == 'on' ) {
                oxy_read_more_link();
            }
            oxy_wp_link_pages(array('before' => '<div class="text-center post-showinfo">', 'after' => '</div>'));
        ?>
    </div>
     <?php
        get_template_part( 'partials/post-extras' );
        if( is_single() ){
            echo oxy_shortcode_sharing( array(
                'fb_show'        => oxy_get_option( 'fb_show' ),
                'twitter_show'   => oxy_get_option('twitter_show'),
                'google_show'    => oxy_get_option('google_show'),
                'pinterest_show' => oxy_get_option('pinterest_show'),
                'linkedin_show'  => oxy_get_option('linkedin_show'),
            ));
        } ?>
</article>