<?php
/**
 * Adds theme specific filters for one click installer module
 *
 * @package Angle
 * @subpackage Admin
 *
 * @copyright (c) 2014 Oxygenna.com
 * @license **LICENSE**
 * @version 1.12.2
 * @author Oxygenna.com
 */

function oxy_one_click_post( $post, $one_click ) {
    @error_reporting(0); // Don't break the JSON result

    // create post object
    $post_object = new stdClass();
    // strip slashes added by json
    $post_object->post_content = stripslashes($post['post_content']);

    $gallery_shortcode = oxy_get_content_shortcode($post_object, 'gallery');
    if ($gallery_shortcode !== null) {
        if (isset($gallery_shortcode[0])) {
            // show gallery
            $gallery_ids = null;
            if (array_key_exists(3, $gallery_shortcode)) {
                if (array_key_exists(0, $gallery_shortcode[3])) {
                    $gallery_attrs = shortcode_parse_atts($gallery_shortcode[3][0]);
                    if (array_key_exists('ids', $gallery_attrs)) {
                        // we have a gallery with ids so lets replace the ids
                        $gallery_ids = explode(',', $gallery_attrs['ids']);
                        $new_gallery_ids = array();
                        foreach ($gallery_ids as $gallery_id) {
                            $new_gallery_ids[] = $one_click->lookup_map('attachments', $gallery_id);
                        }
                        // replace old ids with new ones
                        $old_string = 'ids="' . implode(',', $gallery_ids) . '"';
                        $new_string = 'ids="' . implode(',', $new_gallery_ids) . '"';
                        $post_object->post_content = str_replace($old_string, $new_string, $post_object->post_content);
                    }
                }
            }
        }
    }

    include OXY_THEME_DIR . 'vendor/oxygenna/oxygenna-one-click/inc/simple_html_dom.php';

    if (!empty($post_object->post_content)) {
        $html = str_get_html($post_object->post_content);
        $imgs = $html->find('img');
        foreach ($imgs as $img) {
            $replace_image_src = $one_click->lookup_map('images', $img->src);
            if (false !== $replace_image_src) {
                $img->src = $replace_image_src;
            }
        }
        $post_object->post_content = $html->save();

        $post_object->post_content = $one_click->replace_shortcode_attachment_id($post_object->post_content, 'vc_single_image', 'images', 'attachments');
        $post_object->post_content = $one_click->replace_shortcode_attachment_id($post_object->post_content, 'vc_row', 'background_image', 'attachments');
        $post_object->post_content = $one_click->replace_shortcode_attachment_id($post_object->post_content, 'shapedimage', 'images', 'attachments');
        $post_object->post_content = $one_click->replace_shortcode_attachment_id($post_object->post_content, 'staff_featured', 'member', 'oxy_staff');

    }

    // replace post content with one from object
    $post['post_content'] = $post_object->post_content;

    return $post;
}
add_filter( 'oxy_one_click_post', 'oxy_one_click_post', 10, 2 );

function oxy_filter_import_menu_item( $new_menu_item, $menu_item, $one_click ) {
    switch ($menu_item['type']) {
        case 'post_type':
        case 'taxonomy':
            switch($menu_item['object']) {
                case 'oxy_mega_menu':
                    $mega_menu = get_page_by_title( 'Mega Menu', 'OBJECT', 'oxy_mega_menu' );
                    $new_menu_item['menu-item-object-id'] = $mega_menu->ID;
                    break;
                case 'oxy_mega_columns':
                    $columns = get_posts(array(
                        'post_type' => 'oxy_mega_columns'
                    ));
                    foreach ($columns as $column) {
                        if ($column->post_content === $menu_item['post_content']) {
                            $new_menu_item['menu-item-object-id'] = $column->ID;
                        }
                    }
                    break;
                default:
                    $new_id = $one_click->lookup_map($menu_item['object'], $menu_item['object_id']);
                    if ($new_id !== false) {
                        $new_menu_item['menu-item-object-id'] = $new_id;
                    }
                    break;
            }
            break;
        case 'custom':
        default:
            // do nothing
            break;
    }
    return $new_menu_item;
}
add_filter( 'oxy_one_click_import_menu_item', 'oxy_filter_import_menu_item', 10, 3 );

function oxy_filter_import_packages( $packages ) {
    return array(
        array(
            'name'         => __('Main Demo Content', 'angle-admin-td'),
            'type'         => 'oxygenna',
            'filename'     => 'import.js',
            'description'  => __('Installs all the demo blog posts, pages and images that you see on the demo site.', 'angle-admin-td'),
            'requirements' => array(
                'revslider/revslider.php' => __('Revolution Slider Plugin', 'angle-admin-td'),
                'js_composer/js_composer.php' => __('Visual Composer Plugin', 'angle-admin-td'),
            ),
        ),
        array(
            'name'         => __('WooCommerce Shop Content', 'angle-admin-td'),
            'type'         => 'oxygenna',
            'filename'     => 'woocommerce.js',
            'description'  => __('Installs all the woocommerce products and shop pages that you see on the demo site.', 'angle-admin-td'),
            'requirements' => array(
                'woocommerce/woocommerce.php' => __('WooCommerce Plugin', 'angle-admin-td'),
            ),
        ),
    );
}
add_filter( 'oxy_one_click_import_packages', 'oxy_filter_import_packages', 10, 1 );

function oxy_one_click_export_slideshows( $package_file ) {
    switch( $package_file ) {
        case 'import.json':
            $slideshows = array(
                array(
                    'type'     => 'revslider',
                    'filename' => 'home.zip',
                    'url'      => 'http://one-click-import.s3.amazonaws.com/angle/revslider/home.zip'
                )
            );
        break;
        case 'woocommerce.json':
            $slideshows = array();
        break;
    }

    return $slideshows;
}
add_filter( 'oxy_one_click_export_slideshows', 'oxy_one_click_export_slideshows' );


function oxy_one_click_import_download_url( $filename ) {
    return 'http://one-click-import.s3.amazonaws.com/angle/images/' . $filename;
}
add_filter( 'oxy_one_click_import_download_url', 'oxy_one_click_import_download_url', 10, 1 );

function oxy_one_clicl_theme_docs_url( $url ) {
    return 'http://omegadocs.oxygenna.com';
}
add_filter( 'oxy_one_clicl_theme_docs_url', 'oxy_one_clicl_theme_docs_url', 10, 1 );


//  filter out all revslider and layerslider images from export
function oxy_one_click_export_main_content_attachments( $attachments ) {
    $slideshows = apply_filters('oxy_one_click_export_slideshows', 'import.json');
    $ignore_files = array();
    foreach ($slideshows as $slideshow) {
        // get the zip file
        $zip = new ZipArchive();
        $zip->open(OXY_THEME_DIR . $slideshow['filename']);
        // cycle through each file / dir
        for ($i = 0; $i < $zip->numFiles; $i++) {
            // get the status so we can check if dir (size==0)
            $status = $zip->statIndex($i);
            // only interested in files
            if( $status['size'] > 0 ) {
                // get the filename
                $filename = $zip->getNameIndex($i);
                $pathinfo = pathinfo($filename);
                if( strpos($pathinfo['dirname'], '/uploads') ) {
                    $ignore_files[] = $pathinfo['filename'] . '.' . $pathinfo['extension'];
                }
            }
        }
    }
    $new_attachments = array();
    foreach ( $attachments as $attachment ) {
        $filename = basename(get_attached_file($attachment->ID));
        $ignore_this = false;
        foreach ( $ignore_files as $ignore_file ) {
            if( $filename === $ignore_file ) {
                $ignore_this = true;
                break;
            }
        }

        // do we want to add this one?
        if( !$ignore_this ) {
            $new_attachments[] = $attachment;
        }
    }

    return $new_attachments;
}
add_filter( 'oxy_one_click_export_main_content_attachments', 'oxy_one_click_export_main_content_attachments', 10, 1 );
