<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/review.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$rating   = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );

// backwards compatibility, function added in v2.5.3
if (function_exists('wc_review_is_from_verified_owner')) {
    $verified = wc_review_is_from_verified_owner( $comment->comment_ID );
}

?>
<li itemprop="review" itemscope itemtype="http://schema.org/Review" <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
    <div id="comment-<?php comment_ID(); ?>" class="comment_container">
        <div class="box-round box-mini pull-left">
            <div class="box-dummy"></div>
            <div class="media-avatar">

                <?php echo get_avatar( $comment, apply_filters( 'woocommerce_review_gravatar_size', '48' ), '', get_comment_author() ); ?>

            </div>
        </div>


        <div class="media-body">
            <div class="media-inner">

                <div class="comment-text">

                    <h5 class="media-heading">

                        <?php if ( $rating && get_option( 'woocommerce_enable_review_rating' ) == 'yes' ) : ?>
                            <a itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="star-rating" title="<?php echo sprintf( __( 'Rated %d out of 5', 'woocommerce' ), $rating ) ?>">
                                <span style="width:<?php echo ( $rating / 5 ) * 100; ?>%"><strong itemprop="ratingValue"><?php echo $rating; ?></strong> <?php _e( 'out of 5', 'woocommerce' ); ?></span>
                            </a>
                        <?php endif; ?>

                        <?php do_action( 'woocommerce_review_before_comment_meta', $comment ); ?>

                        <?php if ( $comment->comment_approved == '0' ) : ?>

                            <p class="meta"><em><?php _e( 'Your comment is awaiting approval', 'woocommerce' ); ?></em></p>

                        <?php else : ?>
                            <p class="meta">
                                <strong itemprop="author"><?php comment_author(); ?></strong> <?php

                                    if ( get_option( 'woocommerce_review_rating_verification_label' ) === 'yes' )
                                        if ( $verified )
                                            echo '<em class="verified">(' . __( 'verified owner', 'woocommerce' ) . ')</em> ';

                                ?>&ndash; <time itemprop="datePublished" datetime="<?php echo get_comment_date( 'c' ); ?>"><?php echo get_comment_date( wc_date_format() ); ?></time>:
                            </p>
                        <?php endif; ?>
                    </h5>


                    <?php do_action( 'woocommerce_review_before_comment_text', $comment ); ?>
                    <p itemprop="description" class="description"><?php comment_text(); ?></p>

                    <?php do_action( 'woocommerce_review_after_comment_text', $comment ); ?>
                </div>
            </div>
        </div>
    </div>
