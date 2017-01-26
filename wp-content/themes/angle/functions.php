<?php
/**
 * Main functions file
 *
 * @package Angle
 * @subpackage Frontend
 * @since 0.1
 *
 * @copyright (c) 2014 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.12.2
 */

// create defines
define( 'THEME_NAME', 'Angle' );
define( 'THEME_SHORT', 'angle' );

define( 'OXY_THEME_DIR', get_template_directory() . '/' );
define( 'OXY_THEME_URI', get_template_directory_uri() . '/' );

// include extra theme specific code
include OXY_THEME_DIR . 'inc/frontend.php';
include OXY_THEME_DIR . 'inc/woocommerce.php';
include OXY_THEME_DIR . 'vendor/oxygenna/oxygenna-framework/inc/OxygennaTheme.php';
include OXY_THEME_DIR . 'vendor/oxygenna/oxygenna-mega-menu/oxygenna-mega-menu.php';

function mytheme_custom_styles() {
    wp_enqueue_style( 'anim-style', get_theme_root_uri() . "/angle/assets/css/style-anim.css" );
}
add_action( 'wp_enqueue_scripts', 'mytheme_custom_styles' );



if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 1);
function my_jquery_enqueue() {
    wp_deregister_script('jquery');
    wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js", false, null);
    wp_enqueue_script('jquery');
}



if (!is_admin()) add_action("wp_enqueue_scripts", "scroll_magic_enqueue", 2);
function scroll_magic_enqueue() {
    wp_register_script('scroll', "https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.js", false, null);
    wp_enqueue_script('scroll');
}

if (!is_admin()) add_action("wp_enqueue_scripts", "scroll_magicIndicators_enqueue", 2);
function scroll_magicIndicators_enqueue() {
    wp_register_script('scrollInd', "https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/debug.addIndicators.js", false, null);
    wp_enqueue_script('scrollInd');
}


if (!is_admin()) add_action("wp_enqueue_scripts", "tween_enqueue", 4);
function tween_enqueue() {
    wp_register_script('tween', "https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js", false, null);
    wp_enqueue_script('tween');
}

if (!is_admin()) add_action("wp_enqueue_scripts", "gsap_enqueue", 5);
function gsap_enqueue() {
    wp_register_script('gsap', "https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/animation.gsap.js", false, null);
    wp_enqueue_script('gsap');
}


if (!is_admin()) add_action("wp_enqueue_scripts", "anim_enqueue", 6);
function anim_enqueue() {
    wp_register_script('anim', get_theme_root_uri() . "/angle/assets/js/script.js", false, null, $in_footer = true);
    wp_enqueue_script('anim');
}


/**
 * Apply new wpautop filter to Press Release content
 */
function km_filter_press_release_content() {
    if ( ! is_singular( 'press-releases' ) ) {
        return;
    }
    remove_filter( 'the_content', 'wpautop' );
    add_filter( 'the_content', 'km_remove_wpautop_line_breaks' );
}
add_action( 'wp', 'km_filter_press_release_content' );
/**
 * Apply wpautop() to content and remove line breaks
 *
 * @param  string $content the_content().
 * @return string          the_content() with line breaks removed.
 */
function km_remove_wpautop_line_breaks( $content ) {
    return wpautop( $content, false );
}



// create theme

global $oxy_theme;
$oxy_theme = new OxygennaTheme(
    array(
        'text_domain'       => 'angle-td',
        'admin_text_domain' => 'angle-admin-td',
        'min_wp_ver'        => '3.4',
        'sidebars' => array(
            'sidebar' => array( 'Sidebar', '' ),
        ),
        'widgets' => array(
            'Swatch_twitter'                => 'swatch_twitter.php',
            'Swatch_social'                 => 'swatch_social.php',
            'Swatch_wpml_language_selector' => 'swatch_wpml_language_selector.php',
        ),
        'shortcodes' => false,
    )
);

include OXY_THEME_DIR . 'inc/custom-posts.php';
include OXY_THEME_DIR . 'inc/options/shortcodes/shortcodes.php';
include OXY_THEME_DIR . 'inc/options/widgets/default_overrides.php';

if( is_admin() ) {
    include OXY_THEME_DIR . 'inc/options/shortcodes/create-shortcode-options.php';
    include OXY_THEME_DIR . 'inc/backend.php';
    include OXY_THEME_DIR . 'inc/theme-metaboxes.php';
    include OXY_THEME_DIR . 'inc/visual-composer-extend.php';
    include OXY_THEME_DIR . 'inc/visual-composer.php';
    include OXY_THEME_DIR . 'inc/install-plugins.php';
    include OXY_THEME_DIR . 'inc/one-click-import.php';
    include OXY_THEME_DIR . 'vendor/oxygenna/oxygenna-one-click/inc/OxygennaOneClick.php';
    include OXY_THEME_DIR . 'vendor/oxygenna/oxygenna-typography/oxygenna-typography.php';
}

function oxy_activate_theme( $theme ) {
    // if no swatches are installed then install the default swatches
    // remove old default swatches
    $swatches = get_posts( array(
        'post_type'      => 'oxy_swatch',
        'meta_key'       => THEME_SHORT . '_default_swatch',
        'posts_per_page' => '-1'
    ));
    if( empty( $swatches ) ) {
        update_option( THEME_SHORT . '_install_swatches', true );
    }
}
add_action( 'after_switch_theme', 'oxy_activate_theme' );