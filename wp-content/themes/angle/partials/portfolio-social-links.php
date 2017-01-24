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
global $post;
$permalink = urlencode(get_permalink($post->ID));
$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail');
$featured_image = $featured_image['0'];
$post_title = rawurlencode(get_the_title($post->ID)); ?>

<div class="portfolio-share overlay">
    <span class="overlay"><?php
        _e( 'Share', 'angle-td' ); ?>
    </span>
    <ul class="list-inline">
        <li>
            <a href="https://twitter.com/share?url=<?php echo $permalink; ?>&amp;text=<?php echo $post_title; ?>" target="_blank" data-toggle="tooltip" title="<?php _e( 'Share on Twitter', 'angle-td' ); ?>">
                <i class="fa fa-twitter"></i>
            </a>
        </li>
        <li>
            <a href="http://www.facebook.com/sharer.php?u=<?php echo $permalink; ?>&amp;images=<?php echo $featured_image; ?>" target="_blank" data-toggle="tooltip" title="<?php _e( 'Share on Facebook', 'angle-td' ); ?>">
                <i class="fa fa-facebook"></i>
            </a>
        </li>
        <li>
            <a href="//pinterest.com/pin/create/button/?url=<?php echo $permalink; ?>&amp;media=<?php echo $featured_image; ?>&amp;description=<?php echo $post_title; ?>" target="_blank" data-toggle="tooltip" title="<?php _e( 'Pin on Pinterest', 'angle-td' ); ?>">
                <i class="fa fa-pinterest"></i>
            </a>
        </li>
        <li>
            <a href="https://plus.google.com/share?url=<?php echo $permalink; ?>" target="_blank" data-toggle="tooltip" title="<?php _e( 'Share on Google+', 'angle-td' ); ?>">
                <i class="fa fa-google-plus"></i>
            </a>
        </li>
    </ul>
</div>
