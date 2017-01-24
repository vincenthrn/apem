<?php
/**
 * Loads all theme specific admin backend functionality
 *
 * @package Angle
 * @subpackage Admin
 * @since 0.1
 *
 * @copyright (c) 2014 Oxygenna.com
 * @license **LICENSE**
 * @version 1.12.2
 */

function oxy_admin_init() {
    $need_to_install = get_option( THEME_SHORT . '_install_swatches' );
    if( $need_to_install ) {
        oxy_install_default_swatches();
        // remove install flag
        delete_option( THEME_SHORT . '_install_swatches' );
    }
}
add_action( 'admin_init', 'oxy_admin_init' );


function oxy_check_default_colours_compiled() {
    $theme_options = get_option( THEME_SHORT . '-options' );
    $default_css = get_option( THEME_SHORT . '-default-css' );
    // if default options have been set and we have no compiled css
    if( $theme_options !== false && $default_css === false ) {
        if( oxy_get_option('default_css_default_button_text') !== false ) {
            // compile default colours
            oxy_create_default_colour_css();
        }
    }
}
add_action( 'admin_init', 'oxy_check_default_colours_compiled' );


function oxy_create_logo_css() {
    // get swatch mixins & variables
    $header_sass = file_get_contents( OXY_THEME_DIR . 'assets/scss/bootstrap/_oxygenna-variables.scss' );
    $header_sass .= file_get_contents( OXY_THEME_DIR . 'assets/scss/theme/_compass-mixins.scss' );
    $header_sass .= file_get_contents( OXY_THEME_DIR . 'assets/scss/theme/_mixins.scss' );

    $element_height = 24;
    $navbar_height = oxy_get_option( 'navbar_height' );
    $navbar_scrolled = oxy_get_option( 'navbar_scrolled' );
    $dropdown_width = oxy_get_option( 'dropdown_width' );

    $header_sass .= "@include header-setup(
        {$element_height}px,    // Line height of the navbar
        {$navbar_height}px,     // Navigation bar height
        {$navbar_scrolled}px,   // Navigation bar height after scrolling
        {$dropdown_width}px     // Dropdown submenu width
    );";


    // compile the sass!!!
    if( !class_exists( 'scssc' ) ) {
        require OXY_THEME_DIR . 'vendor/leafo/scssphp/scss.inc.php';
    }
    $scss = new scssc();
    $css = $scss->compile( $header_sass );

    update_option( THEME_SHORT . '-header-css', $css );
}
add_action( 'oxy-options-updated-' . THEME_SHORT . '-general', 'oxy_create_logo_css' );


function oxy_save_colors_on_loader_active() {
    global $oxy_theme_options;
    // check to see if we activated the loader
    if(isset($oxy_theme_options['site_loader']) && $oxy_theme_options['site_loader'] === 'on') {
        // loader is on so save default colors
        oxy_create_default_colour_css();
    }
}
add_action( 'oxy-options-updated-' . THEME_SHORT . '-general', 'oxy_save_colors_on_loader_active' );


function oxy_update_permalinks() {
    //Ensure the $wp_rewrite global is loaded
    global $wp_rewrite;
    //Call flush_rules() as a method of the $wp_rewrite object
    $wp_rewrite->flush_rules();
}
add_action( 'oxy-options-updated-' . THEME_SHORT . '-post-types', 'oxy_update_permalinks' );

/**
 * Compiles all swatches into mixins and into CSS
 *
 * @return void
 **/
function oxy_compile_swatch_scss( $post_id ) {
    // get swatch mixins & variables
    $swatch_sass = file_get_contents( OXY_THEME_DIR . 'assets/scss/bootstrap/_oxygenna-variables.scss' );
    $swatch_sass .= file_get_contents( OXY_THEME_DIR . 'assets/scss/theme/_compass-mixins.scss' );
    $swatch_sass .= file_get_contents( OXY_THEME_DIR . 'assets/scss/theme/_mixins.scss' );

    $swatches_option = get_option( THEME_SHORT . '-swatch-list', array() );
    $swatches_files = get_option( THEME_SHORT . '-swatch-files', array() );
    // get all swatches
    $swatch = get_post( $post_id );

    // if swatch is enabled
    if( get_post_meta( $swatch->ID, THEME_SHORT . '_status', true ) === 'enabled' ) {
        $swatch_sass .= oxy_create_swatch_scss_mixin( 'swatch-' . $swatch->post_name, 'color-swatch', array(
            get_post_meta( $swatch->ID, THEME_SHORT . '_text', true ),
            get_post_meta( $swatch->ID, THEME_SHORT . '_header', true ),
            get_post_meta( $swatch->ID, THEME_SHORT . '_small', true ),
            get_post_meta( $swatch->ID, THEME_SHORT . '_icon', true ),
            get_post_meta( $swatch->ID, THEME_SHORT . '_link', true ),
            get_post_meta( $swatch->ID, THEME_SHORT . '_link_hover', true ),
            get_post_meta( $swatch->ID, THEME_SHORT . '_link_active', true ),
            get_post_meta( $swatch->ID, THEME_SHORT . '_link_headings', true ),
            get_post_meta( $swatch->ID, THEME_SHORT . '_background', true ),
            get_post_meta( $swatch->ID, THEME_SHORT . '_foreground', true ),
            oxy_calculate_scss_opacity( get_post_meta( $swatch->ID, THEME_SHORT . '_overlay', true ), get_post_meta( $swatch->ID, THEME_SHORT . '_overlay_alpha', true ) ),
            get_post_meta( $swatch->ID, THEME_SHORT . '_form_background', true ),
            get_post_meta( $swatch->ID, THEME_SHORT . '_form_text', true ),
            get_post_meta( $swatch->ID, THEME_SHORT . '_form_active', true ),
            get_post_meta( $swatch->ID, THEME_SHORT . '_primary_button_background', true ),
            get_post_meta( $swatch->ID, THEME_SHORT . '_primary_button_text', true )
        ));

        // compile the sass!!!
        if( !class_exists( 'scssc' ) ) {
            require OXY_THEME_DIR . 'vendor/leafo/scssphp/scss.inc.php';
        }
        $scss = new scssc();
        $scss->setFormatter( 'scss_formatter_compressed' );
        $swatch_css = $scss->compile( $swatch_sass );

        $swatches_option[$swatch->post_name] = $swatch_css;

        // Try to write this generated CSS to a file as well.
        $access_type = get_filesystem_method();
        if($access_type === 'direct') {
            /* you can safely run request_filesystem_credentials() without any issues and don't need to worry about passing in a URL */
            $creds = request_filesystem_credentials(site_url() . '/wp-admin/', '', false, false, array());
            /* initialize the API */
            if ( WP_Filesystem($creds) ) {
                global $wp_filesystem;
                $upload_dir = wp_upload_dir();
                $css_file_name = THEME_SHORT . '-swatch-' . $post_id . '.css';
                if ( $wp_filesystem->is_dir($upload_dir['basedir']) && $wp_filesystem->put_contents( $upload_dir['basedir'].DIRECTORY_SEPARATOR.$css_file_name, $swatch_css, FS_CHMOD_FILE) ) {
                    // index the files using the post id
                    $swatches_files[$post_id] = $css_file_name;
                }
            }
        }
    }
    else {
        unset( $swatches_option[$swatch->post_name] );
        unset( $swatches_files[$post_id] );
    }

    // save the css
    update_option( THEME_SHORT . '-swatch-list', $swatches_option );
    update_option( THEME_SHORT . '-swatch-files', $swatches_files );
}
/**
 * Saves all swatch css to swatch_css option for injecting into all pages
 *
 * @param int $post_id The ID of the swatch post.
 */
function oxy_save_swatch( $post_id ) {
    // If this isn't a 'swatch' post, don't update it.
    if( isset( $_POST['post_type'] ) && 'oxy_swatch' === $_POST['post_type'] ) {
        oxy_compile_swatch_scss( $post_id );
    }
}
add_action( 'save_post', 'oxy_save_swatch', 12 );

function oxy_create_swatch_scss_mixin( $class, $mixin_name, $params ) {
    $mixin = '';
    if( '' != $class ) {
        $mixin .= '.' . $class . ', [class*="swatch-"] .' . $class . ' { ';
    }
    $mixin .= '@include ' . $mixin_name;
    $mixin .= '(' . implode( ',', $params ) . ')';
    if( '' != $class ) {
        $mixin .= '}';
    }
    return $mixin;
}

// remove permalink slug box from swatch edit pages
function oxy_hide_permalink_from_swatch_edit() {
    global $post_type;
    if( $post_type == 'oxy_swatch' ) {
        echo '<style type="text/css">#edit-slug-box,#view-post-btn,#post-preview,.updated p a{display: none;}</style>';
    }
}
add_action('admin_print_styles-post-new.php', 'oxy_hide_permalink_from_swatch_edit');
// Style action for the post editting page
add_action('admin_print_styles-post.php', 'oxy_hide_permalink_from_swatch_edit');


/**
 * Installs default swatch posts
 *
 * @return void
 **/
function oxy_install_default_swatches_ajax() {
    header( 'Content-Type: application/json' );
    $resp = new stdClass();
    $resp->status = 'failed';
    if( isset( $_POST['nonce'] ) ) {
        if( wp_verify_nonce( $_POST['nonce'], 'install-defaults') ) {
            oxy_install_default_swatches();
            $resp->status = 'ok';
        }
    }

    echo json_encode( $resp );
    die();
}
add_action( 'wp_ajax_install_default_swatches', 'oxy_install_default_swatches_ajax' );

/**
 * Installs default swatch posts
 *
 * @return void
 **/
function oxy_save_all_swatches_ajax() {
    header( 'Content-Type: application/json' );
    $resp = new stdClass();
    $resp->status = 'failed';
    if( isset( $_POST['nonce'] ) ) {
        if( wp_verify_nonce( $_POST['nonce'], 'install-defaults') ) {
            $swatches = get_posts( array(
                'post_type'      => 'oxy_swatch',
                'meta_key'       => THEME_SHORT . '_status',
                'meta_value'     => 'enabled',
                'posts_per_page' => '-1'
            ));

            foreach ($swatches as $swatch) {
                oxy_compile_swatch_scss( $swatch->ID );
            }

            $resp->status = 'ok';
        }
    }

    echo json_encode( $resp );
    die();
}
add_action( 'wp_ajax_save_all_swatches', 'oxy_save_all_swatches_ajax' );



/**
 * Installs default swatches
 *
 * @return void
 **/
function oxy_install_default_swatches() {
    // remove old default swatches
    $old_swatches = get_posts( array(
        'post_type'      => 'oxy_swatch',
        'meta_key'       => THEME_SHORT . '_default_swatch',
        'posts_per_page' => '-1'
    ));

    if( null !== $old_swatches ) {
        foreach( $old_swatches as $delete_post ) {
            wp_delete_post( $delete_post->ID );
        }
    }

    $default_swatches = include OXY_THEME_DIR . 'inc/options/swatches/default-swatches.php';
    $swatch_colours = include OXY_THEME_DIR . 'inc/options/swatches/swatch-fields.php';

    foreach( $default_swatches as $class => $swatch ) {
        $new_swatch_id = wp_insert_post( array(
            'post_title'  => $swatch['title'],
            'post_name'   => $class,
            'post_type'   => 'oxy_swatch',
            'post_status' => 'publish'
        ));

        if( $new_swatch_id != 0 ) {
            $i = 0;
            foreach( $swatch_colours as $colour ) {
                add_post_meta( $new_swatch_id, THEME_SHORT . '_' . $colour, $swatch['colours'][$i] );
                $i++;
            }
            add_post_meta( $new_swatch_id, THEME_SHORT . '_default_swatch', true );
            add_post_meta( $new_swatch_id, THEME_SHORT . '_status', $swatch['status'] );
        }
        oxy_compile_swatch_scss( $new_swatch_id );
    }

}

/**
 * Takes a option colour and opacity and returns valid scss
 *
 * @return rgba scss
 **/
function oxy_calculate_scss_opacity( $colour, $opacity ) {
    return 'rgba(' . $colour . ',' . ( $opacity / 100 ) . ')';
}

/**
 * Builds the default css colours for the theme
 *
 * @return void
 **/
function oxy_create_default_colour_css() {
    // get swatch mixins & variables
    $default_sass = file_get_contents( OXY_THEME_DIR . 'assets/scss/bootstrap/_oxygenna-variables.scss' );
    $default_sass .= file_get_contents( OXY_THEME_DIR . 'assets/scss/theme/_compass-mixins.scss' );
    $default_sass .= file_get_contents( OXY_THEME_DIR . 'assets/scss/theme/_mixins.scss' );

    $default_sass .= oxy_create_swatch_scss_mixin( '', 'color-defaults', array(
        // default button
        oxy_get_option( 'default_css_default_button_text' ),
        oxy_get_option( 'default_css_default_button_background' ),
        oxy_get_option( 'default_css_default_button_background_hover' ),
        // warning button
        oxy_get_option( 'default_css_warning_button_text' ),
        oxy_get_option( 'default_css_warning_button_background' ),
        oxy_get_option( 'default_css_warning_button_background_hover' ),
        // danger button
        oxy_get_option( 'default_css_danger_button_text' ),
        oxy_get_option( 'default_css_danger_button_background' ),
        oxy_get_option( 'default_css_danger_button_background_hover' ),
        // success button
        oxy_get_option( 'default_css_success_button_text' ),
        oxy_get_option( 'default_css_success_button_background' ),
        oxy_get_option( 'default_css_success_button_background_hover' ),
        // info button
        oxy_get_option( 'default_css_info_button_text' ),
        oxy_get_option( 'default_css_info_button_background' ),
        oxy_get_option( 'default_css_info_button_background_hover' ),

        // button icons
        oxy_get_option( 'default_css_button_icon' ),
        oxy_calculate_scss_opacity( oxy_get_option( 'default_css_button_icon_background' ), oxy_get_option( 'default_css_button_icon_background_alpha' ) ),
        // overlays
        oxy_get_option( 'default_css_overlay' ),
        oxy_calculate_scss_opacity( oxy_get_option( 'default_css_overlay_background' ), oxy_get_option( 'default_css_overlay_background_alpha' ) ),
        // magnific
        oxy_calculate_scss_opacity( oxy_get_option( 'default_css_magnific_background' ), oxy_get_option( 'default_css_magnific_background_alpha' ) ),
        oxy_get_option( 'default_css_magnific_close_icon' ),
        oxy_get_option( 'default_css_magnific_close_icon_background' ),
        // portfolio
        oxy_get_option( 'default_css_portfolio_hover_text' ),
        oxy_calculate_scss_opacity( oxy_get_option( 'default_css_portfolio_hover_background' ), oxy_get_option( 'default_css_portfolio_hover_background_alpha' ) ),
        oxy_get_option( 'default_css_portfolio_hover_button_icon' ),
        oxy_get_option( 'default_css_portfolio_hover_button_background' ),
        // go to top
        oxy_get_option( 'default_css_gototop_icon' ),
        oxy_calculate_scss_opacity( oxy_get_option( 'default_css_gototop_background' ), oxy_get_option( 'default_css_gototop_background_alpha' ) ),
        // loader colors
        oxy_get_option( 'loader_color' ),
        oxy_get_option( 'loader_bg' )

    ));

    // compile the sass!!!
    if( !class_exists( 'scssc' ) ) {
        require OXY_THEME_DIR . 'vendor/leafo/scssphp/scss.inc.php';
    }

    $scss = new scssc();
    $default_css = $scss->compile( $default_sass );
    // save the css
    update_option( THEME_SHORT . '-default-css', $default_css );
}
add_action( 'oxy-options-updated-' . THEME_SHORT . '-default-colours', 'oxy_create_default_colour_css' );

// fix for http://oxygenna.ticksy.com/ticket/169093
// Removing a param that breaks preview in post types with post formats
function oxy_remove_broken__preview_param($link) {
    $link = preg_replace('~(\?|&)post_format=[^&]*~','$1',$link);
    return $link;
}
add_filter( 'preview_post_link', 'oxy_remove_broken__preview_param' );

function add_custom_mime_types($mimes){
    return array_merge($mimes,array (
        'webm' => 'video/webm',
        'zip'  => 'multipart/x-zip'
    ));
}
add_filter('upload_mimes','add_custom_mime_types');

function oxy_version_update() {
    global $oxy_theme_options;

    $current_version = get_option( THEME_SHORT . '_version' );
    if( false === $current_version || version_compare( '1.12.2', $current_version) > 0 ) {
        // update navigation option if outdated
        switch ($oxy_theme_options['header_type']) {
            case 'default':
            case 'top_bar_fixed':
                $oxy_theme_options['header_type'] = 'navbar-sticky';
                update_option( THEME_SHORT . '-options', $oxy_theme_options );
            break;
            case 'top_bar_static':
                $oxy_theme_options['header_type'] = 'navbar-not-sticky';
                update_option( THEME_SHORT . '-options', $oxy_theme_options );
            break;
        }

        // update navigation css
        oxy_create_logo_css();

        update_option( THEME_SHORT . '_version', '1.12.2' );
    }
}
add_action( 'admin_init', 'oxy_version_update' );

// add default font css to typography
function oxy_default_typography_css( $css ) {
    return 'blockquote p, .section-header p {
  font-weight: 300;
}
.light {
  font-weight: 300 !important;
}
.hairline {
  font-weight: 100 !important;
  strong {
    font-weight: 300;
  }
}
.lead {
  font-weight: 300;
  strong {
    font-weight: 400;
  }
}
#masthead .brand {
  font-weight: 300;
}';
}
add_filter( 'oxy_default_typography_css', 'oxy_default_typography_css' );

// turn off update nag from revolution slider
if( isset( $productAdmin ) ) {
    remove_action('admin_notices', array( $productAdmin, 'addActivateNotification' ) );
}

// Deregistering post types
if ( ! function_exists( 'unregister_post_type' ) ) {

    function unregister_post_type( $post_type ) {
        global $wp_post_types;
        if ( isset( $wp_post_types[ 'vc_grid_item' ] ) ) {
            unset( $wp_post_types[ 'vc_grid_item' ] );
            return true;
        }
        return false;
    }
}

// Remove Grid Elements option page for VC
add_action( 'admin_menu', 'adjust_the_wp_menu', 50 );

function adjust_the_wp_menu() {
    if ( defined('VC_PAGE_MAIN_SLUG') && class_exists('Vc_Grid_Item_Editor') ) {
        remove_submenu_page( VC_PAGE_MAIN_SLUG, 'edit.php?post_type=' . rawurlencode( Vc_Grid_Item_Editor::postType() ) );
    }
}