<?php
/**
 * Creates theme shortcode options
 *
 * @package Angle
 * @subpackage Admin
 * @since 0.1
 *
 * @copyright (c) 2014 Oxygenna.com
 * @license **LICENSE**
 * @version 1.12.2
 */

global $oxy_theme;
if( isset( $oxy_theme ) ) {
    $shortcode_options = include OXY_THEME_DIR . 'inc/options/shortcodes/shortcode-options.php';
    // add options to accordion shortcode
    foreach( $shortcode_options as &$shortcode ) {
        if( isset($shortcode['shortcode']) && $shortcode['shortcode'] == 'socialicons') {
            for( $i = 0 ; $i < 10 ; $i++ ) {
                $shortcode['sections'][0]['fields'][] =  array(
                    'name'    => sprintf( __('Social Icon %s', 'angle-admin-td'), $i+1 ),
                    'id'      => sprintf( __('social_icon_%s', 'angle-admin-td'), $i+1 ),
                    'type'    => 'select',
                    'options' => 'social_icons',
                    'default' => '',
                    'blank'   => __('Choose a social network icon', 'angle-admin-td'),
                    'attr'    =>  array(
                        'class'    => 'widefat',
                    ),
                );
                $shortcode['sections'][0]['fields'][] =  array(
                    'name'    => sprintf( __('Social Icon %s URL', 'angle-admin-td'), $i+1 ),
                    'id'      => sprintf( __('social_icon_%s_url', 'angle-admin-td'), $i+1 ),
                    'type'    => 'text',
                    'default' => '',
                    'attr'    =>  array(
                        'class'    => 'widefat',
                    ),
                );
            }
        }
    }

    $oxy_theme->register_shortcode_options($shortcode_options);
}