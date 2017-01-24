<?php
/**
 * Creates all theme metaboxes
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

$extra_header_options = array(
     array(
        'name' => __('Show Header', 'angle-admin-td'),
        'desc' => __('Show or hide the header.', 'angle-admin-td'),
        'id'   => 'show_header',
        'type' => 'select',
        'default' => 'hide',
        'options' => array(
            'hide' => __('Hide', 'angle-admin-td'),
            'show' => __('Show', 'angle-admin-td'),
        ),
    ),
    array(
        'name'    => __('Header Height', 'angle-admin-td'),
        'desc'    => __('Choose the amount of padding added to the height of the header', 'angle-admin-td'),
        'id'      => 'header_height',
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
        'id'      => 'header_swatch',
        'type' => 'select',
        'default' => 'swatch-red-white',
        'options' => include OXY_THEME_DIR . 'inc/options/shortcodes/shortcode-swatches-options.php'
    )
);
$section_header_options = include OXY_THEME_DIR . 'inc/options/global-options/section-header-text.php';
$section_header_background_options = include OXY_THEME_DIR . 'inc/options/global-options/section-background-image.php';

/*  PAGE HEADER OPTIONS */
$oxy_theme->register_metabox( array(
    'id' => 'page_header_header',
    'title' => __('Header Options', 'angle-admin-td'),
    'priority' => 'default',
    'context' => 'advanced',
    'pages' => array('page', 'oxy_service'),
    'javascripts' => array(
        array(
            'handle' => 'header_options_script',
            'src'    => OXY_THEME_URI . 'inc/assets/js/metaboxes/header-options.js',
            'deps'   => array( 'jquery'),
            'localize' => array(
                'object_handle' => 'theme',
                'data'          => THEME_SHORT
            ),
        ),
    ),
    'fields' => array_merge( $extra_header_options, $section_header_options, $section_header_background_options )
));

// Page sidebar option
$oxy_theme->register_metabox( array(
    'id' => 'page_sidebar_swatch',
    'title' => __('Sidebar Template Options', 'angle-admin-td'),
    'priority' => 'default',
    'context' => 'advanced',
    'pages' => array('page', 'oxy_service'),
    'javascripts' => array(
        array(
            'handle' => 'sidebar_swatch',
            'src'    => OXY_THEME_URI . 'inc/assets/js/metaboxes/sidebar-options.js',
            'deps'   => array( 'jquery'),
        ),
    ),
    'fields' => array(
        array(
            'name'    => __('Page Swatch', 'angle-admin-td'),
            'desc'    => __('Select the colour scheme to use for this page and sidebar.', 'angle-admin-td'),
            'id'      => 'sidebar_page_swatch',
            'type' => 'select',
            'default' => 'swatch-white-red',
            'options' => include OXY_THEME_DIR . 'inc/options/shortcodes/shortcode-swatches-options.php'
        ),
        array(
            'name'    => __('Page Decoration', 'angle-admin-td'),
            'desc'    => __('Choose a decoration to use at the top of this page.', 'angle-admin-td'),
            'id'      => 'sidebar_page_decoration',
            'type'    => 'select',
            'default' => '',
            'options' => include OXY_THEME_DIR . 'inc/options/global-options/section-decorations.php',
        ),
    )
));

/*  PAGE HEADER OPTIONS */
$default_swatches = include OXY_THEME_DIR . 'inc/options/shortcodes/shortcode-swatches-options.php';
$oxy_theme->register_metabox( array(
    'id' => 'page_site_overrides',
    'title' => __('Site Overrides', 'angle-admin-td'),
    'priority' => 'default',
    'context' => 'advanced',
    'pages' => array('page'),
    'fields' => array(
        array(
            'name'    => __('Show Top Bar', 'angle-admin-td'),
            'desc'    => __('Show or hide the sites top bar (ideal for landing pages).', 'angle-admin-td'),
            'id'      => 'site_top_bar',
            'type' => 'select',
            'default' => 'show',
            'options' => array(
                'show' => __('Show Top Bar', 'angle-admin-td'),
                'hide' => __('Hide Top Bar', 'angle-admin-td'),
            )
        ),
        array(
            'name'    => __('Show Top Navigation', 'angle-admin-td'),
            'desc'    => __('Show or hide the sites top navigation (ideal for landing pages).', 'angle-admin-td'),
            'id'      => 'site_top_nav',
            'type' => 'select',
            'default' => 'show',
            'options' => array(
                'show' => __('Show Top Nav', 'angle-admin-td'),
                'hide' => __('Hide Top Nav', 'angle-admin-td'),
            )
        ),
        array(
            'name'    => __('Override Top Navigation Swatch', 'angle-admin-td'),
            'desc'    => __('Override the default site top nav swatch (only for this page).', 'angle-admin-td'),
            'id'      => 'site_top_swatch',
            'type' => 'select',
            'default' => '',
            'options' => array_merge( array(
                '' => __('Default Top Nav Swatch', 'angle-admin-td'),
            ), $default_swatches )
        ),
        array(
            'name'    => __('Override Footer Swatch', 'angle-admin-td'),
            'desc'    => __('Override the default site footer swatch (only for this page).', 'angle-admin-td'),
            'id'      => 'site_footer_swatch',
            'type' => 'select',
            'default' => '',
            'options' => array_merge( array(
                '' => __('Default Footer Swatch', 'angle-admin-td'),
            ), $default_swatches )
        ),
    )
));

/* SWATCH METABOX */
$oxy_theme->register_metabox( array(
    'id'       => 'swatch_colours_metabox',
    'title'    => __('Swatch Colours', 'angle-admin-td'),
    'priority' => 'default',
    'context'  => 'advanced',
    'pages'    => array('oxy_swatch'),
    'fields'   => array(
        array(
            'name'    => __('Text Colour', 'angle-admin-td'),
            'id'      => 'text',
            'desc'    => __('Text colour to use for this swatch.', 'angle-admin-td'),
            'default' => '#444',
            'type'    => 'colour',
        ),
        array(
            'name'    => __('Heading Colour', 'angle-admin-td'),
            'id'      => 'header',
            'desc'    => __('Colour of all headings in this swatch.', 'angle-admin-td'),
            'default' => '#222',
            'type'    => 'colour',
        ),
        array(
            'name'    => __('Small Colour', 'angle-admin-td'),
            'id'      => 'small',
            'desc'    => __('Colour of <small> tags.', 'angle-admin-td'),
            'default' => '#666',
            'type'    => 'colour',
        ),
        array(
            'name'    => __('Icon Colour', 'angle-admin-td'),
            'id'      => 'icon',
            'desc'    => __('Colour of all icons.', 'angle-admin-td'),
            'default' => '#444',
            'type'    => 'colour',
        ),
        array(
            'name'    => __('Link Colour', 'angle-admin-td'),
            'id'      => 'link',
            'desc'    => __('Colour of all text links.', 'angle-admin-td'),
            'default' => '#e74c3c',
            'type'    => 'colour',
        ),
        array(
            'name'    => __('Link Colour Hover', 'angle-admin-td'),
            'id'      => 'link_hover',
            'desc'    => __('Colour of all text links on hover.', 'angle-admin-td'),
            'default' => '#df2e1b',
            'type'    => 'colour',
        ),
        array(
            'name'    => __('Link Colour Active', 'angle-admin-td'),
            'id'      => 'link_active',
            'desc'    => __('Colour of all text links he moment it is clicked.', 'angle-admin-td'),
            'default' => '#df2e1b',
            'type'    => 'colour',
        ),
        array(
            'name'    => __('Link Colour Headings', 'angle-admin-td'),
            'id'      => 'link_headings',
            'desc'    => __('Colour of all heading links.', 'angle-admin-td'),
            'default' => '#e74c3c',
            'type'    => 'colour',
        ),
        array(
            'name'    => __('Background Colour', 'angle-admin-td'),
            'id'      => 'background',
            'desc'    => __('Background colour used for this swatch.', 'angle-admin-td'),
            'default' => '#FFF',
            'type'    => 'colour',
        ),
        array(
            'name'    => __('Foreground Colour', 'angle-admin-td'),
            'id'      => 'foreground',
            'desc'    => __('Colour used for foreground elements in this swatch.', 'angle-admin-td'),
            'default' => '#e74c3c',
            'type'    => 'colour',
        ),
        array(
            'name'    => __('Overlay Colour', 'angle-admin-td'),
            'id'      => 'overlay',
            'desc'    => __('Colour used for overlays e.g. portfolio hover effect.', 'angle-admin-td'),
            'default' => '#000',
            'type'    => 'colour',
        ),
        array(
            'name'    => __('Overlay Opacity %', 'angle-admin-td'),
            'desc'    => __('How see through is the overlay in percentage.', 'angle-admin-td'),
            'id'      => 'overlay_alpha',
            'type'    => 'slider',
            'default' => 7,
            'attr'    => array(
                'max'  => 100,
                'min'  => 0,
                'step' => 1
            )
        ),
        array(
            'name'    => __('Form Background Colour', 'angle-admin-td'),
            'id'      => 'form_background',
            'desc'    => __('Colour used for background of form elements.', 'angle-admin-td'),
            'default' => '#e9eeef',
            'type'    => 'colour',
        ),
        array(
            'name'    => __('Form Text Colour', 'angle-admin-td'),
            'id'      => 'form_text',
            'desc'    => __('Colour used for text of form elements.', 'angle-admin-td'),
            'default' => '#888',
            'type'    => 'colour',
        ),
        array(
            'name'    => __('Form Active Colour', 'angle-admin-td'),
            'id'      => 'form_active',
            'desc'    => __('Colour used for border of an active input element.', 'angle-admin-td'),
            'default' => '#cddadd',
            'type'    => 'colour',
        ),
        array(
            'name'    => __('Primary Button Colour', 'angle-admin-td'),
            'id'      => 'primary_button_background',
            'desc'    => __('Colour used for all primary buttons used in this swatch.', 'angle-admin-td'),
            'default' => '#e74c3c',
            'type'    => 'colour',
        ),
        array(
            'name'    => __('Primary Button Text Colour', 'angle-admin-td'),
            'id'      => 'primary_button_text',
            'desc'    => __('Colour used for all primary button text used in this swatch.', 'angle-admin-td'),
            'default' => '#FFF',
            'type'    => 'colour',
        )
    )
));

// swatch status metabox
$oxy_theme->register_metabox( array(
    'id'       => 'swatch_status_metabox',
    'title'    => __('Swatch Status', 'angle-admin-td'),
    'priority' => 'default',
    'context'  => 'side',
    'pages'    => array('oxy_swatch'),
    'fields'   => array(
        array(
            'name'    => __('Swatch Status', 'angle-admin-td'),
            'id'      => 'status',
            'desc'    => __('Turns the swatch on and off.', 'angle-admin-td'),
            'default' => 'active',
            'type'    => 'select',
            'options' => array(
                'enabled' => __('Enabled', 'angle-admin-td'),
                'disabled' => __('Disabled', 'angle-admin-td'),
            )
        ),
    )
));

$link_options = array(
    'id'    => 'link_metabox',
    'title' => __('Link', 'angle-admin-td'),
    'priority' => 'default',
    'context'  => 'advanced',
    'pages'    => array('oxy_service', 'oxy_staff', 'oxy_portfolio_image'),
    'javascripts' => array(
        array(
            'handle' => 'slider_links_options_script',
            'src'    => OXY_THEME_URI . 'inc/assets/js/metaboxes/slider-links-options.js',
            'deps'   => array( 'jquery'),
            'localize' => array(
                'object_handle' => 'theme',
                'data'          => THEME_SHORT
            ),
        ),
    ),
    'fields'  => array(
        array(
            'name' => __('Link Type', 'angle-admin-td'),
            'desc' => __('Make this post link to something.  Default link will link to the single item page.', 'angle-admin-td'),
            'id'   => 'link_type',
            'type' => 'select',
            'options' => array(
                'default'   => __('Default Link', 'angle-admin-td'),
                'page'      => __('Page', 'angle-admin-td'),
                'post'      => __('Post', 'angle-admin-td'),
                'portfolio' => __('Portfolio', 'angle-admin-td'),
                'category'  => __('Category', 'angle-admin-td'),
                'url'       => __('URL', 'angle-admin-td')
            ),
            'default' => 'default',
        ),
        array(
            'name'     => __('Page Link', 'angle-admin-td'),
            'desc'     => __('Choose a page to link this item to', 'angle-admin-td'),
            'id'       => 'page_link',
            'type'     => 'select',
            'options'  => 'taxonomy',
            'taxonomy' => 'pages',
            'default' =>  '',
        ),
        array(
            'name'     => __('Post Link', 'angle-admin-td'),
            'desc'     => __('Choose a post to link this item to', 'angle-admin-td'),
            'id'       => 'post_link',
            'type'     => 'select',
            'options'  => 'taxonomy',
            'taxonomy' => 'posts',
            'default' =>  '',
        ),
        array(
            'name'     => __('Portfolio Link', 'angle-admin-td'),
            'desc'     => __('Choose a portfolio item to link this item to', 'angle-admin-td'),
            'id'       => 'portfolio_link',
            'type'     => 'select',
            'options'  => 'taxonomy',
            'taxonomy' => 'oxy_portfolio_image',
            'default' =>  '',
        ),
        array(
            'name'     => __('Category Link', 'angle-admin-td'),
            'desc'     => __('Choose a category list to link this item to', 'angle-admin-td'),
            'id'       => 'category_link',
            'type'     => 'select',
            'options'  => 'categories',
            'default' =>  '',
        ),
        array(
            'name'    => __('URL Link', 'angle-admin-td'),
            'desc'     => __('Choose a URL to link this item to', 'angle-admin-td'),
            'id'      => 'url_link',
            'type'    => 'text',
            'default' =>  '',
        ),
        array(
            'name'    => __('Open Link In', 'angle-admin-td'),
            'id'      => 'target',
            'type'    => 'select',
            'default' => '_self',
            'options' => array(
                '_self'   => __('Same page as it was clicked ', 'angle-admin-td'),
                '_blank'  => __('Open in new window/tab', 'angle-admin-td'),
                '_parent' => __('Open the linked document in the parent frameset', 'angle-admin-td'),
                '_top'    => __('Open the linked document in the full body of the window', 'angle-admin-td')
            ),
            'desc'    => __('Where the link will open.', 'angle-admin-td'),
        ),
    ),
);

$oxy_theme->register_metabox( $link_options );

// modify link options metabox for slideshow image before registering
unset($link_options['fields'][0]['options']['default']);
$link_options['fields'][0]['options']['none'] = __('No Link', 'angle-admin-td');
$link_options['fields'][0]['default'] = 'none';
$link_options['pages'] = array('oxy_slideshow_image');
$link_options['id'] = 'slide_link_metabox';
$link_options['fields'][6]['options']['magnific'] = __('Open in magnific popup', 'angle-admin-td');

$oxy_theme->register_metabox( $link_options );


$oxy_theme->register_metabox( array(
    'id' => 'Citation',
    'title' => __('Citation', 'angle-admin-td'),
    'priority' => 'default',
    'context' => 'advanced',
    'pages' => array('oxy_testimonial'),
    'fields' => array(
        array(
            'name'    => __('Citation', 'angle-admin-td'),
            'desc'    => __('Reference to the source of the quote', 'angle-admin-td'),
            'id'      => 'citation',
            'type'    => 'text',
        ),
    )
));

$oxy_theme->register_metabox( array(
    'id' => 'services_icon_metabox',
    'title' => __('Service Image & Icon', 'angle-admin-td'),
    'priority' => 'default',
    'context' => 'advanced',
    'pages' => array('oxy_service'),
    'fields' => array(
        array(
            'name' => __('Image Type', 'angle-admin-td'),
            'id'   => 'image_type',
            'desc'    => __('Services can show an uploaded Image, or an Icon or Both Image and Icon.', 'angle-admin-td'),
            'type' => 'select',
            'options' => array(
                'image'       => __('Featured Image', 'angle-admin-td'),
                'icon'        => __('Icon', 'angle-admin-td'),
                'both'        => __('Featured Image & Icon', 'angle-admin-td'),
                'nothing'     => __('Nothing', 'angle-admin-td'),
            )
        ),
        array(
            'name'    => __('Icon', 'angle-admin-td'),
            'desc'    => __('If you select Icon or Featured Image & Icon Image Type this is the icon that will be used.', 'angle-admin-td'),
            'id'      => 'icon',
            'type'    => 'select',
            'options' => 'icons',
        ),
        array(
            'name'    => __('Animation', 'angle-admin-td'),
            'desc'    => __('If you select Icon or Featured Image & Icon Image Type the animation will be applied to the icon. If Feature Image is selected, the animation will be applied to the image.', 'angle-admin-td'),
            'id'      => 'icon_animation',
            'type'    => 'select',
            'default' => 'bounce',
            'options' => include OXY_THEME_DIR . 'inc/options/shortcodes/shortcode-button-animations.php'
        ),
    )
));

// STAFF METABOXES

$oxy_theme->register_metabox( array(
    'id' => 'staff_swatch',
    'title' => __('Swatch', 'angle-admin-td'),
    'priority' => 'default',
    'context' => 'advanced',
    'pages' => array('oxy_staff'),
    'fields' => array(
        array(
            'name'    => __('Staff Detail Section Swatch', 'angle-admin-td'),
            'desc'    => __('Select the colour scheme to use for the top section in the detail page.', 'angle-admin-td'),
            'id'      => 'staff_swatch',
            'type' => 'select',
            'default' => 'swatch-white-red',
            'options' => include OXY_THEME_DIR . 'inc/options/shortcodes/shortcode-swatches-options.php'
        )
    )
));

$oxy_theme->register_metabox( array(
    'id' => 'staff_info',
    'title' => __('Personal Details', 'angle-admin-td'),
    'priority' => 'default',
    'context' => 'advanced',
    'pages' => array('oxy_staff'),
    'fields' => array(
        array(
            'name'    => __('Job Title', 'angle-admin-td'),
            'desc'    => __('Sub header that is shown below the staff members name.', 'angle-admin-td'),
            'id'      => 'position',
            'type'    => 'text',
        ),
        array(
            'name'    => __('Personal Moto Title', 'angle-admin-td'),
            'desc'    => __('The cheeky title that pops up when a staff member image is hovered over.', 'angle-admin-td'),
            'id'      => 'moto_title',
            'type'    => 'text',
        ),
        array(
            'name'    => __('Personal Moto Text', 'angle-admin-td'),
            'desc'    => __('The cheeky text that pops up when a staff member image is hovered over.', 'angle-admin-td'),
            'id'      => 'moto_text',
            'type'    => 'text',
        ),
    )
));

$staff_social = array();
for( $i = 0 ; $i < 5 ; $i++ ) {
    $staff_social[] =
        array(
            'name' => __('Social Icon', 'angle-admin-td') . ' ' . ($i+1),
            'desc' => __('Social Network Icon to show for this Staff Member', 'angle-admin-td'),
            'id'   => 'icon' . $i,
            'type' => 'select',
            'options' => 'icons',
        );
    $staff_social[] =
        array(
            'name'  => __('Social Link', 'angle-admin-td'). ' ' . ($i+1),
            'desc' => __('Add the url to the staff members social network here.', 'angle-admin-td'),
            'id'    => 'link' . $i,
            'type'  => 'text',
            'std'   => '',
        );
}

$oxy_theme->register_metabox( array(
    'id' => 'staff_social',
    'title' => __('Social', 'angle-admin-td'),
    'priority' => 'default',
    'context' => 'advanced',
    'pages' => array('oxy_staff'),
    'fields' => $staff_social,
));

$oxy_theme->register_metabox( array(
    'id' => 'portfolio_template_metabox',
    'title' => __('Portfolio Options', 'angle-admin-td'),
    'priority' => 'default',
    'context' => 'advanced',
    'pages' => array('oxy_portfolio_image'),
    'fields' => array(
        array(
            'name'    => __('Portfolio Swatch', 'angle-admin-td'),
            'desc'    => __('Select the colour scheme to use for the portfolio.', 'angle-admin-td'),
            'id'      => 'portfolio_swatch',
            'type' => 'select',
            'default' => 'swatch-white-red',
            'options' => include OXY_THEME_DIR . 'inc/options/shortcodes/shortcode-swatches-options.php'
        ),
        array(
            'name' => __('Portfolio Template', 'angle-admin-td'),
            'id'   => 'template',
            'desc'    => __("Select a template to use for this portfolio item single page.<br><strong>Big Image</strong> - Will add a full width header to the top of the page which will contain the featured image, Header Title & Description with the skill list on the right side <a href='http://themes.oxygenna.com/swatch/?oxy_portfolio_image=vimeo-video' target='_blank'>like this</a>.<br><strong>Smaller Image</strong> - Will create a header with a smaller image and Header Title, Description and link on the right side of the image <a href='http://themes.oxygenna.com/swatch/?oxy_portfolio_image=integer-sollicitudin' target='_blank'>like this</a>.<br><strong>Full Width Page</strong> - Allows you to create your own page using sections, just like a regular full width page.", 'angle-admin-td'),
            'type' => 'select',
            'options' => array(
                'big'     => __('Big Image', 'angle-admin-td'),
                'small'   => __('Smaller Image', 'angle-admin-td'),
                'page.php'=> __('Fullwidth Page Template', 'angle-admin-td'),
            )
        ),
        array(
            'name'    => __('Top Navigation', 'angle-admin-td'),
            'desc'    => __('Display navigation and title at the top of the page.Otherwise only title will be displayed above description', 'angle-admin-td'),
            'id'      => 'navigation',
            'type'    => 'select',
            'options' => array(
                'on'    => __('On', 'angle-admin-td'),
                'off'   => __('Off', 'angle-admin-td'),
            ),
            'default' => 'on',
        ),
        array(
            'name'  => __('Small template side text', 'angle-admin-td'),
            'id'    => 'description',
            'type'  => 'textarea',
            'attr'  => array( 'rows' => '10', 'style' => 'width:100%' ),
            'desc'  => __('Text will appear in single portfolio small template on the right side of the page', 'angle-admin-td'),
            'std'   => '',
        ),
        array(
            'name'  => __('External url', 'angle-admin-td'),
            'desc'  => __('Link will appear in the single portfolio item underneath the skills list.', 'angle-admin-td'),
            'id'    => 'link',
            'type'  => 'text',
            'std'   => '',
        ),
    )
));

$oxy_theme->register_metabox( array(
    'id'       => 'service_template_metabox',
    'title'    => __('Service Template', 'angle-admin-td'),
    'priority' => 'default',
    'context'  => 'advanced',
    'pages'    => array('oxy_service'),
    'fields'   => array(
        array(
            'name'    => __('Service Page Template', 'angle-admin-td'),
            'id'      => 'template',
            'desc'    => __('Select a page template to use for this service', 'angle-admin-td'),
            'type'    => 'select',
            'options' => array(
                'page.php'                  => __('Full Width', 'angle-admin-td'),
                'template-leftsidebar.php'  => __('Left Sidebar', 'angle-admin-td'),
                'template-rightsidebar.php' => __('Right Sidebar', 'angle-admin-td'),
            ),
            'default' => 'page.php',
        ),
    )
));

$product_category_options = array(
    array(
        'name'    => __('Category Swatch', 'angle-admin-td'),
        'desc'    => __('Swatch that will be used by this category page.', 'angle-admin-td'),
        'id'      => 'category_swatch',
        'type'    => 'select',
        'default' => 'swatch-white-red',
        'options' => include OXY_THEME_DIR . 'inc/options/shortcodes/shortcode-swatches-options.php'
    ),
    array(
        'name'    => __('Category Decoration', 'angle-admin-td'),
        'desc'    => __('Choose a decoration style to use at the top of your category page.', 'angle-admin-td'),
        'id'      => 'category_decoration',
        'type'    => 'select',
        'default' => '',
        'options' => include OXY_THEME_DIR . 'inc/options/global-options/section-decorations.php',
    ),
    array(
        'name'    => __('Product Columns', 'angle-admin-td'),
        'desc'    => __('Number of columns to use for products on this page.', 'angle-admin-td'),
        'id'      => 'product_columns',
        'type'    => 'select',
        'default' => 3,
        'options'    => array(
            '3'  => __('3 Columns', 'angle-admin-td'),
            '2'  => __('2 Columns', 'angle-admin-td'),
            '4'  => __('4 Columns', 'angle-admin-td'),
        )
    ),
);
$oxy_theme->register_metabox( array(
    'id' => 'category_header',
    'title' => __('Category Header Type', 'angle-admin-td'),
    'priority' => 'default',
    'context' => 'advanced',
    'taxonomies' => array('product_cat'),
    'fields' => array_merge( $product_category_options, $extra_header_options, $section_header_options, $section_header_background_options )
));

$oxy_theme->register_metabox( array(
    'id' => 'tag_header',
    'title' => __('Product Tag Header Type', 'angle-admin-td'),
    'priority' => 'default',
    'context' => 'advanced',
    'taxonomies' => array('product_tag'),
    'fields' => array_merge( $product_category_options, $extra_header_options, $section_header_options, $section_header_background_options )
));
