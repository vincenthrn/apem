<?php
/**
 * Registers all theme option pages
 *
 * @package Angle
 * @subpackage Admin
 * @since 0.1
 *
 * @copyright (c) 2014 Oxygenna.com
 * @license **LICENSE**
 * @version 1.12.2
 */

// setup blog header options
$blog_extra_header_options = array(
     array(
        'name' => __('Show Header', 'angle-admin-td'),
        'desc' => __('Show or hide the header.', 'angle-admin-td'),
        'id'   => 'show_header',
        'type' => 'select',
        'default' => 'show',
        'options' => array(
            'hide' => __('Hide', 'angle-admin-td'),
            'show' => __('Show', 'angle-admin-td'),
        ),
    ),
    array(
        'name'    => __('Header Height', 'angle-admin-td'),
        'desc'    => __('Choose the amount of padding added to the height of the header', 'angle-admin-td'),
        'id'      => 'height',
        'type'    => 'select',
        'options' => array(
            'normal'     => __('Normal', 'angle-admin-td'),
            'short'      => __('Short', 'angle-admin-td'),
            'tiny'       => __('Tiny', 'angle-admin-td'),
            'nopadding' => __('No Padding', 'angle-admin-td'),
        ),
        'default' => 'normal',
    ),
);
$blog_header_options = include OXY_THEME_DIR . 'inc/options/global-options/section-header-text.php';
$blog_header_background_options = include OXY_THEME_DIR . 'inc/options/global-options/section-background-image.php';
// change defaults
$blog_header_options[0]['default'] = __('Blog', 'angle-admin-td');
$blog_header_options[1]['default'] = __('Latest News and Updates', 'angle-admin-td');

global $oxy_theme;
if( isset($oxy_theme) ) {
    $oxy_theme->register_option_page( array(
        'page_title' => __('General', 'angle-admin-td'),
        'menu_title' => __('General', 'angle-admin-td'),
        'slug'       => THEME_SHORT . '-general',
        'main_menu'  => true,
        'main_menu_title' => THEME_NAME,
        'main_menu_icon'  => 'dashicons-marker',
        'icon'       => 'tools',
        // 'javascripts' => array(
        //     array(
        //         'handle' => 'header_options_script',
        //         'src'    => OXY_THEME_URI . 'inc/options/javascripts/pages/header-options.js',
        //         'deps'   => array( 'jquery'),
        //         'localize' => array(
        //             'object_handle' => 'theme',
        //             'data'          => THEME_SHORT
        //         ),
        //     ),
        // ),
        'sections'   => array(
            'logo-section' => array(
                'title'   => __('Logo', 'angle-admin-td'),
                'header'  => __('These options allow you to configure the site logo, you can select a logo type and then create a text logo, image logo or both image and text.  There is also an option to use retina sized images.', 'angle-admin-td'),
                'fields' => array(
                    array(
                        'name'    => __('Logo Text', 'angle-admin-td'),
                        'desc'    => __('Add your logo text here works with Logo Type (Text, Text & Image)', 'angle-admin-td'),
                        'id'      => 'logo_text',
                        'type'    => 'text',
                        'default' => 'Angle',
                    ),
                    array(
                        'name'    => __('Logo Image', 'angle-admin-td'),
                        'desc'    => __('Upload a logo for your site, works with Logo Type (Image, Text & Image)', 'angle-admin-td'),
                        'id'      => 'logo_image',
                        'store'   => 'url',
                        'type'    => 'upload',
                        'default' => OXY_THEME_URI . 'assets/images/logo.png',
                    ),
                )
            ),
            'loader-section' => array(
                'title'  => __('Page Loader', 'angle-admin-td'),
                'header' => __('Toggle an animation when each page loads.', 'angle-admin-td'),
                'fields' => array(
                    array(
                        'name'      => __('Loading Animation', 'angle-admin-td'),
                        'desc'      => __('Show a loader whenever a page is loaded', 'angle-admin-td'),
                        'id'        => 'site_loader',
                        'type'      => 'radio',
                        'options'   => array(
                            'on'    => __('Enable', 'angle-admin-td'),
                            'off'   => __('Disable', 'angle-admin-td'),
                        ),
                        'default'   => 'off',
                    ),
                    array(
                        'name'    => __('Page Loader Style', 'angle-admin-td'),
                        'desc'    => __('Choose a style of page loader to show at the start of loading a page', 'angle-admin-td'),
                        'id'      => 'site_loader_style',
                        'type'    => 'radio',
                        'options' => array(
                            'dot'     => __('Dot', 'angle-admin-td'),
                            'minimal' => __('Minimal', 'angle-admin-td'),
                            'counter' => __('Counter', 'angle-admin-td'),
                        ),
                        'default' => 'minimal',
                    )
                )
            ),
            'header-section' => array(
                'title'   => __('Header Options', 'angle-admin-td'),
                'header'  => __('This section will allow you to setup your site header.  You can choose from three different types of header to use on your site, and adjust the header height to allow room for your logo.', 'angle-admin-td'),
                'fields' => array(
                    array(
                        'name'    => __('Header Type', 'angle-admin-td'),
                        'desc'    => __("Sets the type of header to use at the top of your site and its behaviour.", 'angle-admin-td'),
                        'id'      => 'header_type',
                        'type'    => 'select',
                        'options' => array(
                            'navbar-sticky'     => __('Nav Bar Fixed - Navigation bar that scrolls with the page.', 'angle-admin-td'),
                            'navbar-not-sticky' => __('Nav Bar Static - Navigation bar with regular scrolling.', 'angle-admin-td'),
                        ),
                        'default' => 'navbar-sticky',
                    ),
                    array(
                        'name'      => __('Menu Height', 'angle-admin-td'),
                        'desc'      => __('Use this slider to adjust the menu height.  Ideal if you want to adjust the height to fit your logo.', 'angle-admin-td'),
                        'id'        => 'navbar_height',
                        'type'      => 'slider',
                        'default'   => 90,
                        'attr'      => array(
                            'max'       => 300,
                            'min'       => 24,
                            'step'      => 1
                        )
                    ),
                     array(
                        'name'      => __('Menu Change Scroll Point', 'angle-admin-td'),
                        'desc'      => __('Point in pixels after the page scrolls that will trigger the menu to change shape / colour.', 'angle-admin-td'),
                        'id'        => 'navbar_scrolled_point',
                        'type'      => 'slider',
                        'default'   => 200,
                        'attr'      => array(
                            'max'       => 1000,
                            'min'       => 0,
                            'step'      => 1
                        )
                    ),
                    array(
                        'name'      => __('Menu Height After Scroll', 'angle-admin-td'),
                        'desc'      => __('Use this slider to adjust the menu height after menu has scrolled.', 'angle-admin-td'),
                        'id'        => 'navbar_scrolled',
                        'type'      => 'slider',
                        'default'   => 70,
                        'attr'      => array(
                            'max'       => 300,
                            'min'       => 24,
                            'step'      => 1
                        )
                    ),
                    array(
                        'name'    => __('Hover Menu', 'angle-admin-td'),
                        'desc'    => __('Choose between menu that will open when you click or hover (desktop only option since mobile devices will always use touch)', 'angle-admin-td'),
                        'id'      => 'hover_menu',
                        'type'    => 'radio',
                        'options' => array(
                            'off'  => __('Click', 'angle-admin-td'),
                            'on'     => __('Hover', 'angle-admin-td'),
                        ),
                        'default' => 'off',
                    ),
                    array(
                        'name'    => __('Hover Menu Delay', 'angle-admin-td'),
                        'desc'    => __('Delay in seconds before the hover menu closes after moving mouse off the menu.', 'angle-admin-td'),
                        'id'      => 'hover_menu_delay',
                        'type'      => 'slider',
                        'default'   => 200,
                        'attr'      => array(
                            'max'       => 1000,
                            'min'       => 0,
                            'step'      => 1
                        )
                    ),
                    array(
                        'name'    => __('Hover Menu Fade Delay', 'angle-admin-td'),
                        'desc'    => __('Delay of the Fade In/Fade Out animation .', 'angle-admin-td'),
                        'id'      => 'hover_menu_fade_delay',
                        'type'      => 'slider',
                        'default'   => 200,
                        'attr'      => array(
                            'max'       => 1000,
                            'min'       => 0,
                            'step'      => 1
                        )
                    ),
                    array(
                        'name'    => __('Header Swatch', 'angle-admin-td'),
                        'desc'    => __('Choose a color swatch for the header', 'angle-admin-td'),
                        'id'      => 'header_swatch',
                        'type'    => 'select',
                        'default' => 'swatch-red-white',
                        'options' => include OXY_THEME_DIR . 'inc/options/shortcodes/shortcode-swatches-options.php'
                    ),
                    array(
                        'name'      => __('Dropdown Menu Width', 'angle-admin-td'),
                        'desc'      => __('Use this slider to adjust the dropdown width.  ', 'angle-admin-td'),
                        'id'        => 'dropdown_width',
                        'type'      => 'slider',
                        'default'   => 200,
                        'attr'      => array(
                            'max'       => 300,
                            'min'       => 200,
                            'step'      => 10
                        )
                    ),

                    array(
                        'name'    => __('Top Bar Swatch', 'angle-admin-td'),
                        'desc'    => __('Choose a color swatch for the Top Bar when you have a Header Type Top Bar or Combo', 'angle-admin-td'),
                        'id'      => 'top_bar_swatch',
                        'type'    => 'select',
                        'default' => 'swatch-red-white',
                        'options' => include OXY_THEME_DIR . 'inc/options/shortcodes/shortcode-swatches-options.php'
                    ),
                    array(
                        'name'    => __('Capitalization', 'angle-admin-td'),
                        'desc'    => __('Enable-disable automatic capitalization in header logo and menus', 'angle-admin-td'),
                        'id'      => 'header_capitalization',
                        'type'    => 'select',
                        'options' => array(
                            'on'          => __('Uppercase', 'angle-admin-td'),
                            'lowercase'   => __('Lowercase', 'angle-admin-td'),
                            'capitalize'  => __('Capitalize', 'angle-admin-td'),
                            'off'         => __('None', 'angle-admin-td'),
                        ),
                        'default' => 'on',
                    ),
                )
            ),
            'layout-options' => array(
                'title'   => __('Layout Options', 'angle-admin-td'),
                'header'  => __('This section will allow you to setup the layout of your site.', 'angle-admin-td'),
                'fields' => array(
                    array(
                         'name'    => __('Layout Type', 'angle-admin-td'),
                         'desc'    => __('Sets the site layout (Normal - site will use all the width of the page, Boxed - Site will be surrounded by a background )', 'angle-admin-td'),
                         'id'      => 'layout_type',
                         'type'    => 'radio',
                         'options' => array(
                            'normal' => __('Normal', 'angle-admin-td'),
                            'boxed'  => __('Boxed', 'angle-admin-td'),
                        ),
                        'default' => 'normal',
                    )
                )
            ),
            'upper-footer-section' => array(
                'title'   => __('Upper Footer', 'angle-admin-td'),
                'header'  => __('This footer is above the bottom footer of your site.  Here you can set the footer to use 1-4 columns, you can add Widgets to your footer in the Appearance -> Widgets page', 'angle-admin-td'),
                'fields' => array(
                    array(
                        'name'    => __('Upper Footer Columns', 'angle-admin-td'),
                        'desc'    => __('Select how many columns will the upper footer consist of.', 'angle-admin-td'),
                        'id'      => 'upper_footer_columns',
                        'type'    => 'radio',
                        'options' => array(
                            1  => __('1', 'angle-admin-td'),
                            2  => __('2', 'angle-admin-td'),
                            3  => __('3', 'angle-admin-td'),
                            4  => __('4', 'angle-admin-td'),
                        ),
                        'default' => 2,
                    ),
                    array(
                        'name'    => __('Upper Footer Swatch', 'angle-admin-td'),
                        'desc'    => __('Choose a color swatch for the upper footer', 'angle-admin-td'),
                        'id'      => 'upper_footer_swatch',
                        'type'    => 'select',
                        'default' => 'swatch-red-white',
                        'options' => include OXY_THEME_DIR . 'inc/options/shortcodes/shortcode-swatches-options.php'
                    ),
                    array(
                        'name'    => __('Upper Footer Decoration', 'angle-admin-td'),
                        'desc'    => __('Choose a style to use as the Upper Footer decoration.', 'angle-admin-td'),
                        'id'      => 'upper_decoration',
                        'type'    => 'select',
                        'default' => 'none',
                        'options' => include OXY_THEME_DIR . 'inc/options/global-options/section-decorations.php',
                    ),
                    array(
                        'name'    => __('Upper Footer Height', 'angle-admin-td'),
                        'desc'    => __('Choose the amount of padding added to the height of the Upper Footer', 'angle-admin-td'),
                        'id'      => 'upper_footer_height',
                        'type'    => 'select',
                        'options' => array(
                            'normal' => __('Normal', 'angle-admin-td'),
                            'short'  => __('Short', 'angle-admin-td'),
                            'tiny'   => __('Tiny', 'angle-admin-td'),
                        ),
                        'default' => 'normal',
                    )
                )
            ),
            'footer-section' => array(
                'title'   => __('Footer', 'angle-admin-td'),
                'header'  => __('The footer is the bottom bar of your site.  Here you can set the footer to use 1-4 columns, you can add Widgets to your footer in the Appearance -> Widgets page', 'angle-admin-td'),
                'fields' => array(
                    array(
                        'name'    => __('Footer Columns', 'angle-admin-td'),
                        'desc'    => __('Select how many columns will the footer consist of.', 'angle-admin-td'),
                        'id'      => 'footer_columns',
                        'type'    => 'radio',
                        'options' => array(
                            1  => __('1', 'angle-admin-td'),
                            2  => __('2', 'angle-admin-td'),
                            3  => __('3', 'angle-admin-td'),
                            4  => __('4', 'angle-admin-td'),
                        ),
                        'default' => 2,
                    ),
                    array(
                        'name'    => __('Footer Swatch', 'angle-admin-td'),
                        'desc'    => __('Choose a color swatch for the footer', 'angle-admin-td'),
                        'id'      => 'footer_swatch',
                        'type'    => 'select',
                        'default' => 'swatch-red-white',
                        'options' => include OXY_THEME_DIR . 'inc/options/shortcodes/shortcode-swatches-options.php'
                    ),
                    array(
                        'name'    => __('Footer Decoration', 'angle-admin-td'),
                        'desc'    => __('Choose a style to use as the Footer decoration.', 'angle-admin-td'),
                        'id'      => 'footer_decoration',
                        'type'    => 'select',
                        'default' => 'none',
                        'options' => include OXY_THEME_DIR . 'inc/options/global-options/section-decorations.php',
                    ),
                    array(
                        'name'    => __('Footer Height', 'angle-admin-td'),
                        'desc'    => __('Choose the amount of padding added to the height of the Footer', 'angle-admin-td'),
                        'id'      => 'footer_height',
                        'type'    => 'select',
                        'options' => array(
                            'normal' => __('Normal', 'angle-admin-td'),
                            'short'  => __('Short', 'angle-admin-td'),
                            'tiny'   => __('Tiny', 'angle-admin-td'),
                        ),
                        'default' => 'normal',
                    ),
                    array(
                        'name'    => __('Back to top', 'angle-admin-td'),
                        'desc'    => __('Enable the back-to-top button', 'angle-admin-td'),
                        'id'      => 'back_to_top',
                        'type'    => 'radio',
                        'options' => array(
                            'enable'  => __('Enable', 'angle-admin-td'),
                            'disable'  => __('Disable', 'angle-admin-td'),
                        ),
                        'default' => 'enable',
                    ),
                )
            ),
        )
    ));
    $oxy_theme->register_option_page( array(
        'page_title' => __('Blog', 'angle-admin-td'),
        'menu_title' => __('Blog', 'angle-admin-td'),
        'slug'       => THEME_SHORT . '-blog',
        'main_menu'  => false,
        'icon'       => 'tools',
        'sections'   => array(
            'blog-header-section' => array(
                'title'   => __('Blog Header Options', 'angle-admin-td'),
                'header'  => __('Change how your blog header looks.', 'angle-admin-td'),
                'fields' => array_merge( $blog_extra_header_options, $blog_header_options, $blog_header_background_options )
            ),
            'blog-section' => array(
                'title'   => __('General Blog Options', 'angle-admin-td'),
                'header'  => __('Here you can setup the blog options that are used on all the main blog list pages', 'angle-admin-td'),
                'fields' => array(
                    array(
                        'name'    => __('Blog Layout', 'angle-admin-td'),
                        'desc'    => __('Layout of your blog page. Choose right sidebar, left sidebar, fullwidth layout', 'angle-admin-td'),
                        'id'      => 'blog_layout',
                        'type'    => 'radio',
                        'options' => array(
                            'sidebar-right' => __('Right Sidebar', 'angle-admin-td'),
                            'full-width'    => __('Full Width', 'angle-admin-td'),
                            'sidebar-left'  => __('Left Sidebar', 'angle-admin-td'),
                        ),
                        'default' => 'sidebar-right',
                    ),
                    array(
                        'name'    => __('Post Icons', 'angle-admin-td'),
                        'desc'    => __('Toggle post icons on/off in post', 'angle-admin-td'),
                        'id'      => 'blog_post_icons',
                        'type'    => 'radio',
                        'options' => array(
                            'on'   => __('On', 'angle-admin-td'),
                            'off'  => __('Off', 'angle-admin-td'),
                        ),
                        'default' => 'on',
                    ),
                    array(
                        'name'    => __('Show Comments On', 'angle-admin-td'),
                        'desc'    => __('Where to allow comments. All (show all), Pages (only on pages), Posts (only on posts), Off (all comments are off)', 'angle-admin-td'),
                        'id'      => 'site_comments',
                        'type'    => 'radio',
                        'options' => array(
                            'all'   => __('All', 'angle-admin-td'),
                            'pages' => __('Pages', 'angle-admin-td'),
                            'posts' => __('Posts', 'angle-admin-td'),
                            'Off'   => __('Off', 'angle-admin-td')
                        ),
                        'default' => 'posts',
                    ),
                    array(
                        'name'    => __('Show Read More', 'angle-admin-td'),
                        'desc'    => __('Show or hide the readmore link in list view', 'angle-admin-td'),
                        'id'      => 'blog_show_readmore',
                        'type'    => 'radio',
                        'options' => array(
                            'on'   => __('On', 'angle-admin-td'),
                            'off'  => __('Off', 'angle-admin-td'),
                        ),
                        'default' => 'on',
                    ),
                    array(
                        'name' => __('Blog read more link', 'angle-admin-td'),
                        'desc' => __('The text that will be used for your read more links', 'angle-admin-td'),
                        'id' => 'blog_readmore',
                        'type' => 'text',
                        'default' => 'read more',
                    ),
                    array(
                        'name'    => __('Strip teaser', 'angle-admin-td'),
                        'desc'    => __('Strip the content before the <--more--> tag in single post view', 'angle-admin-td'),
                        'id'      => 'blog_stripteaser',
                        'type'    => 'radio',
                        'options' => array(
                            'on'   => __('On', 'angle-admin-td'),
                            'off'  => __('Off', 'angle-admin-td'),
                        ),
                        'default' => 'off',
                    ),
                    array(
                        'name'    => __('Pagination Style', 'angle-admin-td'),
                        'desc'    => __('How your pagination will be shown', 'angle-admin-td'),
                        'id'      => 'blog_pagination',
                        'type'    => 'radio',
                        'options' => array(
                            'pages'     => __('Pages', 'angle-admin-td'),
                            'next_prev' => __('Next & Previous', 'angle-admin-td'),
                        ),
                        'default' => 'pages',
                    ),
                )
            ),
            'blog-single-section' => array(
                'title'   => __('Blog Single Page', 'angle-admin-td'),
                'header'  => __('This section allows you to set up how your single post will look.', 'angle-admin-td'),
                'fields' => array(
                    array(
                        'name'    => __('Display categories', 'angle-admin-td'),
                        'desc'    => __('Toggle categories on/off in post', 'angle-admin-td'),
                        'id'      => 'blog_categories',
                        'type'    => 'radio',
                        'options' => array(
                            'on'   => __('On', 'angle-admin-td'),
                            'off'  => __('Off', 'angle-admin-td'),
                        ),
                        'default' => 'on',
                    ),
                    array(
                        'name'    => __('Display tags', 'angle-admin-td'),
                        'desc'    => __('Toggle tags on/off in post', 'angle-admin-td'),
                        'id'      => 'blog_tags',
                        'type'    => 'radio',
                        'options' => array(
                            'on'   => __('On', 'angle-admin-td'),
                            'off'  => __('Off', 'angle-admin-td'),
                        ),
                        'default' => 'on',
                    ),
                    array(
                        'name'    => __('Display comment count', 'angle-admin-td'),
                        'desc'    => __('Toggle comment count on/off in post', 'angle-admin-td'),
                        'id'      => 'blog_comment_count',
                        'type'    => 'radio',
                        'options' => array(
                            'on'   => __('On', 'angle-admin-td'),
                            'off'  => __('Off', 'angle-admin-td'),
                        ),
                        'default' => 'on',
                    ),
                    array(
                        'name'    => __('Show related posts', 'angle-admin-td'),
                        'desc'    => __('Show Related Posts after the post content', 'angle-admin-td'),
                        'id'      => 'related_posts',
                        'type'    => 'radio',
                        'options' => array(
                            'on'   => __('On', 'angle-admin-td'),
                            'off'  => __('Off', 'angle-admin-td'),
                        ),
                        'default' => 'on',
                    ),
                    array(
                        'name'    => __('Number of related posts', 'angle-admin-td'),
                        'desc'    => __('Choose how many related posts are displayed in the related posts section after the post content', 'angle-admin-td'),
                        'id'      => 'related_posts_number',
                        'type'    => 'radio',
                        'options' => array(
                            '3'   => __('3', 'angle-admin-td'),
                            '4'   => __('4', 'angle-admin-td'),
                            '6'   => __('6', 'angle-admin-td'),
                            '8'   => __('8', 'angle-admin-td'),
                        ),
                        'default' => '3',
                    ),
                    array(
                        'name'    => __('Related posts per slide', 'angle-admin-td'),
                        'desc'    => __('Choose how many related posts are displayed in each slide', 'angle-admin-td'),
                        'id'      => 'related_posts_per_slide',
                        'type'    => 'radio',
                        'options' => array(
                            '3'   => __('3', 'angle-admin-td'),
                            '4'   => __('4', 'angle-admin-td'),
                        ),
                        'default' => '3',
                    ),
                    array(
                        'name'    => __('Related posts section height', 'angle-admin-td'),
                        'desc'    => __('Choose the amount of padding added to the height of the Related posts section', 'angle-admin-td'),
                        'id'      => 'related_posts_height',
                        'type'    => 'select',
                        'options' => array(
                            'section-normal' => __('Normal', 'angle-admin-td'),
                            'section-short'  => __('Short', 'angle-admin-td'),
                            'section-tiny'   => __('Tiny', 'angle-admin-td'),
                        ),
                        'default' => 'normal',
                    ),
                    array(
                        'name'    => __('Display avatar', 'angle-admin-td'),
                        'desc'    => __('Toggle avatars on/off in Author Bio Section', 'angle-admin-td'),
                        'id'      => 'site_avatars',
                        'type'    => 'radio',
                        'options' => array(
                            'on'   => __('On', 'angle-admin-td'),
                            'off'  => __('Off', 'angle-admin-td'),
                        ),
                        'default' => 'on',
                    ),
                    array(
                        'name'    => __('Open Featured Image in Magnific Popup', 'angle-admin-td'),
                        'desc'    => __('Featured image in single post view will open in a large preview popup', 'angle-admin-td'),
                        'id'      => 'blog_fancybox',
                        'type'    => 'radio',
                        'options' => array(
                            'on'   => __('On', 'angle-admin-td'),
                            'off'  => __('Off', 'angle-admin-td'),
                        ),
                        'default' => 'on',
                    ),
                    array(
                        'name'    => __('Show Facebook Button', 'angle-admin-td'),
                        'desc'    => __('Show facebook share button on your single blog pages', 'angle-admin-td'),
                        'id'      => 'fb_show',
                        'type'    => 'radio',
                        'options' => array(
                            'show' => __('Show', 'angle-admin-td'),
                            'hide' => __('Hide', 'angle-admin-td'),
                        ),
                        'default' => 'show',
                    ),
                    array(
                        'name'    => __('Show Tweet Button', 'angle-admin-td'),
                        'desc'    => __('Show tweet share button on your single blog pages', 'angle-admin-td'),
                        'id'      => 'twitter_show',
                        'type'    => 'radio',
                        'options' => array(
                            'show' => __('Show', 'angle-admin-td'),
                            'hide' => __('Hide', 'angle-admin-td'),
                        ),
                        'default' => 'show',
                    ),
                    array(
                        'name'    => __('Show Google+ Button', 'angle-admin-td'),
                        'desc'    => __('Show G+ share button on your single blog pages', 'angle-admin-td'),
                        'id'      => 'google_show',
                        'type'    => 'radio',
                        'options' => array(
                            'show' => __('Show', 'angle-admin-td'),
                            'hide' => __('Hide', 'angle-admin-td'),
                        ),
                        'default' => 'show',
                    ),
                    array(
                        'name'    => __('Show Pinterest Button', 'angle-admin-td'),
                        'desc'    => __('Show Pinterest share button on your single blog pages', 'angle-admin-td'),
                        'id'      => 'pinterest_show',
                        'type'    => 'radio',
                        'options' => array(
                            'show' => __('Show', 'angle-admin-td'),
                            'hide' => __('Hide', 'angle-admin-td'),
                        ),
                        'default' => 'show',
                    ),
                    array(
                        'name'    => __('Show LinkedIn Button', 'angle-admin-td'),
                        'desc'    => __('Show LinkedIn share button on your single blog pages', 'angle-admin-td'),
                        'id'      => 'linkedin_show',
                        'type'    => 'radio',
                        'options' => array(
                            'show' => __('Show', 'angle-admin-td'),
                            'hide' => __('Hide', 'angle-admin-td'),
                        ),
                        'default' => 'show',
                    )
                )
            ),
            'swatches-section' => array(
                'title'   => __('Swatches', 'angle-admin-td'),
                'header'  => __('All the blog sections can be swatched.  You can choose the colours of your blog header, posts, related posts and author bio.', 'angle-admin-td'),
                'fields' => array(
                    array(
                        'name'    => __('Header Swatch', 'angle-admin-td'),
                        'desc'    => __('Select the colour scheme to use for the header on this page.', 'angle-admin-td'),
                        'id'      => 'blog_header_swatch',
                        'type' => 'select',
                        'default' => 'swatch-red-white',
                        'options' => include OXY_THEME_DIR . 'inc/options/shortcodes/shortcode-swatches-options.php'
                    ),
                    array(
                        'name'    => __('Blog Swatch', 'angle-admin-td'),
                        'desc'    => __('Choose a color swatch for the Blog page', 'angle-admin-td'),
                        'id'      => 'blog_swatch',
                        'type'    => 'select',
                        'default' => 'swatch-white-red',
                        'options' => include OXY_THEME_DIR . 'inc/options/shortcodes/shortcode-swatches-options.php'
                    ),
                    array(
                        'name'    => __('Blog Decoration', 'angle-admin-td'),
                        'desc'    => __('Choose a style to use as the blog decoration.', 'angle-admin-td'),
                        'id'      => 'blog_header_decoration',
                        'type'    => 'select',
                        'default' => 'none',
                        'options' => include OXY_THEME_DIR . 'inc/options/global-options/section-decorations.php',
                    ),
                    array(
                        'name'    => __('Related Posts Section Swatch', 'angle-admin-td'),
                        'desc'    => __('Choose a color swatch for the related posts section below post content', 'angle-admin-td'),
                        'id'      => 'related_posts_section_swatch',
                        'type'    => 'select',
                        'default' => 'swatch-red-white',
                        'options' => include OXY_THEME_DIR . 'inc/options/shortcodes/shortcode-swatches-options.php'
                    ),
                    array(
                        'name'    => __('Related Posts Decoration', 'angle-admin-td'),
                        'desc'    => __('Choose a style to use as the Related Posts decoration.', 'angle-admin-td'),
                        'id'      => 'related_posts_decoration',
                        'type'    => 'select',
                        'default' => 'none',
                        'options' => include OXY_THEME_DIR . 'inc/options/global-options/section-decorations.php',
                    ),
                    array(
                        'name'    => __('Related Posts Swatch', 'angle-admin-td'),
                        'desc'    => __('Choose a color swatch for all the related posts below post content', 'angle-admin-td'),
                        'id'      => 'related_posts_swatch',
                        'type'    => 'select',
                        'default' => 'swatch-white-red',
                        'options' => include OXY_THEME_DIR . 'inc/options/shortcodes/shortcode-swatches-options.php'
                    ),
                    array(
                        'name'    => __('Author Swatch', 'angle-admin-td'),
                        'desc'    => __('Choose a color swatch for the author bio section', 'angle-admin-td'),
                        'id'      => 'author_bio_swatch',
                        'type'    => 'select',
                        'default' => 'swatch-white-red',
                        'options' => include OXY_THEME_DIR . 'inc/options/shortcodes/shortcode-swatches-options.php'
                    ),
                    array(
                        'name'    => __('Author Decoration', 'angle-admin-td'),
                        'desc'    => __('Choose a style to use as the Author\'s Page decoration.', 'angle-admin-td'),
                        'id'      => 'author_decoration',
                        'type'    => 'select',
                        'default' => 'none',
                        'options' => include OXY_THEME_DIR . 'inc/options/global-options/section-decorations.php',
                    ),
                    array(
                        'name'    => __('Search Result Swatch', 'angle-admin-td'),
                        'desc'    => __('Choose a color swatch for the search result section', 'angle-admin-td'),
                        'id'      => 'search_result_swatch',
                        'type'    => 'select',
                        'default' => 'swatch-white-red',
                        'options' => include OXY_THEME_DIR . 'inc/options/shortcodes/shortcode-swatches-options.php'
                    ),
                    array(
                        'name'    => __('Search Result Decoration', 'angle-admin-td'),
                        'desc'    => __('Choose a style to use as the search result page decoration.', 'angle-admin-td'),
                        'id'      => 'search_result_decoration',
                        'type'    => 'select',
                        'default' => '',
                        'options' => include OXY_THEME_DIR . 'inc/options/global-options/section-decorations.php',
                    )
                )
            ),
        )
    ));
    $oxy_theme->register_option_page( array(
        'page_title' => __('Flexslider Options', 'angle-admin-td'),
        'menu_title' => __('Flexslider', 'angle-admin-td'),
        'slug'       => THEME_SHORT . '-flexslider',
        'header'  => __('Global options for flexsliders used in the site (gallery posts, gallery portfolio items).', 'angle-admin-td'),
        'main_menu'  => false,
        'icon'       => 'tools',
        'sections'   => array(
            'slider-section' => array(
                'title' => __('Slideshow', 'angle-admin-td'),
                'header'  => __('Setup your global default flexslider options.', 'angle-admin-td'),
                'fields' => array(
                    array(
                        'name'      =>  __('Animation style', 'angle-admin-td'),
                        'desc'      =>  __('Select how your slider animates', 'angle-admin-td'),
                        'id'        => 'animation',
                        'type'      => 'select',
                        'options'   =>  array(
                            'slide' => __('Slide', 'angle-admin-td'),
                            'fade'  => __('Fade', 'angle-admin-td'),
                        ),
                        'attr'      =>  array(
                            'class'    => 'widefat',
                        ),
                        'default'   => 'slide',
                    ),
                    array(
                        'name'      => __('Direction', 'angle-admin-td'),
                        'desc'      =>  __('Select the direction your slider slides', 'angle-admin-td'),
                        'id'        => 'direction',
                        'type'      => 'select',
                        'default'   =>  'horizontal',
                        'options' => array(
                            'horizontal' => __('Horizontal', 'angle-admin-td'),
                            'vertical'   => __('Vertical', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'      => __('Speed', 'angle-admin-td'),
                        'desc'      => __('Set the speed of the slideshow cycling, in milliseconds', 'angle-admin-td'),
                        'id'        => 'speed',
                        'type'      => 'slider',
                        'default'   => 7000,
                        'attr'      => array(
                            'max'       => 15000,
                            'min'       => 2000,
                            'step'      => 1000
                        )
                    ),
                    array(
                        'name'      => __('Duration', 'angle-admin-td'),
                        'desc'      => __('Set the speed of animations', 'angle-admin-td'),
                        'id'        => 'duration',
                        'type'      => 'slider',
                        'default'   => 600,
                        'attr'      => array(
                            'max'       => 1500,
                            'min'       => 200,
                            'step'      => 100
                        )
                    ),
                    array(
                        'name'      => __('Auto start', 'angle-admin-td'),
                        'id'        => 'autostart',
                        'type'      => 'radio',
                        'default'   =>  'true',
                        'desc'    => __('Start slideshow automatically', 'angle-admin-td'),
                        'options' => array(
                            'true'  => __('On', 'angle-admin-td'),
                            'false' => __('Off', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'      => __('Show navigation arrows', 'angle-admin-td'),
                        'id'        => 'directionnav',
                        'type'      => 'radio',
                        'desc'    => __('Shows the navigation arrows at the sides of the flexslider.', 'angle-admin-td'),
                        'default'   =>  'hide',
                        'options' => array(
                            'hide' => __('Hide', 'angle-admin-td'),
                            'show' => __('Show', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'      => __('Navigation arrows type', 'angle-admin-td'),
                        'id'        => 'directionnavtype',
                        'type'      => 'radio',
                        'desc'      => __('Type of the direction arrows, fancy (with bg) or simple.', 'angle-admin-td'),
                        'default'   =>  'simple',
                        'options' => array(
                            'simple' => __('Simple', 'angle-admin-td'),
                            'fancy'  => __('Fancy', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'      => __('Show controls', 'angle-admin-td'),
                        'id'        => 'showcontrols',
                        'type'      => 'radio',
                        'default'   =>  'show',
                        'desc'    => __('If you choose hide the option below will be ignored', 'angle-admin-td'),
                        'options' => array(
                            'hide' => __('Hide', 'angle-admin-td'),
                            'show' => __('Show', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'      => __('Choose the place of the controls', 'angle-admin-td'),
                        'id'        => 'controlsposition',
                        'type'      => 'radio',
                        'default'   =>  'inside',
                        'desc'    => __('Choose the position of the navigation controls', 'angle-admin-td'),
                        'options' => array(
                            'inside'    => __('Inside', 'angle-admin-td'),
                            'outside'   => __('Outside', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'      =>  __('Choose the alignment of the controls', 'angle-admin-td'),
                        'id'        => 'controlsalign',
                        'type'      => 'radio',
                        'desc'    => __('Choose the alignment of the navigation controls', 'angle-admin-td'),
                        'options'   =>  array(
                            'center' => __('Center', 'angle-admin-td'),
                            'left'   => __('Left', 'angle-admin-td'),
                            'right'  => __('Right', 'angle-admin-td'),
                        ),
                        'attr'      =>  array(
                            'class'    => 'widefat',
                        ),
                        'default'   => 'center',
                    ),
                    array(
                        'name'      => __('Show tooltip', 'angle-admin-td'),
                        'id'        => 'tooltip',
                        'type'      => 'radio',
                        'default'   =>  'hide',
                        'desc'    => __('Display the slide title as tooltip', 'angle-admin-td'),
                        'options' => array(
                            'hide' => __('Hide', 'angle-admin-td'),
                            'show' => __('Show', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'      => __('Reverse', 'angle-admin-td'),
                        'id'        => 'reverse',
                        'type'      => 'radio',
                        'default'   =>  'false',
                        'desc'    => __('Reverse the animation direction', 'angle-admin-td'),
                        'options' => array(
                            'true'  => __('On', 'angle-admin-td'),
                            'false' => __('Off', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'      => __('Animation Loop', 'angle-admin-td'),
                        'id'        => 'animationloop',
                        'type'      => 'radio',
                        'default'   =>  'true',
                        'desc'    => __('Gives the slider a seamless infinite loop', 'angle-admin-td'),
                        'options' => array(
                            'true'  => __('On', 'angle-admin-td'),
                            'false' => __('Off', 'angle-admin-td'),
                        ),
                    ),
                )
            ),
            'captions-section' => array(
                'title' => __('Captions', 'angle-admin-td'),
                'fields' => array(
                    array(
                        'name'      => __('Show Captions', 'angle-admin-td'),
                        'id'        => 'captions',
                        'type'      => 'radio',
                        'default'   =>  'hide',
                        'desc'    => __('If you choose hide the options below will be ignored', 'angle-admin-td'),
                        'options' => array(
                            'hide' => __('Hide', 'angle-admin-td'),
                            'show' => __('Show', 'angle-admin-td'),
                            ),
                    ),
                    array(
                        'name'      => __('Captions Vertical Position', 'angle-admin-td'),
                        'desc'      => __('Choose between bottom and top positioning', 'angle-admin-td'),
                        'id'        => 'captions_vertical',
                        'type'      => 'radio',
                        'default'   =>  'bottom',
                        'options' => array(
                            'top'    => __('Top', 'angle-admin-td'),
                            'bottom' => __('Bottom', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'      => __('Captions Horizontal Position', 'angle-admin-td'),
                        'desc'      => __('Choose among left, right and alternate positioning', 'angle-admin-td'),
                        'id'        => 'captions_horizontal',
                        'type'      => 'radio',
                        'default'   =>  'left',
                        'options' => array(
                            'left'      => __('Left', 'angle-admin-td'),
                            'right'     => __('Right', 'angle-admin-td'),
                            'alternate' => __('Alternate', 'angle-admin-td'),
                        ),
                    ),
                )
            ),
        )
    ));

    $oxy_theme->register_option_page(   array(
        'page_title' => __('404 Page Options', 'angle-admin-td'),
        'menu_title' => __('404', 'angle-admin-td'),
        'slug'       => THEME_SHORT . '-404',
        'main_menu'  => false,
        'icon'       => 'tools',
        'sections'   => array(
            '404-header-section' => array(
                'title'   => __('Header', 'angle-admin-td'),
                'header'  => __('If someone goes to a invalid url this 404 page will be shown.  You can change the image, title, text and colour of the 404 page here.', 'angle-admin-td'),
                'fields' => array(
                    array(
                        'name'    => __('404 image', 'angle-admin-td'),
                        'desc'    => __('Upload an image to show on your 404 page', 'angle-admin-td'),
                        'id'      => '404_header_image',
                        'type'    => 'upload',
                        'store'   => 'url',
                        'default' => OXY_THEME_URI . 'assets/images/404.png',
                    ),
                    array(
                        'name'    => __('Page Title', 'angle-admin-td'),
                        'desc'    => __('The title that appears on your 404 page', 'angle-admin-td'),
                        'id'      => '404_title',
                        'type'    => 'text',
                        'default' => __('Page Not Found', 'angle-admin-td')
                    ),
                    array(
                        'name'    => __('Header Swatch', 'angle-admin-td'),
                        'desc'    => __('Choose a color swatch for the 404 page', 'angle-admin-td'),
                        'id'      => '404_header_swatch',
                        'type'    => 'select',
                        'default' => 'swatch-red-white',
                        'options' => include OXY_THEME_DIR . 'inc/options/shortcodes/shortcode-swatches-options.php'
                    ),
                    array(
                        'name'    => __('Page Text', 'angle-admin-td'),
                        'desc'    => __('The content of your 404 page', 'angle-admin-td'),
                        'id'      => '404_content',
                        'type'    => 'editor',
                        'settings' => array( 'media_buttons' => false ),
                        'default' => __('The page you requested could not be found.', 'angle-admin-td')
                    ),
                    array(
                        'name'    => __('Page Swatch', 'angle-admin-td'),
                        'desc'    => __('Choose a color swatch for the 404 page', 'angle-admin-td'),
                        'id'      => '404_swatch',
                        'type'    => 'select',
                        'default' => 'swatch-red-white',
                        'options' => include OXY_THEME_DIR . 'inc/options/shortcodes/shortcode-swatches-options.php'
                    ),
                    array(
                        'name'    => __('Page Top Decoration', 'angle-admin-td'),
                        'desc'    => __('Choose a style to use as the top decoration.', 'angle-admin-td'),
                        'id'      => '404_decoration',
                        'type'    => 'select',
                        'default' => 'none',
                        'options' => include OXY_THEME_DIR . 'inc/options/global-options/section-decorations.php',
                    )
                )
            ),
        ),
    ));
    $oxy_theme->register_option_page( array(
        'page_title' => __('Portfolio Page Options', 'angle-admin-td'),
        'menu_title' => __('Portfolio', 'angle-admin-td'),
        'slug'       => THEME_SHORT . '-portfolio',
        'main_menu'  => false,
        'sections'   => array(
            'portfolio-section' => array(
                'title'   => __('Portfolio Single Page', 'angle-admin-td'),
                'header'  => __('When you click on a portfolio item you will be taken to its single page.  You can change how these pages look here.', 'angle-admin-td'),
                'fields' => array(
                    array(
                        'name'    => __('Show related items', 'angle-admin-td'),
                        'desc'    => __('Toggle the display of the related items section', 'angle-admin-td'),
                        'id'      => 'portfolio_show_related',
                        'type'    => 'radio',
                        'options' => array(
                            'on'   => __('On', 'angle-admin-td'),
                            'off'  => __('Off', 'angle-admin-td'),
                        ),
                        'default' => 'on',
                    ),
                    array(
                        'name'    => __('Related items title', 'angle-admin-td'),
                        'desc'    => __('Related items title that is shown on single portfolio page above related items', 'angle-admin-td'),
                        'id'      => 'portfolio_related_title',
                        'type'    => 'text',
                        'default' => __('Related Work', 'angle-admin-td'),
                    ),
                    array(
                        'name'    => __('Related items Swatch', 'angle-admin-td'),
                        'desc'    => __('Swatch for the related items in single portfolio page', 'angle-admin-td'),
                        'id'      => 'portfolio_related_swatch',
                        'type'    => 'select',
                        'default' => 'swatch-red-white',
                        'options' => include OXY_THEME_DIR . 'inc/options/shortcodes/shortcode-swatches-options.php'
                    ),
                    array(
                        'name'    => __('Related items Section Decoration', 'angle-admin-td'),
                        'desc'    => __('Choose a style to use as the top decoration.', 'angle-admin-td'),
                        'id'      => 'portfolio_related_decoration',
                        'type'    => 'select',
                        'default' => 'none',
                        'options' => include OXY_THEME_DIR . 'inc/options/global-options/section-decorations.php',
                    ),
                    array(
                        'name'    => __('Related items section height', 'angle-admin-td'),
                        'desc'    => __('Choose the amount of padding added to the height of the Related items section', 'angle-admin-td'),
                        'id'      => 'related_items_height',
                        'type'    => 'select',
                        'options' => array(
                            'normal' => __('Normal', 'angle-admin-td'),
                            'short'  => __('Short', 'angle-admin-td'),
                            'tiny'   => __('Tiny', 'angle-admin-td'),
                        ),
                        'default' => 'normal',
                    ),
                    array(
                        'name'      => __('Related items Shape', 'angle-admin-td'),
                        'desc'      => __('Shape for the related items in single portfolio page', 'angle-admin-td'),
                        'id'        => 'portfolio_related_shape',
                        'type'      => 'select',
                        'default'   => 'hex',
                        'options' => array(
                            'round'  => __('Circle', 'angle-admin-td'),
                            'square' => __('Square', 'angle-admin-td'),
                            'rect'   => __('Rectangle', 'angle-admin-td'),
                            'hex'    => __('Hexagon', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'      =>  __('Related items Shadow', 'angle-admin-td'),
                        'id'        => 'portfolio_related_shadow',
                        'type'      => 'select',
                        'options'   =>  array(
                            'show' => __('Show', 'angle-admin-td'),
                            'hide' => __('Hide', 'angle-admin-td'),
                        ),
                        'default'   => 'hide',
                    ),
                )
            ),
            'portfolio-size-section' => array(
                'title'   => __('Portfolio Image Sizes', 'angle-admin-td'),
                'header'  => __('When your portfolio images are uploaded they will be automatially saved using these dimensions.', 'angle-admin-td'),
                'fields' => array(
                    array(
                        'name'    => __('Image Width', 'angle-admin-td'),
                        'desc'    => __('Width of each portfolio item', 'angle-admin-td'),
                        'id'      => 'portfolio_item_width',
                        'type'    => 'slider',
                        'default'   => 800,
                        'attr'      => array(
                            'max'       => 1200,
                            'min'       => 50,
                            'step'      => 1
                        )
                    ),
                    array(
                        'name'    => __('Image Height', 'angle-admin-td'),
                        'desc'    => __('Height of each portfolio item', 'angle-admin-td'),
                        'id'      => 'portfolio_item_height',
                        'type'    => 'slider',
                        'default'   => 600,
                        'attr'      => array(
                            'max'       => 800,
                            'min'       => 50,
                            'step'      => 1
                        )
                    ),
                    array(
                        'name'      => __('Image Cropping', 'angle-admin-td'),
                        'id'        => 'portfolio_item_crop',
                        'type'      => 'radio',
                        'default'   =>  'on',
                        'desc'    => __('Crop images to the exact proportions', 'angle-admin-td'),
                        'options' => array(
                            'on' => __('Crop Images', 'angle-admin-td'),
                            'off' => __('Do not crop', 'angle-admin-td'),
                        ),
                    ),
                )
            ),
        )
    ));
    $oxy_theme->register_option_page( array(
        'page_title' => __('Post Types', 'angle-admin-td'),
        'menu_title' => __('Post Types', 'angle-admin-td'),
        'slug'       => THEME_SHORT . '-post-types',
        'main_menu'  => false,
        'sections'   => array(
            'permalinks-section' => array(
                'title'   => __('Configure your permalinks here', 'angle-admin-td'),
                'header'  => __('Some of the custom single pages ( Portfolios, Services, Staff ) can be configured to use their own special url.  This helps with SEO.  Set your permalinks here, save and then navigate to one of the items and you will see the url in the format below.', 'angle-admin-td'),
                'fields' => array(
                    array(
                        'prefix'  => '<code>' . get_home_url() . '/</code>',
                        'postfix' => '<code>/my-portfolio-item</code>',
                        'name'    => __('Portfolio URL slug', 'angle-admin-td'),
                        'desc'    => __('Choose the url you would like your portfolios to be shown on', 'angle-admin-td'),
                        'id'      => 'portfolio_slug',
                        'type'    => 'text',
                        'default' => 'portfolio',
                    ),
                    array(
                        'prefix'  => '<code>' . get_home_url() . '/</code>',
                        'postfix' => '<code>/my-service</code>',
                        'name'    => __('Service URL slug', 'angle-admin-td'),
                        'desc'    => __('Choose the url you would like your services to use', 'angle-admin-td'),
                        'id'      => 'services_slug',
                        'type'    => 'text',
                        'default' => 'our-services',
                    ),
                    array(
                        'prefix'  => '<code>' . get_home_url() . '/</code>',
                        'postfix' => '<code>/our-team</code>',
                        'name'    => __('Staff URL slug', 'angle-admin-td'),
                        'desc'    => __('Choose the url you would like your staff pages to use', 'angle-admin-td'),
                        'id'      => 'staff_slug',
                        'type'    => 'text',
                        'default' => 'our-team',
                    ),
                )
            ),
            'posttypes-archives-section' => array(
                'title'   => __('Post Types Archive Pages', 'angle-admin-td'),
                'header'  => __('Set your post types archives pages here', 'angle-admin-td'),
                'fields' => array(
                    array(
                        'name'      => __('Portfolio Archive Page', 'angle-admin-td'),
                        'desc'      => __('Set the archive page for the portfolio post type', 'angle-admin-td'),
                        'id'        => 'portfolio_archive_page',
                        'type'      => 'select',
                        'options'  => 'taxonomy',
                        'taxonomy' => 'pages',
                        'default' =>  '',
                        'blank' => __('None', 'angle-admin-td'),
                    ),
                    array(
                        'name'      => __('Services Archive Page', 'angle-admin-td'),
                        'desc'      => __('Set the archive page for the services post type', 'angle-admin-td'),
                        'id'        => 'services_archive_page',
                        'type'      => 'select',
                        'options'  => 'taxonomy',
                        'taxonomy' => 'pages',
                        'default' =>  '',
                        'blank' => __('None', 'angle-admin-td'),
                    ),
                    array(
                        'name'      => __('Staff Archive Page', 'angle-admin-td'),
                        'desc'      => __('Set the archive page for the staff post type', 'angle-admin-td'),
                        'id'        => 'staff_archive_page',
                        'type'      => 'select',
                        'options'  => 'taxonomy',
                        'taxonomy' => 'pages',
                        'default' =>  '',
                        'blank' => __('None', 'angle-admin-td'),
                    ),
                )
            ),
        )
    ));
    $oxy_theme->register_option_page( array(
        'page_title' => __('Advanced Theme Options', 'angle-admin-td'),
        'menu_title' => __('Advanced', 'angle-admin-td'),
        'slug'       => THEME_SHORT . '-advanced',
        'main_menu'  => false,
        'sections'   => array(
            'css-section' => array(
                'title'   => __('CSS', 'angle-admin-td'),
                'header'  => __('Here you can save some custom CSS that will be loaded in the header. This will allow you to override some of the default styling of the theme.</br> Please ensure that the CSS added here is valid. You can copy / paste your CSS <a href="https://jigsaw.w3.org/css-validator/#validate_by_input" target="_blank">here</a> to validate it.', 'angle-admin-td'),
                'fields' => array(
                    array(
                        'name'    => __('Extra CSS (loaded last in the header)', 'angle-admin-td'),
                        'desc'    => __('Add extra CSS rules to be included in all pages', 'angle-admin-td'),
                        'id'      => 'extra_css',
                        'type'    => 'textarea',
                        'attr'    => array( 'rows' => '10', 'style' => 'width:100%' ),
                        'default' => '',
                    ),
                    array(
                        'name'    => __('Swatch CSS Loading', 'angle-admin-td'),
                        'desc'    => __('Defines where the dynamic swatch css that is created by your swatch options is saved. If you are using a lot of swatches it is recommended to save them to a file.', 'angle-admin-td'),
                        'id'      => 'swatch_css_save',
                        'type'    => 'select',
                        'options' => array(
                            'file'  => __('Save swatches to files', 'angle-admin-td'),
                            'head'  => __('Inject swatches in page header', 'angle-admin-td'),
                        ),
                        'default' => 'head',
                    ),
                )
            ),
            'js-section' => array(
                'title'   => __('Javascript', 'angle-admin-td'),
                'header'  => __('Here you can modify the theme advanced JS options', 'angle-admin-td'),
                'fields' => array(
                    array(
                        'name'    => __('Extra Javascript (loaded last in the header)', 'angle-admin-td'),
                        'desc'    => __('Add extra Javascript rules to be included in all pages that will be loaded in the header.  Code will be wrapped in script tags by default.', 'angle-admin-td'),
                        'id'      => 'extra_js',
                        'type'    => 'textarea',
                        'attr'    => array( 'rows' => '10', 'style' => 'width:100%' ),
                        'default' => '',
                    ),
                )
            ),
            'assets-section' => array(
                'title'   => __('Assets', 'angle-admin-td'),
                'header'  => __('Here you can choose the type of asset files enqueued by the theme.', 'angle-admin-td'),
                'fields' => array(
                    array(
                        'name'    => __('Load Minified CSS and JS Assets', 'angle-admin-td'),
                        'desc'    => __('Choose between minified and not minified theme CSS and Javascript files. Minified files are smaller and faster to load, while non-minified are easier to edit and mofify because they are more readable. Minified assets are enqueued by default.', 'angle-admin-td'),
                        'id'      => 'minified_assets',
                        'type'    => 'radio',
                        'options' => array(
                            'on'  => __('On', 'angle-admin-td'),
                            'off' => __('Off', 'angle-admin-td'),
                        ),
                        'default' => 'on',
                    ),
                )
            ),
            'atom-section' => array(
                'title'   => __('Enable Atom Meta', 'angle-admin-td'),
                'header'  => __('Here you can enable atom meta for posts author, title and date (used by search engines).', 'angle-admin-td'),
                'fields' => array(
                    array(
                        'name'    => __('Author', 'angle-admin-td'),
                        'desc'    => __('Enable atom meta for posts author', 'angle-admin-td'),
                        'id'      => 'atom_author',
                        'type'    => 'radio',
                        'options' => array(
                            'on'  => __('On', 'angle-admin-td'),
                            'off' => __('Off', 'angle-admin-td'),
                        ),
                        'default' => 'on',
                    ),
                    array(
                        'name'    => __('Title', 'angle-admin-td'),
                        'desc'    => __('Enable atom meta for posts title', 'angle-admin-td'),
                        'id'      => 'atom_title',
                        'type'    => 'radio',
                        'options' => array(
                            'on'  => __('On', 'angle-admin-td'),
                            'off' => __('Off', 'angle-admin-td'),
                        ),
                        'default' => 'on',
                    ),
                    array(
                        'name'    => __('Date', 'angle-admin-td'),
                        'desc'    => __('Enable atom meta for posts date', 'angle-admin-td'),
                        'id'      => 'atom_date',
                        'type'    => 'radio',
                        'options' => array(
                            'on'  => __('On', 'angle-admin-td'),
                            'off' => __('Off', 'angle-admin-td'),
                        ),
                        'default' => 'on',
                    )
                )
            ),
            'favicon-section' => array(
                'title'   => __('Site Fav Icon', 'angle-admin-td'),
                'header'  => __('The site Fav Icon is the icon that appears in the top corner of the browser tab, it is also used when saving bookmarks.  Upload your own custom Fav Icon here, recommended resolutions are 16x16 or 32x32.', 'angle-admin-td'),
                'fields' => array(
                    array(
                      'name' => __('Fav Icon', 'angle-admin-td'),
                      'id'   => 'favicon',
                      'type' => 'upload',
                      'store' => 'url',
                      'desc' => __('Upload a Fav Icon for your site here', 'angle-admin-td'),
                      'default' => OXY_THEME_URI . 'assets/images/favicons/favicon.ico',
                    ),
                )
            ),
            'apple-section' => array(
                'title'   => __('Apple Icons', 'angle-admin-td'),
                'header'  => __('If someone saves a bookmark to their desktop on an Apple device this is the icon that will be used.  Here you can upload the icon you would like to be used on the various Apple devices.', 'angle-admin-td'),
                'fields' => array(
                    array(
                        'name' => __('iPhone Icon (60x60)', 'angle-admin-td'),
                        'id'   => 'iphone_icon',
                        'type' => 'upload',
                        'store' => 'url',
                        'desc' => __('Upload an icon to be used by iPhone as a bookmark (60 x 60 pixels)', 'angle-admin-td'),
                        'default' => OXY_THEME_URI . 'assets/images/favicons/apple-touch-icon-60x60-precomposed.png',
                    ),
                    array(
                        'name'    => __('iPhone -  Apply Apple style', 'angle-admin-td'),
                        'desc'    => __('Allow device to apply styling to the icon?', 'angle-admin-td'),
                        'id'      => 'iphone_icon_pre',
                        'type'    => 'radio',
                        'default' => 'apple-touch-icon',
                        'options' => array(
                            'apple-touch-icon'             => __('Allow Styling', 'angle-admin-td'),
                            'apple-touch-icon-precomposed' => __('Leave It Alone', 'angle-admin-td'),
                        ),
                    ),
                    array(
                      'name' => __('iPhone Retina Icon (114x114)', 'angle-admin-td'),
                      'id'   => 'iphone_retina_icon',
                      'type' => 'upload',
                      'store' => 'url',
                      'desc' => __('Upload an icon to be used by iPhone Retina as a bookmark (114 x 114 pixels)', 'angle-admin-td'),
                      'default' => OXY_THEME_URI . 'assets/images/favicons/apple-touch-icon-114x114-precomposed.png',
                    ),
                    array(
                        'name'    => __('iPhone Retina -  Apply Apple style', 'angle-admin-td'),
                        'desc'    => __('Allow device to apply styling to the icon?', 'angle-admin-td'),
                        'id'      => 'iphone_retina_icon_pre',
                        'type'    => 'radio',
                        'default' => 'apple-touch-icon',
                        'options' => array(
                            'apple-touch-icon'             => __('Allow Styling', 'angle-admin-td'),
                            'apple-touch-icon-precomposed' => __('Leave It Alone', 'angle-admin-td'),
                        ),
                    ),
                    array(
                      'name' => __('iPad Icon (72x72)', 'angle-admin-td'),
                      'id'   => 'ipad_icon',
                      'type' => 'upload',
                      'store' => 'url',
                      'desc' => __('Upload an icon to be used by iPad as a bookmark (72 x 72 pixels)', 'angle-admin-td'),
                      'default' => OXY_THEME_URI . 'assets/images/favicons/apple-touch-icon-72x72-precomposed.png',
                    ),
                    array(
                        'name'    => __('iPad -  Apply Apple style', 'angle-admin-td'),
                        'desc'    => __('Allow device to apply styling to the icon?', 'angle-admin-td'),
                        'id'      => 'ipad_icon_pre',
                        'type'    => 'radio',
                        'default' => 'apple-touch-icon',
                        'options' => array(
                            'apple-touch-icon'             => __('Allow Styling', 'angle-admin-td'),
                            'apple-touch-icon-precomposed' => __('Leave It Alone', 'angle-admin-td'),
                        ),
                    ),
                    array(
                      'name' => __('iPad Retina Icon (144x144)', 'angle-admin-td'),
                      'id'   => 'ipad_icon_retina',
                      'type' => 'upload',
                      'store' => 'url',
                      'desc' => __('Upload an icon to be used by iPad Retina as a bookmark (144 x 144 pixels)', 'angle-admin-td'),
                      'default' => OXY_THEME_URI . 'assets/images/favicons/apple-touch-icon-144x144-precomposed.png',
                    ),
                    array(
                        'name'    => __('iPad -  Apply Apple style', 'angle-admin-td'),
                        'desc'    => __('Allow device to apply styling to the icon?', 'angle-admin-td'),
                        'id'      => 'ipad_icon_retina_pre',
                        'type'    => 'radio',
                        'default' => 'apple-touch-icon',
                        'options' => array(
                            'apple-touch-icon'             => __('Allow Styling', 'angle-admin-td'),
                            'apple-touch-icon-precomposed' => __('Leave It Alone', 'angle-admin-td'),
                        ),
                    ),
                )
            ),
            'mobile-section' => array(
                'title'   => __('Mobile', 'angle-admin-td'),
                'header'  => __('Here you can configure settings targeted at mobile devices', 'angle-admin-td'),
                'fields' => array(
                    array(
                        'name'    => __('Background Videos', 'angle-admin-td'),
                        'desc'    => __('Here you can enable section background videos for mobile. By default it is set to off in order to save bandwidth. Section background image will be displayed as a fallback', 'angle-admin-td'),
                        'id'      => 'mobile_videos',
                        'type'    => 'radio',
                        'options' => array(
                            'on'  => __('On', 'angle-admin-td'),
                            'off' => __('Off', 'angle-admin-td'),
                        ),
                        'default' => 'off',
                    ),
                )
            ),
            'google-anal-section' => array(
                'title'   => __('Google Analytics', 'angle-admin-td'),
                'header'  => __('Set your Google Analytics Tracker and keep track of visitors to your site.', 'angle-admin-td'),
                'fields' => array(
                    'google_anal' => array(
                        'name' => __('Google Analytics', 'angle-admin-td'),
                        'desc' => __('Paste your google analytics code here', 'angle-admin-td'),
                        'id' => 'google_anal',
                        'type' => 'text',
                        'default' => 'UA-XXXXX-X',
                    )
                )
            )
        )
    ));
}

$oxy_theme->register_option_page( array(
    'page_title' => __('WooCommerce', 'angle-admin-td'),
    'menu_title' => __('WooCommerce', 'angle-admin-td'),
    'slug'       => THEME_SHORT . '-woocommerce',
    'main_menu'  => false,
    'icon'       => 'tools',
    'sections'   => array(
        'woo-general' => array(
            'title'   => __('General WooCommerce Page Options', 'angle-admin-td'),
            'header'  => __('Change the way your shop page looks with these options.', 'angle-admin-td'),
            'fields' => array(
                array(
                    'name'    => __('General Shop Swatch', 'angle-admin-td'),
                    'desc'    => __('Choose a general colour scheme to use for your WooCommerce site.', 'angle-admin-td'),
                    'id'      => 'woocom_general_swatch',
                    'type'    => 'select',
                    'default' => 'swatch-white-red',
                    'options' => include OXY_THEME_DIR . 'inc/options/shortcodes/shortcode-swatches-options.php'
                ),
                array(
                    'name'    => __('General Shop Decoration', 'angle-admin-td'),
                    'desc'    => __('Choose a decoration style to use at the top of your shop pages.', 'angle-admin-td'),
                    'id'      => 'woocom_general_decoration',
                    'type'    => 'select',
                    'default' => 'none',
                    'options' => include OXY_THEME_DIR . 'inc/options/global-options/section-decorations.php',
                ),
            )
        ),
        'woo-shop-section' => array(
            'title'   => __('Shop Page', 'angle-admin-td'),
            'header'  => __('Change the way your shop page looks with these options.', 'angle-admin-td'),
            'fields' => array(
                array(
                    'name'    => __('Shop Layout', 'angle-admin-td'),
                    'desc'    => __('Layout of your shop page. Choose among right sidebar, left sidebar, fullwidth layout', 'angle-admin-td'),
                    'id'      => 'shop_layout',
                    'type'    => 'radio',
                    'options' => array(
                        'sidebar-right' => __('Right Sidebar', 'angle-admin-td'),
                        'full-width'    => __('Full Width', 'angle-admin-td'),
                        'sidebar-left'  => __('Left Sidebar', 'angle-admin-td'),
                    ),
                    'default' => 'full-width',
                ),
                array(
                    'name'    => __('Shop Page Columns', 'angle-admin-td'),
                    'desc'    => __('Number of columns to use for the products on the main shop page.', 'angle-admin-td'),
                    'id'      => 'woocommerce_shop_page_columns',
                    'type'    => 'slider',
                    'default' => 3,
                    'attr'    => array(
                        'max'  => 4,
                        'min'  => 2,
                        'step' => 1
                    )
                ),
            )
        ),
        'woo-shop-checkout-sidebar' => array(
            'title'   => __('Checkout Sidebar', 'angle-admin-td'),
            'header'  => __('Change the way your shop page looks with these options.', 'angle-admin-td'),
            'fields' => array(
                array(
                    'name'    => __('Checkout Slide Sidebar Swatch', 'angle-admin-td'),
                    'desc'    => __('Choose a color swatch for the cart that slides in from the side.', 'angle-admin-td'),
                    'id'      => 'pageslide_cart_swatch',
                    'type'    => 'select',
                    'default' => 'swatch-white-red',
                    'options' => include OXY_THEME_DIR . 'inc/options/shortcodes/shortcode-swatches-options.php'
                ),
            )
        ),
         'product-slider-section' => array(
            'title' => __('Product Slideshow', 'angle-admin-td'),
            'header'  => __('Setup your product page flexslider options.', 'angle-admin-td'),
            'fields' => array(
                array(
                    'name'      =>  __('Animation style', 'angle-admin-td'),
                    'desc'      =>  __('Select how your slider animates', 'angle-admin-td'),
                    'id'        => 'product_animation',
                    'type'      => 'select',
                    'options'   =>  array(
                        'slide' => __('Slide', 'angle-admin-td'),
                        'fade'  => __('Fade', 'angle-admin-td'),
                    ),
                    'attr'      =>  array(
                        'class'    => 'widefat',
                    ),
                    'default'   => 'slide',
                ),
                array(
                    'name'      => __('Speed', 'angle-admin-td'),
                    'desc'      => __('Set the speed of the slideshow cycling, in milliseconds', 'angle-admin-td'),
                    'id'        => 'product_speed',
                    'type'      => 'slider',
                    'default'   => 7000,
                    'attr'      => array(
                        'max'       => 15000,
                        'min'       => 2000,
                        'step'      => 1000
                    )
                ),
                array(
                    'name'      => __('Duration', 'angle-admin-td'),
                    'desc'      => __('Set the speed of animations', 'angle-admin-td'),
                    'id'        => 'product_duration',
                    'type'      => 'slider',
                    'default'   => 600,
                    'attr'      => array(
                        'max'       => 1500,
                        'min'       => 200,
                        'step'      => 100
                    )
                ),
                array(
                    'name'      => __('Auto start', 'angle-admin-td'),
                    'id'        => 'product_autostart',
                    'type'      => 'radio',
                    'default'   =>  'true',
                    'desc'    => __('Start slideshow automatically', 'angle-admin-td'),
                    'options' => array(
                        'true'  => __('On', 'angle-admin-td'),
                        'false' => __('Off', 'angle-admin-td'),
                    ),
                ),
                array(
                    'name'      => __('Show navigation arrows', 'angle-admin-td'),
                    'id'        => 'product_directionnav',
                    'type'      => 'radio',
                    'desc'    => __('Shows the navigation arrows at the sides of the flexslider.', 'angle-admin-td'),
                    'default'   =>  'hide',
                    'options' => array(
                        'hide' => __('Hide', 'angle-admin-td'),
                        'show' => __('Show', 'angle-admin-td'),
                    ),
                ),
                array(
                    'name'      => __('Navigation arrows type', 'angle-admin-td'),
                    'id'        => 'product_directionnavtype',
                    'type'      => 'radio',
                    'desc'      => __('Type of the direction arrows, fancy (with bg) or simple.', 'angle-admin-td'),
                    'default'   =>  'simple',
                    'options' => array(
                        'simple' => __('Simple', 'angle-admin-td'),
                        'fancy'  => __('Fancy', 'angle-admin-td'),
                    ),
                ),
                array(
                    'name'      => __('Show controls', 'angle-admin-td'),
                    'id'        => 'product_showcontrols',
                    'type'      => 'radio',
                    'default'   =>  'thumbnails',
                    'desc'    => __('If you choose hide the option below will be ignored', 'angle-admin-td'),
                    'options' => array(
                        'hide' => __('Hide', 'angle-admin-td'),
                        'show' => __('Show', 'angle-admin-td'),
                        'thumbnails' => __('Thumbnails', 'angle-admin-td'),
                    ),
                ),
                array(
                    'name'      => __('Choose the place of the controls', 'angle-admin-td'),
                    'id'        => 'product_controlsposition',
                    'type'      => 'radio',
                    'default'   =>  'outside',
                    'desc'    => __('Choose the position of the navigation controls', 'angle-admin-td'),
                    'options' => array(
                        'inside'    => __('Inside', 'angle-admin-td'),
                        'outside'   => __('Outside', 'angle-admin-td'),
                    ),
                ),
                array(
                    'name'      =>  __('Choose the alignment of the controls', 'angle-admin-td'),
                    'id'        => 'product_controlsalign',
                    'type'      => 'radio',
                    'desc'    => __('Choose the alignment of the navigation controls', 'angle-admin-td'),
                    'options'   =>  array(
                        'center' => __('Center', 'angle-admin-td'),
                        'left'   => __('Left', 'angle-admin-td'),
                        'right'  => __('Right', 'angle-admin-td'),
                    ),
                    'attr'      =>  array(
                        'class'    => 'widefat',
                    ),
                    'default'   => 'left',
                ),
            )
        ),
        'product-single-section' => array(
            'title'   => __('Single Product Page', 'angle-admin-td'),
            'header'  => __('This section allows you to set up your social icons for single products.', 'angle-admin-td'),
            'fields' => array(
                array(
                    'name'    => __('Show Facebook Button', 'angle-admin-td'),
                    'desc'    => __('Show facebook share button on your single product', 'angle-admin-td'),
                    'id'      => 'woo_fb_show',
                    'type'    => 'radio',
                    'options' => array(
                        'show' => __('Show', 'angle-admin-td'),
                        'hide' => __('Hide', 'angle-admin-td'),
                    ),
                    'default' => 'show',
                ),
                array(
                    'name'    => __('Show Tweet Button', 'angle-admin-td'),
                    'desc'    => __('Show tweet share button on your single product', 'angle-admin-td'),
                    'id'      => 'woo_twitter_show',
                    'type'    => 'radio',
                    'options' => array(
                        'show' => __('Show', 'angle-admin-td'),
                        'hide' => __('Hide', 'angle-admin-td'),
                    ),
                    'default' => 'show',
                ),
                array(
                    'name'    => __('Show Google+ Button', 'angle-admin-td'),
                    'desc'    => __('Show G+ share button on your single product', 'angle-admin-td'),
                    'id'      => 'woo_google_show',
                    'type'    => 'radio',
                    'options' => array(
                        'show' => __('Show', 'angle-admin-td'),
                        'hide' => __('Hide', 'angle-admin-td'),
                    ),
                    'default' => 'show',
                ),
                array(
                    'name'    => __('Show Pinterest Button', 'angle-admin-td'),
                    'desc'    => __('Show Pinterest share button on your single product', 'angle-admin-td'),
                    'id'      => 'woo_pinterest_show',
                    'type'    => 'radio',
                    'options' => array(
                        'show' => __('Show', 'angle-admin-td'),
                        'hide' => __('Hide', 'angle-admin-td'),
                    ),
                    'default' => 'show',
                ),
                array(
                    'name'    => __('Show LinkedIn Button', 'angle-admin-td'),
                    'desc'    => __('Show LinkedIn share button on your single product', 'angle-admin-td'),
                    'id'      => 'woo_linkedin_show',
                    'type'    => 'radio',
                    'options' => array(
                        'show' => __('Show', 'angle-admin-td'),
                        'hide' => __('Hide', 'angle-admin-td'),
                    ),
                    'default' => 'show',
                )
            )
        ),
        'woo-cart-widget' => array(
            'title'   => __('Cart Popup', 'angle-admin-td'),
            'header'  => __('Change the way your cart popup behaves with these options.', 'angle-admin-td'),
            'fields' => array(
                 array(
                    'name'      => __('Cart Popup', 'angle-admin-td'),
                    'id'        => 'woo_cart_popup',
                    'type'      => 'radio',
                    'default'   =>  'show',
                    'desc'    => __('If you choose show, cart popup will display when you click on the cart widget', 'angle-admin-td'),
                    'options' => array(
                        'hide' => __('Hide', 'angle-admin-td'),
                        'show' => __('Show', 'angle-admin-td'),
                    ),
                ),
            )
        ),
    )
));
$oxy_theme->register_option_page( array(
    'page_title' => __('Default Site Colours', 'angle-admin-td'),
    'menu_title' => __('Colours', 'angle-admin-td'),
    'slug'       => THEME_SHORT . '-default-colours',
    'main_menu'  => false,
    'icon'       => 'tools',
    'javascripts' => array(
        array(
            'handle' => 'default-swatches',
            'src'    => OXY_THEME_URI . 'inc/options/javascripts/pages/default-swatches.js',
            'deps'   => array( 'jquery' ),
            'localize' => array(
                'object_handle' => 'localData',
                'data' => array(
                    'ajaxurl' => admin_url( 'admin-ajax.php' ),
                    'installDefaultsNonce'  => wp_create_nonce( 'install-defaults' )
                )
            ),
        ),
    ),
    'sections'   => array(
        'default-swatch-section' => array(
            'title' => __('Default Swatches Install', 'angle-admin-td'),
            'header'  => __('Re-install the themes default swatches here. <strong>Warning this will remove any modifications you have made to the default swatches</strong>', 'angle-admin-td'),
            'fields' => array(
                array(
                    'name'      =>  __('Re-install Default Swatches', 'angle-admin-td'),
                    'button-text' => __('Install Defaults', 'angle-admin-td'),
                    'desc'    => __('This button will reinstall all the default swatches for the site.', 'angle-admin-td'),
                    'id'        => 'install_defaults',
                    'type'      => 'button',
                    'attr'        => array(
                        'id'    => 'install-default-swatches',
                        'class' => 'button button-primary'
                    ),
                ),
            )
        ),
        'save-all-swatch-section' => array(
            'title' => __('Save all swatches', 'angle-admin-td'),
            'header'  => __('This option will re-save all your enabled swatches.', 'angle-admin-td'),
            'fields' => array(
                array(
                    'name'      =>  __('Save All Swatches', 'angle-admin-td'),
                    'button-text' => __('Save Swatches', 'angle-admin-td'),
                    'desc'    => __('This button will re-save all swatches.', 'angle-admin-td'),
                    'id'        => 'save_all_swatches',
                    'type'      => 'button',
                    'attr'        => array(
                        'id'    => 'save-all-swatches',
                        'class' => 'button button-primary'
                    ),
                ),
            )
        ),
        'default-button-colours-section' => array(
            'title'   => __('Default Button Colours', 'angle-admin-td'),
        'header'  => __('Set the default bootstrap button colours here. See <a target="_blank" href="http://getbootstrap.com/css/#buttons">Bootstrap docs here</a>.', 'angle-admin-td'),
            'fields' => array(
                array(
                    'name'    => __('Text Colour', 'angle-admin-td'),
                    'id'      => 'default_css_default_button_text',
                    'desc'    => __('Text colour to use for the default button.', 'angle-admin-td'),
                    'default' => '#FFF',
                    'type'    => 'colour',
                ),
                array(
                    'name'    => __('Background Colour', 'angle-admin-td'),
                    'id'      => 'default_css_default_button_background',
                    'desc'    => __('Background colour to use for the default button.', 'angle-admin-td'),
                    'default' => '#777777',
                    'type'    => 'colour',
                ),
                array(
                    'name'    => __('Background Hover Colour', 'angle-admin-td'),
                    'id'      => 'default_css_default_button_background_hover',
                    'desc'    => __('Background colour when user hovers over the default button.', 'angle-admin-td'),
                    'default' => '#8B8B8B',
                    'type'    => 'colour',
                ),
            )
        ),
        'warning-button-colours-section' => array(
            'title'   => __('Warning Button Colours', 'angle-admin-td'),
            'header'  => __('Set the warning bootstrap button colours here. See <a target="_blank" href="http://getbootstrap.com/css/#buttons">Bootstrap docs here</a>.', 'angle-admin-td'),
            'fields' => array(
                array(
                    'name'    => __('Warning Button - Text Colour', 'angle-admin-td'),
                    'id'      => 'default_css_warning_button_text',
                    'desc'    => __('Text colour to use for the warning button.', 'angle-admin-td'),
                    'default' => '#FFFFFF',
                    'type'    => 'colour',
                ),
                array(
                    'name'    => __('Warning Button - Background Colour', 'angle-admin-td'),
                    'id'      => 'default_css_warning_button_background',
                    'desc'    => __('Background colour to use for the warning button.', 'angle-admin-td'),
                    'default' => '#F18D38',
                    'type'    => 'colour',
                ),
                array(
                    'name'    => __('Warning Button - Background Hover Colour', 'angle-admin-td'),
                    'id'      => 'default_css_warning_button_background_hover',
                    'desc'    => __('Background colour when user hovers over the warning button.', 'angle-admin-td'),
                    'default' => '#E57211',
                    'type'    => 'colour',
                ),
            )
        ),
        'danger-button-colours-section' => array(
            'title'   => __('Danger Button Colours', 'angle-admin-td'),
            'header'  => __('Set the danger bootstrap button colours here. See <a target="_blank" href="http://getbootstrap.com/css/#buttons">Bootstrap docs here</a>.', 'angle-admin-td'),
            'fields' => array(
                array(
                    'name'    => __('Danger Button - Text Colour', 'angle-admin-td'),
                    'id'      => 'default_css_danger_button_text',
                    'desc'    => __('Text colour to use for the danger button.', 'angle-admin-td'),
                    'default' => '#FFFFFF',
                    'type'    => 'colour',
                ),
                array(
                    'name'    => __('Danger Button - Background Colour', 'angle-admin-td'),
                    'id'      => 'default_css_danger_button_background',
                    'desc'    => __('Background colour to use for the danger button.', 'angle-admin-td'),
                    'default' => '#E74C3C',
                    'type'    => 'colour',
                ),
                array(
                    'name'    => __('Danger Button - Background Hover Colour', 'angle-admin-td'),
                    'id'      => 'default_css_danger_button_background_hover',
                    'desc'    => __('Background colour when user hovers over the danger button.', 'angle-admin-td'),
                    'default' => '#D62C1A',
                    'type'    => 'colour',
                ),
            )
        ),
        'success-button-colours-section' => array(
            'title'   => __('Success Button Colours', 'angle-admin-td'),
            'header'  => __('Set the success bootstrap button colours here. See <a target="_blank" href="http://getbootstrap.com/css/#buttons">Bootstrap docs here</a>.', 'angle-admin-td'),
            'fields' => array(
                array(
                    'name'    => __('Success Button - Text Colour', 'angle-admin-td'),
                    'id'      => 'default_css_success_button_text',
                    'desc'    => __('Text colour to use for the success button.', 'angle-admin-td'),
                    'default' => '#FFFFFF',
                    'type'    => 'colour',
                ),
                array(
                    'name'    => __('Success Button - Background Colour', 'angle-admin-td'),
                    'id'      => 'default_css_success_button_background',
                    'desc'    => __('Background colour to use for the success button.', 'angle-admin-td'),
                    'default' => '#427E77',
                    'type'    => 'colour',
                ),
                array(
                    'name'    => __('Success Button - Background Hover Colour', 'angle-admin-td'),
                    'id'      => 'default_css_success_button_background_hover',
                    'desc'    => __('Background colour when user hovers over the success button.', 'angle-admin-td'),
                    'default' => '#305D57',
                    'type'    => 'colour',
                ),
            )
        ),
        'info-button-colours-section' => array(
            'title'   => __('Info Button Colours', 'angle-admin-td'),
            'header'  => __('Set the info bootstrap button colours here. See <a target="_blank" href="http://getbootstrap.com/css/#buttons">Bootstrap docs here</a>.', 'angle-admin-td'),
            'fields' => array(
                array(
                    'name'    => __('Info Button - Text Colour', 'angle-admin-td'),
                    'id'      => 'default_css_info_button_text',
                    'desc'    => __('Text colour to use for the info button.', 'angle-admin-td'),
                    'default' => '#FFF',
                    'type'    => 'colour',
                ),
                array(
                    'name'    => __('Info Button - Background Colour', 'angle-admin-td'),
                    'id'      => 'default_css_info_button_background',
                    'desc'    => __('Background colour to use for the info button.', 'angle-admin-td'),
                    'default' => '#5D89AC',
                    'type'    => 'colour',
                ),
                array(
                    'name'    => __('Info Button - Background Hover Colour', 'angle-admin-td'),
                    'id'      => 'default_css_info_button_background_hover',
                    'desc'    => __('Background colour when user hovers over the info button.', 'angle-admin-td'),
                    'default' => '#486F8E',
                    'type'    => 'colour',
                ),
            )
        ),
        'icon-button-colours-section' => array(
            'title'   => __('Button Icon Colours', 'angle-admin-td'),
            'header'  => __('Set the colours used for icons when used in buttons.', 'angle-admin-td'),
            'fields' => array(
                array(
                    'name'    => __('Button Icon Colour', 'angle-admin-td'),
                    'id'      => 'default_css_button_icon',
                    'desc'    => __('Text colour to use for icons when used inside buttons.', 'angle-admin-td'),
                    'default' => '#FFFFFF',
                    'type'    => 'colour',
                ),
                array(
                    'name'    => __('Button Icon Background Colour', 'angle-admin-td'),
                    'id'      => 'default_css_button_icon_background',
                    'desc'    => __('Background colour to be used in fancy buttons.', 'angle-admin-td'),
                    'default' => '#FFF',
                    'type'    => 'colour',
                ),
                array(
                    'name'    => __('Button icon Background Opacity %', 'angle-admin-td'),
                    'desc'    => __('How see through is the overlay in percentage.', 'angle-admin-td'),
                    'id'      => 'default_css_button_icon_background_alpha',
                    'type'    => 'slider',
                    'default' => 20,
                    'attr'    => array(
                        'max'  => 100,
                        'min'  => 0,
                        'step' => 1
                    )
                ),
            )
        ),
        'overlays-colours-section' => array(
            'title'   => __('Overlay Colours', 'angle-admin-td'),
            'header'  => __('Set the colours used in overlay areas.', 'angle-admin-td'),
            'fields' => array(
                array(
                    'name'    => __('Overlay Text', 'angle-admin-td'),
                    'id'      => 'default_css_overlay',
                    'desc'    => __('Text colour to text inside overlay areas.', 'angle-admin-td'),
                    'default' => '#FFF',
                    'type'    => 'colour',
                ),
                array(
                    'name'    => __('Overlay Background Colour', 'angle-admin-td'),
                    'id'      => 'default_css_overlay_background',
                    'desc'    => __('Background colour to be used in overlay areas.', 'angle-admin-td'),
                    'default' => '#000',
                    'type'    => 'colour',
                ),
                array(
                    'name'    => __('Overlay Background Opacity %', 'angle-admin-td'),
                    'desc'    => __('How see through is the overlay in percentage.', 'angle-admin-td'),
                    'id'      => 'default_css_overlay_background_alpha',
                    'type'    => 'slider',
                    'default' => 80,
                    'attr'    => array(
                        'max'  => 100,
                        'min'  => 0,
                        'step' => 1
                    )
                ),

            )
        ),
        'magnific-colours-section' => array(
            'title'   => __('Magnific (image lightbox) Colours ', 'angle-admin-td'),
            'header'  => __('Set the colours used in overlay when an image preview is clicked.', 'angle-admin-td'),
            'fields' => array(
                array(
                    'name'    => __('Preview Background Colour', 'angle-admin-td'),
                    'id'      => 'default_css_magnific_background',
                    'desc'    => __('Background colour to be used in overlay areas.', 'angle-admin-td'),
                    'default' => '#FFF',
                    'type'    => 'colour',
                ),
                array(
                    'name'    => __('Preview Background Opacity %', 'angle-admin-td'),
                    'desc'    => __('How see through is the overlay in percentage.', 'angle-admin-td'),
                    'id'      => 'default_css_magnific_background_alpha',
                    'type'    => 'slider',
                    'default' => 95,
                    'attr'    => array(
                        'max'  => 100,
                        'min'  => 0,
                        'step' => 1
                    )
                ),
                array(
                    'name'    => __('Close Button Icon Colour', 'angle-admin-td'),
                    'id'      => 'default_css_magnific_close_icon',
                    'desc'    => __('Text colour to use for preview close button icon.', 'angle-admin-td'),
                    'default' => '#FFF',
                    'type'    => 'colour',
                ),
                array(
                    'name'    => __('Close  Button Icon Background Colour', 'angle-admin-td'),
                    'id'      => 'default_css_magnific_close_icon_background',
                    'desc'    => __('Background colour to be used for preview close button.', 'angle-admin-td'),
                    'default' => '#E74C3C',
                    'type'    => 'colour',
                ),
            )
        ),
        'portfolio-colours-section' => array(
            'title'   => __('Portfolio Hover Colours ', 'angle-admin-td'),
            'header'  => __('Set the colours used in portfolios when you hover over an item.', 'angle-admin-td'),
            'fields' => array(
                array(
                    'name'    => __('Hover Text', 'angle-admin-td'),
                    'id'      => 'default_css_portfolio_hover_text',
                    'desc'    => __('Text colour to use inside hover .', 'angle-admin-td'),
                    'default' => '#FFF',
                    'type'    => 'colour',
                ),
                array(
                    'name'    => __('Hover Button Icon Colour', 'angle-admin-td'),
                    'id'      => 'default_css_portfolio_hover_button_icon',
                    'desc'    => __('Icon colour to use for bottom buttons shown on hover.', 'angle-admin-td'),
                    'default' => '#FFF',
                    'type'    => 'colour',
                ),
                array(
                    'name'    => __('Hover Button Icon Background Colour', 'angle-admin-td'),
                    'id'      => 'default_css_portfolio_hover_button_background',
                    'desc'    => __('Background colour to use for bottom buttons shown on hover.', 'angle-admin-td'),
                    'default' => '#E74C3C',
                    'type'    => 'colour',
                ),
                array(
                    'name'    => __('Hover Background Colour', 'angle-admin-td'),
                    'id'      => 'default_css_portfolio_hover_background',
                    'desc'    => __('Background colour to be used when user hovers over item.', 'angle-admin-td'),
                    'default' => '#000',
                    'type'    => 'colour',
                ),
                array(
                    'name'    => __('Hover Background Opacity %', 'angle-admin-td'),
                    'desc'    => __('How see through is the hover overlay in percentage.', 'angle-admin-td'),
                    'id'      => 'default_css_portfolio_hover_background_alpha',
                    'type'    => 'slider',
                    'default' => 80,
                    'attr'    => array(
                        'max'  => 100,
                        'min'  => 0,
                        'step' => 1
                    )
                ),
            )
        ),
        'go-to-top-colours-section' => array(
            'title'   => __('Go to top button Colours ', 'angle-admin-td'),
            'header'  => __('Set the colours used in go to top button that appears on scrolling a page.', 'angle-admin-td'),
            'fields' => array(
                array(
                    'name'    => __('Button Icon Colour', 'angle-admin-td'),
                    'id'      => 'default_css_gototop_icon',
                    'desc'    => __('Icon colour to use for go to top button.', 'angle-admin-td'),
                    'default' => '#FFF',
                    'type'    => 'colour',
                ),
                array(
                    'name'    => __('Button Background Colour', 'angle-admin-td'),
                    'id'      => 'default_css_gototop_background',
                    'desc'    => __('Background colour to use for go to top button.', 'angle-admin-td'),
                    'default' => '#E32F1C',
                    'type'    => 'colour',
                ),
                array(
                    'name'    => __('Button Background Opacity %', 'angle-admin-td'),
                    'desc'    => __('How see through is the go to top button in percentage.', 'angle-admin-td'),
                    'id'      => 'default_css_gototop_background_alpha',
                    'type'    => 'slider',
                    'default' => 100,
                    'attr'    => array(
                        'max'  => 100,
                        'min'  => 0,
                        'step' => 1
                    )
                ),
            )
        ),
        'loader-colours-section' => array(
            'title'   => __('Loader Colours ', 'angle-admin-td'),
            'header'  => __('Set the colours of the loader.', 'angle-admin-td'),
            'fields' => array(
                array(
                    'name'    => __('Loader Colour', 'angle-admin-td'),
                    'id'      => 'loader_color',
                    'desc'    => __('Color of the loader', 'angle-admin-td'),
                    'default' => '#ffffff',
                    'type'    => 'colour',
                ),
                array(
                    'name'    => __('Loader background', 'angle-admin-td'),
                    'id'      => 'loader_bg',
                    'desc'    => __('Background colour of the loader.', 'angle-admin-td'),
                    'default' => '#e74c3c',
                    'format' => 'rgba',
                    'type'    => 'colour',
                )
            )
        )
    )
));
$oxy_theme->register_option_page(array(
    'page_title' => __('Typography Settings', 'angle-admin-td'),
    'menu_title' => __('Typography', 'angle-admin-td'),
    'slug'       => THEME_SHORT . '-typography',
    'main_menu'  => false,
    'icon'       => 'tools',
    'stylesheets' => array(
        array(
            'handle' => 'typography-page',
            'src'    => OXY_THEME_URI . 'vendor/oxygenna/oxygenna-typography/assets/css/typography-page.css',
            'deps'   => array('oxy-typography-select2', 'thickbox'),
        ),
    ),
    'javascripts' => array(
        array(
            'handle' => 'typography-page',
            'src'    => OXY_THEME_URI . 'vendor/oxygenna/oxygenna-typography/assets/javascripts/typography-page.js',
            'deps'   => array('jquery', 'underscore', 'thickbox', 'oxy-typography-select2', 'jquery-ui-dialog'),
            'localize' => array(
                'object_handle' => 'typographyPage',
                'data' => array(
                    'ajaxurl' => admin_url('admin-ajax.php'),
                    'listNonce'  => wp_create_nonce('list-fontstack'),
                    'fontModal'  => wp_create_nonce('font-modal'),
                    'updateNonce'  => wp_create_nonce('update-fontstack'),
                    'defaultFontsNonce' => wp_create_nonce('default-fonts'),
                )
            )
        ),
    ),
    // include a font stack option to enqueue select 2 ok
    'sections'   => array(
        'font-section' => array(
            'title'   => __('Fonts settings section', 'angle-admin-td'),
            'header'  => __('Setup Fonts settings here.', 'angle-admin-td'),
            'fields' => array(
                array(
                    'name' => __('Font Stack:', 'angle-admin-td'),
                    'id' => 'font_list',
                    'type' => 'fontlist',
                    'class-file' => OXY_THEME_DIR . 'vendor/oxygenna/oxygenna-typography/inc/options/font-list.php',
                ),
            )
        )
    )
));

$oxy_theme->register_option_page(array(
    'page_title' => __('Fonts', 'angle-admin-td'),
    'menu_title' => __('Fonts', 'angle-admin-td'),
    'slug'       => THEME_SHORT . '-fonts',
    'main_menu'  => false,
    'icon'       => 'tools',
    'sections'   => array(
        'google-fonts-section' => array(
            'title'   => __('Google Fonts', 'angle-admin-td'),
            // 'header'  => __('Setup Your Google Fonts Here.', 'angle-admin-td'),
            'fields' => array(
                array(
                    'name'        => __('Fetch Google Fonts', 'angle-admin-td'),
                    'button-text' => __('Update Fonts', 'angle-admin-td'),
                    'id'          => 'google_update_fonts_button',
                    'type'        => 'button',
                    'desc'        => __('Click this button to fetch the latest fonts from Google and update your Google Fonts list.', 'angle-admin-td'),
                    'attr'        => array(
                        'id'    => 'google-update-fonts-button',
                        'class' => 'button button-primary'
                    ),
                    'javascripts' => array(
                        array(
                            'handle' => 'google-font-updater',
                            'src'    => OXY_THEME_URI . 'vendor/oxygenna/oxygenna-typography/assets/javascripts/options/google-font-updater.js',
                            'deps'   => array('jquery'),
                            'localize' => array(
                                'object_handle' => 'googleUpdate',
                                'data' => array(
                                    'ajaxurl'   => admin_url('admin-ajax.php'),
                                    // generate a nonce with a unique ID "myajax-post-comment-nonce"
                                    // so that you can check it later when an AJAX request is sent
                                    'nonce'     => wp_create_nonce('google-fetch-fonts-nonce'),
                                )
                            )
                        ),
                    ),
                )
            )
        ),
        'typekit-provider-options' => array(
            'title'   => __('TypeKit Fonts', 'angle-admin-td'),
            'header'  => __('If you have a TypeKit account and would like to use it in your site.  Enter your TypeKit API key below and then click the Update your kits button.', 'angle-admin-td'),
            'fields' => array(
                array(
                    'name' => __('Typekit API Token', 'angle-admin-td'),
                    'desc' => __('Add your typekit api token here', 'angle-admin-td'),
                    'id'   => 'typekit_api_token',
                    'type' => 'text',
                    'attr'        => array(
                        'id'    => 'typekit-api-key',
                    )
                ),
                array(
                    'name'        => __('TypeKit Kits', 'angle-admin-td'),
                    'button-text' => __('Update your kits', 'angle-admin-td'),
                    'desc' => __('Click this button to update your typography list with the kits available from your TypeKit account.', 'angle-admin-td'),
                    'id'          => 'typekit_kits_button',
                    'type'        => 'button',
                    'attr'        => array(
                        'id'    => 'typekit-kits-button',
                        'class' => 'button button-primary'
                    ),
                    'javascripts' => array(
                        array(
                            'handle' => 'typekit-kit-updater',
                            'src'    => OXY_THEME_URI . 'vendor/oxygenna/oxygenna-typography/assets/javascripts/options/typekit-updater.js',
                            'deps'   => array('jquery' ),
                            'localize' => array(
                                'object_handle' => 'typekitUpdate',
                                'data' => array(
                                    'ajaxurl'   => admin_url('admin-ajax.php'),
                                    'nonce'     => wp_create_nonce('typekit-kits-nonce'),
                                )
                            )
                        ),
                    ),
                )
            )
        )
    )
));
