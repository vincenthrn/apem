<?php
/**
 * Stores options for themes quick uploaders
 *
 * @package Angle
 * @subpackage Admin
 * @since 0.1
 *
 * @copyright (c) 2014 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.12.2
 */

return array(
    // slideshoe quick upload
    'oxy_slideshow_image' => array(
        'menu_title' => __('Quick Slideshow', 'angle-admin-td'),
        'page_title' => __('Quick Slideshow Creator', 'angle-admin-td'),
        'item_singular'  => __('Slideshow Image', 'angle-admin-td'),
        'item_plural'  => __('Slideshow Images', 'angle-admin-td'),
        'taxonomies' => array(
            'oxy_slideshow_categories'
        )
    ),
    // services quick upload
    'oxy_service' => array(
        'menu_title' => __('Quick Services', 'angle-admin-td'),
        'page_title' => __('Quick Services Creator', 'angle-admin-td'),
        'item_singular'  => __('Services', 'angle-admin-td'),
        'item_plural'  => __('Service', 'angle-admin-td'),
        'show_editor' => true,
    ),
    // portfolio quick upload
    'oxy_portfolio_image' => array(
        'menu_title' => __('Quick Portfolio', 'angle-admin-td'),
        'page_title' => __('Quick Portfolio Creator', 'angle-admin-td'),
        'item_singular'  => __('Portfolio Image', 'angle-admin-td'),
        'item_plural'  => __('Portfolio Images', 'angle-admin-td'),
        'show_editor' => true,
        'taxonomies' => array(
            'oxy_portfolio_categories'
        )
    ),
    // staff quick upload
    'oxy_staff' => array(
        'menu_title' => __('Quick Staff', 'angle-admin-td'),
        'page_title' => __('Quick Staff Creator', 'angle-admin-td'),
        'item_singular'  => __('Staff Member', 'angle-admin-td'),
        'item_plural'  => __('Staff', 'angle-admin-td'),
        'show_editor' => true,
        'taxonomies' => array(
            'oxy_staff_skills'
        )
    )
);