<?php
/**
 * Visual Composer setup
 *
 * @package Angle
 * @subpackage Admin
 * @since 0.1
 *
 * @copyright (c) 2014 Oxygenna.com
 * @license **LICENSE**
 * @version 1.12.2
 */


if( function_exists('vc_set_as_theme') ) {
    vc_set_as_theme( true );
}

if( function_exists( 'vc_disable_frontend' ) ) {
    vc_disable_frontend( true );
}

if( class_exists('WPBakeryVisualComposerAbstract') ) {

    function oxy_option_to_vc_option( $options ) {
        $vc_options = array();
        foreach( $options['sections'] as $section ) {
            foreach( $section['fields'] as $field ) {
                $vc_option = array(
                    'heading' => $field['name'],
                    'type' => oxy_option_type_to_vc_option_type( $field['type'] ),
                    'param_name' => $field['id'],
                );

                if( isset( $field['admin_label'] ) ) {
                    $vc_option['admin_label'] = $field['admin_label'];
                }

                if( isset( $field['desc'] ) ) {
                    $vc_option['description'] = $field['desc'];
                }

                if( isset( $field['holder'] ) ) {
                    $vc_option['holder'] = $field['holder'];
                }

                if( isset( $field['default'] ) ) {
                    $vc_option['value'] = $field['default'];
                }

                if( isset( $field['options']) && $field['type'] === 'radio' ) {
                    $vc_option['value'] = array_flip( $field['options']);
                }

                // include original oxy option in case we implement our own option
                $vc_option['oxy_option'] = $field;

                $vc_options[] = $vc_option;
            }
        }
        return $vc_options;
    }

    function oxy_option_type_to_vc_option_type( $type ) {
        switch( $type ) {
            case 'radio':
            case 'icons':
                return 'dropdown';
            break;
            case 'text':
                return 'textfield';
            break;
            case 'upload':
                return 'attach_image';
            break;
            case 'colour':
                return 'colorpicker';
            break;
            default:
                return $type;
            break;
        }
    }

    function oxy_option_params_to_vc_option_params( $option ) {
        switch( $option['type'] ) {
            case 'radio':
                return array_flip( $option['options'] );
            break;
        }
    }

    /**
     * Creates and renders oxygenna option inside visual composer
     *
     * @return void
     * @author
     **/
    function oxy_custom_vc_oxy_option($settings, $value) {
        $attr = array(
            'name' => $settings['oxy_option']['id'],
            'class' => 'wpb_vc_param_value'
        );
        if( isset( $settings['oxy_option']['attr'] ) ) {
            $attr = array_merge( $attr, $settings['oxy_option']['attr'] );
        }

        $option = OxygennaOptions::create_option( $settings['oxy_option'], $value, $attr );
        return '<div class="my_param_block">' . $option->render( false ) . '</div>';
    }

    /**
     * Creates and renders oxygenna select and hidden field to store value ( for multiple selects ) inside visual composer
     *
     * @return void
     * @author
     **/
    function oxy_custom_vc_oxy_select($settings, $value) {
        $attr = array(
            'class' => 'vc_oxygenna_select'
        );
        if( isset( $settings['oxy_option']['attr'] ) ) {
            $attr = array_merge( $attr, $settings['oxy_option']['attr'] );
        }

        if( ( $value === 'null' || empty($value) ) && isset( $settings['oxy_option']['default'] ) ) {
            $value = $settings['oxy_option']['default'];
        }

        $option = OxygennaOptions::create_option( $settings['oxy_option'], $value, $attr );

        $output = '<div class="my_param_block">';
        $output .= $option->render( false );
        $output .= '<input type="hidden" class="wpb_vc_param_value" name="' . $settings['oxy_option']['id'] . '" value="' . $value . '"/>';
        $output .= '</div>';
        return $output;
    }

    function oxy_add_vc_shortcode_params() {
        if( function_exists('vc_add_shortcode_param') ) {
            vc_add_shortcode_param('select', 'oxy_custom_vc_oxy_select', OXY_THEME_URI . 'inc/options/javascripts/visual-composer/select.js' );
            vc_add_shortcode_param('slider', 'oxy_custom_vc_oxy_option', OXY_TF_URI . 'inc/options/fields/slider/slider.js' );
        }
    }
    add_action( 'init', 'oxy_add_vc_shortcode_params' );


    /**
     * Adds stylesheet to visual composer
     *
     * @return void
     **/
    function oxy_add_vc_style() {
        $pt_array = get_option( 'wpb_js_content_types', array( 'page' ) );

        if( null !== $pt_array ) {
            if( in_array( get_post_type(), $pt_array ) ) {
                wp_enqueue_style( 'oxy_vc_admin', OXY_THEME_URI . 'inc/assets/stylesheets/visual-composer/visual-composer.css', array( 'js_composer' ) );
                wp_enqueue_script( 'oxy_vc_admin', OXY_THEME_URI . 'inc/assets/js/visual-composer/visual-composer.js', array('wpb_js_composer_js_view'), '0.1', true);
            }
        }
    }
    add_action( 'admin_print_scripts-post.php', 'oxy_add_vc_style' );
    add_action( 'admin_print_scripts-post-new.php', 'oxy_add_vc_style' );


    function oxy_init_vc_shortcodes() {
        // add our theme shortcodes to vc

        // create theme specific shortcodes for vc
        $shortcode_options = include OXY_THEME_DIR . 'inc/options/shortcodes/shortcode-options.php';

        /////////////////////////////////// VC codes //////////////////////////////////////////////
        vc_map( array(
            'name'                    => $shortcode_options['vc_row']['title'],
            'description'             => $shortcode_options['vc_row']['desc'],
            'base'                    => 'vc_row',
            'is_container'            => true,
            'icon'                    => 'icon-wpb-row',
            'show_settings_on_create' => false,
            'category'                => __('Content', 'js_composer'),
            'params'                  => oxy_option_to_vc_option( $shortcode_options['vc_row'] ),
            'js_view'                 => 'VcRowView'
        ));

        vc_map( array(
            'name'                    => __('Row', 'angle-admin-td'),
            'description'             => $shortcode_options['vc_row_inner']['desc'],
            'base'                    => 'vc_row_inner',
            'content_element'         => false,
            "is_container"            => true,
            'icon'                    => 'icon-wpb-row',
            'weight'                  => 1000,
            'show_settings_on_create' => false,
            'params'                  => oxy_option_to_vc_option( $shortcode_options['vc_row_inner'] ),
            'js_view'                 => 'VcRowView'
        ) );

        vc_map( array(
            'name'            => $shortcode_options['vc_column']['title'],
            'description'     => $shortcode_options['vc_column']['desc'],
            'base'            => 'vc_column',
            'is_container'    => true,
            'content_element' => false,
            'params'          => oxy_option_to_vc_option( $shortcode_options['vc_column'] ),
            'js_view'         => 'VcColumnView'
        ) );

         vc_map( array(
            'name'            => $shortcode_options['vc_column']['title'],
            'description'     => $shortcode_options['vc_column']['desc'],
            'base'            => 'vc_column_inner',
            'is_container'    => true,
            'content_element' => false,
            'params'          => oxy_option_to_vc_option( $shortcode_options['vc_column'] ),
            'js_view'         => 'VcColumnView'
        ) );

        // vc_single_image shortcode
        vc_map( array(
            'name'                    => $shortcode_options['image']['title'],
            'description'             => $shortcode_options['image']['desc'],
            'base'                    => 'vc_single_image',
            'is_container'            => false,
            'icon'                    => 'icon-wpb-single-image',
            'show_settings_on_create' => true,
            'category'                => __('Content', 'js_composer'),
            'params'                  => oxy_option_to_vc_option( $shortcode_options['image'] )
        ));

        // vc_separator shortcode
        vc_map( array(
            'name'                    => 'Separator',
            'description'             => __('Adds an <hr> tag.', 'angle-admin-td'),
            'base'                    => 'vc_separator',
            'icon'                    => 'icon-oxy-ruler-divider',
            'show_settings_on_create' => false
        ));

        // vc_tabs
        $tab_id_1 = time().'-1-'.rand(0, 100);
        $tab_id_2 = time().'-2-'.rand(0, 100);
        vc_map( array(
            'name'  => __('Tabs', 'js_composer'),
            'description'   => __('Creates Bootstrap Tabs with content.', 'angle-admin-td'),
            'base' => 'vc_tabs',
            'show_settings_on_create' => false,
            'is_container' => true,
            'icon' => 'icon-wpb-ui-tab-content',
            'category' => __('Bootstrap', 'js_composer'),
            'params' => array(
                array(
                    'type' => 'dropdown',
                    'heading' => __('Tabs Style', 'js_composer'),
                    'param_name' => 'style',
                    'value' => array(
                        __('Top', 'js_composer')    => 'top',
                        __('Bottom', 'js_composer') => 'bottom'
                    ),
                    'description' => __('Choose where the tabs are located', 'js_composer')
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Extra class name', 'js_composer'),
                    'param_name' => 'el_class',
                    'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer')
                )
            ),
            'custom_markup' => '
            <div class="wpb_tabs_holder wpb_holder vc_container_for_children">
            <ul class="tabs_controls">
            </ul>
            %content%
            </div>'
            ,
            'default_content' => '
            [vc_tab title="' . __('Tab 1','js_composer') . '" tab_id="'.$tab_id_1.'"][/vc_tab]
            [vc_tab title="' . __('Tab 2','js_composer') . '" tab_id="'.$tab_id_2.'"][/vc_tab]
            ',
            'js_view' => 'VcTabsView'
        ));

        /* Text Block
        ---------------------------------------------------------- */
        vc_map( array(
            'name'          => __('Text Block', 'js_composer'),
            'description'   => __('A block of text with WYSIWYG editor', 'angle-admin-td'),
            'base'          => 'vc_column_text',
            'icon'          => 'icon-wpb-layer-shape-text',
            'wrapper_class' => 'clearfix',
            'category'      => __('Content', 'js_composer'),
            'params'        => array(
            array(
                'type'       => 'textarea_html',
                'holder'     => 'div',
                'heading'    => __('Text', 'js_composer'),
                'param_name' => 'content',
                'value'      => __('<p>I am text block. Click edit button to change this text.</p>', 'js_composer')
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __('Extra class name', 'js_composer'),
                'param_name'  => 'extra_classes',
                'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer')
            )
          )
        ));

        vc_map( array(
            'name' => __('Accordion', 'js_composer'),
            'description'   => __('Creates a Bootstrap Accordion.', 'angle-admin-td'),
            'base' => 'vc_accordion',
            'show_settings_on_create' => false,
            'is_container' => true,
            'icon' => 'icon-wpb-ui-accordion',
            'category' => __('Bootstrap', 'js_composer'),
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => __('Extra class name', 'js_composer'),
                    'param_name' => 'el_class',
                    'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer')
                )
            ),
            'custom_markup' => '
            <div class="wpb_accordion_holder wpb_holder clearfix vc_container_for_children">
            %content%
            </div>
            <div class="tab_controls">
            <button class="add_tab" title="'.__("Add accordion section", "js_composer").'">'.__("Add accordion section", "js_composer").'</button>
            </div>
            ',
            'default_content' => '
            [vc_accordion_tab title="'.__('Section 1', "js_composer").'" state="closed"][/vc_accordion_tab]
            [vc_accordion_tab title="'.__('Section 2', "js_composer").'" state="closed"][/vc_accordion_tab]
            ',
            'js_view' => 'VcAccordionView'
        ));

        vc_map( array(
            'name' => __('Accordion Section', 'js_composer'),
            'base' => 'vc_accordion_tab',
            'allowed_container_element' => 'vc_row',
            'is_container' => true,
            'content_element' => false,
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => __('Title', 'js_composer'),
                    'param_name' => 'title',
                    'description' => __('Accordion section title.', 'js_composer')
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __('State', 'js_composer'),
                    'param_name' => 'state',
                    'value' => array(
                        __('Closed', 'js_composer') => 'closed',
                        __('Open', 'js_composer')   => 'open',
                    ),
                    'description' => __('Is this accordion panel open?', 'js_composer')
                ),
            ),
            'js_view' => 'VcAccordionTabView'
        ));


        /////////////////////////////////// BOOSTRAP codes /////////////////////////////////////////
        vc_map( array(
            'name'                    => $shortcode_options['panel']['title'],
            'description'             => $shortcode_options['panel']['desc'],
            'base'          => 'panel',
            'allowed_container_element' => 'vc_row',
            'is_container' => true,
            'content_element' => true,
            'icon'          => 'icon-oxy-panel',
            'category'      => __('Bootstrap', 'js_composer'),
            'params'        => oxy_option_to_vc_option( $shortcode_options['panel'] ),
            'js_view' => 'VcColumnView'
        ));

        vc_map( array(
            'name'                    => $shortcode_options['vc_message']['title'],
            'description'             => $shortcode_options['vc_message']['desc'],
            'base'          => 'vc_message',
            'icon'          => 'icon-wpb-information-white',
            'wrapper_class' => 'alert',
            'category'      => __('Bootstrap', 'js_composer'),
            'params'        => oxy_option_to_vc_option( $shortcode_options['vc_message'] ),
            'js_view'       => 'VcMessageView'
        ));

        vc_map( array(
            'name'                    => $shortcode_options['button']['title'],
            'description'             => $shortcode_options['button']['desc'],
            'base'     => 'button',
            'icon'     => 'icon-wpb-ui-button',
            'category' => __('Content', 'js_composer'),
            'params'   => oxy_option_to_vc_option( $shortcode_options['button'] ),
            'js_view'  => 'OxyVcButtonView'
        ));

        vc_map( array(
            'name'                    => $shortcode_options['progress']['title'],
            'description'             => $shortcode_options['progress']['desc'],
            'base'                    => 'progress',
            'is_container'            => false,
            'icon'                    => 'icon-wpb-graph',
            'show_settings_on_create' => true,
            'category'                => __('Theme Elements', 'js_composer'),
            'params'                  => oxy_option_to_vc_option( $shortcode_options['progress'] )
        ));

        /////////////////////////////////// TYPOGRAPHY codes //////////////////////////////////////////////

        vc_map( array(
            'name'                    => $shortcode_options['icon']['title'],
            'description'             => $shortcode_options['icon']['desc'],
            'base'     => 'icon',
            'icon'     => 'icon-oxy-icon',
            'category' => __('Typography', 'js_composer'),
            'params'   => oxy_option_to_vc_option( $shortcode_options['icon'] ),
            'js_view' => 'OxyVcIconView'
        ));

        vc_map( array(
            'name'                    => $shortcode_options['heading']['title'],
            'description'             => $shortcode_options['heading']['desc'],
            'base'     => 'heading',
            'icon'     => 'icon-oxy-heading',
            'category' => __('Typography', 'js_composer'),
            'params'   => oxy_option_to_vc_option( $shortcode_options['heading'] ),
            'js_view' => 'OxyVcHeadingView'
        ));

        vc_map( array(
            'name'                    => $shortcode_options['lead']['title'],
            'description'             => $shortcode_options['lead']['desc'],
            'base'     => 'lead',
            'icon'     => 'icon-oxy-lead-p',
            'category' => __('Typography', 'js_composer'),
            'params'   => oxy_option_to_vc_option( $shortcode_options['lead'] ),
            'js_view' => 'OxyVcLeadView'
        ));

        vc_map( array(
            'name'                    => $shortcode_options['blockquote']['title'],
            'description'             => $shortcode_options['blockquote']['desc'],
            'base'     => 'blockquote',
            'icon'     => 'icon-oxy-quote',
            'category' => __('Typography', 'js_composer'),
            'params'   => oxy_option_to_vc_option( $shortcode_options['blockquote'] ),
            'js_view' => 'OxyVcBlockQuoteView'
        ));

        vc_map( array(
            'name'                    => $shortcode_options['code']['title'],
            'description'             => $shortcode_options['code']['desc'],
            'base'     => 'code',
            'icon'     => 'icon-wpb-raw-javascript',
            'category' => __('Typography', 'js_composer'),
            'params'   => oxy_option_to_vc_option( $shortcode_options['code'] ),
        ));

        /////////////////////////////////// THEME codes //////////////////////////////////////////////

        // vc_single_image shortcode
        vc_map( array(
            'name'                    => $shortcode_options['feature']['title'],
            'description'             => $shortcode_options['feature']['desc'],
            'base'                    => 'feature',
            'is_container'            => false,
            'icon'                    => 'icon-oxy-feature',
            'category'                => __('Theme Elements', 'js_composer'),
            'params'                  => oxy_option_to_vc_option( $shortcode_options['feature'] ),
        ));

        // vc_single_image shortcode
        vc_map( array(
            'name'                    => $shortcode_options['shapedimage']['title'],
            'description'             => $shortcode_options['shapedimage']['desc'],
            'base'                    => 'shapedimage',
            'is_container'            => false,
            'icon'                    => 'icon-oxy-shaped',
            'show_settings_on_create' => true,
            'category'                => __('Theme Elements', 'js_composer'),
            'params'                  => oxy_option_to_vc_option( $shortcode_options['shapedimage'] ),
            'js_view'                 => 'OxyVcShapedImageView'
        ));

        vc_map( array(
            'name'                    => $shortcode_options['pricing']['title'],
            'description'             => $shortcode_options['pricing']['desc'],
            'base'     => 'pricing',
            'icon'     => 'icon-oxy-pricing',
            'category' => __('Theme Elements', 'js_composer'),
            'params'   => oxy_option_to_vc_option( $shortcode_options['pricing'] ),
        ));

        vc_map( array(
            'name'                    => $shortcode_options['featuredicon']['title'],
            'description'             => $shortcode_options['featuredicon']['desc'],
            'base'     => 'featuredicon',
            'icon'     => 'icon-oxy-f-icon',
            'category' => __('Theme Elements', 'js_composer'),
            'params'   => oxy_option_to_vc_option( $shortcode_options['featuredicon'] ),
            'js_view'  => 'OxyVcFeaturedIconView'
        ));


        // recent posts shortcode
        vc_map( array(
            'name'                    => $shortcode_options['recent_posts']['title'],
            'description'             => $shortcode_options['recent_posts']['desc'],
            'base'                    => 'recent_posts',
            'is_container'            => false,
            'icon'                    => 'icon-wpb-application-icon-large',
            'show_settings_on_create' => true,
            'category'                => __('Theme Elements', 'js_composer'),
            'params'                  => oxy_option_to_vc_option( $shortcode_options['recent_posts'] )
        ));

        // services shortcode
        vc_map( array(
            'name'                    => $shortcode_options['services']['title'],
            'description'             => $shortcode_options['services']['desc'],
            'base'                    => 'services',
            'is_container'            => false,
            'icon'                    => 'icon-oxy-services',
            'show_settings_on_create' => true,
            'category'                => __('Theme Elements', 'js_composer'),
            'params'                  => oxy_option_to_vc_option( $shortcode_options['services'] )
        ));

        // portfolio shortcode
        vc_map( array(
            'name'                    => $shortcode_options['portfolio']['title'],
            'description'             => $shortcode_options['portfolio']['desc'],
            'base'                    => 'portfolio',
            'is_container'            => false,
            'icon'                    => 'icon-wpb-images-carousel',
            'show_settings_on_create' => true,
            'category'                => __('Theme Elements', 'js_composer'),
            'params'                  => oxy_option_to_vc_option( $shortcode_options['portfolio'] )
        ));


        vc_map( array(
            'name'                    => $shortcode_options['staff_list']['title'],
            'description'             => $shortcode_options['staff_list']['desc'],
            'base'                    => 'staff_list',
            'is_container'            => false,
            'icon'                    => 'icon-oxy-staff',
            'show_settings_on_create' => true,
            'category'                => __('Theme Elements', 'js_composer'),
            'params'                  => oxy_option_to_vc_option( $shortcode_options['staff_list'] )
        ));

        vc_map( array(
            'name'                    => $shortcode_options['staff_featured']['title'],
            'description'             => $shortcode_options['staff_featured']['desc'],
            'base'                    => 'staff_featured',
            'is_container'            => false,
            'icon'                    => 'icon-oxy-f-staff',
            'show_settings_on_create' => true,
            'category'                => __('Theme Elements', 'js_composer'),
            'params'                  => oxy_option_to_vc_option( $shortcode_options['staff_featured'] )
        ));

        vc_map( array(
            'name'                    => $shortcode_options['testimonials']['title'],
            'description'             => $shortcode_options['testimonials']['desc'],
            'base'                    => 'testimonials',
            'is_container'            => false,
            'icon'                    => 'icon-oxy-testimonial',
            'show_settings_on_create' => true,
            'category'                => __('Theme Elements', 'js_composer'),
            'params'                  => oxy_option_to_vc_option( $shortcode_options['testimonials'] )
        ));


        vc_map( array(
            'name'                    => $shortcode_options['map']['title'],
            'description'             => $shortcode_options['map']['desc'],
            'base'                    => 'map',
            'is_container'            => false,
            'icon'                    => 'icon-wpb-map-pin',
            'show_settings_on_create' => true,
            'category'                => __('Content', 'js_composer'),
            'params'                  => oxy_option_to_vc_option( $shortcode_options['map'] )
        ));

        vc_map( array(
            'name'                    => $shortcode_options['slideshow']['title'],
            'description'             => $shortcode_options['slideshow']['desc'],
            'base'                    => 'slideshow',
            'is_container'            => false,
            'icon'                    => 'icon-wpb-images-stack',
            'show_settings_on_create' => true,
            'category'                => __('Content', 'js_composer'),
            'params'                  => oxy_option_to_vc_option( $shortcode_options['slideshow'] )
        ));

        vc_map( array(
            'name'                    => $shortcode_options['pie']['title'],
            'description'             => $shortcode_options['pie']['desc'],
            'base'                    => 'pie',
            'is_container'            => false,
            'icon'                    => 'icon-wpb-vc_pie',
            'show_settings_on_create' => true,
            'category'                => __('Theme Elements', 'js_composer'),
            'params'                  => oxy_option_to_vc_option( $shortcode_options['pie'] )
        ));

        vc_map( array(
            'name'                    => $shortcode_options['counter']['title'],
            'description'             => $shortcode_options['counter']['desc'],
            'base'                    => 'counter',
            'is_container'            => false,
            'icon'                    => 'icon-wpb-vc_counter',
            'show_settings_on_create' => true,
            'category'                => __('Theme Elements', 'js_composer'),
            'params'                  => oxy_option_to_vc_option( $shortcode_options['counter'] )
        ));

        vc_map( array(
            'name'                    => $shortcode_options['countdown']['title'],
            'description'             => $shortcode_options['countdown']['desc'],
            'base'                    => 'countdown',
            'is_container'            => false,
            'icon'                    => 'icon-wpb-vc_countdown',
            'show_settings_on_create' => true,
            'category'                => __('Theme Elements', 'js_composer'),
            'params'                  => oxy_option_to_vc_option( $shortcode_options['countdown'] )
        ));

        vc_map( array(
            'name'                    => $shortcode_options['fancybutton']['title'],
            'description'             => $shortcode_options['fancybutton']['desc'],
            'base'                    => 'fancybutton',
            'icon'                    => 'icon-oxy-fancy',
            'category'                => __('Theme Elements', 'js_composer'),
            'params'                  => oxy_option_to_vc_option( $shortcode_options['fancybutton'] ),
            'js_view'                 => 'OxyVcButtonView'
        ));

        vc_map( array(
            'name'                    => $shortcode_options['sharing']['title'],
            'description'             => $shortcode_options['sharing']['desc'],
            'base'                    => 'sharing',
            'is_container'            => false,
            'icon'                    => 'icon-oxy-sharing',
            'show_settings_on_create' => true,
            'category'                => __('Theme Elements', 'js_composer'),
            'params'                  => oxy_option_to_vc_option( $shortcode_options['sharing'] )
        ));

        vc_map( array(
            'name'                    => $shortcode_options['vc_video']['title'],
            'description'             => $shortcode_options['vc_video']['desc'],
            'base'                    => 'vc_video',
            'is_container'            => false,
            'icon'                    => 'icon-wpb-film-youtube',
            'show_settings_on_create' => true,
            'category'                => __('Theme Elements', 'js_composer'),
            'params'                  => oxy_option_to_vc_option( $shortcode_options['vc_video'] )
        ));
    }
    add_action( 'vc_before_init', 'oxy_init_vc_shortcodes' );

    function oxy_remove_vc_shortcodes() {

        // remove all vc shortcodes
        vc_remove_element( 'vc_tta_pageable' );
        // vc_remove_element( 'vc_row' );
        // vc_remove_element( 'vc_row_inner' );
        // vc_remove_element( 'vc_column_inner' );
        // vc_remove_element( 'vc_column' );
        // vc_remove_element( 'vc_column_text' );
        vc_remove_element( 'vc_twitter' );
        vc_remove_element( 'vc_text_separator' );
        // vc_remove_element( 'vc_separator' );
        // vc_remove_element( 'vc_message' );
        vc_remove_element( 'vc_facebook' );
        vc_remove_element( 'vc_tweetmeme' );
        vc_remove_element( 'vc_googleplus' );
        vc_remove_element( 'vc_pinterest' );
        vc_remove_element( 'vc_toggle' );
        // vc_remove_element( 'vc_single_image' );
        vc_remove_element( 'vc_gallery' );
        vc_remove_element( 'vc_images_carousel' );
        // vc_remove_element( 'vc_tabs' );
        vc_remove_element( 'vc_tta_tabs' );
        vc_remove_element( 'vc_tour' );
        vc_remove_element( 'vc_round_chart' );
        vc_remove_element( 'vc_line_chart' );
        vc_remove_element( 'vc_tta_tour' );
        // vc_remove_element( 'vc_tab' );
        // vc_remove_element( 'vc_accordion' );
        vc_remove_element( 'vc_tta_accordion' );
        // vc_remove_element( 'vc_accordion_tab' );
        vc_remove_element( 'vc_teaser_grid' );
        vc_remove_element( 'vc_posts_grid' );
        vc_remove_element( 'vc_carousel' );
        vc_remove_element( 'vc_posts_slider' );
        // vc_remove_element( 'vc_widget_sidebar' );
        vc_remove_element( 'vc_button' );
        vc_remove_element( 'vc_button2' );
        vc_remove_element( 'vc_cta_button' );
        vc_remove_element( 'vc_cta_button2' );
        vc_remove_element( 'vc_cta' );
        vc_remove_element( 'vc_btn' );
        // vc_remove_element( 'vc_video' );
        vc_remove_element( 'vc_gmaps' );
        vc_remove_element( 'vc_custom_heading' );
        //vc_remove_element( 'vc_raw_html' );
        //vc_remove_element( 'vc_raw_js' );
        vc_remove_element( 'vc_flickr' );
        vc_remove_element( 'vc_progress_bar' );
        vc_remove_element( 'vc_pie' );
        // vc_remove_element( 'contact-form-7' );
        // vc_remove_element( 'layerslider_vc' );
        // vc_remove_element( 'rev_slider_vc' );
        // vc_remove_element( 'gravityform' );
        vc_remove_element( 'vc_wp_search' );
        vc_remove_element( 'vc_wp_meta' );
        vc_remove_element( 'vc_wp_recentcomments' );
        vc_remove_element( 'vc_wp_calendar' );
        vc_remove_element( 'vc_wp_pages' );
        vc_remove_element( 'vc_wp_tagcloud' );
        vc_remove_element( 'vc_wp_custommenu' );
        vc_remove_element( 'vc_wp_text' );
        vc_remove_element( 'vc_wp_posts' );
        vc_remove_element( 'vc_wp_links' );
        vc_remove_element( 'vc_wp_categories' );
        vc_remove_element( 'vc_wp_archives' );
        vc_remove_element( 'vc_wp_rss' );
        vc_remove_element( 'vc_basic_grid' );
        vc_remove_element( 'vc_media_grid' );
        vc_remove_element( 'vc_masonry_grid' );
        vc_remove_element( 'vc_masonry_media_grid' );
        vc_remove_element( 'vc_icon' );
        // vc_remove_element( 'vc_empty_space' );
        // vc_remove_element( 'add_to_cart_url' );
        // vc_remove_element( 'product_attribute' );
    }
    add_action( 'init', 'oxy_remove_vc_shortcodes' );

}

/**
 * removes default VC templates when you edit an empty page
 *
 * @return void
 * @author
 **/
function oxy_remove_templates_from_vc_welcome($templates)
{
    return array();
}
add_filter('vc_load_default_templates_welcome_block', 'oxy_remove_templates_from_vc_welcome');

/**
 * Deregisters Grid Elements post type for VC >= 4.4
 *
 * @return boolean
 * @author
 **/
if (! function_exists( 'unregister_vc_grid_element' ) )
{
    function unregister_vc_grid_element(){
        unregister_post_type( 'vc_grid_item' );
    }
    add_action('init', 'unregister_vc_grid_element', 20);
}
