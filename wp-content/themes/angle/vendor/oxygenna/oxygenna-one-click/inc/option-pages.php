<?php
/**
 * Once Click Installer Option Pages
 *
 * @package Angle
 * @subpackage Admin
 *
 * @copyright (c) 2014 Oxygenna.com
 * @license **LICENSE**
 * @version 1.12.2
 * @author Oxygenna.com
 */

global $oxy_theme;
$oxy_theme->register_option_page(array(
    'page_title' => __('Demo Content Setup', 'angle-admin-td'),
    'menu_title' => __('Demo Content Setup', 'angle-admin-td'),
    'slug'       => THEME_SHORT . '-oneclick',
    'main_menu'  => false,
    'icon'       => 'tools',
    'stylesheets' => array(
        array(
            'handle' => 'one_click_installer',
            'src'    => OXY_ONECLICK_URI . 'assets/stylesheets/one-click-installer.css',
            'deps'   => array( ),
        ),
    ),
    'javascripts' => array(
        array(
            'handle' => 'one_click_installer',
            'src'    => OXY_ONECLICK_URI . 'assets/javascripts/one-click-option-page.js',
            'deps'   => array( 'jquery', 'jquery-ui-progressbar', 'jquery-ui-dialog' ),
            'localize' => array(
                'object_handle' => 'importInfo',
                'data'          => array(
                    'ajaxURL'       => admin_url('admin-ajax.php'),
                    'importNonce'   => wp_create_nonce('oxy-importer'),
                    'themeURL'      => OXY_THEME_URI,
                    'themePackages' => array_reverse(apply_filters('oxy_one_click_import_packages', array()))
                )
            ),
        ),
    ),
    'sections'   => array(
        'oneclick-setup' => array(
            'title'   => __('OneClick Installer', 'angle-admin-td'),
            'header'  => __('Make my site just like the demo site!', 'angle-admin-td'),
            'fields' => array(
                array(
                    'name'        => __('Install Demo Site Content', 'angle-admin-td'),
                    'button-text' => __('Make Me Beautiful', 'angle-admin-td'),
                    'desc'        => __('This button will setup your site to look just like the demo site.', 'angle-admin-td'),
                    'id'          => 'oneclick_setup',
                    'attr'        => array(
                        'class'   => 'one-click'
                    ),
                    'type'        => 'button',
                ),
            )
        )
    )
));
