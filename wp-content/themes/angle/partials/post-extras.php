<?php
/**
 * Shows tags, categories and comment count for posts
 *
 * @package Angle
 * @subpackage Frontend
 * @since 1.3
 *
 * @copyright (c) 2014 Oxygenna.com
 * @license **LICENSE**
 * @version 1.12.2
 */
?>
<div class="post-extras bordered text-center">
    <?php if( get_post_format(get_the_ID()) != 'quote' ) {?>
        <div class="text-center">
            <span class="post-category">
                <?php if( has_category() && oxy_get_option( 'blog_categories' ) == 'on' ) : ?>
                <i class="fa fa-folder-open"></i>
                <?php the_category( ', ' ); ?>
                <?php endif; ?>
            </span>
            <span class="post-tags">
                <?php if( has_tag() && oxy_get_option( 'blog_tags' ) == 'on' ) : ?>
                <i class="fa fa-tags"></i>
                <?php the_tags( $before = '', $sep = ', ', $after = '' ); ?>
                <?php endif; ?>
            </span>
            <span class="post-link">
                <?php if ( comments_open() && ! post_password_required() && oxy_get_option( 'blog_comment_count' ) == 'on' && !is_single() ) : ?>
                <i class="fa fa-comments"></i>
                <?php comments_popup_link( _x( 'No comments', 'comments number', 'angle-td' ), _x( '1 comment', 'comments number', 'angle-td' ), _x( '% comments', 'comments number', 'angle-td' ) ); ?>
                <?php endif; ?>
            </span>
        </div>
    <?php } ?>
</div>
<?php oxy_atom_author_meta(); ?>