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
    <div class="post-media overlay"></div>
    <div class="post-head small-screen-center no-title"><?php
        if(oxy_get_option('blog_post_icons') == 'on'){ ?>
        <div class="post-icon">
            <div class="hex hex-big">
                <?php oxy_post_icon($post->ID, true); ?>
            </div>
        </div><?php
        } ?>
    </div>
    <div class="post-body entry-content">
        <?php echo do_shortcode('[blockquote who="'.get_the_title().'" cite=""]'.get_the_content().'[/blockquote]'); ?>
        <?php oxy_wp_link_pages(array('before' => '<div class="text-center post-showinfo">', 'after' => '</div>')); ?>

    </div>
    <?php get_template_part( 'partials/post-extras' ); ?>

</article>