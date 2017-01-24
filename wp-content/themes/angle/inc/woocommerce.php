<?php
/**
 * All Woocommerce stuff
 *
 * @package Angle
 * @subpackage Admin
 * @since 0.1
 *
 * @copyright (c) 2014 Oxygenna.com
 * @license **LICENSE**
 * @version 1.12.2
 */

add_theme_support( 'woocommerce' );

if( oxy_is_woocommerce_active() ) {
     // Dequeue WooCommerce stylesheet(s)
    if ( version_compare( WOOCOMMERCE_VERSION, "2.1" ) >= 0 ) {
        // WooCommerce 2.1 or above is active
        add_filter( 'woocommerce_enqueue_styles', '__return_false' );
    } else {
        // WooCommerce is less than 2.1
        define( 'WOOCOMMERCE_USE_CSS', false );
    }
    function oxy_shop_product_widget() {
        dynamic_sidebar('shop-widget');
    }
    /**
     * All hooks for the shop page and category list page go here
     *
     * @return void
     **/
    function oxy_shop_and_category_hooks() {
        if( is_shop() || is_product_category() || is_product_tag() ) {
            function oxy_remove_title() {
                return false;
            }
            add_filter( 'woocommerce_show_page_title', 'oxy_remove_title');

            function oxy_shop_layout_start() {
                switch (oxy_get_option('shop_layout')) {
                    case 'sidebar-left':?>
                        <div class="row"><div class="col-md-3"> <?php get_sidebar(); ?></div><div class="col-md-9"><?php
                        break;
                    case 'sidebar-right': ?>
                        <div class="row"><div class="col-md-9"><?php
                        break;
                }
            }
            // remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
            add_action('woocommerce_before_main_content', 'oxy_shop_layout_start', 18);
            add_action( 'woocommerce_before_main_content', 'wc_print_notices', 18 );
            add_action( 'woocommerce_before_main_content', 'oxy_shop_product_widget', 17 );

            function oxy_shop_layout_end(){
                switch (oxy_get_option('shop_layout')) {
                    case 'sidebar-left': ?>
                        </div></div><?php
                        break;
                    case 'sidebar-right': ?>
                        </div><div class="col-md-3"><?php get_sidebar(); ?></div></div><?php
                        break;
                }
            }
            add_action('woocommerce_after_main_content', 'oxy_shop_layout_end', 9);


            function oxy_before_breadcrumbs() {
                echo '<div class="row"><div class="col-md-6">';
            }
            // remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
            add_action('woocommerce_before_main_content', 'oxy_before_breadcrumbs', 19);

            function oxy_after_breadcrumbs() {
                echo '</div><div class="col-md-6 text-right">';
            }
            add_action('woocommerce_before_main_content', 'oxy_after_breadcrumbs', 20);

            function oxy_after_orderby() {
              echo '</div></div>';
            }
            add_action('woocommerce_before_shop_loop', 'oxy_after_orderby', 30);

        }
    }

    function oxy_single_product_hooks() {
        if( is_product() ) {
            // we need to reposition the messages before the breadcrumbs
            remove_action( 'woocommerce_before_single_product', 'wc_print_notices', 12);
            add_action( 'woocommerce_before_main_content', 'wc_print_notices', 15 );
            add_action('woocommerce_before_main_content', 'oxy_shop_product_widget', 11);
        }
    }

    add_action( 'wp', 'oxy_shop_and_category_hooks' );
    add_action( 'wp', 'oxy_single_product_hooks');

    // GLOBAL HOOKS - EFFECT ALL PAGES
    // Removing action that shows in the footer a site-wide note
    remove_action( 'wp_footer', 'woocommerce_demo_store', 10);

    // first unhook the global WooCommerce wrappers. They were adding another <div id=content> around.
    remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
    remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

    function oxy_before_main_content_10() {
        $woocommerce_shop_section_classes = apply_filters( 'oxy_woocommerce_shop_classes', 10 );
        echo '<section class="section section-commerce section-short ' . $woocommerce_shop_section_classes . ' has-top">';
        if( is_product_category() ) {
            $category = get_queried_object();
            if( isset($category->term_id) ) {
                $shop_decoration = get_option( THEME_SHORT . '-tax-mtb-category_decoration'. $category->term_id, '' );
                echo oxy_section_decoration( 'top', $shop_decoration );
            }
        }
        if( is_shop() ){
            $shop_decoration = oxy_get_option('woocom_general_decoration');
            echo oxy_section_decoration( 'top', $shop_decoration );
        }
        echo '<div class="container">';
    }
    add_action('woocommerce_before_main_content', 'oxy_before_main_content_10', 10);

    function oxy_after_main_content_10() {
      echo '</div></section>';
    }
    add_action('woocommerce_after_main_content', 'woocommerce_site_note', 10);
    add_action('woocommerce_after_main_content', 'oxy_after_main_content_10', 11);

    function custom_override_breadcrumb_fields($fields) {
        $fields['wrap_before']='<nav class="woocommerce-breadcrumb" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">';
        $fields['wrap_after']='</nav>';
        $fields['before']='<span>';
        $fields['after']='</span>';
        $fields['delimiter']=' ';
        return $fields;
    }
    add_filter('woocommerce_breadcrumb_defaults','custom_override_breadcrumb_fields');

    // removing default woocommerce image display. Also affects shortcodes.
    remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

    function oxy_woocommerce_template_loop_product_thumbnail(){
        global $product;
        $image_ids = $product->get_gallery_attachment_ids();
        $back_image = array_shift( $image_ids );
        echo '<div class="product-image">';
        echo '<div class="product-image-front">' .woocommerce_get_product_thumbnail() . '</div>';
        if( null != $back_image ){
            $back_image = wp_get_attachment_image_src( $back_image, 'shop_catalog' );
            echo '<div class="product-image-back"><img src="' . $back_image[0] . '" alt=""/></div>';
        }
        echo '</div>';
    }
    add_action( 'woocommerce_before_shop_loop_item_title', 'oxy_woocommerce_template_loop_product_thumbnail', 10 );

    function oxy_woo_shop_header() {
        if( is_shop() ) {
            oxy_page_header( woocommerce_get_page_id( 'shop' ) );
        }
        else if( is_product_category() ) {
            $category = get_queried_object();
            if( isset($category->term_id) ) {
                oxy_create_taxonomy_header( $category );
            }
        }
        else if( is_product_tag() ) {
            $tag = get_queried_object();
            if( isset($tag->term_id) ) {
                oxy_create_taxonomy_header( $tag );
            }
        }
        else if ( is_page( get_option( 'woocommerce_myaccount_page_id' ) ) ) {
            oxy_page_header( get_option( 'woocommerce_myaccount_page_id' ) );
        }
    }

    function oxy_create_taxonomy_header( $queried_object ) {
        if( get_option( THEME_SHORT . '-tax-mtb-show_header'. $queried_object->term_id, 'hide' ) === 'show' ) {
                // if we have not set the title use category title or tag title as default
                $title = get_option( THEME_SHORT . '-tax-mtb-title'. $queried_object->term_id, '' );
                $title = empty($title) ? $queried_object->name : $title;
                // create header section
                echo oxy_shortcode_section( array(
                // header options
                'title'           => $title,
                'subtitle'        => get_option( THEME_SHORT . '-tax-mtb-subtitle'. $queried_object->term_id, '' ),
                'title_size'      => get_option( THEME_SHORT . '-tax-mtb-title_size'. $queried_object->term_id, '' ),
                'title_weight'    => get_option( THEME_SHORT . '-tax-mtb-title_weight'. $queried_object->term_id, '' ),
                'title_align'     => get_option( THEME_SHORT . '-tax-mtb-title_align'. $queried_object->term_id, 'center' ),
                'title_underline' => get_option( THEME_SHORT . '-tax-mtb-title_underline'. $queried_object->term_id, '' ),
                // section options
                'swatch'          => get_option( THEME_SHORT . '-tax-mtb-header_swatch'. $queried_object->term_id, 'swatch-red-white' ),
                'height'          => get_option( THEME_SHORT . '-tax-mtb-header_height'. $queried_object->term_id, '' ),
                // background options
                'background_image'                => get_option( THEME_SHORT . '-tax-mtb-background_image'. $queried_object->term_id, '' ),
                'background_video'                => get_option( THEME_SHORT . '-tax-mtb-background_video'. $queried_object->term_id, '' ),
                'background_position_vertical'    => get_option( THEME_SHORT . '-tax-mtb-background_position_vertical'. $queried_object->term_id, '0' ),
                'overlay_colour'                  => get_option( THEME_SHORT . '-tax-mtb-overlay_colour'. $queried_object->term_id, '' ),
                'overlay_opacity'                 => get_option( THEME_SHORT . '-tax-mtb-overlay_opacity'. $queried_object->term_id, '' ),
                'overlay_grid'                    => get_option( THEME_SHORT . '-tax-mtb-overlay_grid'. $queried_object->term_id, '' ),
                'background_image_size'           => get_option( THEME_SHORT . '-tax-mtb-background_image_size'. $queried_object->term_id, '' ),
                'background_image_repeat'         => get_option( THEME_SHORT . '-tax-mtb-background_image_repeat'. $queried_object->term_id, '' ),
                'background_image_attachment'     => get_option( THEME_SHORT . '-tax-mtb-background_image_attachment'. $queried_object->term_id, '' ),
            ));
        }
    }

    // Change number or products per row to based on options
    add_filter( 'loop_shop_columns', 'oxy_woocom_loop_columns' );
    if( !function_exists( 'oxy_woocom_loop_columns' ) ) {
        function oxy_woocom_loop_columns() {
            if( is_shop() || is_product()) {
                return oxy_get_option( 'woocommerce_shop_page_columns', 3);
            }
            else if( is_product_category() ) {
                $category = get_queried_object();
                if( isset($category->term_id) ) {
                    return get_option( THEME_SHORT . '-tax-mtb-product_columns'. $category->term_id, 3 );
                }
            }
            else if( is_product_tag() ) {
                $tag = get_queried_object();
                if( isset($tag->term_id) ) {
                    return get_option( THEME_SHORT . '-tax-mtb-product_columns'. $tag->term_id, 3 );
                }
            }
            else {
                return 3;
            }
        }
    }

    // Change number or products per row to based on options
    add_filter( 'oxy_woocommerce_shop_classes', 'oxy_woocommerce_shop_classes' );
    if( !function_exists( 'oxy_woocommerce_shop_classes' ) ) {
        function oxy_woocommerce_shop_classes() {
            if( is_product_category() ) {
                $category = get_queried_object();
                if( isset($category->term_id) ) {
                    return get_option( THEME_SHORT . '-tax-mtb-category_swatch'. $category->term_id, 'swatch-white-red' );
                }
            }
            else {
                return oxy_get_option( 'woocom_general_swatch' );
            }
        }
    }


    // Change number or products shown in cross sells
    add_filter( 'woocommerce_cross_sells_columns', 'oxy_woocommerce_cross_sells_columns' );
    if( !function_exists( 'oxy_woocommerce_cross_sells_columns' ) ) {
        function oxy_woocommerce_cross_sells_columns( $columns ) {
            return 4;
        }
    }

}

/*
 *
 * Set default image sizes on activation hook
 *
 */
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action( 'init', 'woocommerce_default_image_dimensions', 1 );
/**
 * Define image sizes
 */
function woocommerce_default_image_dimensions() {
    $catalog = array(
        'width'     => '500',
        'height'    => '500',
        'crop'      => 1
    );

    $single = array(
        'width'     => '700',
        'height'    => '700',
        'crop'      => 1
    );

    $thumbnail = array(
        'width'     => '90',
        'height'    => '90',
        'crop'      => 1
    );

    // Image sizes
    update_option( 'shop_catalog_image_size', $catalog );       // Product category thumbs
    update_option( 'shop_single_image_size', $single );         // Single product image
    update_option( 'shop_thumbnail_image_size', $thumbnail );   // Image gallery thumbs
}

remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description' );

// Deregistering styles that override the + and - buttons of cart quantity products
add_action('wp_enqueue_scripts', 'oxy_load_woo_scripts');

function oxy_load_woo_scripts() {
    if (wp_style_is('wcqi-css', 'registered')) {
        wp_deregister_style('wcqi-css');
    }
}

if ( ! function_exists( 'woocommerce_site_note' ) ) {

    /**
     * Adds a demo store banner to the site if enabled
     *
     */
    function woocommerce_site_note() {

        if ( ! is_store_notice_showing() ) {
            return;
        }

        $notice = get_option( 'woocommerce_demo_store_notice' );

        if ( empty( $notice ) ) {
            $notice = __( 'This is a demo store for testing purposes &mdash; no orders shall be fulfilled.', 'woocommerce' );
        }
        echo '<div class="alert alert-info">' . wp_kses_post( $notice ) . '</div>';

    }
}