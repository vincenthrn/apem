<?php
/**
 * Social Links for posts
 *
 * @package Angle
 * @subpackage Frontend
 * @since 1.01
 *
 * @copyright (c) 2014 Oxygenna.com
 * @license **LICENSE**
 * @version 1.12.2
 */
global $post;
$permalink = urlencode(get_permalink($post->ID));
$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail');
$featured_image = $featured_image['0'];
$post_title = rawurlencode(get_the_title($post->ID));

if( $fb_show  == 'show' || $twitter_show == 'show' || $google_show == 'show' || $pinterest_show == 'show' || $linkedin_show == 'show'  ) : ?>
    <div class="post-share text-center">
        <small><?php
            _e( 'Share this post', 'angle-td' ); ?>
        </small>
        <ul class="social-share"><?php
            if( $twitter_show == 'show' ) : ?>
                <li>
                    <a href="https://twitter.com/share?url=<?php echo $permalink; ?>&amp;text=<?php echo $post_title; ?>" target="_blank" data-toggle="tooltip" title="Share on Twitter">
                        <i class="fa fa-twitter"></i>
                    </a>
                </li><?php
            endif;
            if( $google_show == 'show' ) : ?>
                <li>
                    <a href="https://plus.google.com/share?url=<?php echo $permalink; ?>" target="_blank" data-toggle="tooltip" title="Share on Google+">
                        <i class="fa fa-google-plus"></i>
                    </a>
                </li><?php
            endif;
            if( $fb_show == 'show' ) : ?>
                <li>
                    <a href="http://www.facebook.com/sharer.php?u=<?php echo $permalink; ?>&amp;images=<?php echo $featured_image; ?>" target="_blank" data-toggle="tooltip" title="Share on Facebook">
                        <i class="fa fa-facebook"></i>
                    </a>
                </li><?php
            endif;
            if( $pinterest_show == 'show' ) : ?>
                <li>
                    <a href="//pinterest.com/pin/create/button/?url=<?php echo $permalink; ?>&amp;media=<?php echo $featured_image; ?>&amp;description=<?php echo $post_title; ?>" target="_blank" data-toggle="tooltip" title="Pin on Pinterest">
                        <i class="fa fa-pinterest"></i>
                    </a>
                </li><?php
            endif;
            if( $linkedin_show == 'show' ) : ?>
                <li>
                    <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $permalink; ?>" target="_blank" data-toggle="tooltip" title="Share on LinkedIn">
                        <i class="fa fa-linkedin"></i>
                    </a>
                </li><?php
            endif; ?>
        </ul>
    </div><?php
endif;