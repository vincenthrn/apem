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
    <?php
    $link_shortcode = oxy_get_content_shortcode( $post, 'link' );
    $img_link = '';
    $title = get_the_title();
    if( $link_shortcode !== null ) {
        $remove = $link_shortcode[0];
        if( isset( $link_shortcode[5] ) ) {
            $link_shortcode = $link_shortcode[5];
            if( isset( $link_shortcode[0] ) ) {
                $img_link = $link_shortcode[0];
                $title = '<a href="' . $link_shortcode[0] . '">' . get_the_title( $post->ID ) . '</a>';
                $content = str_replace( $remove, '', get_the_content() );
            }
        }
    }
    ?>
    <div class="post-media overlay">
        <?php
        if( has_post_thumbnail() && !is_search()) {
            $img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
            $link_class = 'class="feature-image hover-animate"';
            echo '<a href="' . $img_link . '" ' . $link_class . '>';
            echo '<img src="'.$img[0].'" alt="'.oxy_post_thumbnail_name($post).'">';
            $icon_class = 'fa fa-link';
            echo '<i class="'.$icon_class.'"></i>';
            echo '</a>';

        } ?>
    </div>
    <div class="post-head small-screen-center">
        <h2 class="post-title entry-title">
            <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'angle-td' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
                <?php echo $title; ?>
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
        <?php echo empty($content)? the_content(): $content; ?>
        <?php oxy_wp_link_pages(array('before' => '<div class="text-center post-showinfo">', 'after' => '</div>')); ?>
    </div>
    <?php get_template_part( 'partials/post-extras' ); ?>
</article>