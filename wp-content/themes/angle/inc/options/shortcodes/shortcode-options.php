<?php
/**
 * Sets up all theme shortcode options
 *
 * @package Angle
 * @subpackage Frontend
 * @since 0.1
 *
 * @copyright (c) 2014 Oxygenna.com
 * @license **LICENSE**
 * @version 1.12.2
 */
$heading_options = include OXY_THEME_DIR . 'inc/options/global-options/header-options.php';
$heading_options[0]['name'] = __('Heading', 'angle-admin-td');
$heading_options[0]['id'] = 'content';
unset( $heading_options[0]['admin_label'] );
return array(
    // SECTION
    'vc_row' => array(
        'shortcode'     => 'vc_row',
        'title'         => __('Row', 'angle-admin-td'),
        'desc'          => __('A Horizontal section to add content to.', 'angle-admin-td'),
        'insert_with'   => 'dialog',
        'has_content'   => true,
        'sections'      => array(
            array(
                'title' => __('Row Header', 'angle-admin-td'),
                'fields' => include OXY_THEME_DIR . 'inc/options/global-options/section-header-text.php',
            ),
            include OXY_THEME_DIR . 'inc/options/shortcodes/shortcode-section-options.php',
            array(
                'title' => __('Row Background', 'angle-admin-td'),
                'fields' => include OXY_THEME_DIR . 'inc/options/global-options/section-background-image.php'
            )
        )
    ),
    'vc_row_inner' => array(
        'shortcode'     => 'vc_row_inner',
        'title'         => __('Row Inner', 'angle-admin-td'),
        'desc'          => __('A Nested Horizontal section to add content to.', 'angle-admin-td'),
        'insert_with'   => 'dialog',
        'has_content'   => true,
        'sections'      => array(
            array(
                'title' => __('General', 'angle-admin-td'),
                'fields' => array(
                    array(
                        'name'    => __('Extra Classes', 'angle-admin-td'),
                        'desc'    => __('Add any extra classes you need to add to this column. ( space separated )', 'angle-admin-td'),
                        'id'      => 'extra_classes',
                        'default'     =>  '',
                        'type'        => 'text',
                    ),
                )
            )
        )
    ),
    // SECTION
    'vc_column' => array(
        'shortcode'     => 'vc_column',
        'title'         => __('Column', 'angle-admin-td'),
        'desc'          => __('Column shortcode for use inside a row.', 'angle-admin-td'),
        'insert_with'   => 'dialog',
        'has_content'   => true,
        'sections'      => array(
            array(
                'title' => __('General', 'angle-admin-td'),
                'fields' => array(
                    array(
                        'name'      => __('Column Alignment', 'angle-admin-td'),
                        'id'        => 'align',
                        'type'      => 'select',
                        'default'   => 'default',
                        'options' => array(
                            'Default' => __('Default (no class)', 'angle-admin-td'),
                            'left'    => __('Left', 'angle-admin-td'),
                            'center'  => __('Center', 'angle-admin-td'),
                            'right'   => __('Right', 'angle-admin-td'),
                        ),
                        'desc'    => __('Sets the alignment items in the column.', 'angle-admin-td'),
                    ),
                    array(
                        'name'    => __('Extra Classes', 'angle-admin-td'),
                        'desc'    => __('Add any extra classes you need to add to this column. ( space separated )', 'angle-admin-td'),
                        'id'      => 'extra_classes',
                        'default'     =>  '',
                        'type'        => 'text',
                    ),
                )
            ),
            array(
                'title' => __('On Scroll Animation', 'angle-admin-td'),
                'fields' => array(
                    array(
                        'name'      =>  __('On Scroll Animation', 'angle-admin-td'),
                        'id'        => 'os_animation_enabled',
                        'type'      => 'select',
                        'options'   =>  array(
                            'on'  => __('Enabled', 'angle-admin-td'),
                            'off' => __('Disabled', 'angle-admin-td'),
                        ),
                        'default'   => 'off',
                    ),
                    array(
                        'name'      => __('Animation Delay', 'angle-admin-td'),
                        'desc'      => __('Set the speed of animations', 'angle-admin-td'),
                        'id'        => 'os_animation_delay',
                        'type'      => 'slider',
                        'default'   => '0.1',
                        'attr'      => array(
                            'max'       => 4.0,
                            'min'       => 0.1,
                            'step'      => 0.1
                        )
                    ),
                    array(
                        'name'    => __('Animation Effect', 'angle-admin-td'),
                        'desc'    => __('Set the effect of the animation', 'angle-admin-td'),
                        'id'      => 'os_animation',
                        'type'    => 'select',
                        'default' => 'bounce',
                        'options' => include OXY_THEME_DIR . 'inc/options/shortcodes/shortcode-button-animations.php'
                    ),
                )
            )
        )
    ),
    'heading' => array(
        'shortcode'     => 'heading',
        'title'         => __('Heading', 'angle-admin-td'),
        'desc'          => __('Creates a heading tag H1-H6', 'angle-admin-td'),
        'insert_with'   => 'dialog',
        'has_content'   => true,
        'sections'      => array(
            array(
                'title' => __('Header', 'angle-admin-td'),
                'fields' => $heading_options
            ),
        )
    ),
    'services' =>array(
        'shortcode'     => 'services',
        'title'         => __('Services', 'angle-admin-td'),
        'desc'          => __('Displays a horizontal / vertical list of services.', 'angle-admin-td'),
        'insert_with'   => 'dialog',
        'has_content'   => false,
        'sections'      => array(
            array(
                'title' => __('Services', 'angle-admin-td'),
                'fields' => array(
                    array(
                        'name'    => __('Choose a category', 'angle-admin-td'),
                        'desc'    => __('Category of services to show', 'angle-admin-td'),
                        'id'      => 'category',
                        'default' =>  '',
                        'admin_label' => true,
                        'type'    => 'select',
                        'options' => 'taxonomy',
                        'taxonomy' => 'oxy_service_category',
                        'blank_label' => __('All Categories', 'angle-admin-td')
                    ),
                    array(
                        'name'    => __('Services Count', 'angle-admin-td'),
                        'desc'    => __('Number of services to show(set to 0 to show all)', 'angle-admin-td'),
                        'id'      => 'count',
                        'type'    => 'slider',
                        'default' => '3',
                        'admin_label' => true,
                        'attr'    => array(
                            'max'  => 100,
                            'min'  => 0,
                            'step' => 1
                        )
                    ),
                    array(
                        'name'      => __('Service Style', 'angle-admin-td'),
                        'id'        => 'style',
                        'type'      => 'select',
                        'default'   =>  'horizontal',
                        'admin_label' => true,
                        'options' => array(
                            'horizontal' => __('Horizontal', 'angle-admin-td'),
                            'vertical' => __('Vertical', 'angle-admin-td'),
                        ),
                        'desc'    => __('Services will be shown horizontallly or vertically on the page.', 'angle-admin-td'),
                    ),
                    array(
                        'name'    => __('Columns (horizontal style)', 'angle-admin-td'),
                        'desc'    => __('Number of columns to show the services in', 'angle-admin-td'),
                        'id'      => 'columns',
                        'type'    => 'select',
                        'options' => array(
                            2 => __('Two columns', 'angle-admin-td'),
                            3 => __('Three columns', 'angle-admin-td'),
                            4 => __('Four columns', 'angle-admin-td'),
                            6 => __('Six columns', 'angle-admin-td'),
                        ),
                        'default' => '3',
                    ),
                    array(
                        'name'      =>  __('Image Shape', 'angle-admin-td'),
                        'id'        => 'image_shape',
                        'type'      => 'select',
                        'admin_label' => true,
                        'options'   =>  array(
                            'round'  => __('Circle', 'angle-admin-td'),
                            'square' => __('Square', 'angle-admin-td'),
                            'rect'   => __('Rectangle', 'angle-admin-td'),
                            'hex'    => __('Hexagon', 'angle-admin-td'),
                        ),
                        'default'   => 'round',
                    ),
                    array(
                        'name'      =>  __('Shape Size', 'angle-admin-td'),
                        'id'        => 'image_size',
                        'type'      => 'select',
                        'options'   =>  array(
                            'big'    => __('Big', 'angle-admin-td'),
                            'huge'   => __('Huge', 'angle-admin-td'),
                            'normal' => __('Normal', 'angle-admin-td'),
                            'medium' => __('Medium', 'angle-admin-td'),
                            'small'  => __('Small', 'angle-admin-td'),
                        ),
                        'default'   => 'big',
                    ),
                    array(
                        'name'      =>  __('Shadow', 'angle-admin-td'),
                        'id'        => 'image_shadow',
                        'type'      => 'select',
                        'options'   =>  array(
                            'show' => __('Show', 'angle-admin-td'),
                            'hide' => __('Hide', 'angle-admin-td'),
                        ),
                        'default'   => 'hide',
                    ),
                    array(
                        'name'      => __('Show Connections', 'angle-admin-td'),
                        'id'        => 'connected',
                        'type'      => 'select',
                        'default'   =>  'show',
                        'options' => array(
                            'show' => __('Show', 'angle-admin-td'),
                            'hide' => __('Hide', 'angle-admin-td'),
                        ),
                        'desc'    => __('Services will be connected with a dotted line.', 'angle-admin-td'),
                    ),
                    array(
                        'name'      => __('Show Titles', 'angle-admin-td'),
                        'id'        => 'show_titles',
                        'type'      => 'select',
                        'default'   =>  'show',
                        'options' => array(
                            'show' => __('Show', 'angle-admin-td'),
                            'hide' => __('Hide', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'      => __('Link Title', 'angle-admin-td'),
                        'id'        => 'link_titles',
                        'type'      => 'select',
                        'default'   =>  'on',
                        'options' => array(
                            'on'  => __('On', 'angle-admin-td'),
                            'off' => __('Off', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'      => __('Show Image', 'angle-admin-td'),
                        'id'        => 'show_images',
                        'type'      => 'select',
                        'default'   =>  'show',
                        'options' => array(
                            'show'  => __('Show', 'angle-admin-td'),
                            'hide' => __('Hide', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'      => __('Link Image', 'angle-admin-td'),
                        'id'        => 'link_images',
                        'type'      => 'select',
                        'default'   =>  'on',
                        'options' => array(
                            'on'  => __('On', 'angle-admin-td'),
                            'off' => __('Off', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'      => __('Show Excerpt', 'angle-admin-td'),
                        'id'        => 'show_excerpts',
                        'type'      => 'select',
                        'default'   =>  'show',
                        'options' => array(
                            'show' => __('Show', 'angle-admin-td'),
                            'hide' => __('Hide', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'      => __('Excerpt & More Text Alignment', 'angle-admin-td'),
                        'id'        => 'align_excerpts',
                        'type'      => 'select',
                        'default'   => 'center',
                        'options' => array(
                            'left'   => __('Left', 'angle-admin-td'),
                            'center' => __('Center', 'angle-admin-td'),
                            'right'  => __('Right', 'angle-admin-td'),
                            'justify'  => __('Justify', 'angle-admin-td')
                        ),
                        'desc'    => __('Sets the text alignment of the excerpt text and the read more link.', 'angle-admin-td'),
                    ),
                    array(
                        'name'      => __('Show Readmore Link', 'angle-admin-td'),
                        'id'        => 'show_readmores',
                        'type'      => 'select',
                        'default'   =>  'show',
                        'options' => array(
                            'show' => __('Show', 'angle-admin-td'),
                            'hide' => __('Hide', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'    => __('Readmore Link Text', 'angle-admin-td'),
                        'id'      => 'readmore_text',
                        'type'    => 'text',
                        'default' => 'Read more',
                        'desc'    => __('Customize your readmore link', 'angle-admin-td'),
                    ),
                    array(
                        'name'        => __('Order by', 'angle-admin-td'),
                        'desc'        => __('Choose the way service items will be ordered.', 'angle-admin-td'),
                        'id'          => 'orderby',
                        'type'        => 'select',
                        'default'     =>  'none',
                        'options'     => array(
                            'none'        => __('None', 'angle-admin-td'),
                            'title'       => __('Title', 'angle-admin-td'),
                            'date'        => __('Date', 'angle-admin-td'),
                            'ID'          => __('ID', 'angle-admin-td'),
                            'author'      => __('Author', 'angle-admin-td'),
                            'modified'    => __('Last Modified', 'angle-admin-td'),
                            'menu_order'  => __('Menu Order', 'angle-admin-td'),
                            'rand'        => __('Random', 'angle-admin-td'),
                        )
                    ),
                    array(
                        'name'        => __('Order', 'angle-admin-td'),
                        'desc'        => __('Choose how services will be ordered.', 'angle-admin-td'),
                        'id'          => 'order',
                        'type'        => 'select',
                        'default'     =>  'ASC',
                        'options'     => array(
                            'ASC'     => __('Ascending', 'angle-admin-td'),
                            'DESC'    => __('Descending', 'angle-admin-td'),
                        )
                    )
                )
            ),
        )
    ),
     // TESTIMONIALS SHORTCODE SECTION
    'testimonials' => array(
        'shortcode' => 'testimonials',
        'title'     => __('Testimonials', 'angle-admin-td'),
        'desc'      => __('Displays a list / slideshow of testimonials.', 'angle-admin-td'),
        'insert_with' => 'dialog',
        'has_content'   => false,
        'sections'   => array(
            array(
                'title' => __('Testimonials', 'angle-admin-td'),
                'fields' => array(
                    array(
                        'name'    => __('Choose a group', 'angle-admin-td'),
                        'desc'    => __('Group of testimonials to show', 'angle-admin-td'),
                        'id'      => 'group',
                        'default' =>  '',
                        'type'    => 'select',
                        'admin_label' => true,
                        'admin_label' => true,
                        'options' => 'taxonomy',
                        'taxonomy' => 'oxy_testimonial_group',
                        'blank_label' => __('All Testimonials', 'angle-admin-td')
                    ),
                    array(
                        'name'    => __('Number Of Testimonials', 'angle-admin-td'),
                        'desc'    => __('Number of Testimonials to display(set to 0 to show all)', 'angle-admin-td'),
                        'id'      => 'count',
                        'type'    => 'slider',
                        'admin_label' => true,
                        'default' => '3',
                        'attr'    => array(
                            'max'   => 10,
                            'min'   => 0,
                            'step'  => 1
                        )
                    ),
                    array(
                        'name'    => __('Show avatars', 'angle-admin-td'),
                        'desc'    => __('Display the featured image as avatar', 'angle-admin-td'),
                        'id'      => 'show_image',
                        'type'    => 'select',
                        'default' => 'show',
                        'options' => array(
                            'show' => __('Show', 'angle-admin-td'),
                            'hide' => __('Hide', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'    => __('Display as Slideshow', 'angle-admin-td'),
                        'desc'    => __('Display the testimonials as a slideshow', 'angle-admin-td'),
                        'id'      => 'slideshow',
                        'type'    => 'select',
                        'default' => 'on',
                        'options' => array(
                            'on'   => __('On', 'angle-admin-td'),
                            'off'  => __('Off', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'      => __('Speed', 'angle-admin-td'),
                        'desc'      => __('Set the speed of the slideshow cycling, in milliseconds', 'angle-admin-td'),
                        'id'        => 'speed',
                        'type'      => 'slider',
                        'default'   => '7000',
                        'attr'      => array(
                            'max'       => 15000,
                            'min'       => 2000,
                            'step'      => 1000
                        )
                    ),
                    array(
                        'name'    => __('Randomize', 'angle-admin-td'),
                        'desc'    => __('Randomize the ordering of the testimonials', 'angle-admin-td'),
                        'id'      => 'randomize',
                        'type'    => 'select',
                        'default' => 'off',
                        'options' => array(
                            'on'   => __('On', 'angle-admin-td'),
                            'off'  => __('Off', 'angle-admin-td'),
                        ),
                    )
                )
            ),
        )
    ),
     /* Staff Shortcodes */
    'staff_list' =>  array(
        'shortcode'     => 'staff_list',
        'title'         => __('Staff List', 'angle-admin-td'),
        'desc'          => __('Displays a list of staff members in columns.', 'angle-admin-td'),
        'insert_with'   => 'dialog',
        'has_content'   => false,
        'sections'      => array(
            array(
                'title' => __('Staff members list', 'angle-admin-td'),
                'fields' => array(
                    array(
                        'name'    => __('Choose a department', 'angle-admin-td'),
                        'desc'    => __('Populate your list from a department', 'angle-admin-td'),
                        'id'      => 'department',
                        'default' =>  '',
                        'type'    => 'select',
                        'admin_label' => true,
                        'options' => 'taxonomy',
                        'taxonomy' => 'oxy_staff_department',
                        'blank_label' => __('Select a department', 'angle-admin-td')
                    ),
                    array(
                        'name'    => __('Number Of members', 'angle-admin-td'),
                        'desc'    => __('Number of members to display(set to 0 to show all)', 'angle-admin-td'),
                        'id'      => 'count',
                        'type'    => 'slider',
                        'admin_label' => true,
                        'default' => '3',
                        'attr'    => array(
                            'max'  => 100,
                            'min'  => 0,
                            'step' => 1
                        )
                    ),
                    array(
                        'name'    => __('List Columns', 'angle-admin-td'),
                        'desc'    => __('Number of columns to show staff in', 'angle-admin-td'),
                        'id'      => 'columns',
                        'type'    => 'select',
                        'admin_label' => true,
                        'options' => array(
                            2 => __('Two columns', 'angle-admin-td'),
                            3 => __('Three columns', 'angle-admin-td'),
                            4 => __('Four columns', 'angle-admin-td'),
                            6 => __('Six columns', 'angle-admin-td'),
                        ),
                        'default' => '3',
                    ),
                    array(
                        'name'      =>  __('Image Shape', 'angle-admin-td'),
                        'id'        => 'image_shape',
                        'type'      => 'select',
                        'admin_label' => true,
                        'options'   =>  array(
                            'round'  => __('Circle', 'angle-admin-td'),
                            'square' => __('Square', 'angle-admin-td'),
                            'rect'   => __('Rectangle', 'angle-admin-td'),
                            'hex'    => __('Hexagon', 'angle-admin-td'),
                        ),
                        'default'   => 'round',
                    ),
                    array(
                        'name'      =>  __('Shape Size', 'angle-admin-td'),
                        'id'        => 'image_size',
                        'type'      => 'select',
                        'options'   =>  array(
                            'big'    => __('Big', 'angle-admin-td'),
                            'huge'   => __('Huge', 'angle-admin-td'),
                            'normal' => __('Normal', 'angle-admin-td'),
                            'medium' => __('Medium', 'angle-admin-td'),
                            'small'  => __('Small', 'angle-admin-td'),
                        ),
                        'default'   => 'big',
                    ),
                    array(
                        'name'      =>  __('Shadow', 'angle-admin-td'),
                        'id'        => 'image_shadow',
                        'type'      => 'select',
                        'options'   =>  array(
                            'show' => __('Show', 'angle-admin-td'),
                            'hide' => __('Hide', 'angle-admin-td'),
                        ),
                        'default'   => 'hide',
                    ),
                    array(
                        'name'    => __('Link in name', 'angle-admin-td'),
                        'desc'    => __('Make the name link to the url specified in staff page', 'angle-admin-td'),
                        'id'      => 'link_name',
                        'type'    => 'select',
                        'default' => 'on',
                        'options' => array(
                            'on'  => __('On', 'angle-admin-td'),
                            'off' => __('Off', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'    => __('Show Position', 'angle-admin-td'),
                        'desc'    => __('Display the staff position below the name', 'angle-admin-td'),
                        'id'      => 'show_name',
                        'type'    => 'select',
                        'default' => 'show',
                        'options' => array(
                            'show' => __('Show', 'angle-admin-td'),
                            'hide' => __('Hide', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'      => __('Show Excerpt', 'angle-admin-td'),
                        'id'        => 'show_excerpts',
                        'type'      => 'select',
                        'default'   => 'show',
                        'options' => array(
                            'show' => __('Show', 'angle-admin-td'),
                            'hide' => __('Hide', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'      => __('Excerpt & More Text Alignment', 'angle-admin-td'),
                        'id'        => 'align_excerpts',
                        'type'      => 'select',
                        'default'   => 'center',
                        'options' => array(
                            'left'   => __('Left', 'angle-admin-td'),
                            'center' => __('Center', 'angle-admin-td'),
                            'right'  => __('Right', 'angle-admin-td'),
                            'justify'  => __('Justify', 'angle-admin-td')
                        ),
                        'desc'    => __('Sets the text alignment of the excerpt text and the read more link.', 'angle-admin-td'),
                    ),
                    array(
                        'name'      => __('Show Social Links', 'angle-admin-td'),
                        'id'        => 'show_social',
                        'type'      => 'select',
                        'default'   => 'show',
                        'options' => array(
                            'show' => __('Show', 'angle-admin-td'),
                            'hide' => __('Hide', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'    => __('Open Social Links In', 'angle-admin-td'),
                        'id'      => 'link_target',
                        'type'    => 'select',
                        'default' => '_self',
                        'options' => array(
                            '_self'   => __('Same page as it was clicked ', 'angle-admin-td'),
                            '_blank'  => __('Open in new window/tab', 'angle-admin-td'),
                            '_parent' => __('Open the linked document in the parent frameset', 'angle-admin-td'),
                            '_top'    => __('Open the linked document in the full body of the window', 'angle-admin-td')
                        ),
                        'desc'    => __('Where the social links open to', 'angle-admin-td'),
                    ),
                    array(
                        'name'        => __('Order by', 'angle-admin-td'),
                        'desc'        => __('Choose the way staff items will be ordered.', 'angle-admin-td'),
                        'id'          => 'orderby',
                        'type'        => 'select',
                        'default'     =>  'none',
                        'options'     => array(
                            'none'        => __('None', 'angle-admin-td'),
                            'title'       => __('Title', 'angle-admin-td'),
                            'date'        => __('Date', 'angle-admin-td'),
                            'ID'          => __('ID', 'angle-admin-td'),
                            'author'      => __('Author', 'angle-admin-td'),
                            'modified'    => __('Last Modified', 'angle-admin-td'),
                            'menu_order'  => __('Menu Order', 'angle-admin-td'),
                            'rand'        => __('Random', 'angle-admin-td'),
                        )
                    ),
                    array(
                        'name'        => __('Order', 'angle-admin-td'),
                        'desc'        => __('Choose how staff will be ordered.', 'angle-admin-td'),
                        'id'          => 'order',
                        'type'        => 'select',
                        'default'     =>  'ASC',
                        'options'     => array(
                            'ASC'     => __('Ascending', 'angle-admin-td'),
                            'DESC'    => __('Descending', 'angle-admin-td'),
                        )
                    )
                )
            ),
        ),
    ),
    'staff_featured' => array(
        'shortcode'     => 'staff_featured',
        'title'         => __('Featured Staff', 'angle-admin-td'),
        'desc'          => __('Displays a featured section about one member of staff.', 'angle-admin-td'),
        'insert_with'   => 'dialog',
        'has_content'   => false,
        'sections'      => array(
            array(
                'title' => __('Staff', 'angle-admin-td'),
                'fields' => array(
                    array(
                        'name'    => __('Featured member', 'angle-admin-td'),
                        'desc'    => __('Select the staff member that will be featured', 'angle-admin-td'),
                        'id'      => 'member',
                        'default' =>  '',
                        'type'    => 'select',
                        'options' => 'staff_featured',
                    ),
                    array(
                        'name'      =>  __('Image Shape', 'angle-admin-td'),
                        'id'        => 'image_shape',
                        'type'      => 'select',
                        'admin_label' => true,
                        'options'   =>  array(
                            'round'  => __('Circle', 'angle-admin-td'),
                            'square' => __('Square', 'angle-admin-td'),
                            'rect'   => __('Rectangle', 'angle-admin-td'),
                            'hex'    => __('Hexagon', 'angle-admin-td'),
                        ),
                        'default'   => 'round',
                    ),
                    array(
                        'name'      =>  __('Image Size', 'angle-admin-td'),
                        'id'        => 'image_size',
                        'type'      => 'select',
                        'options'   =>  array(
                            'big'    => __('Big', 'angle-admin-td'),
                            'huge'   => __('Huge', 'angle-admin-td'),
                            'normal' => __('Normal', 'angle-admin-td'),
                            'medium' => __('Medium', 'angle-admin-td'),
                            'small'  => __('Small', 'angle-admin-td'),
                        ),
                        'default'   => 'big',
                    ),
                    array(
                        'name'      =>  __('Shadow', 'angle-admin-td'),
                        'id'        => 'image_shadow',
                        'type'      => 'select',
                        'options'   =>  array(
                            'show' => __('Show', 'angle-admin-td'),
                            'hide' => __('Hide', 'angle-admin-td'),
                        ),
                        'default'   => 'hide',
                    ),
                    array(
                        'name'    => __('Show Position', 'angle-admin-td'),
                        'desc'    => __('Display the staff position below the name', 'angle-admin-td'),
                        'id'      => 'show_position',
                        'type'    => 'select',
                        'default' => 'show',
                        'options' => array(
                            'show' => __('Show', 'angle-admin-td'),
                            'hide' => __('Hide', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'      => __('Show Content', 'angle-admin-td'),
                        'id'        => 'show_content',
                        'type'      => 'select',
                        'default'   => 'show',
                        'options' => array(
                            'show' => __('Show', 'angle-admin-td'),
                            'hide' => __('Hide', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'      => __('Content Font Size', 'angle-admin-td'),
                        'id'        => 'content_size',
                        'type'      => 'select',
                        'default'   => 'big',
                        'options' => array(
                            'big'   => __('Big', 'angle-admin-td'),
                            'small' => __('Small', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'      => __('Content Alignment', 'angle-admin-td'),
                        'id'        => 'align_content',
                        'type'      => 'select',
                        'default'   => 'center',
                        'options' => array(
                            'left'   => __('Left', 'angle-admin-td'),
                            'center' => __('Center', 'angle-admin-td'),
                            'right'  => __('Right', 'angle-admin-td'),
                            'justify'  => __('Justify', 'angle-admin-td')
                        ),
                        'desc'    => __('Sets the text alignment of the excerpt text and the read more link.', 'angle-admin-td'),
                    ),
                    array(
                        'name'      => __('Show Social Links', 'angle-admin-td'),
                        'id'        => 'show_social',
                        'type'      => 'select',
                        'default'   => 'show',
                        'options' => array(
                            'show' => __('Show', 'angle-admin-td'),
                            'hide' => __('Hide', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'    => __('Open Social Links In', 'angle-admin-td'),
                        'id'      => 'link_target',
                        'type'    => 'select',
                        'default' => '_self',
                        'options' => array(
                            '_self'   => __('Same page as it was clicked ', 'angle-admin-td'),
                            '_blank'  => __('Open in new window/tab', 'angle-admin-td'),
                            '_parent' => __('Open the linked document in the parent frameset', 'angle-admin-td'),
                            '_top'    => __('Open the linked document in the full body of the window', 'angle-admin-td')
                        ),
                        'desc'    => __('Where the social links open to', 'angle-admin-td'),
                    ),
                )
            ),
        )
    ),
    // PORTFOLIO SHORTCODE OPTIONS
    'portfolio' => array(
        'shortcode'     => 'portfolio',
        'title'         => __('Portfolio', 'angle-admin-td'),
        'desc'          => __('Displays a set of portfolio items in columns.', 'angle-admin-td'),
        'insert_with'   => 'dialog',
        'has_content'   => false,
        'sections'      => array(
            array(
                'title' => __('Portfolio', 'angle-admin-td'),
                'fields' => array(
                    array(
                        'name'    => __('Category', 'angle-admin-td'),
                        'desc'    => __('Categories to show (leave blank to show all)', 'angle-admin-td'),
                        'id'      => 'categories',
                        'default' =>  '',
                        'type'    => 'select',
                        'options' => 'taxonomy',
                        'taxonomy' => 'oxy_portfolio_categories',
                        'admin_label' => true,
                        'attr' => array(
                            'multiple' => '',
                            'style' => 'height:100px'
                        )
                    ),
                    array(
                        'name'    => __('Number of portfolio items to display  (per page if pagination is on )', 'angle-admin-td'),
                        'desc'    => __('Number of portfolio items to display(per page)', 'angle-admin-td'),
                        'id'      => 'count',
                        'type'    => 'slider',
                        'default' => '3',
                        'admin_label' => true,
                        'attr'    => array(
                            'max'   => 24,
                            'min'   => 1,
                            'step'  => 1
                        )
                    ),
                    array(
                        'name'    => __('Portfolio Columns', 'angle-admin-td'),
                        'desc'    => __('Number of columns to show the portfolio in', 'angle-admin-td'),
                        'id'      => 'columns',
                        'type'    => 'slider',
                        'default' => '3',
                        'admin_label' => true,
                        'attr'    => array(
                            'max'   => 4,
                            'min'   => 2,
                            'step'  => 1
                        )
                    ),
                    array(
                        'name'      => __('Use pagination', 'angle-admin-td'),
                        'desc'      => __('Split your portfolio items in pages', 'angle-admin-td'),
                        'id'        => 'pagination',
                        'type'      => 'select',
                        'default'   => 'off',
                        'options' => array(
                            'off'       => __('Off', 'angle-admin-td'),
                            'simple'    => __('Simple', 'angle-admin-td'),
                            'infinite'  => __('Infinite', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'      => __('Shape', 'angle-admin-td'),
                        'desc'      => __('Choose the portfolio image shape', 'angle-admin-td'),
                        'id'        => 'shape',
                        'type'      => 'select',
                        'default'   => 'round',
                        'admin_label' => true,
                        'options' => array(
                            'round'  => __('Circle', 'angle-admin-td'),
                            'square' => __('Square', 'angle-admin-td'),
                            'rect'   => __('Rectangle', 'angle-admin-td'),
                            'hex'    => __('Hexagon', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'      =>  __('Shadow', 'angle-admin-td'),
                        'id'        => 'show_shadow',
                        'type'      => 'select',
                        'options'   =>  array(
                            'show' => __('Show', 'angle-admin-td'),
                            'hide' => __('Hide', 'angle-admin-td'),
                        ),
                        'default'   => 'show',
                    ),
                    array(
                        'name'    => __('Show Title', 'angle-admin-td'),
                        'desc'    => __('Display the portfolio title', 'angle-admin-td'),
                        'id'      => 'show_title',
                        'type'    => 'select',
                        'default' => 'show',
                        'options' => array(
                            'show' => __('Show', 'angle-admin-td'),
                            'hide' => __('Hide', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'      => __('Show Excerpt', 'angle-admin-td'),
                        'desc'      => __('Display the portfolio excerpt', 'angle-admin-td'),
                        'id'        => 'show_excerpt',
                        'type'      => 'select',
                        'default'   => 'show',
                        'options' => array(
                            'show' => __('Show', 'angle-admin-td'),
                            'hide' => __('Hide', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'      =>  __('Overlay', 'angle-admin-td'),
                        'desc'      => __('Show overlay on hover', 'angle-admin-td'),
                        'id'        => 'show_overlay',
                        'type'      => 'select',
                        'options'   =>  array(
                            'show' => __('Show', 'angle-admin-td'),
                            'hide' => __('Hide', 'angle-admin-td'),
                        ),
                        'default'   => 'show',
                    ),
                    array(
                        'name'      =>  __('Magnific on hidden overlay', 'angle-admin-td'),
                        'desc'      => __('Open portfolio links in Magnific popup when overlay is hidden', 'angle-admin-td'),
                        'id'        => 'show_magnific',
                        'type'      => 'select',
                        'options'   =>  array(
                            'show'   => __('Show', 'angle-admin-td'),
                            'hide'   => __('Hide', 'angle-admin-td'),
                        ),
                        'default'   => 'show',
                    ),
                    array(
                        'name'    => __('Magnific Overlay Link Type', 'PLUGIN_TD'),
                        'desc'    => __('Select the magnific link type to use for the item.', 'PLUGIN_TD'),
                        'id'      => 'magnific_link_type',
                        'type'    => 'select',
                        'default' => 'magnific',
                        'options' => array(
                            'magnific'      => __('Magnific Single Item', 'PLUGIN_TD'),
                            'magnific-all'  => __('Magnific All Items', 'PLUGIN_TD')
                        ),
                    ),
                    array(
                        'name'      => __('Magnific Popup Captions', 'angle-admin-td'),
                        'id'        => 'magnific_caption',
                        'type'      => 'select',
                        'default'   => 'post_title_caption',
                        'options' => array(
                            'image_caption'         => __('Media Image Caption', 'angle-admin-td'),
                            'post_title_caption'    => __('Post Title', 'angle-admin-td'),
                            'off'                   => __('No Captions', 'angle-admin-td'),
                        ),
                        'desc'    => __('What the caption below the magnific popup image will be.', 'angle-admin-td'),
                    ),
                    array(
                        'name'    => __('Portfolio Filters', 'angle-admin-td'),
                        'desc'    => __('Show filter navigation', 'angle-admin-td'),
                        'id'      => 'show_filters',
                        'type'      => 'select',
                        'default'   =>  'show',
                        'options'  => array(
                            'show' => __('Show', 'angle-admin-td'),
                            'hide' => __('Hide', 'angle-admin-td'),
                            )
                    ),
                    array(
                        'name'        => __('Order by', 'angle-admin-td'),
                        'desc'        => __('Choose the way portfolio items will be ordered.', 'angle-admin-td'),
                        'id'          => 'orderby',
                        'type'        => 'select',
                        'default'     =>  'none',
                        'options'     => array(
                            'none'        => __('None', 'angle-admin-td'),
                            'title'       => __('Title', 'angle-admin-td'),
                            'date'        => __('Date', 'angle-admin-td'),
                            'ID'          => __('ID', 'angle-admin-td'),
                            'author'      => __('Author', 'angle-admin-td'),
                            'modified'    => __('Last Modified', 'angle-admin-td'),
                            'menu_order'  => __('Menu Order', 'angle-admin-td'),
                            'rand'        => __('Random', 'angle-admin-td'),
                        )
                    ),
                    array(
                        'name'        => __('Order', 'angle-admin-td'),
                        'desc'        => __('Choose how portfolio will be ordered.', 'angle-admin-td'),
                        'id'          => 'order',
                        'type'        => 'select',
                        'default'     =>  'ASC',
                        'options'     => array(
                            'ASC'     => __('Ascending', 'angle-admin-td'),
                            'DESC'    => __('Descending', 'angle-admin-td'),
                        )
                    )
                )
            ),
        )
    ),
     'recent_posts' => array(
        'shortcode' => 'recent_posts',
        'title'     => __('Recent Posts', 'angle-admin-td'),
        'desc'       => __('Displays a list of recent posts.', 'angle-admin-td'),
        'insert_with' => 'dialog',
        'has_content'   => false,
        'sections'   => array(
            array(
                'title' => __('Recent Posts', 'angle-admin-td'),
                'fields' => array(
                    array(
                        'name'        => __('Layout', 'angle-admin-td'),
                        'desc'        => __('Section Layout', 'angle-admin-td'),
                        'id'          => 'layout',
                        'type'        => 'select',
                        'default'     => 'simple',
                        'admin_label' => true,
                        'options'     => array(
                            'simple'    => __('Simple', 'angle-admin-td'),
                            'slideshow' => __('Slideshow', 'angle-admin-td'),
                            'masonry'   => __('Masonry', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'        => __('Pagination', 'angle-admin-td'),
                        'desc'        => __('Toggle Pagination on/off', 'angle-admin-td'),
                        'id'          => 'pagination',
                        'type'        => 'select',
                        'default'     => 'on',
                        'admin_label' => true,
                        'options'     => array(
                            'on'    => __('On', 'angle-admin-td'),
                            'off'   => __('Off', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'    => __('Number of posts per page', 'angle-admin-td'),
                        'desc'    => __('Number of posts to display per page ( if pagination is on ) or total number of posts ( if pagination is off/slideshow )', 'angle-admin-td'),
                        'id'      => 'count',
                        'type'    => 'slider',
                        'default' => '3',
                        'attr'    => array(
                            'max'   => 10,
                            'min'   => 1,
                            'step'  => 1
                        )
                    ),
                    array(
                        'name'    => __('Post category', 'angle-admin-td'),
                        'desc'    => __('Choose posts from a specific category', 'angle-admin-td'),
                        'id'      => 'cat',
                        'default' =>  '',
                        'type'    => 'select',
                        'options' => 'categories',
                        'attr' => array(
                            'multiple' => '',
                            'style' => 'height:100px'
                        )
                    ),
                    array(
                        'name'    => __('Post Swatch', 'angle-admin-td'),
                        'desc'    => __('Choose a color swatch for the posts', 'angle-admin-td'),
                        'id'      => 'post_swatch',
                        'type'    => 'select',
                        'default' => 'swatch-red-white',
                        'options' => include OXY_THEME_DIR . 'inc/options/shortcodes/shortcode-swatches-options.php'
                    ),
                    array(
                        'name'    => __('Columns', 'angle-admin-td'),
                        'desc'    => __('Number of columns to show posts in', 'angle-admin-td'),
                        'id'      => 'columns',
                        'type'    => 'select',
                        'default' => '3',
                        'options' => array(
                            '1' => __('1 Column', 'angle-admin-td'),
                            '2' => __('2 Columns', 'angle-admin-td'),
                            '3' => __('3 Columns', 'angle-admin-td'),
                            '4' => __('4 Columns', 'angle-admin-td'),
                        ),
                    ),
                     array(
                        'name'      => __('Use infinite Scroll in Masonry', 'angle-admin-td'),
                        'desc'    => __('pagination is not displayed in masonry if infinite scrolling is on', 'angle-admin-td'),
                        'id'        => 'infinite_scroll',
                        'type'      => 'select',
                        'default'   => 'on',
                        'options' => array(
                            'on'  => __('On', 'angle-admin-td'),
                            'off' => __('Off', 'angle-admin-td'),
                        ),
                    ),
                )
            ),
        )
    ),
    // MAP SHORTCODE OPTIONS
    'map' => array(
        'shortcode'     => 'map',
        'title'         => __('Google Map', 'angle-admin-td'),
        'desc'          => __('Adds a Google Map to the page.', 'angle-admin-td'),
        'insert_with'   => 'dialog',
        'has_content'   => false,
        'sections'      => array(
            array(
                'title' => __('Map', 'angle-admin-td'),
                'fields' => array(
                    array(
                        'name'      => __('Map Type', 'angle-admin-td'),
                        'id'        => 'map_type',
                        'type'      => 'select',
                        'default'   =>  'ROADMAP',
                        'options' => array(
                            'ROADMAP'   => __('Roadmap', 'angle-admin-td'),
                            'SATELLITE' => __('Satellite', 'angle-admin-td'),
                            'TERRAIN'   => __('Terrain', 'angle-admin-td'),
                            'HYBRID'    => __('Hybrid', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'      => __('Map Zoom', 'angle-admin-td'),
                        'id'        => 'map_zoom',
                        'type'      => 'slider',
                        'default' => '15',
                        'attr'    => array(
                            'max'   => 20,
                            'min'   => 1,
                            'step'  => 1
                        )
                    ),
                    array(
                        'name'      => __('Mouse Wheel Scrolling', 'angle-admin-td'),
                        'id'        => 'map_scroll',
                        'type'      => 'select',
                        'default'   => 'off',
                        'options' => array(
                            'off' => __('Off', 'angle-admin-td'),
                            'on'  => __('On', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'      => __('Draggable', 'angle-admin-td'),
                        'id'        => 'map_draggable',
                        'type'      => 'select',
                        'default'   => 'off',
                        'options' => array(
                            'off' => __('Off', 'angle-admin-td'),
                            'on'  => __('On', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'      => __('Map Style', 'angle-admin-td'),
                        'id'        => 'map_style',
                        'type'      => 'select',
                        'default'   =>  'flat',
                        'options' => array(
                            'flat'    => __('Flat', 'angle-admin-td'),
                            'regular' => __('Regular', 'angle-admin-td'),
                        ),
                    ),
                )
            ),
            array(
                'title' => __('Marker', 'angle-admin-td'),
                'fields' => array(
                    array(
                        'name'      => __('Show Marker', 'angle-admin-td'),
                        'id'        => 'marker',
                        'type'      => 'select',
                        'default'   =>  'show',
                        'options' => array(
                            'hide' => __('Hide', 'angle-admin-td'),
                            'show' => __('Show', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'    => __('Marker Address', 'angle-admin-td'),
                        'desc'    => __('Address to show marker', 'angle-admin-td'),
                        'id'      => 'address',
                        'default' =>  '',
                        'type'    => 'text',
                    ),
                    array(
                        'name'    => __('Marker Latitude', 'angle-admin-td'),
                        'desc'    => __('Latitude of marker (if you dont want to use address)', 'angle-admin-td'),
                        'id'      => 'lat',
                        'default' =>  '',
                        'type'    => 'text',
                    ),
                    array(
                        'name'    => __('Marker Longitude', 'angle-admin-td'),
                        'desc'    => __('Longitude of marker (if you dont want to use address)', 'angle-admin-td'),
                        'id'      => 'lng',
                        'default' =>  '',
                        'type'    => 'text',
                    ),
                    array(
                        'name'    => __('Marker Label', 'angle-admin-td'),
                        'desc'    => __('Label to show above the marker', 'angle-admin-td'),
                        'id'      => 'label',
                        'default' =>  '',
                        'type'    => 'text',
                    ),
                )
            ),
            array(
                'title' => __('Section', 'angle-admin-td'),
                'fields' => array(
                    array(
                        'name'      => __('Map Section Height', 'angle-admin-td'),
                        'id'        => 'height',
                        'type'      => 'slider',
                        'default' => '500',
                        'attr'    => array(
                            'max'   => 800,
                            'min'   => 50,
                            'step'  => 1
                        )
                    ),
                )
            )
        )
    ),
    // PIECHART SHORTCODE
    'pie' => array(
        'shortcode' => 'pie',
        'title'     => __('Pie Chart', 'angle-admin-td'),
        'desc'      => __('Creates a circular chart to show a % value.', 'angle-admin-td'),
        'insert_with' => 'dialog',
        'has_content'   => false,
        'sections'   => array(
            array(
                'title' => __('Pie Chart', 'angle-admin-td'),
                'fields' => array(
                    array(
                        'name'    => __('Track Colour', 'angle-admin-td'),
                        'desc'    => __('Choose the chart track colour', 'angle-admin-td'),
                        'id'      => 'track_colour',
                        'default' =>  '',
                        'type'    => 'colour',
                    ),
                    array(
                        'name'    => __('Bar Colour', 'angle-admin-td'),
                        'desc'    => __('Choose the chart bar colour', 'angle-admin-td'),
                        'id'      => 'bar_colour',
                        'default' =>  '',
                        'type'    => 'colour',
                    ),
                    array(
                        'name'    => __('Icon', 'angle-admin-td'),
                        'desc'    => __('Choose a chart icon', 'angle-admin-td'),
                        'id'      => 'icon',
                        'default' =>  '',
                        'type'    => 'select',
                        'options' => 'icons',
                    ),
                    array(
                        'name'    => __('Icon Animation', 'angle-admin-td'),
                        'desc'    => __('Choose an icon animation', 'angle-admin-td'),
                        'id'      => 'icon_animation',
                        'type'    => 'select',
                        'default' => 'none',
                        'options' => include OXY_THEME_DIR . 'inc/options/shortcodes/shortcode-button-animations.php'
                    ),
                    array(
                        'name'    => __('Percentage', 'angle-admin-td'),
                        'desc'    => __('Percentage of the pie chart', 'angle-admin-td'),
                        'id'      => 'percentage',
                        'admin_label' => true,
                        'type'    => 'slider',
                        'default' => '50',
                        'attr'    => array(
                            'max'   => 100,
                            'min'   => 1,
                            'step'  => 1
                        )
                    ),
                    array(
                        'name'    => __('Size', 'angle-admin-td'),
                        'desc'    => __('Set the size of the chart', 'angle-admin-td'),
                        'id'      => 'size',
                        'type'    => 'slider',
                        'default' => '200',
                        'attr'    => array(
                            'max'   => 400,
                            'min'   => 50,
                            'step'  => 1
                        )
                    ),
                    array(
                        'name'    => __('Line Width', 'angle-admin-td'),
                        'desc'    => __('Set the width of the charts line', 'angle-admin-td'),
                        'id'      => 'line_width',
                        'type'    => 'slider',
                        'default' => '20',
                        'attr'    => array(
                            'max'   => 30,
                            'min'   => 5,
                            'step'  => 1
                        )
                    ),
                )
            ),
        )
    ),
     // COUNTER SHORTCODE
    'counter' => array(
        'shortcode' => 'counter',
        'title'     => __('Counter', 'angle-admin-td'),
        'desc'      => __('Creates a circular counter to show an integer value.', 'angle-admin-td'),
        'insert_with' => 'dialog',
        'has_content'   => false,
        'sections'   => array(
            array(
                'title' => __('Counter', 'angle-admin-td'),
                'fields' => array(
                    array(
                        'name'    => __('Value', 'angle-admin-td'),
                        'desc'    => __('Value of the circular counter', 'angle-admin-td'),
                        'id'      => 'value',
                        'admin_label' => true,
                        'default'     =>  '',
                        'type'        => 'text',
                    ),
                    array(
                        'name'    => __('Counter Font Size', 'angle-admin-td'),
                        'desc'    => __('Choose the size of the font to use in the counter', 'angle-admin-td'),
                        'id'      => 'counter_size',
                        'type'    => 'select',
                        'options' => array(
                            'normal'      => __('Normal', 'angle-admin-td'),
                            'super' => __('Super (60px)', 'angle-admin-td'),
                            'hyper' => __('Hyper (96px)', 'angle-admin-td'),
                        ),
                        'default' => 'normal',
                    ),
                    array(
                        'name'    => __('Counter Font Weight', 'angle-admin-td'),
                        'desc'    => __('Choose the weight of the font to use in the counter', 'angle-admin-td'),
                        'id'      => 'counter_weight',
                        'type'    => 'select',
                        'options' => array(
                            'regular'  => __('Regular', 'angle-admin-td'),
                            'black'    => __('Black', 'angle-admin-td'),
                            'bold'     => __('Bold', 'angle-admin-td'),
                            'light'    => __('Light', 'angle-admin-td'),
                            'hairline' => __('Hairline', 'angle-admin-td'),
                        ),
                        'default' => 'regular',
                    ),
                    array(
                        'name'    => __('Underline', 'angle-admin-td'),
                        'desc'    => __('Underline the number.', 'angle-admin-td'),
                        'id'      => 'underline',
                        'type'    => 'select',
                        'options' => array(
                            'underline'    => __('Underline', 'angle-admin-td'),
                            'no-underline' => __('No Underline', 'angle-admin-td')
                        ),
                        'default' => 'underline',
                    ),
                )
            ),
        )
    ),
    'pricing' => array(
        'title'       => __('Pricing Column', 'angle-admin-td'),
        'desc'        => __('Displays a price info column.', 'angle-admin-td'),
        'shortcode'   => 'pricing',
        'insert_with' => 'dialog',
        'has_content' => false,
        'sections'   => array(
            array(
                'title' => __('Pricing Table', 'angle-admin-td'),
                'fields' => array(
                    array(
                        'name'        => __('Heading', 'angle-admin-td'),
                        'desc'        => __('Heading text of the column', 'angle-admin-td'),
                        'id'          => 'heading',
                        'admin_label' => true,
                        'default'     =>  '',
                        'type'        => 'text',
                    ),
                    array(
                        'name'      => __('Featured Column', 'angle-admin-td'),
                        'id'        => 'featured',
                        'type'      => 'select',
                        'default'   =>  'false',
                        'options' => array(
                            'false' => __('Not Featured', 'angle-admin-td'),
                            'true'  => __('Featured', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'      => __('Show price', 'angle-admin-td'),
                        'id'        => 'show_price',
                        'type'      => 'select',
                        'default'   =>  'true',
                        'options' => array(
                            'true' => __('Show', 'angle-admin-td'),
                            'false' => __('Hide', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'    => __('Price', 'angle-admin-td'),
                        'desc'    => __('Price to show at top of the column.', 'angle-admin-td'),
                        'id'      => 'price',
                        'default' =>  '',
                        'type'    => 'text',
                    ),
                    array(
                        'name'    => __('Price Currency', 'angle-admin-td'),
                        'desc'    => __('Price currency to show next to the price.', 'angle-admin-td'),
                        'id'      => 'currency',
                        'default' =>  '&#36;',
                        'type'    => 'select',
                        'options' => array(
                            '&#36;'   => __('Dollar', 'angle-admin-td'),
                            '&#128;'  => __('Euro', 'angle-admin-td'),
                            '&#163;'  => __('Pound', 'angle-admin-td'),
                            '&#165;'  => __('Yen', 'angle-admin-td'),
                            'custom' => __('Custom', 'angle-admin-td'),
                        )
                    ),
                    array(
                        'name'    => __('Custom Currency', 'angle-admin-td'),
                        'desc'    => __('If custom currency selected enter the html code here. e.g. <code>&#8359;</code>', 'angle-admin-td'),
                        'id'      => 'custom_currency',
                        'default' =>  '',
                        'type'    => 'text',
                    ),
                    array(
                        'name'    => __('After Price Text', 'angle-admin-td'),
                        'desc'    => __('Text to show after the price.', 'angle-admin-td'),
                        'id'      => 'per',
                        'default' =>  '',
                        'type'    => 'text',
                    ),
                    array(
                        'name'    => __('Item List', 'angle-admin-td'),
                        'desc'    => __('List of items to put in the column under the price. Divide categories with linebreaks (Enter)', 'angle-admin-td'),
                        'id'      => 'list',
                        'default' =>  '',
                        'type'    => 'exploded_textarea',
                    ),
                    array(
                        'name'      => __('Show button', 'angle-admin-td'),
                        'id'        => 'show_button',
                        'type'      => 'select',
                        'default'   =>  'true',
                        'options' => array(
                            'true' => __('Show', 'angle-admin-td'),
                            'false' => __('Hide', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'    => __('Button Text', 'angle-admin-td'),
                        'desc'    => __('Text to inside the button at the bottom of the column.', 'angle-admin-td'),
                        'id'      => 'button_text',
                        'default' =>  '',
                        'type'    => 'text',
                    ),
                    array(
                        'name'    => __('Button Link', 'angle-admin-td'),
                        'desc'    => __('Link that the button will point to.', 'angle-admin-td'),
                        'id'      => 'button_link',
                        'default' =>  '',
                        'type'    => 'text',
                    ),
                )
            )
        ),
    ),
    'feature' => array(
        'shortcode'   => 'feature',
        'title'       => __('Feature', 'angle-admin-td'),
        'desc'        => __('Displays a shape with an icon alongside some text.', 'angle-admin-td'),
        'insert_with' => 'dialog',
        'has_content'   => false,
        'sections'    => array(
            array(
                'title'   => 'general',
                'fields'  => array(
                    array(
                        'name'      => __('Show Icon', 'angle-admin-td'),
                        'id'        => 'show_icon',
                        'type'      => 'select',
                        'default'   =>  'true',
                        'options' => array(
                            'true' => __('Show', 'angle-admin-td'),
                            'false' => __('Hide', 'angle-admin-td'),
                        ),
                        'desc'    => __('Show / Hide the icon on the left.', 'angle-admin-td'),
                    ),
                    array(
                        'name'    => __('Icon', 'angle-admin-td'),
                        'id'      => 'icon',
                        'type'    => 'select',
                        'admin_label' => true,
                        'options' => 'icons',
                        'default' => '',
                        'desc'    => __('Choose an icon to use in your featured icon', 'angle-admin-td'),
                    ),
                    array(
                        'name'    => __('Icon Shape', 'angle-admin-td'),
                        'desc'    => __('Set shape used for the icon.', 'angle-admin-td'),
                        'id'      => 'shape',
                        'type'    => 'select',
                        'default' => 'round',
                        'options'    => array(
                            'square' => __('Square', 'angle-admin-td'),
                            'round'  => __('Circle', 'angle-admin-td'),
                            'hex'    => __('Hexagon', 'angle-admin-td'),
                        )
                    ),
                    array(
                        'name'    => __('Icon Animation', 'PLUGIN_TD'),
                        'desc'    => __('Choose an icon animation', 'PLUGIN_TD'),
                        'id'      => 'animation',
                        'type'    => 'select',
                        'default' => '',
                        'options' => include OXY_THEME_DIR . 'inc/options/shortcodes/shortcode-button-animations.php'
                    ),
                    array(
                        'name'        => __('Title', 'angle-admin-td'),
                        'id'          => 'title',
                        'type'        => 'text',
                        'admin_label' => true,
                        'default'     => '',
                        'desc'        => __('Choose a title for your featured item.', 'angle-admin-td'),
                    ),
                    array(
                        'name'        => __('Content', 'angle-admin-td'),
                        'id'          => 'content',
                        'type'        => 'textarea',
                        'default'     => '',
                        'desc'        => __('Content to show below title.', 'angle-admin-td'),
                    ),
                )
            )
        )
    ),
    'slideshow' => array(
        'shortcode'     => 'slideshow',
        'title'         => __('Slideshow', 'angle-admin-td'),
        'desc'          => __('Adds a Flexslider slideshow to the page.', 'angle-admin-td'),
        'insert_with'   => 'dialog',
        'has_content'   => false,
        'sections'      => array(
            array(
                'title' => __('Slideshow', 'angle-admin-td'),
                'javascripts' => array(
                    array(
                        'handle' => 'header_options_script',
                        'src'    => OXY_THEME_URI . 'inc/options/javascripts/dialogs/slider-options.js',
                        'deps'   => array( 'jquery'),
                        'localize' => array(
                            'object_handle' => 'theme',
                            'data'          => THEME_SHORT
                        ),
                    ),
                ),
                'fields' => array(
                    array(
                        'name'    => __('Choose a Flexslider', 'angle-admin-td'),
                        'desc'    => __('Populate your slider with one of the slideshows you created', 'angle-admin-td'),
                        'id'      => 'flexslider',
                        'default' =>  '',
                        'type'    => 'select',
                        'options' => 'slideshow',
                    ),
                    array(
                        'name'      =>  __('Animation style', 'angle-admin-td'),
                        'desc'      =>  __('Select how your slider animates', 'angle-admin-td'),
                        'id'        => 'animation',
                        'type'      => 'select',
                        'options'   =>  array(
                            'slide' => __('Slide', 'angle-admin-td'),
                            'fade'  => __('Fade', 'angle-admin-td'),
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
                        'default'   => '7000',
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
                        'default'   => '600',
                        'attr'      => array(
                            'max'       => 1500,
                            'min'       => 200,
                            'step'      => 100
                        )
                    ),
                    array(
                        'name'      => __('Auto start', 'angle-admin-td'),
                        'id'        => 'autostart',
                        'type'      => 'select',
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
                        'type'      => 'select',
                        'default'   =>  'hide',
                        'options' => array(
                            'show' => __('Show', 'angle-admin-td'),
                            'hide' => __('Hide', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'      => __('Navigation arrows type', 'angle-admin-td'),
                        'id'        => 'directionnavtype',
                        'type'      => 'select',
                        'default'   =>  'simple',
                        'options' => array(
                            'simple' => __('Simple', 'angle-admin-td'),
                            'fancy'  => __('Fancy', 'angle-admin-td'),
                        ),
                    ),
                     array(
                        'name'      => __('Item width', 'angle-admin-td'),
                        'desc'      => __('Set width of the slider items( leave blank for full )', 'angle-admin-td'),
                        'id'        => 'itemwidth',
                        'type'      => 'text',
                        'default'   => '',
                        'attr'      =>  array(
                            'size'    => 8,
                        ),
                    ),
                    array(
                        'name'      => __('Show controls', 'angle-admin-td'),
                        'id'        => 'showcontrols',
                        'type'      => 'select',
                        'default'   =>  'show',
                        'options' => array(
                            'show' => __('Show', 'angle-admin-td'),
                            'hide' => __('Hide', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'      => __('Choose the place of the controls', 'angle-admin-td'),
                        'id'        => 'controlsposition',
                        'type'      => 'select',
                        'default'   =>  'inside',
                        'options' => array(
                            'inside'    => __('Inside', 'angle-admin-td'),
                            'outside'   => __('Outside', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'      =>  __('Choose the alignment of the controls', 'angle-admin-td'),
                        'id'        => 'controlsalign',
                        'type'      => 'select',
                        'options'   =>  array(
                            'center' => __('Center', 'angle-admin-td'),
                            'left'   => __('Left', 'angle-admin-td'),
                            'right'  => __('Right', 'angle-admin-td'),
                        ),
                        'default'   => 'center',
                    ),
                    array(
                        'name'      => __('Reverse', 'angle-admin-td'),
                        'id'        => 'reverse',
                        'type'      => 'radio',
                        'default'   =>  'false',
                        'desc'    => __('Reverse the animation direction', 'angle-admin-td'),
                        'options' => array(
                            'false' => __('Off', 'angle-admin-td'),
                            'true'  => __('On', 'angle-admin-td'),
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
            array(
                'title' => __('Captions', 'angle-admin-td'),
                'fields' => array(
                    array(
                        'name'      => __('Show Captions', 'angle-admin-td'),
                        'id'        => 'captions',
                        'type'      => 'select',
                        'default'   =>  'show',
                        'options' => array(
                            'show' => __('Show', 'angle-admin-td'),
                            'hide' => __('Hide', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'      => __('Captions Vertical Position', 'angle-admin-td'),
                        'id'        => 'captions_vertical',
                        'type'      => 'select',
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
                        'type'      => 'select',
                        'default'   =>  'left',
                        'options' => array(
                            'left'      => __('Left', 'angle-admin-td'),
                            'right'     => __('Right', 'angle-admin-td'),
                            'alternate' => __('Alternate', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'      => __('Show Tooltip', 'angle-admin-td'),
                        'id'        => 'tooltip',
                        'type'      => 'select',
                        'default'   =>  'hide',
                        'desc'    => __('Show tooltip', 'angle-admin-td'),
                        'options' => array(
                            'show'  => __('Show', 'angle-admin-td'),
                            'hide'  => __('Hide', 'angle-admin-td'),
                        ),
                    ),
                )
            ),
        )
    ),
    'image' => array(
        'shortcode'     => 'image',
        'title'         => __('Image', 'angle-admin-td'),
        'desc'          => __('Displays an image.', 'angle-admin-td'),
        'insert_with'   => 'dialog',
        'has_content'   => false,
        'sections'      => array(
            array(
                'title' => __('Image', 'angle-admin-td'),
                'fields' => array(
                    array(
                        'name'    => __('Image Source', 'angle-admin-td'),
                        'id'      => 'images',
                        'type'    => 'upload',
                        'store'   => 'id',
                        'default' => '',
                        'desc'    => __('Place the source path of the image here', 'angle-admin-td'),
                    ),
                    array(
                        'name'    => __('Image size', 'angle-admin-td'),
                        'desc'    => __('Choose the size that the image will have', 'angle-admin-td'),
                        'id'      => 'size',
                        'type'    => 'select',
                        'default' => 'medium',
                        'options' => array(
                            'thumbnail' => __('Thumbnail', 'angle-admin-td'),
                            'medium'    => __('Medium', 'angle-admin-td'),
                            'large'     => __('Large', 'angle-admin-td'),
                            'full'      => __('Full', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'      => __('Align', 'angle-admin-td'),
                        'id'        => 'align',
                        'type'      => 'select',
                        'default'   => 'none',
                        'options' => array(
                            'none'       => __('None', 'angle-admin-td'),
                            'left'   => __('Left', 'angle-admin-td'),
                            'center' => __('Center', 'angle-admin-td'),
                            'right'  => __('Right', 'angle-admin-td'),
                            'justify'  => __('Justify', 'angle-admin-td')
                        ),
                        'desc'    => __('Sets the text alignment of the image.', 'angle-admin-td'),
                    ),
                    array(
                        'name'    => __('Image Alt', 'angle-admin-td'),
                        'id'      => 'alt',
                        'type'    => 'text',
                        'default' => '',
                        'desc'    => __('Place the alt of the image here', 'angle-admin-td'),
                    ),
                    array(
                        'name'    => __('Link', 'angle-admin-td'),
                        'id'      => 'link',
                        'type'    => 'text',
                        'default' => '',
                        'desc'    => __('Place a link here', 'angle-admin-td'),
                    ),
                    array(
                        'name'    => __('Open Link In', 'angle-admin-td'),
                        'id'      => 'link_target',
                        'type'    => 'select',
                        'default' => '_self',
                        'options' => array(
                            '_self'   => __('Same page as it was clicked ', 'angle-admin-td'),
                            '_blank'  => __('Open in new window/tab', 'angle-admin-td'),
                        ),
                        'desc'    => __('Where the link will open.', 'angle-admin-td'),
                    ),
                )
            )
        )
    ),
    'shapedimage' => array(
        'shortcode'     => 'shapedimage',
        'title'         => __('Shaped Image', 'angle-admin-td'),
        'desc'          => __('Displays an image that is clipped to a shape.', 'angle-admin-td'),
        'insert_with'   => 'dialog',
        'has_content'   => false,
        'sections'      => array(
            array(
                'title' => __('Image', 'angle-admin-td'),
                'fields' => array(
                    array(
                        'name'    => __('Image Source', 'angle-admin-td'),
                        'id'      => 'images',
                        'type'    => 'upload',
                        'store'   => 'id',
                        'default' => '',
                        'desc'    => __('Place the source path of the image here', 'angle-admin-td'),
                    ),
                    array(
                        'name'    => __('Image size', 'angle-admin-td'),
                        'desc'    => __('Choose the size that the image will have', 'angle-admin-td'),
                        'id'      => 'shape_size',
                        'type'    => 'select',
                        'default' => 'medium',
                        'admin_label' => true,
                        'options' => array(
                            'small'  => __('Small', 'angle-admin-td'),
                            'medium' => __('Medium', 'angle-admin-td'),
                            'normal' => __('Normal', 'angle-admin-td'),
                            'big'    => __('Big', 'angle-admin-td'),
                            'huge'   => __('Huge', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'    => __('Shape', 'angle-admin-td'),
                        'desc'    => __('Choose if the image will be roundrd or not', 'angle-admin-td'),
                        'id'      => 'shape',
                        'type'    => 'select',
                        'default' => 'round',
                        'options'    => array(
                            'rect'   => __('Rectangle', 'angle-admin-td'),
                            'square' => __('Square', 'angle-admin-td'),
                            'round'  => __('Circle', 'angle-admin-td'),
                            'hex'    => __('Hexagon', 'angle-admin-td'),
                        )
                    ),
                    array(
                        'name'      =>  __('Shadow', 'angle-admin-td'),
                        'id'        => 'shape_shadow',
                        'type'      => 'select',
                        'options'   =>  array(
                            'hide' => __('Hide', 'angle-admin-td'),
                            'show' => __('Show', 'angle-admin-td'),
                        ),
                        'default'   => 'show'
                    ),
                    array(
                        'name'      => __('Align', 'angle-admin-td'),
                        'id'        => 'align',
                        'type'      => 'select',
                        'default'   => 'none',
                        'options' => array(
                            'none'   => __('None', 'angle-admin-td'),
                            'left'   => __('Left', 'angle-admin-td'),
                            'center' => __('Center', 'angle-admin-td'),
                            'right'  => __('Right', 'angle-admin-td'),
                        ),
                        'desc'    => __('Sets the text alignment of the image.', 'angle-admin-td'),
                    ),
                    array(
                        'name'    => __('Hover Animation', 'PLUGIN_TD'),
                        'desc'    => __('Choose a hover animation', 'PLUGIN_TD'),
                        'id'      => 'animation',
                        'type'    => 'select',
                        'default' => 'none',
                        'options' => include OXY_THEME_DIR . 'inc/options/shortcodes/shortcode-button-animations.php'
                    ),
                    array(
                        'name'    => __('Open In Magnific Popup', 'PLUGIN_TD'),
                        'desc'    => __('Open the original image in magnific on click (overrides link option)', 'PLUGIN_TD'),
                        'id'      => 'magnific',
                        'type'    => 'select',
                        'default' => 'off',
                        'options' => array(
                            'on'    => __('On', 'PLUGIN_TD'),
                            'off'   => __('Off', 'PLUGIN_TD'),
                        ),
                    ),
                    array(
                        'name'    => __('Image Alt', 'angle-admin-td'),
                        'id'      => 'alt',
                        'type'    => 'text',
                        'default' => '',
                        'desc'    => __('Place the alt of the image here', 'angle-admin-td'),
                    ),
                    array(
                        'name'    => __('Link', 'angle-admin-td'),
                        'id'      => 'link',
                        'type'    => 'text',
                        'default' => '',
                        'desc'    => __('Place a link here', 'angle-admin-td'),
                    ),
                    array(
                        'name'    => __('Open Links In', 'angle-admin-td'),
                        'id'      => 'link_target',
                        'type'    => 'select',
                        'default' => '_self',
                        'options' => array(
                            '_self'   => __('Same page as it was clicked ', 'angle-admin-td'),
                            '_blank'  => __('Open in new window/tab', 'angle-admin-td'),
                        ),
                        'desc'    => __('Where the link will open.', 'angle-admin-td'),
                    ),
                )
            )
        )
    ),
    'featuredicon' => array(
        'shortcode'     => 'featuredicon',
        'title'         => __('Featured Icon', 'angle-admin-td'),
        'desc'          => __('Creates a shape with an icon in the middle.', 'angle-admin-td'),
        'insert_with'   => 'dialog',
        'has_content'   => false,
        'sections'      => array(
            array(
                'title' => __('Icon', 'angle-admin-td'),
                'fields' => array(
                    array(
                        'name'    => __('Icon', 'angle-admin-td'),
                        'id'      => 'icon',
                        'type'    => 'select',
                        'options' => 'icons',
                        'default' => 'glass',
                        'desc'    => __('Choose an icon to use in your featured icon', 'angle-admin-td'),
                    ),
                    array(
                        'name'    => __('Featured Icon Size', 'angle-admin-td'),
                        'desc'    => __('Choose the size that the image will have', 'angle-admin-td'),
                        'id'      => 'shape_size',
                        'type'    => 'select',
                        'default' => 'medium',
                        'options' => array(
                            'small'  => __('Small', 'angle-admin-td'),
                            'medium' => __('Medium', 'angle-admin-td'),
                            'normal' => __('Normal', 'angle-admin-td'),
                            'big'    => __('Big', 'angle-admin-td'),
                            'huge'   => __('Huge', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'        => __('Shape', 'angle-admin-td'),
                        'desc'        => __('Choose if the image will be roundrd or not', 'angle-admin-td'),
                        'id'          => 'shape',
                        'type'        => 'select',
                        'default'     => 'round',
                        'admin_label' => true,
                        'options'     => array(
                            'rect'   => __('Rectangle', 'angle-admin-td'),
                            'square' => __('Square', 'angle-admin-td'),
                            'round'  => __('Circle', 'angle-admin-td'),
                            'hex'    => __('Hexagon', 'angle-admin-td'),
                        )
                    ),
                    array(
                        'name'    => __('Icon Animation', 'PLUGIN_TD'),
                        'desc'    => __('Choose an icon animation', 'PLUGIN_TD'),
                        'id'      => 'animation',
                        'type'    => 'select',
                        'default' => '',
                        'options' => include OXY_THEME_DIR . 'inc/options/shortcodes/shortcode-button-animations.php'
                    ),
                    array(
                        'name'      =>  __('Shadow', 'angle-admin-td'),
                        'desc'    => __('Shows a shadow below the shape.', 'PLUGIN_TD'),
                        'id'        => 'shape_shadow',
                        'type'      => 'select',
                        'options'   =>  array(
                            'hide' => __('Hide', 'angle-admin-td'),
                            'show' => __('Show', 'angle-admin-td'),
                        ),
                        'default'   => 'show'
                    ),
                )
            )
        )
    ),
    'icon' => array(
        'shortcode'   => 'icon',
        'title'       => __('Icon', 'PLUGIN_TD'),
        'desc'        => __('Displays a Font Awesome icon.', 'angle-admin-td'),
        'insert_with' => 'dialog',
        'sections'    => array(
            array(
                'title'   => 'General',
                'fields'  => array(
                    array(
                        'name'    => __('Font Size', 'PLUGIN_TD'),
                        'desc'    => __('Size of font to use for icon ( set to 0 to inhertit font size from container )', 'PLUGIN_TD'),
                        'id'      => 'size',
                        'type'    => 'slider',
                        'default' => '16',
                        'attr'    => array(
                            'max'  => 48,
                            'min'  => 0,
                            'step' => 1
                        )
                    ),
                )
            ),
            array(
                'title'   => 'Icon',
                'fields'  => array(
                    array(
                        'name'    => __('Icon', 'PLUGIN_TD'),
                        'desc'    => __('Type of button to display', 'PLUGIN_TD'),
                        'id'      => 'content',
                        'type'    => 'select',
                        'options' => 'icons',
                        'default' => 'glass',
                        'admin_label' => true
                    )
                ),
            ),
        ),
    ),
    'button' =>  array(
        'shortcode'   => 'button',
        'title'       => __('Button', 'PLUGIN_TD'),
        'desc'        => __('Adds a Bootstrap button to the page.', 'angle-admin-td'),
        'insert_with' => 'dialog',
        'sections'    => array(
            array(
                'title'   => 'General',
                'fields'  => array(
                    array(
                        'name'    => __('Button type', 'PLUGIN_TD'),
                        'desc'    => __('Type of button to display', 'PLUGIN_TD'),
                        'id'      => 'type',
                        'type'    => 'select',
                        'default' => 'default',
                        'options' => array(
                            'default' => __('Default', 'PLUGIN_TD'),
                            'primary' => __('Primary', 'PLUGIN_TD'),
                            'info'    => __('Info', 'PLUGIN_TD'),
                            'success' => __('Success', 'PLUGIN_TD'),
                            'warning' => __('Warning', 'PLUGIN_TD'),
                            'danger'  => __('Danger', 'PLUGIN_TD'),
                            'link'    => __('Link', 'PLUGIN_TD'),
                        ),
                    ),
                    array(
                        'name'    => __('Button size', 'PLUGIN_TD'),
                        'desc'    => __('Size of button to display', 'PLUGIN_TD'),
                        'id'      => 'size',
                        'type'    => 'select',
                        'default' => 'normal',
                        'options' => array(
                            'normal' => __('Default', 'PLUGIN_TD'),
                            'lg'      => __('Large', 'PLUGIN_TD'),
                            'sm'      => __('Small', 'PLUGIN_TD'),
                            'xs'      => __('Mini', 'PLUGIN_TD'),
                        ),
                    ),
                    array(
                        'name'    => __('Text', 'PLUGIN_TD'),
                        'id'      => 'title',
                        'holder'  => 'button',
                        'type'    => 'text',
                        'default' => __('My button', 'PLUGIN_TD'),
                        'desc'    => __('Add a label to the button', 'PLUGIN_TD'),
                    ),
                    array(
                        'name'    => __('Link', 'PLUGIN_TD'),
                        'id'      => 'link',
                        'type'    => 'text',
                        'default' => '',
                        'desc'    => __('Where the button links to', 'PLUGIN_TD'),
                    ),
                )
            ),
            array(
                'title'   => 'Advanced',
                'fields'  => array(
                    array(
                        'name'    => __('Extra classes', 'PLUGIN_TD'),
                        'id'      => 'xclass',
                        'type'    => 'text',
                        'default' => '',
                        'desc'    => __('Add an extra class to the button', 'PLUGIN_TD'),
                    ),
                    array(
                        'name'    => __('Open Link In', 'PLUGIN_TD'),
                        'id'      => 'link_open',
                        'type'    => 'select',
                        'default' => '_self',
                        'options' => array(
                            '_self'   => __('Same page as it was clicked ', 'PLUGIN_TD'),
                            '_blank'  => __('Open in new window/tab', 'PLUGIN_TD'),
                            '_parent' => __('Open the linked document in the parent frameset', 'PLUGIN_TD'),
                            '_top'    => __('Open the linked document in the full body of the window', 'PLUGIN_TD')
                        ),
                        'desc'    => __('Where the button link opens to', 'PLUGIN_TD'),
                    ),
                )
            ),
            array(
                'title'   => 'Icon',
                'fields'  => array(
                    array(
                        'name'    => __('Show Icon', 'PLUGIN_TD'),
                        'desc'    => __('Use an icon in this button', 'PLUGIN_TD'),
                        'id'      => 'show_icon',
                        'type'    => 'select',
                        'default' => 'no-icon',
                        'options' => array(
                            'no-icon' => __('No Icon', 'PLUGIN_TD'),
                            'left'    => __('On Left', 'PLUGIN_TD'),
                            'right'   => __('On Right', 'PLUGIN_TD'),
                        ),
                    ),
                    array(
                        'name'    => __('Icon', 'PLUGIN_TD'),
                        'desc'    => __('Type of button to display', 'PLUGIN_TD'),
                        'id'      => 'icon',
                        'type'    => 'select',
                        'options' => 'icons',
                        'default' => ''
                    )
                ),
            ),
        ),
    ),
    'fancybutton' =>  array(
        'shortcode'   => 'fancybutton',
        'title'       => __('Fancy Button', 'PLUGIN_TD'),
        'desc'        => __('Creates a fancy call to action button with an icon.', 'angle-admin-td'),
        'insert_with' => 'dialog',
        'sections'    => array(
            array(
                'title'   => 'General',
                'fields'  => array(
                    array(
                        'name'    => __('Button type', 'PLUGIN_TD'),
                        'desc'    => __('Type of button to display', 'PLUGIN_TD'),
                        'id'      => 'type',
                        'type'    => 'select',
                        'default' => 'default',
                        'admin_label' => true,
                        'options' => array(
                            'default' => __('Default', 'PLUGIN_TD'),
                            'primary' => __('Primary', 'PLUGIN_TD'),
                            'info'    => __('Info', 'PLUGIN_TD'),
                            'success' => __('Success', 'PLUGIN_TD'),
                            'warning' => __('Warning', 'PLUGIN_TD'),
                            'danger'  => __('Danger', 'PLUGIN_TD'),
                        ),
                    ),
                    array(
                        'name'    => __('Button size', 'PLUGIN_TD'),
                        'desc'    => __('Size of button to display', 'PLUGIN_TD'),
                        'id'      => 'size',
                        'type'    => 'select',
                        'default' => 'normal',
                        'options' => array(
                            'normal'      => __('Default', 'PLUGIN_TD'),
                            'lg' => __('Large', 'PLUGIN_TD'),
                        ),
                    ),
                    array(
                        'name'      => __('Button Alignment', 'angle-admin-td'),
                        'id'        => 'align',
                        'type'      => 'select',
                        'default'   => 'center',
                        'options' => array(
                            'left'   => __('Left', 'angle-admin-td'),
                            'center' => __('Center', 'angle-admin-td'),
                            'right'  => __('Right', 'angle-admin-td'),
                        ),
                        'desc'    => __('Align the button.', 'angle-admin-td'),
                    ),
                    array(
                        'name'    => __('Text', 'PLUGIN_TD'),
                        'id'      => 'label',
                        'type'    => 'text',
                        'admin_label' => true,
                        'default' => __('My button', 'PLUGIN_TD'),
                        'desc'    => __('Add a label to the button', 'PLUGIN_TD'),
                    ),
                    array(
                        'name'    => __('Link', 'PLUGIN_TD'),
                        'id'      => 'link',
                        'type'    => 'text',
                        'default' => '',
                        'desc'    => __('Where the button links to', 'PLUGIN_TD'),
                    ),
                )
            ),
            array(
                'title'   => 'Advanced',
                'fields'  => array(
                    array(
                        'name'    => __('Extra classes', 'PLUGIN_TD'),
                        'id'      => 'xclass',
                        'type'    => 'text',
                        'default' => '',
                        'desc'    => __('Add an extra class to the button', 'PLUGIN_TD'),
                    ),
                    array(
                        'name'    => __('Open Link In', 'PLUGIN_TD'),
                        'id'      => 'link_open',
                        'type'    => 'select',
                        'default' => '_self',
                        'options' => array(
                            '_self'   => __('Same page as it was clicked ', 'PLUGIN_TD'),
                            '_blank'  => __('Open in new window/tab', 'PLUGIN_TD'),
                            '_parent' => __('Open the linked document in the parent frameset', 'PLUGIN_TD'),
                            '_top'    => __('Open the linked document in the full body of the window', 'PLUGIN_TD')
                        ),
                        'desc'    => __('Where the button link opens to', 'PLUGIN_TD'),
                    ),
                )
            ),
            array(
                'title'   => 'Icon',
                'fields'  => array(
                    array(
                        'name'    => __('Icon Position', 'PLUGIN_TD'),
                        'desc'    => __('Which side of the button to show the icon.', 'PLUGIN_TD'),
                        'id'      => 'icon_position',
                        'type'    => 'select',
                        'default' => 'left',
                        'options' => array(
                            'left'  => __('Left', 'PLUGIN_TD'),
                            'right' => __('Right', 'PLUGIN_TD'),
                        ),
                    ),
                    array(
                        'name'    => __('Icon Animation', 'PLUGIN_TD'),
                        'desc'    => __('Choose an icon animation', 'PLUGIN_TD'),
                        'id'      => 'animation',
                        'type'    => 'select',
                        'default' => 'none',
                        'options' => include OXY_THEME_DIR . 'inc/options/shortcodes/shortcode-button-animations.php'
                    ),
                    array(
                        'name'    => __('Icon', 'PLUGIN_TD'),
                        'desc'    => __('Type of button to display', 'PLUGIN_TD'),
                        'id'      => 'icon',
                        'admin_label' => true,
                        'type'    => 'select',
                        'options' => 'icons',
                        'default' => ''
                    )
                ),
            ),
        ),
    ),
    'vc_message' => array(
        'shortcode'   => 'vc_message',
        'title'       => __('Alert', 'PLUGIN_TD'),
        'desc'          => __('Creates a Bootstrap Alert box.', 'angle-admin-td'),
        'insert_with' => 'dialog',
        'sections'    => array(
            array(
                'title'   => __('General', 'PLUGIN_TD'),
                'fields'  => array(
                    array(
                        'name'    => __('Alert type', 'PLUGIN_TD'),
                        'desc'    => __('Type of alert to display', 'PLUGIN_TD'),
                        'id'      => 'color',
                        'type'    => 'select',
                        'default' => 'alert-success',
                        'options' => array(
                            'alert-success' => __('Success', 'PLUGIN_TD'),
                            'alert-info'    => __('Information', 'PLUGIN_TD'),
                            'alert-warning' => __('Warning', 'PLUGIN_TD'),
                            'alert-danger'  => __('Danger', 'PLUGIN_TD'),
                        ),
                    ),
                    array(
                        'name'    => __('Title', 'PLUGIN_TD'),
                        'id'      => 'title',
                        'type'    => 'text',
                        'holder'  => 'h2',
                        'default' => __('Watch Out!', 'PLUGIN_TD'),
                        'desc'    => __('The bold text that appears first in the alert', 'PLUGIN_TD'),
                    ),
                    array(
                        'name'    => __('Main Text', 'PLUGIN_TD'),
                        'id'      => 'content',
                        'type'    => 'text',
                        'holder'  => 'div',
                        'default' => __('Change a few things up and try submitting again.', 'PLUGIN_TD'),
                        'desc'    => __('Main text that will appear in the alert box', 'PLUGIN_TD'),
                    ),
                    array(
                        'name'    => __('Dismissable', 'PLUGIN_TD'),
                        'id'      => 'dismissable',
                        'type'    => 'select',
                        'default' => 'false',
                        'desc'    => __('Defines if the alert can be removed using an x in the corner.', 'PLUGIN_TD'),
                        'options' => array(
                            'true'  => __('Closable', 'PLUGIN_TD'),
                            'false' => __('Not Closable', 'PLUGIN_TD'),
                        ),
                    )
                )
            ),
        ),
    ),
    'panel' => array(
        'shortcode' => 'panel',
        'title'     => __('Panel', 'PLUGIN_TD'),
        'desc'      => __('Creates a Bootstrap Panel with a title and some content.', 'angle-admin-td'),
        'insert_with' => 'dialog',
        'sections'    => array(
            array(
                'title'   => __('General', 'PLUGIN_TD'),
                'fields'  => array(
                    array(
                        'name'    => __('Title', 'PLUGIN_TD'),
                        'id'      => 'title',
                        'type'    => 'text',
                        'holder'  => 'h3',
                        'default' => '',
                        'desc'    => __('The title of the panel.', 'PLUGIN_TD'),
                    ),
                )
            )
        ),

    ),
    'progress' =>    array(
        'shortcode'   => 'progress',
        'title'       => __('Progress Bar', 'PLUGIN_TD'),
        'desc'        => __('Creates a Bootstrap progress bar with a % value.', 'angle-admin-td'),
        'insert_with' => 'dialog',
        'sections'    => array(
            array(
                'title'   => 'general',
                'fields'  => array(
                    array(
                        'name'    => __('Percentage', 'PLUGIN_TD'),
                        'desc'    => __('Percentage of the progress bar', 'PLUGIN_TD'),
                        'id'      => 'percentage',
                        'type'    => 'slider',
                        'default' => '50',
                        'attr'    => array(
                            'max'  => 100,
                            'min'  => 1,
                            'step' => 1
                        )
                    ),
                    array(
                        'name'    => __('Bar Type', 'PLUGIN_TD'),
                        'desc'    => __('Type of bar to display', 'PLUGIN_TD'),
                        'id'      => 'type',
                        'type'    => 'select',
                        'default' => 'progress',
                        'options' => array(
                            'progress'                        => __('Normal', 'PLUGIN_TD'),
                            'progress progress-striped'       => __('Striped', 'PLUGIN_TD'),
                            'progress progress-striped active'=> __('Animated', 'PLUGIN_TD'),
                        ),
                    ),
                    array(
                        'name'    => __('Bar Style', 'PLUGIN_TD'),
                        'desc'    => __('Style of bar to display', 'PLUGIN_TD'),
                        'id'      => 'style',
                        'type'    => 'select',
                        'default' => 'progress-bar-info',
                        'options' => array(
                            'progress-bar-primary'  => __('primary', 'PLUGIN_TD'),
                            'progress-bar-info'     => __('Info', 'PLUGIN_TD'),
                            'progress-bar-success'  => __('Success', 'PLUGIN_TD'),
                            'progress-bar-warning'  => __('Warning', 'PLUGIN_TD'),
                            'progress-bar-danger'   => __('Danger', 'PLUGIN_TD'),
                        ),
                    ),


                )
            ),
        ),
    ),
    'lead' => array(
        'shortcode'   => 'lead',
        'title'       => __('Lead Paragraph', 'PLUGIN_TD'),
        'desc'        => __('Adds a lead paragraph, with slightly larger and bolder text.', 'angle-admin-td'),
        'insert_with' => 'dialog',
        'sections'    => array(
            array(
                'title'   => 'general',
                'fields'  => array(
                    array(
                        'name'      => __('Text Alignment', 'angle-admin-td'),
                        'id'        => 'align',
                        'type'      => 'select',
                        'default'   => 'center',
                        'options' => array(
                            'left'   => __('Left', 'angle-admin-td'),
                            'center' => __('Center', 'angle-admin-td'),
                            'right'  => __('Right', 'angle-admin-td'),
                            'justify'  => __('Justify', 'angle-admin-td')
                        ),
                        'desc'    => __('Sets the text alignment of the lead text.', 'angle-admin-td'),
                    ),
                    array(
                        'name'      => __('Lead Text', 'angle-admin-td'),
                        'holder'    => 'p',
                        'id'        => 'content',
                        'type'      => 'textarea',
                        'default'   => '',
                        'desc'    => __('Text to show in the lead text paragraph.', 'angle-admin-td'),
                    ),
                )
            )
        )
    ),
    'blockquote' => array(
        'shortcode'   => 'blockquote',
        'title'       => __('Blockquote', 'PLUGIN_TD'),
        'desc'        => __('Creates a quotation.', 'angle-admin-td'),
        'insert_with' => 'dialog',
        'sections'    => array(
            array(
                'title'   => 'general',
                'fields'  => array(
                    array(
                        'name'      => __('Text Alignment', 'angle-admin-td'),
                        'id'        => 'align',
                        'type'      => 'select',
                        'default'   => 'left',
                        'options' => array(
                            'left'   => __('Left', 'angle-admin-td'),
                            'right'  => __('Right', 'angle-admin-td'),
                            'justify'  => __('Justify', 'angle-admin-td')
                        ),
                        'desc'    => __('Sets the text alignment of the lead text.', 'angle-admin-td'),
                    ),
                    array(
                        'name'      => __('Quote Text', 'angle-admin-td'),
                        'holder'    => 'p',
                        'id'        => 'content',
                        'type'      => 'textarea',
                        'default'   => '',
                        'desc'    => __('Text to show in the quote.', 'angle-admin-td'),
                    ),
                    array(
                        'name'    => __('Who?', 'PLUGIN_TD'),
                        'id'      => 'who',
                        'type'    => 'text',
                        'default' => '',
                        'desc'    => __('Who said the quote.', 'PLUGIN_TD'),
                    ),
                    array(
                        'name'    => __('Citation', 'PLUGIN_TD'),
                        'id'      => 'cite',
                        'type'    => 'text',
                        'default' => '',
                        'desc'    => __('Citation of the quote (i.e the source).', 'PLUGIN_TD'),
                    ),
                )
            )
        )
    ),
    'code' => array(
        'shortcode'   => 'code',
        'title'       => __('Code', 'PLUGIN_TD'),
        'desc'        => __('For use adding source code to a page.', 'angle-admin-td'),
        'insert_with' => 'dialog',
        'sections'    => array(
            array(
                'title'   => 'general',
                'fields'  => array(
                    array(
                        'name'      => __('Source Code', 'angle-admin-td'),
                        'holder'    => 'p',
                        'id'        => 'content',
                        'type'      => 'textarea',
                        'default'   => '',
                        'desc'    => __('Source code to display.', 'angle-admin-td'),
                    ),
                )
            )
        )
    ),
    'countdown' => array(
        'shortcode'   => 'countdown',
        'title'       => __('Countdown Timer', 'PLUGIN_TD'),
        'desc'        => __('Adds a countdown timer for coming soon pages.', 'angle-admin-td'),
        'insert_with' => 'dialog',
        'sections'    => array(
            array(
                'title'   => 'general',
                'fields'  => array(
                    array(
                        'name'      => __('Countdown Date', 'angle-admin-td'),
                        'id'        => 'date',
                        'type'      => 'text',
                        'default'   => '',
                        'admin_label' => true,
                        'desc'    => __('Date to countdown to in the format YYYY/MM/DD HH:MM.', 'angle-admin-td'),
                    ),
                    array(
                        'name'    => __('Number Font Size', 'angle-admin-td'),
                        'desc'    => __('Choose size of the font to use for the countdown numbers.', 'angle-admin-td'),
                        'id'      => 'number_size',
                        'type'    => 'select',
                        'options' => array(
                            'normal' => __('Normal', 'angle-admin-td'),
                            'super'  => __('Super (60px)', 'angle-admin-td'),
                            'hyper'  => __('Hyper (96px)', 'angle-admin-td'),
                        ),
                        'default' => 'normal',
                    ),
                    array(
                        'name'    => __('Number Font Weight', 'angle-admin-td'),
                        'desc'    => __('Choose weight of the font of the countdown numbers.', 'angle-admin-td'),
                        'id'      => 'number_weight',
                        'type'    => 'select',
                        'options' => array(
                            'regular'  => __('Regular', 'angle-admin-td'),
                            'black'    => __('Black', 'angle-admin-td'),
                            'bold'     => __('Bold', 'angle-admin-td'),
                            'light'    => __('Light', 'angle-admin-td'),
                            'hairline' => __('Hairline', 'angle-admin-td'),
                        ),
                        'default' => 'regular',
                    ),
                    array(
                        'name'    => __('Number Underline', 'angle-admin-td'),
                        'desc'    => __('Adds an underline effect below the countdown numbers.', 'angle-admin-td'),
                        'id'      => 'number_underline',
                        'default' => 'no-underline',
                        'type' => 'select',
                        'options' => array(
                            'underline'    => __('Show', 'angle-admin-td'),
                            'no-underline' => __('Hide', 'angle-admin-td'),
                        ),
                    ),
                )
            )
        )
    ),
    'sharing' => array(
        'shortcode'   => 'sharing',
        'title'       => __('Social Sharing Icons', 'PLUGIN_TD'),
        'desc'        => __('Adds Social Sharing icons to your pages', 'angle-admin-td'),
        'insert_with' => 'dialog',
        'sections'    => array(
            array(
                'title'   => 'general',
                'fields'  => array(
                    array(
                        'name'    => __('Show Facebook', 'angle-admin-td'),
                        'desc'    => __('Show Facebook share icon', 'angle-admin-td'),
                        'id'      => 'fb_show',
                        'default' => 'show',
                        'type' => 'select',
                        'options' => array(
                            'show'    => __('Show', 'angle-admin-td'),
                            'hide' => __('Hide', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'    => __('Show Twitter', 'angle-admin-td'),
                        'desc'    => __('Show Twitter share icon', 'angle-admin-td'),
                        'id'      => 'twitter_show',
                        'default' => 'show',
                        'type' => 'select',
                        'options' => array(
                            'show'    => __('Show', 'angle-admin-td'),
                            'hide' => __('Hide', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'    => __('Show Google+', 'angle-admin-td'),
                        'desc'    => __('Show Google+ share icon', 'angle-admin-td'),
                        'id'      => 'google_show',
                        'default' => 'show',
                        'type' => 'select',
                        'options' => array(
                            'show'    => __('Show', 'angle-admin-td'),
                            'hide' => __('Hide', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'    => __('Show Pinterest', 'angle-admin-td'),
                        'desc'    => __('Show Pinterest share icon', 'angle-admin-td'),
                        'id'      => 'pinterest_show',
                        'default' => 'show',
                        'type' => 'select',
                        'options' => array(
                            'show'    => __('Show', 'angle-admin-td'),
                            'hide' => __('Hide', 'angle-admin-td'),
                        ),
                    ),
                    array(
                        'name'    => __('Show LinkedIn', 'angle-admin-td'),
                        'desc'    => __('Show LinkedIn share icon', 'angle-admin-td'),
                        'id'      => 'linkedin_show',
                        'default' => 'show',
                        'type' => 'select',
                        'options' => array(
                            'show'    => __('Show', 'angle-admin-td'),
                            'hide' => __('Hide', 'angle-admin-td'),
                        ),
                    ),
                )
            )
        )
    ),
    'vc_video' => array(
        'shortcode'     => 'vc_video',
        'title'         => __('Video Player', 'angle-admin-td'),
        'desc'          => __('Adds a video player.', 'angle-admin-td'),
        'insert_with'   => 'dialog',
        'has_content'   => false,
        'sections'      => array(
            array(
                'title' => __('Video Options', 'angle-admin-td'),
                'fields' => array(
                    array(
                        'name'      => __('Video URL', 'angle-admin-td'),
                        'id'        => 'link',
                        'type'      => 'text',
                        'default'   =>  '',
                    ),
                )
            )
        )
    ),
);
