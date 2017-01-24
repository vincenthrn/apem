<?php
/**
 * Options for BBPres
 *
 * @package Angle
 * @subpackage Admin
 * @since 0.1
 *
 * @copyright (c) 2014 Oxygenna.com
 * @license **LICENSE**
 * @version 1.12.2
 */
$extra_bb_press_header_options = array(     
    array(
        'name'    => __('Header Height', 'angle-admin-td'),
        'desc'    => __('Choose the amount of padding added to the height of the header', 'angle-admin-td'),
        'id'      => 'bbpress_header_header_height',
        'type'    => 'select',
        'options' => array(
            'normal'     => __('Normal', 'angle-admin-td'),
            'short'      => __('Short', 'angle-admin-td'),
            'tiny'       => __('Tiny', 'angle-admin-td'),
            'nopadding' => __('No Padding', 'angle-admin-td'),
        ),
        'default' => 'normal',
    ),
    array(
        'name'    => __('Header Swatch', 'angle-admin-td'),
        'desc'    => __('Select the colour scheme to use for the header on this page.', 'angle-admin-td'),
        'id'      => 'bbpress_header_header_swatch',
        'type' => 'select',
        'default' => 'swatch-red-white',
        'options' => include OXY_THEME_DIR . 'inc/options/shortcodes/shortcode-swatches-options.php'
    )
);
$bbpress_header_options = include OXY_THEME_DIR . 'inc/options/global-options/section-header-text.php';
$bbpress_header_section_options = include OXY_THEME_DIR . 'inc/options/global-options/section-background-image.php';

// remove header text
unset($bbpress_header_options[0]);
unset($bbpress_header_options[1]);

// set defaults for blog heading and section
$bbpress_header_options[2]['default'] = 'super';
$bbpress_header_options[3]['default'] = 'light';

global $oxy_theme;
$oxy_theme->register_option_page(array(
    'menu_title' => __('BBPress', 'angle-admin-td'),
    'page_title' => __('BBPress Theme Settings', 'angle-admin-td'),
    'slug'       => THEME_SHORT . '-bbpress',
    'main_menu'  => false,
    'icon'       => 'tools',
    'sections'   => array(
        'bbpress-general' => array(
            'title'   => __('General BBPress Options', 'angle-admin-td'),
            'header'  => __('', 'angle-admin-td'),
            'fields' => array(
                array(
                    'name'    => __('BBPress Page Style', 'angle-admin-td'),
                    'desc'    => __('Select a layout style to use for your blog pages.', 'angle-admin-td'),
                    'id'      => 'bbpress_style',                    
                    'default' => 'right',
                    'type'    => 'radio',
                    'options' => array(
                        'right'     => __('Right Sidebar', 'angle-admin-td'),
                        'left'      => __('Left Sidebar', 'angle-admin-td'),
                        'fullwidth' => __('Full Width', 'angle-admin-td'),
                        
                    ),
                    'default' => 'right',
                ),
                array(
                    'name'    => __('BBPres Swatch', 'angle-admin-td'),
                    'desc'    => __('Choose a color swatch for the BBPress pages', 'angle-admin-td'),
                    'id'      => 'bbpress_swatch',
                    'type'    => 'select',
                    'default' => 'swatch-white',
                    'options' => include OXY_THEME_DIR . 'inc/options/shortcodes/shortcode-swatches-options.php'
                ),
            )
        ),
        'bbpress-header-text' => array(
            'title'   => __('BBPress Header Titles', 'angle-admin-td'),
            'header'  => __('Change the text for some of your BBPress page headings.', 'angle-admin-td'),
            'fields'  => array(
                array(
                    'name' => __('Forums Title', 'angle-admin-td'),
                    'desc' => __('Title that is shown on the main forums archive page.', 'angle-admin-td'),
                    'id'   => 'bbpress_header_forums',
                    'type' => 'text',
                    'default' => __('Forums', 'angle-admin-td')
                ),
                array(
                    'name' => __('Topics Title', 'angle-admin-td'),
                    'desc' => __('Title that is shown on the main topics archive page.', 'angle-admin-td'),
                    'id'   => 'bbpress_header_topics',
                    'type' => 'text',
                    'default' => __('Topics', 'angle-admin-td')
                )
            )
        ),
        'bbpress-header-options' => array(
            'title'   => __('BBPress Header Options', 'angle-admin-td'),
            'header'  => __('Change how your BBPress headers look.', 'angle-admin-td'),
            'fields'  => array_merge(
                array(
                    array(
                        'name' => __('Show Header', 'angle-admin-td'),
                        'desc' => __('Show or hide the header at the top of the page.', 'angle-admin-td'),
                        'id'   => 'bbpress_header_show_header',
                        'type' => 'select',
                        'default' => 'show',
                        'options' => array(
                            'hide' => __('Hide', 'angle-admin-td'),
                            'show' => __('Show', 'angle-admin-td'),
                        ),
                    ),                    
                ),               
                array(
                    array(
                        'name' => __('Show Breadcrumbs', 'angle-admin-td'),
                        'desc' => __('Show or hide the breadcrumbs in the header', 'angle-admin-td'),
                        'id'   => 'bbpress_header_show_breadcrumbs',
                        'type' => 'select',
                        'default' => 'show',
                        'options' => array(
                            'hide' => __('Hide', 'angle-admin-td'),
                            'show' => __('Show', 'angle-admin-td'),
                        ),
                    )
                )
            )
        ),
        'bbpress-header-heading' => array(
            'title'   => __('BBPress Header Heading', 'angle-admin-td'),
            'header'  => __('Change the text of your BBPress heading here.', 'angle-admin-td'),
            'fields'  => array_merge( $extra_bb_press_header_options, oxy_prefix_options_id( 'bbpress_header', $bbpress_header_options )),
        ),
        'bbpress-header-section' => array(
            'title'   => __('BBPress Header Section', 'angle-admin-td'),
            'header'  => __('Change the appearance of your BBPress header section.', 'angle-admin-td'),
            'fields'  => oxy_prefix_options_id( 'bbpress_header', $bbpress_header_section_options )
        ),
    )
));
