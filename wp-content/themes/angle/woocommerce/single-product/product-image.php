<?php
/**
 * Single Product Image
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $product;

if ( $product->product_type == 'variable' ) { ?>

    <div class="images">

    <?php
        if ( has_post_thumbnail() ) {

            $image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
            $image_link  = wp_get_attachment_url( get_post_thumbnail_id() );
            $image       = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
                'title' => $image_title
                ) );
            $attachment_count = count( $product->get_gallery_attachment_ids() );

            if ( $attachment_count > 0 ) {
                $gallery = '[product-gallery]';
            } else {
                $gallery = '';
            }

            echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_title, $image ), $post->ID );

        }
        else {
            echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );
        } ?>

    <?php do_action( 'woocommerce_product_thumbnails' ); ?>

    </div><?php
}
else {
    // fetch all product images
    $image_ids = $product->get_gallery_attachment_ids();
    // add featured image to the start of the array
    array_unshift( $image_ids, get_post_thumbnail_id() );
    ?>
    <div id="product-images" class="flexslider" data-flex-animation="<?php echo oxy_get_option('product_animation'); ?>" data-flex-controlsalign="<?php echo oxy_get_option('product_controlsalign'); ?>" data-flex-controlsposition="<?php echo oxy_get_option('product_controlsposition'); ?>" data-flex-directions="<?php echo oxy_get_option('product_directionnav'); ?>" data-flex-directions-type="<?php echo oxy_get_option('product_directionnavtype'); ?>" data-flex-speed="<?php echo oxy_get_option('product_speed'); ?>" data-flex-controls="<?php echo oxy_get_option('product_showcontrols'); ?>" data-flex-slideshow="<?php echo oxy_get_option('product_autostart'); ?>" data-flex-duration="<?php echo oxy_get_option('product_duration'); ?>" data-flex-reverse="false">
        <ul class="slides product-gallery">
            <?php foreach( $image_ids as $image_id ) :
                $thumb = wp_get_attachment_image_src( $image_id, 'shop_thumbnail' );
                $single= wp_get_attachment_image_src( $image_id, 'shop_single' );
                $full  = wp_get_attachment_image_src( $image_id, 'full' ); ?>
                <li data-thumb="<?php echo $thumb[0]; ?>">
                    <figure>
                        <img src="<?php echo $single[0]; ?>" alt="<?php the_title(); ?>">
                    </figure>
                    <figcaption>
                        <a href="<?php echo $full[0]; ?>">
                            <i class="fa fa-search-plus"></i>
                        </a>
                    </figcaption>
                </li>
            <?php endforeach; ?>
        </ul>
    </div><?php
} ?>